<?php

namespace App\Http\Controllers;

use App\Models\ArsipSurat;
use Illuminate\Http\Request;

class ArsipSuratController extends Controller
{
    public function index(Request $request)
    {
        $arsips = ArsipSurat::with(['warga', 'template'])
            ->when($request->search, function ($q) use ($request) {
                $q->where('nomor_surat', 'like', '%' . $request->search . '%')
                    ->orWhereHas('warga', fn($q) => $q->where('nama', 'like', '%' . $request->search . '%'));
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('arsip.index', compact('arsips'));
    }

    public function destroy(ArsipSurat $arsip)
    {
        // Hapus file fisik jika ada
        $filePath = public_path($arsip->file_surat);
        if (file_exists($filePath)) {
            @unlink($filePath);
        }

        $arsip->delete();

        return redirect()->route('arsip.index')->with('success', 'Arsip surat berhasil dihapus.');
    }
}
