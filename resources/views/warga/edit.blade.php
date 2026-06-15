@extends('app')

@section('content')

<main class="flex-1 overflow-y-auto p-5 lg:p-8">

    {{-- Page Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-7 animate-fade-up s1">
        <div>
            <div class="flex items-center gap-2 mb-1">
                <a href="#" class="text-gray-400 hover:text-forest-600 transition-colors">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                    </svg>
                </a>
                <span class="text-gray-400 text-sm">Data Warga</span>
                <svg class="w-3 h-3 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                </svg>
                <span class="text-forest-700 text-sm font-semibold">Edit Warga</span>
            </div>
            <h3 class="text-forest-900 font-bold text-xl">Edit Data Warga</h3>
            <p class="text-gray-400 text-sm mt-0.5">Isi formulir di bawah untuk mengubah data warga</p>
        </div>
        <a href="{{ route('warga.index') }}"
            class="inline-flex items-center gap-2 bg-gray-100 hover:bg-gray-200 text-gray-600 text-sm font-semibold px-4 py-2.5 rounded-xl transition-colors flex-shrink-0">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 15L3 9m0 0l6-6M3 9h12a6 6 0 010 12h-3" />
            </svg>
            Kembali
        </a>
    </div>

    {{-- Form Card --}}
    <form method="POST" action="{{ route('warga.update', $warga->id) }}" class="animate-fade-up s2">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">

            {{-- LEFT: Main Form --}}
            <div class="xl:col-span-2 space-y-5">

                {{-- Section: Identitas Utama --}}
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-100 flex items-center gap-3">
                        <div class="w-8 h-8 rounded-lg bg-forest-50 flex items-center justify-center">
                            <svg class="w-4 h-4 text-forest-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-forest-900 text-sm">Identitas Utama</h4>
                            <p class="text-gray-400 text-xs">Data kependudukan dasar</p>
                        </div>
                    </div>
                    <div class="p-6 grid grid-cols-1 sm:grid-cols-2 gap-5">

                        {{-- NIK --}}
                        <div class="sm:col-span-2">
                            <label class="block text-xs font-bold text-gray-600 uppercase tracking-wider mb-1.5">
                                NIK <span class="text-red-400">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute left-3 top-1/2 -translate-y-1/2">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 9h3.75M15 12h3.75M15 15h3.75M4.5 19.5h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5zm6-10.125a1.875 1.875 0 11-3.75 0 1.875 1.875 0 013.75 0zm1.294 6.336a6.721 6.721 0 01-3.17.789 6.721 6.721 0 01-3.168-.789 3.376 3.376 0 016.338 0z" />
                                    </svg>
                                </div>
                                <input type="text" name="nik" value="{{ old('nik', $warga->nik) }}" maxlength="16" placeholder="16 digit NIK"
                                    class="w-full pl-10 pr-4 py-2.5 text-sm border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-forest-300 focus:border-forest-400 bg-gray-50 placeholder-gray-300 text-gray-800 font-mono tracking-wide transition-all">
                            </div>
                            <p class="text-[11px] text-gray-400 mt-1">Nomor Induk Kependudukan 16 digit sesuai KTP</p>
                        </div>

                        {{-- Nama --}}
                        <div class="sm:col-span-2">
                            <label class="block text-xs font-bold text-gray-600 uppercase tracking-wider mb-1.5">
                                Nama Lengkap <span class="text-red-400">*</span>
                            </label>
                            <input type="text" name="nama" value="{{ old('nama', $warga->nama) }}" placeholder="Nama sesuai KTP"
                                class="w-full px-4 py-2.5 text-sm border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-forest-300 focus:border-forest-400 bg-gray-50 placeholder-gray-300 text-gray-800 transition-all">
                        </div>

                        {{-- Tempat Lahir --}}
                        <div>
                            <label class="block text-xs font-bold text-gray-600 uppercase tracking-wider mb-1.5">
                                Tempat Lahir <span class="text-red-400">*</span>
                            </label>
                            <input type="text" name="tempat_lahir" value="{{ old('tempat_lahir', $warga->tempat_lahir) }}" placeholder="Kota tempat lahir"
                                class="w-full px-4 py-2.5 text-sm border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-forest-300 focus:border-forest-400 bg-gray-50 placeholder-gray-300 text-gray-800 transition-all">
                        </div>

                        {{-- Tanggal Lahir --}}
                        <div>
                            <label class="block text-xs font-bold text-gray-600 uppercase tracking-wider mb-1.5">
                                Tanggal Lahir <span class="text-red-400">*</span>
                            </label>
                            <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir', $warga->tanggal_lahir) }}"
                                class="w-full px-4 py-2.5 text-sm border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-forest-300 focus:border-forest-400 bg-gray-50 text-gray-800 transition-all">
                        </div>

                        {{-- Jenis Kelamin --}}
                        <div>
                            <label class="block text-xs font-bold text-gray-600 uppercase tracking-wider mb-1.5">
                                Jenis Kelamin <span class="text-red-400">*</span>
                            </label>
                            <div class="flex gap-3">
                                <label class="flex-1 cursor-pointer">
                                    <input type="radio" name="jenis_kelamin" value="Laki-laki" {{ old('jenis_kelamin', $warga->jenis_kelamin) === 'Laki-laki' ? 'checked' : '' }} class="peer hidden">
                                    <div class="flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl border-2 border-gray-200 text-sm font-semibold text-gray-400 bg-gray-50 peer-checked:border-blue-400 peer-checked:bg-blue-50 peer-checked:text-blue-600 transition-all hover:border-gray-300">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                                        </svg>
                                        Laki-laki
                                    </div>
                                </label>
                                <label class="flex-1 cursor-pointer">
                                    <input type="radio" name="jenis_kelamin" value="Perempuan" {{ old('jenis_kelamin', $warga->jenis_kelamin) === 'Perempuan' ? 'checked' : '' }} class="peer hidden">
                                    <div class="flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl border-2 border-gray-200 text-sm font-semibold text-gray-400 bg-gray-50 peer-checked:border-pink-400 peer-checked:bg-pink-50 peer-checked:text-pink-600 transition-all hover:border-gray-300">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                                        </svg>
                                        Perempuan
                                    </div>
                                </label>
                            </div>
                        </div>

                        {{-- Agama --}}
                        <div>
                            <label class="block text-xs font-bold text-gray-600 uppercase tracking-wider mb-1.5">
                                Agama <span class="text-red-400">*</span>
                            </label>
                            <div class="relative">
                                <select name="agama"
                                    class="w-full appearance-none px-4 py-2.5 text-sm border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-forest-300 focus:border-forest-400 bg-gray-50 text-gray-800 transition-all pr-10">
                                    <option value="" disabled selected class="text-gray-300">Pilih agama</option>
                                    @foreach (['Islam','Kristen','Katolik','Hindu','Buddha','Konghucu'] as $agama)
                                    <option value="{{ $agama }}" {{ old('agama', $warga->agama) === $agama ? 'selected' : '' }}>
                                        {{ $agama }}
                                    </option>
                                    @endforeach
                                </select>
                                <svg class="absolute right-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400 pointer-events-none" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                </svg>
                            </div>
                        </div>

                    </div>
                </div>

                {{-- Section: Informasi Tambahan --}}
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden animate-fade-up s3">
                    <div class="px-6 py-4 border-b border-gray-100 flex items-center gap-3">
                        <div class="w-8 h-8 rounded-lg bg-earth-50 flex items-center justify-center">
                            <svg class="w-4 h-4 text-earth-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-forest-900 text-sm">Informasi Tambahan</h4>
                            <p class="text-gray-400 text-xs">Pekerjaan, status, dan alamat</p>
                        </div>
                    </div>
                    <div class="p-6 grid grid-cols-1 sm:grid-cols-2 gap-5">

                        {{-- Pekerjaan --}}
                        <div>
                            <label class="block text-xs font-bold text-gray-600 uppercase tracking-wider mb-1.5">
                                Pekerjaan
                            </label>
                            <div class="relative">
                                <select name="pekerjaan"
                                    class="w-full appearance-none px-4 py-2.5 text-sm border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-forest-300 focus:border-forest-400 bg-gray-50 text-gray-800 transition-all pr-10">
                                    <option value="" disabled selected>Pilih pekerjaan</option>
                                    @foreach (['Belum/Tidak Bekerja', 'Pelajar/Mahasiswa', 'Pegawai Negeri Sipil', 'TNI/Polri', 'Pegawai Swasta', 'Wiraswasta', 'Petani/Pekebun', 'Nelayan', 'Buruh', 'Ibu Rumah Tangga', 'Pensiunan', 'Lainnya'] as $item)
                                    <option value="{{ $item }}" {{ old('pekerjaan', $warga->pekerjaan) === $item ? 'selected' : '' }}>
                                        {{ $item === 'Pegawai Negeri Sipil' ? 'Pegawai Negeri Sipil (PNS)' : $item }}
                                    </option>
                                    @endforeach
                                </select>
                                <svg class="absolute right-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400 pointer-events-none" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                </svg>
                            </div>
                        </div>

                        {{-- Status Perkawinan --}}
                        <div>
                            <label class="block text-xs font-bold text-gray-600 uppercase tracking-wider mb-1.5">
                                Status Perkawinan <span class="text-red-400">*</span>
                            </label>
                            <div class="relative">
                                <select name="status_perkawinan"
                                    class="w-full appearance-none px-4 py-2.5 text-sm border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-forest-300 focus:border-forest-400 bg-gray-50 text-gray-800 transition-all pr-10">
                                    <option value="" disabled selected>Pilih status</option>
                                    @foreach (['Belum Kawin', 'Kawin', 'Cerai Hidup', 'Cerai Mati'] as $item)
                                    <option value="{{ $item }}" {{ old('status_perkawinan', $warga->status_perkawinan) === $item ? 'selected' : '' }}>
                                        {{ $item }}
                                    </option>
                                    @endforeach
                                </select>
                                <svg class="absolute right-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400 pointer-events-none" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                </svg>
                            </div>
                        </div>

                        {{-- Alamat --}}
                        <div class="sm:col-span-2">
                            <label class="block text-xs font-bold text-gray-600 uppercase tracking-wider mb-1.5">
                                Alamat Lengkap <span class="text-red-400">*</span>
                            </label>
                            <div class="relative">
                                <svg class="absolute left-3 top-3.5 w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                                </svg>
                                <textarea name="alamat" rows="3" placeholder="Jl. Nama Jalan No. X RT XX/RW XX, Desa/Kelurahan, Kecamatan"
                                    class="w-full pl-10 pr-4 py-2.5 text-sm border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-forest-300 focus:border-forest-400 bg-gray-50 placeholder-gray-300 text-gray-800 transition-all resize-none">
                                {{ old('alamat', $warga->alamat) }}
                                </textarea>
                            </div>
                        </div>

                        {{-- No. HP --}}
                        <div class="sm:col-span-2">
                            <label class="block text-xs font-bold text-gray-600 uppercase tracking-wider mb-1.5">
                                Nomor Telepon
                            </label>
                            <div class="relative">
                                <div class="absolute left-3 top-1/2 -translate-y-1/2 flex items-center gap-1.5">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z" />
                                    </svg>
                                    <span class="text-xs text-gray-400 font-semibold">+62</span>
                                </div>
                                <input type="tel" name="nomor_telepon" value="{{ old('nomor_telepon', $warga->nomor_telepon) }}" placeholder="8xx-xxxx-xxxx"
                                    class="w-full pl-16 pr-4 py-2.5 text-sm border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-forest-300 focus:border-forest-400 bg-gray-50 placeholder-gray-300 text-gray-800 font-mono tracking-wide transition-all">
                            </div>
                            <p class="text-[11px] text-gray-400 mt-1">Format: 08xx-xxxx-xxxx atau tanpa angka 0 di depan</p>
                        </div>

                    </div>
                </div>

            </div>

            {{-- RIGHT: Info Panel + Timestamps --}}
            <div class="space-y-5">

                {{-- Info Banner --}}
                <div class="bg-gradient-to-br from-forest-700 to-forest-900 rounded-2xl p-5 text-white shadow-lg animate-fade-up s3">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-10 h-10 rounded-xl bg-white/10 flex items-center justify-center">
                            <svg class="w-5 h-5 text-forest-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
                            </svg>
                        </div>
                        <div>
                            <p class="font-bold text-sm">Panduan Pengisian</p>
                            <p class="text-forest-400 text-xs">Pastikan data akurat</p>
                        </div>
                    </div>
                    <ul class="space-y-2.5">
                        <li class="flex items-start gap-2 text-xs text-forest-200">
                            <span class="w-5 h-5 rounded-full bg-forest-600 flex items-center justify-center flex-shrink-0 mt-0.5 text-[10px] font-bold text-white">1</span>
                            NIK harus 16 digit dan unik per warga.
                        </li>
                        <li class="flex items-start gap-2 text-xs text-forest-200">
                            <span class="w-5 h-5 rounded-full bg-forest-600 flex items-center justify-center flex-shrink-0 mt-0.5 text-[10px] font-bold text-white">2</span>
                            Nama lengkap sesuai dengan dokumen resmi (KTP/KK).
                        </li>
                        <li class="flex items-start gap-2 text-xs text-forest-200">
                            <span class="w-5 h-5 rounded-full bg-forest-600 flex items-center justify-center flex-shrink-0 mt-0.5 text-[10px] font-bold text-white">3</span>
                            Alamat disertai RT/RW dan nama jalan yang lengkap.
                        </li>
                        <li class="flex items-start gap-2 text-xs text-forest-200">
                            <span class="w-5 h-5 rounded-full bg-forest-600 flex items-center justify-center flex-shrink-0 mt-0.5 text-[10px] font-bold text-white">4</span>
                            Kolom bertanda <span class="text-red-300 font-bold">*</span> wajib diisi.
                        </li>
                    </ul>
                </div>

                {{-- Timestamps (Read-only info) --}}
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden animate-fade-up s4">
                    <div class="px-5 py-4 border-b border-gray-100 flex items-center gap-3">
                        <div class="w-8 h-8 rounded-lg bg-gray-50 flex items-center justify-center">
                            <svg class="w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-forest-900 text-sm">Timestamp</h4>
                            <p class="text-gray-400 text-xs">Diisi otomatis oleh sistem</p>
                        </div>
                    </div>
                    <div class="p-5 space-y-4">
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-1.5">Dibuat Pada</label>
                            <div class="flex items-center gap-2 px-3 py-2.5 rounded-xl bg-gray-50 border border-dashed border-gray-200">
                                <svg class="w-4 h-4 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 9v7.5" />
                                </svg>
                                <span class="text-xs font-semibold text-gray-700">
                                    {{ $warga->created_at->isoFormat('D MMMM Y, HH:mm') }} WIB
                                </span>
                            </div>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-1.5">Diperbarui Pada</label>
                            <div class="flex items-center gap-2 px-3 py-2.5 rounded-xl bg-gray-50 border border-dashed border-gray-200">
                                <svg class="w-4 h-4 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
                                </svg>
                                <span class="text-xs font-semibold text-gray-700">
                                    {{ $warga->updated_at->isoFormat('D MMMM Y, HH:mm') }} WIB
                                </span>
                            </div>
                        </div>
                        <p class="text-[11px] text-gray-400 bg-gray-50 rounded-xl px-3 py-2 leading-relaxed">
                            Field <code class="font-mono bg-gray-200 px-1 rounded text-gray-600">created_at</code> dan <code class="font-mono bg-gray-200 px-1 rounded text-gray-600">updated_at</code> dikelola otomatis oleh Laravel.
                        </p>
                    </div>
                </div>

                {{-- Action Buttons --}}
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 space-y-3 animate-fade-up s5">
                    <button type="submit"
                        class="w-full flex items-center justify-center gap-2 bg-forest-600 hover:bg-forest-700 active:bg-forest-800 text-white text-sm font-bold px-4 py-3 rounded-xl transition-all shadow-sm hover:shadow-md">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Simpan Data Warga
                    </button>
                    <!-- <button type="reset"
                        class="w-full flex items-center justify-center gap-2 bg-gray-50 hover:bg-gray-100 text-gray-500 text-sm font-semibold px-4 py-2.5 rounded-xl transition-colors border border-gray-200">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
                        </svg>
                        Reset Formulir
                    </button> -->
                </div>

            </div>
        </div>

    </form>

</main>

@endsection