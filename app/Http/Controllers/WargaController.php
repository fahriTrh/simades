<?php

namespace App\Http\Controllers;

use App\Models\Warga;
use Illuminate\Http\Request;

class WargaController extends Controller
{
    public function index(Request $request)
    {
        $query = Warga::query();

        if ($request->filled('search')) {
            $query->where('nama', 'like', '%' . $request->search . '%')
                ->orWhere('nik', 'like', '%' . $request->search . '%');
        }

        $wargas = $query->latest()->paginate(20)->withQueryString();

        return view('warga.index', compact('wargas'));
    }

    public function show(Warga $warga)
    {
        return view('warga.detail', compact('warga'));
    }

    public function create()
    {
        return view('warga.tambah');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nik'               => 'nullable|digits:16|unique:wargas,nik',
            'nama'              => 'nullable|string|max:255',
            'tempat_lahir'      => 'nullable|string|max:255',
            'tanggal_lahir'     => 'nullable|date',
            'jenis_kelamin'     => 'nullable|in:Laki-laki,Perempuan',
            'agama'             => 'nullable|string',
            'status_perkawinan' => 'nullable|string',
            'alamat'            => 'nullable|string',
            'pekerjaan'         => 'nullable|string',
            'nomor_telepon'     => 'nullable|string|max:20',
        ]);

        Warga::create($request->only([
            'nik',
            'nama',
            'tempat_lahir',
            'tanggal_lahir',
            'jenis_kelamin',
            'agama',
            'status_perkawinan',
            'alamat',
            'pekerjaan',
            'nomor_telepon',
        ]));

        return redirect()->route('warga.index')
            ->with('success', 'Data warga berhasil ditambahkan.');
    }

    public function edit(Warga $warga)
    {
        return view('warga.edit', compact('warga'));
    }

    public function update(Request $request, Warga $warga)
    {
        $request->validate([
            'nik'               => 'required|digits:16|unique:wargas,nik,' . $warga->id,
            'nama'              => 'required|string|max:255',
            'tempat_lahir'      => 'required|string|max:255',
            'tanggal_lahir'     => 'required|date',
            'jenis_kelamin'     => 'required|in:Laki-laki,Perempuan',
            'agama'             => 'required|string',
            'status_perkawinan' => 'required|string',
            'alamat'            => 'required|string',
            'pekerjaan'         => 'nullable|string',
            'nomor_telepon'     => 'nullable|string|max:20',
        ]);

        $warga->update($request->only([
            'nik',
            'nama',
            'tempat_lahir',
            'tanggal_lahir',
            'jenis_kelamin',
            'agama',
            'status_perkawinan',
            'alamat',
            'pekerjaan',
            'nomor_telepon',
        ]));

        return redirect()->route('warga.index')
            ->with('success', 'Data warga berhasil diperbarui.');
    }

    public function destroy(Warga $warga)
    {
        $warga->delete();

        return redirect()->route('warga.index')
            ->with('success', 'Data warga berhasil dihapus.');
    }
}
