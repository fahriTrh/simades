@extends('app')

@section('content')
<main class="flex-1 overflow-y-auto p-5 lg:p-8">

    {{-- Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-7 animate-fade-up s1">
        <div>
            <h3 class="text-forest-900 font-bold text-xl">Generate Surat</h3>
            <p class="text-gray-400 text-sm mt-0.5">Pilih template dan warga untuk membuat surat otomatis</p>
        </div>
    </div>

    <form method="POST" action="{{ route('generate.generate') }}">
        @csrf
        <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">

            {{-- LEFT --}}
            <div class="xl:col-span-2 space-y-5">

                {{-- Pilih Template --}}
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden animate-fade-up s2">
                    <div class="px-6 py-4 border-b border-gray-100 flex items-center gap-3">
                        <div class="w-8 h-8 rounded-lg bg-forest-50 flex items-center justify-center">
                            <svg class="w-4 h-4 text-forest-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-forest-900 text-sm">Pilih Template Surat</h4>
                            <p class="text-gray-400 text-xs">Template yang akan digunakan</p>
                        </div>
                    </div>
                    <div class="p-6">
                        @if ($templates->isEmpty())
                        <div class="flex items-center gap-3 px-4 py-3 bg-yellow-50 border border-yellow-200 rounded-xl text-yellow-700 text-sm">
                            <svg class="w-4 h-4 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
                            </svg>
                            Belum ada template. <a href="{{ route('template.create') }}" class="font-semibold underline ml-1">Tambah template</a>
                        </div>
                        @else
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            @foreach ($templates as $tmpl)
                            <label class="cursor-pointer">
                                <input type="radio" name="template_id" value="{{ $tmpl->id }}" class="peer hidden">
                                <div class="flex items-center gap-3 px-4 py-3 rounded-xl border-2 border-gray-100 bg-gray-50 peer-checked:border-forest-400 peer-checked:bg-forest-50 transition-all hover:border-gray-200">
                                    <div class="w-8 h-8 rounded-lg bg-white border border-gray-200 peer-checked:border-forest-200 flex items-center justify-center flex-shrink-0">
                                        <svg class="w-4 h-4 text-forest-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                                        </svg>
                                    </div>
                                    <span class="text-sm font-semibold text-forest-900 leading-tight">{{ $tmpl->nama_template }}</span>
                                </div>
                            </label>
                            @endforeach
                        </div>
                        @error('template_id')
                        <p class="text-xs text-red-500 mt-2">{{ $message }}</p>
                        @enderror
                        @endif
                    </div>
                </div>

                {{-- Pilih Warga --}}
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden animate-fade-up s3">
                    <div class="px-6 py-4 border-b border-gray-100 flex items-center gap-3">
                        <div class="w-8 h-8 rounded-lg bg-earth-50 flex items-center justify-center">
                            <svg class="w-4 h-4 text-earth-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-forest-900 text-sm">Pilih Warga</h4>
                            <p class="text-gray-400 text-xs">Data warga yang akan dimasukkan ke surat</p>
                        </div>
                    </div>
                    <div class="p-6 space-y-4">

                        {{-- Search warga --}}
                        <div class="relative">
                            <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 15.803a7.5 7.5 0 0010.607 10.607z" />
                            </svg>
                            <input type="text" id="searchWarga" placeholder="Cari nama atau NIK warga..."
                                oninput="filterWarga(this.value)"
                                class="w-full pl-9 pr-4 py-2.5 text-sm border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-forest-300 bg-gray-50 placeholder-gray-300 text-gray-700">
                        </div>

                        {{-- List warga --}}
                        <div id="wargaList" class="space-y-2 max-h-72 overflow-y-auto pr-1">
                            @forelse ($wargas as $w)
                            <label class="warga-item cursor-pointer block"
                                data-nama="{{ strtolower($w->nama) }}"
                                data-nik="{{ $w->nik }}">
                                <input type="radio" name="warga_id" value="{{ $w->id }}" class="peer hidden">
                                <div class="flex items-center gap-3 px-4 py-3 rounded-xl border-2 border-gray-100 bg-gray-50 peer-checked:border-earth-400 peer-checked:bg-earth-50 transition-all hover:border-gray-200">
                                    <div class="w-9 h-9 rounded-full flex items-center justify-center flex-shrink-0 font-bold text-xs {{ $w->jenis_kelamin === 'Laki-laki' ? 'bg-blue-100 text-blue-700' : 'bg-pink-100 text-pink-600' }}">
                                        {{ strtoupper(substr($w->nama, 0, 2)) }}
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-semibold text-gray-800 truncate">{{ $w->nama }}</p>
                                        <p class="text-xs text-gray-400 font-mono">{{ $w->nik }}</p>
                                    </div>
                                    <span class="text-[11px] font-semibold px-2 py-0.5 rounded-full flex-shrink-0 {{ $w->jenis_kelamin === 'Laki-laki' ? 'bg-blue-50 text-blue-600' : 'bg-pink-50 text-pink-500' }}">
                                        {{ $w->jenis_kelamin }}
                                    </span>
                                </div>
                            </label>
                            @empty
                            <p class="text-sm text-gray-400 text-center py-4">Belum ada data warga.</p>
                            @endforelse
                        </div>
                        <p id="emptySearch" class="hidden text-sm text-gray-400 text-center py-4">Warga tidak ditemukan.</p>

                        @error('warga_id')
                        <p class="text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

            </div>

            {{-- RIGHT --}}
            <div class="space-y-5">

                {{-- Info --}}
                <div class="bg-gradient-to-br from-forest-700 to-forest-900 rounded-2xl p-5 text-white shadow-lg animate-fade-up s2">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-10 h-10 rounded-xl bg-white/10 flex items-center justify-center">
                            <svg class="w-5 h-5 text-forest-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 003.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 003.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 00-3.09 3.09z" />
                            </svg>
                        </div>
                        <div>
                            <p class="font-bold text-sm">Cara Generate Surat</p>
                            <p class="text-forest-400 text-xs">3 langkah mudah</p>
                        </div>
                    </div>
                    <ul class="space-y-3">
                        <li class="flex items-start gap-2 text-xs text-forest-200">
                            <span class="w-5 h-5 rounded-full bg-forest-600 flex items-center justify-center flex-shrink-0 mt-0.5 text-[10px] font-bold text-white">1</span>
                            Pilih template surat yang akan digunakan.
                        </li>
                        <li class="flex items-start gap-2 text-xs text-forest-200">
                            <span class="w-5 h-5 rounded-full bg-forest-600 flex items-center justify-center flex-shrink-0 mt-0.5 text-[10px] font-bold text-white">2</span>
                            Pilih warga yang datanya akan dimasukkan ke surat.
                        </li>
                        <li class="flex items-start gap-2 text-xs text-forest-200">
                            <span class="w-5 h-5 rounded-full bg-forest-600 flex items-center justify-center flex-shrink-0 mt-0.5 text-[10px] font-bold text-white">3</span>
                            Klik tombol Generate — file .docx akan otomatis terunduh.
                        </li>
                    </ul>
                </div>

                {{-- Nomor Surat & Keterangan --}}
                <div class="space-y-3">
                    <div>
                        <label class="text-xs font-semibold text-gray-500 mb-1.5 block">Nomor Surat</label>
                        <input
                            type="text"
                            name="nomor_surat"
                            value="{{ old('nomor_surat', $nomorSuratTerbaru ?? '') }}"
                            placeholder="Masukkan nomor surat"
                            class="w-full px-3 py-2.5 text-sm border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-forest-300 bg-gray-50 placeholder-gray-300 text-gray-700 @error('nomor_surat') border-red-400 @enderror">
                        @error('nomor_surat')
                        <p class="text-[11px] text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                        @if($nomorSuratTerbaru ?? false)
                        <p class="text-[11px] text-gray-400 mt-1">Diisi dari nomor surat terakhir, ubah jika perlu.</p>
                        @endif
                    </div>

                    <div>
                        <label class="text-xs font-semibold text-gray-500 mb-1.5 block">
                            Keterangan <span class="font-normal text-gray-400">(opsional)</span>
                        </label>
                        <textarea
                            name="keterangan"
                            rows="3"
                            placeholder="Tambahkan keterangan jika diperlukan"
                            class="w-full px-3 py-2.5 text-sm border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-forest-300 bg-gray-50 placeholder-gray-300 text-gray-700 resize-none @error('keterangan') border-red-400 @enderror">{{ old('keterangan') }}</textarea>
                        @error('keterangan')
                        <p class="text-[11px] text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>


                {{-- Tombol --}}
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 space-y-3 animate-fade-up s3">

                    {{-- Pilih Format --}}
                    <!-- <div>
                        <p class="text-xs font-semibold text-gray-500 mb-2">Format Unduhan</p>
                        <div class="flex gap-2">
                            <label class="flex-1 cursor-pointer">
                                <input type="radio" name="format" value="docx" class="peer hidden" checked>
                                <div class="flex items-center justify-center gap-1.5 px-3 py-2 rounded-xl border-2 border-gray-100 bg-gray-50 peer-checked:border-forest-400 peer-checked:bg-forest-50 transition-all text-xs font-semibold text-gray-600 peer-checked:text-forest-700">
                                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                                    </svg>
                                    .docx
                                </div>
                            </label>
                            <label class="flex-1 cursor-pointer">
                                <input type="radio" name="format" value="pdf" class="peer hidden">
                                <div class="flex items-center justify-center gap-1.5 px-3 py-2 rounded-xl border-2 border-gray-100 bg-gray-50 peer-checked:border-red-400 peer-checked:bg-red-50 transition-all text-xs font-semibold text-gray-600 peer-checked:text-red-600">
                                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                                    </svg>
                                    .pdf
                                </div>
                            </label>
                        </div>
                    </div> -->
                    <button type="submit"
                        class="w-full flex items-center justify-center gap-2 bg-forest-600 hover:bg-forest-700 text-white text-sm font-bold px-4 py-3 rounded-xl transition-all shadow-sm hover:shadow-md">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3" />
                        </svg>
                        Generate & Unduh Surat
                    </button>
                    <p class="text-[11px] text-gray-400 text-center">File akan diunduh dalam format <span class="font-semibold">.docx</span></p>
                </div>

            </div>
        </div>
    </form>

</main>

<script>
    function filterWarga(keyword) {
        const items = document.querySelectorAll('.warga-item');
        const empty = document.getElementById('emptySearch');
        const q = keyword.toLowerCase();
        let visible = 0;

        items.forEach(item => {
            const nama = item.getAttribute('data-nama');
            const nik = item.getAttribute('data-nik');
            const show = nama.includes(q) || nik.includes(q);
            item.style.display = show ? 'block' : 'none';
            if (show) visible++;
        });

        empty.classList.toggle('hidden', visible > 0);
    }
</script>

@endsection