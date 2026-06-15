@extends('app')

@section('content')
<main class="flex-1 overflow-y-auto p-5 lg:p-8">

    {{-- Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-7 animate-fade-up s1">
        <div>
            <div class="flex items-center gap-2 mb-1">
                <a href="{{ route('template.index') }}" class="text-gray-400 hover:text-forest-600 transition-colors">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                    </svg>
                </a>
                <span class="text-gray-400 text-sm">Template Surat</span>
                <svg class="w-3 h-3 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                </svg>
                <span class="text-forest-700 text-sm font-semibold">Edit Template</span>
            </div>
            <h3 class="text-forest-900 font-bold text-xl">Edit Template Surat</h3>
            <p class="text-gray-400 text-sm mt-0.5">Ubah nama atau ganti file Word template</p>
        </div>
        <a href="{{ route('template.index') }}"
            class="inline-flex items-center gap-2 bg-gray-100 hover:bg-gray-200 text-gray-600 text-sm font-semibold px-4 py-2.5 rounded-xl transition-colors flex-shrink-0">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 15L3 9m0 0l6-6M3 9h12a6 6 0 010 12h-3" />
            </svg>
            Kembali
        </a>
    </div>

    <form method="POST" action="{{ route('template.update', $template->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">

            {{-- LEFT --}}
            <div class="xl:col-span-2 space-y-5">

                {{-- Form Upload --}}
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden animate-fade-up s2">
                    <div class="px-6 py-4 border-b border-gray-100 flex items-center gap-3">
                        <div class="w-8 h-8 rounded-lg bg-forest-50 flex items-center justify-center">
                            <svg class="w-4 h-4 text-forest-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-forest-900 text-sm">Informasi Template</h4>
                            <p class="text-gray-400 text-xs">Nama dan file dokumen Word</p>
                        </div>
                    </div>
                    <div class="p-6 space-y-5">

                        {{-- Nama Template --}}
                        <div>
                            <label class="block text-xs font-bold text-gray-600 uppercase tracking-wider mb-1.5">
                                Nama Template <span class="text-red-400">*</span>
                            </label>
                            <input type="text" name="nama_template" value="{{ old('nama_template', $template->nama_template) }}"
                                placeholder="Contoh: Surat Keterangan Domisili"
                                class="w-full px-4 py-2.5 text-sm border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-forest-300 focus:border-forest-400 bg-gray-50 placeholder-gray-300 text-gray-800 transition-all">
                            @error('nama_template')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Tambahkan info file lama di atas label upload --}}
                        @if ($template->file_word)
                        <a href="{{ asset('templates/' . $template->file_word) }}" download
                            class="flex items-center gap-3 px-4 py-3 bg-forest-50 border border-forest-100 rounded-xl mb-3 hover:bg-forest-100 hover:border-forest-200 transition-colors group">
                            <svg class="w-4 h-4 text-forest-500 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                            </svg>
                            <div class="flex-1 overflow-hidden">
                                <p class="text-xs font-semibold text-forest-700">File saat ini:</p>
                                <p class="text-xs text-forest-500 font-mono truncate">{{ $template->file_word }}</p>
                            </div>
                            <svg class="w-4 h-4 text-forest-400 group-hover:text-forest-600 flex-shrink-0 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3" />
                            </svg>
                        </a>
                        @endif

                        {{-- Upload File --}}
                        <div>
                            <label class="block text-xs font-bold text-gray-600 uppercase tracking-wider mb-1.5">
                                File Word (.docx) <span class="text-red-400">*</span>
                            </label>
                            <label for="file_word"
                                class="flex flex-col items-center justify-center w-full h-36 border-2 border-dashed border-gray-200 rounded-xl cursor-pointer bg-gray-50 hover:bg-forest-50 hover:border-forest-300 transition-all group">
                                <div id="uploadPlaceholder" class="flex flex-col items-center gap-2">
                                    <svg class="w-8 h-8 text-gray-300 group-hover:text-forest-400 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5" />
                                    </svg>
                                    <p class="text-sm text-gray-400 group-hover:text-forest-600 transition-colors">Klik untuk upload file <span class="font-semibold">.docx</span></p>
                                    <p class="text-xs text-gray-300">Maksimal 5MB</p>
                                </div>
                                <div id="uploadPreview" class="hidden flex-col items-center gap-2">
                                    <svg class="w-8 h-8 text-forest-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                                    </svg>
                                    <p id="uploadFileName" class="text-sm font-semibold text-forest-700"></p>
                                    <p class="text-xs text-gray-400">Klik untuk ganti file</p>
                                </div>
                                <input type="file" id="file_word" name="file_word" accept=".docx" class="hidden"
                                    onchange="previewFile(this)">
                            </label>
                            @error('file_word')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                    </div>
                </div>

                {{-- Placeholder chips --}}
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden animate-fade-up s3">
                    <div class="px-6 py-4 border-b border-gray-100 flex items-center gap-3">
                        <div class="w-8 h-8 rounded-lg bg-earth-50 flex items-center justify-center">
                            <svg class="w-4 h-4 text-earth-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 6.75L22.5 12l-5.25 5.25m-10.5 0L1.5 12l5.25-5.25m7.5-3l-4.5 16.5" />
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-forest-900 text-sm">Daftar Placeholder</h4>
                            <p class="text-gray-400 text-xs">Klik untuk menyalin, lalu tempel di dokumen Word Anda</p>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex flex-wrap gap-2">
                            @foreach ($fields as $field)
                            <button type="button"
                                data-field="{{ $field }}"
                                onclick="copyPlaceholder(this)"
                                class="chip-btn inline-flex items-center gap-1.5 px-3 py-1.5 bg-forest-50 hover:bg-forest-100 border border-forest-200 text-forest-700 text-xs font-mono font-semibold rounded-lg transition-all hover:shadow-sm">
                                <svg class="w-3 h-3 icon-copy" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.666 3.888A2.25 2.25 0 0013.5 2.25h-3c-1.03 0-1.9.693-2.166 1.638m7.332 0c.055.194.084.4.084.612v0a.75.75 0 01-.75.75H9a.75.75 0 01-.75-.75v0c0-.212.03-.418.084-.612m7.332 0c.646.049 1.288.11 1.927.184 1.1.128 1.907 1.077 1.907 2.185V19.5a2.25 2.25 0 01-2.25 2.25H6.75A2.25 2.25 0 014.5 19.5V6.257c0-1.108.806-2.057 1.907-2.185a48.208 48.208 0 011.927-.184" />
                                </svg>
                                <span class="chip-label">&lt;&lt;{{ $field }}&gt;&gt;</span>
                            </button>
                            @endforeach
                        </div>
                        <p class="text-[11px] text-gray-400 mt-4 leading-relaxed">
                            Tulis placeholder ini langsung di dokumen Word Anda pada posisi yang diinginkan.
                            Contoh: <span class="font-mono bg-gray-100 px-1 rounded text-gray-600">menerangkan bahwa <strong>&lt;&lt;nama&gt;&gt;</strong> dengan NIK <strong>&lt;&lt;nik&gt;&gt;</strong>...</span>
                        </p>
                    </div>
                </div>

            </div>

            {{-- RIGHT --}}
            <div class="space-y-5">

                {{-- Panduan --}}
                <div class="bg-gradient-to-br from-forest-700 to-forest-900 rounded-2xl p-5 text-white shadow-lg animate-fade-up s3">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-10 h-10 rounded-xl bg-white/10 flex items-center justify-center">
                            <svg class="w-5 h-5 text-forest-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
                            </svg>
                        </div>
                        <div>
                            <p class="font-bold text-sm">Cara Membuat Template</p>
                            <p class="text-forest-400 text-xs">Ikuti langkah berikut</p>
                        </div>
                    </div>
                    <ul class="space-y-3">
                        <li class="flex items-start gap-2 text-xs text-forest-200">
                            <span class="w-5 h-5 rounded-full bg-forest-600 flex items-center justify-center flex-shrink-0 mt-0.5 text-[10px] font-bold text-white">1</span>
                            Buat dokumen surat di Microsoft Word seperti biasa dengan format yang diinginkan.
                        </li>
                        <li class="flex items-start gap-2 text-xs text-forest-200">
                            <span class="w-5 h-5 rounded-full bg-forest-600 flex items-center justify-center flex-shrink-0 mt-0.5 text-[10px] font-bold text-white">2</span>
                            Salin placeholder di sebelah kiri (contoh: <span class="font-mono bg-white/10 px-1 rounded">&lt;&lt;nama&gt;&gt;</span>) lalu tempel di posisi yang sesuai dalam dokumen Word.
                        </li>
                        <li class="flex items-start gap-2 text-xs text-forest-200">
                            <span class="w-5 h-5 rounded-full bg-forest-600 flex items-center justify-center flex-shrink-0 mt-0.5 text-[10px] font-bold text-white">3</span>
                            Simpan file dalam format <span class="font-mono bg-white/10 px-1 rounded">.docx</span> (bukan .doc atau .pdf).
                        </li>
                        <li class="flex items-start gap-2 text-xs text-forest-200">
                            <span class="w-5 h-5 rounded-full bg-forest-600 flex items-center justify-center flex-shrink-0 mt-0.5 text-[10px] font-bold text-white">4</span>
                            Upload file di halaman ini. Sistem akan otomatis mengganti placeholder dengan data warga saat generate surat.
                        </li>
                    </ul>
                </div>

                {{-- Contoh placeholder --}}
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden animate-fade-up s4">
                    <div class="px-5 py-4 border-b border-gray-100">
                        <h4 class="font-bold text-forest-900 text-sm">Contoh Penggunaan</h4>
                    </div>
                    <div class="p-5 space-y-3">
                        @foreach ([
                        ['f' => 'nama', 'k' => 'Nama lengkap warga'],
                        ['f' => 'nik', 'k' => 'NIK 16 digit'],
                        ['f' => 'tempat_lahir', 'k' => 'Kota tempat lahir'],
                        ['f' => 'tanggal_lahir', 'k' => 'Tanggal lahir'],
                        ['f' => 'alamat', 'k' => 'Alamat lengkap'],
                        ['f' => 'pekerjaan', 'k' => 'Pekerjaan warga'],
                        ['f' => 'status_perkawinan', 'k' => 'Status perkawinan'],
                        ] as $contoh)
                        <div class="flex items-center justify-between gap-3">
                            <span class="font-mono text-xs bg-forest-50 text-forest-700 px-2 py-1 rounded-lg border border-forest-100 whitespace-nowrap">
                                &lt;&lt;{{ $contoh['f'] }}&gt;&gt;
                            </span>
                            <span class="text-xs text-gray-400 text-right">{{ $contoh['k'] }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>

                {{-- Tombol --}}
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 space-y-3 animate-fade-up s5">
                    <button type="submit"
                        class="w-full flex items-center justify-center gap-2 bg-forest-600 hover:bg-forest-700 text-white text-sm font-bold px-4 py-3 rounded-xl transition-all shadow-sm hover:shadow-md">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Simpan Template
                    </button>
                    <a href="{{ route('template.index') }}"
                        class="w-full flex items-center justify-center gap-2 bg-gray-50 hover:bg-gray-100 text-gray-500 text-sm font-semibold px-4 py-2.5 rounded-xl transition-colors border border-gray-200">
                        Batal
                    </a>
                </div>

            </div>
        </div>
    </form>

</main>

<script>
    function previewFile(input) {
        const placeholder = document.getElementById('uploadPlaceholder');
        const preview = document.getElementById('uploadPreview');
        const fileName = document.getElementById('uploadFileName');

        if (input.files && input.files[0]) {
            fileName.textContent = input.files[0].name;
            placeholder.classList.add('hidden');
            preview.classList.remove('hidden');
            preview.classList.add('flex');
        }
    }

    function copyPlaceholder(btn) {
        const field = btn.getAttribute('data-field');
        const text = '<<' + field + '>>';

        navigator.clipboard.writeText(text).then(() => {
            const label = btn.querySelector('.chip-label');
            const icon = btn.querySelector('.icon-copy');

            const originalLabel = label.innerHTML;
            label.textContent = 'Disalin!';
            icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/>';

            btn.classList.add('bg-forest-600', 'text-white', 'border-forest-600');
            btn.classList.remove('bg-forest-50', 'text-forest-700', 'border-forest-200');

            setTimeout(() => {
                label.innerHTML = originalLabel;
                icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" d="M15.666 3.888A2.25 2.25 0 0013.5 2.25h-3c-1.03 0-1.9.693-2.166 1.638m7.332 0c.055.194.084.4.084.612v0a.75.75 0 01-.75.75H9a.75.75 0 01-.75-.75v0c0-.212.03-.418.084-.612m7.332 0c.646.049 1.288.11 1.927.184 1.1.128 1.907 1.077 1.907 2.185V19.5a2.25 2.25 0 01-2.25 2.25H6.75A2.25 2.25 0 014.5 19.5V6.257c0-1.108.806-2.057 1.907-2.185a48.208 48.208 0 011.927-.184" />';
                btn.classList.remove('bg-forest-600', 'text-white', 'border-forest-600');
                btn.classList.add('bg-forest-50', 'text-forest-700', 'border-forest-200');
            }, 1500);
        });
    }
</script>

@endsection