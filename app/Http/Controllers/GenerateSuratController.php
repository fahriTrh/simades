<?php

namespace App\Http\Controllers;

use App\Models\Warga;
use App\Models\TemplateSurat;
use Illuminate\Http\Request;
use PhpOffice\PhpWord\TemplateProcessor;
use App\Models\ArsipSurat;
use Illuminate\Support\Facades\Auth;

class GenerateSuratController extends Controller
{
    public function index()
    {
        $templates = TemplateSurat::latest()->get();
        $wargas    = Warga::orderBy('nama')->get();
        $nomorSuratTerbaru = ArsipSurat::latest('id')->value('nomor_surat');

        return view('generate.index', compact('templates', 'wargas', 'nomorSuratTerbaru'));
    }

    public function generate(Request $request)
    {
        $request->validate([
            'nomor_surat' => 'required|string|unique:arsip_surats,nomor_surat',
            'keterangan'  => 'nullable|string',
            'template_id' => 'required|exists:template_surats,id',
            'warga_id'    => 'required|exists:wargas,id',
        ]);

        $template = TemplateSurat::findOrFail($request->template_id);
        $warga    = Warga::findOrFail($request->warga_id);

        $filePath = public_path('templates/' . $template->file_word);

        if (!file_exists($filePath)) {
            return back()->with('error', 'File template tidak ditemukan.');
        }

        // Siapkan folder generated
        if (!file_exists(public_path('generated'))) {
            mkdir(public_path('generated'), 0755, true);
        }

        $outputName = 'surat_' . str_replace(' ', '_', strtolower($warga->nama)) . '_' . time() . '.docx';
        $outputPath = public_path('generated/' . $outputName);
        copy($filePath, $outputPath);

        // Replace placeholder di document.xml
        $zip = new \ZipArchive();
        if ($zip->open($outputPath) === true) {
            $xml = $zip->getFromName('word/document.xml');

            $replacements = [
                '&lt;&lt;nik&gt;&gt;'               => $warga->nik ?? '-',
                '&lt;&lt;nama&gt;&gt;'              => $warga->nama ?? '-',
                '&lt;&lt;tempat_lahir&gt;&gt;'      => $warga->tempat_lahir ?? '-',
                '&lt;&lt;tanggal_lahir&gt;&gt;'     => $warga->tanggal_lahir
                    ? \Carbon\Carbon::parse($warga->tanggal_lahir)->isoFormat('D MMMM Y')
                    : '-',
                '&lt;&lt;jenis_kelamin&gt;&gt;'     => $warga->jenis_kelamin ?? '-',
                '&lt;&lt;alamat&gt;&gt;'            => $warga->alamat ?? '-',
                '&lt;&lt;agama&gt;&gt;'             => $warga->agama ?? '-',
                '&lt;&lt;pekerjaan&gt;&gt;'         => $warga->pekerjaan ?? '-',
                '&lt;&lt;status_perkawinan&gt;&gt;' => $warga->status_perkawinan ?? '-',
                '&lt;&lt;nomor_telepon&gt;&gt;'     => $warga->nomor_telepon ?? '-',
                '<<nik>>'               => $warga->nik ?? '-',
                '<<nama>>'              => $warga->nama ?? '-',
                '<<tempat_lahir>>'      => $warga->tempat_lahir ?? '-',
                '<<tanggal_lahir>>'     => $warga->tanggal_lahir
                    ? \Carbon\Carbon::parse($warga->tanggal_lahir)->isoFormat('D MMMM Y')
                    : '-',
                '<<jenis_kelamin>>'     => $warga->jenis_kelamin ?? '-',
                '<<alamat>>'            => $warga->alamat ?? '-',
                '<<agama>>'             => $warga->agama ?? '-',
                '<<pekerjaan>>'         => $warga->pekerjaan ?? '-',
                '<<status_perkawinan>>' => $warga->status_perkawinan ?? '-',
                '<<nomor_telepon>>'     => $warga->nomor_telepon ?? '-',
            ];

            $xml = str_replace(array_keys($replacements), array_values($replacements), $xml);
            $zip->addFromString('word/document.xml', $xml);
            $zip->close();
        } else {
            return back()->with('error', 'Gagal membuka file template.');
        }

        // Konversi ke PDF jika diminta
        if ($request->format === 'pdf') {
            $phpWord    = \PhpOffice\PhpWord\IOFactory::load($outputPath);
            $htmlWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'HTML');
            $htmlPath   = public_path('generated/tmp_' . time() . '.html');
            $htmlWriter->save($htmlPath);

            $html = file_get_contents($htmlPath);
            @unlink($htmlPath);
            @unlink($outputPath); // hapus docx sementara

            $pdf     = app('dompdf.wrapper');
            $pdf->loadHTML($html);
            $pdf->setPaper('A4', 'portrait');

            $finalName = str_replace('.docx', '.pdf', $outputName);
            $finalPath = public_path('generated/' . $finalName);
            file_put_contents($finalPath, $pdf->output());
        } else {
            $finalName = $outputName;
            $finalPath = $outputPath;
        }

        // Simpan ke arsip surat
        ArsipSurat::create([
            'warga_id'      => $warga->id,
            'template_id'   => $template->id,
            'created_by'    => Auth::guard('admin')->id(),
            'nomor_surat'   => $request->nomor_surat,
            'tanggal_surat' => now()->toDateString(),
            'file_surat'    => 'generated/' . $finalName,
            'keterangan'    => $request->keterangan,
        ]);

        return response()->download($finalPath, $finalName);
    }
}
