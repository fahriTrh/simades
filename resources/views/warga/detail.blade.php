@extends('app')

@section('content')

@php



$isMale = $warga['jenis_kelamin'] === 'Laki-laki';
$initials = strtoupper(substr($warga['nama'], 0, 2));

$tanggal = \Carbon\Carbon::parse($warga['tanggal_lahir']);
$umur = $tanggal->age;
@endphp

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
                <span class="text-forest-700 text-sm font-semibold">Detail Warga</span>
            </div>
            <h3 class="text-forest-900 font-bold text-xl">Detail Data Warga</h3>
            <p class="text-gray-400 text-sm mt-0.5">Informasi lengkap warga terdaftar</p>
        </div>
        <div class="flex items-center gap-2 flex-shrink-0">
            <a href="{{ route('warga.edit', $warga->id) }}"
               class="inline-flex items-center gap-2 bg-earth-500 hover:bg-earth-600 text-white text-sm font-semibold px-4 py-2.5 rounded-xl transition-colors shadow-sm">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125" />
                </svg>
                Edit
            </a>
            <a href="{{ route('warga.index') }}"
               class="inline-flex items-center gap-2 bg-gray-100 hover:bg-gray-200 text-gray-600 text-sm font-semibold px-4 py-2.5 rounded-xl transition-colors">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 15L3 9m0 0l6-6M3 9h12a6 6 0 010 12h-3" />
                </svg>
                Kembali
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">

        {{-- LEFT: Data Detail --}}
        <div class="xl:col-span-2 space-y-5">

            {{-- Section: Identitas Utama --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden animate-fade-up s2">
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

                <div class="p-6 grid grid-cols-1 sm:grid-cols-2 gap-x-8 gap-y-5">

                    {{-- NIK --}}
                    <div class="sm:col-span-2">
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">NIK</p>
                        <div class="flex items-center gap-3 px-4 py-3 bg-gray-50 rounded-xl border border-gray-100">
                            <svg class="w-4 h-4 text-gray-400 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 9h3.75M15 12h3.75M15 15h3.75M4.5 19.5h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5zm6-10.125a1.875 1.875 0 11-3.75 0 1.875 1.875 0 013.75 0zm1.294 6.336a6.721 6.721 0 01-3.17.789 6.721 6.721 0 01-3.168-.789 3.376 3.376 0 016.338 0z" />
                            </svg>
                            <span class="font-mono text-sm font-semibold text-forest-900 tracking-widest">{{ $warga['nik'] }}</span>
                        </div>
                    </div>

                    {{-- Nama --}}
                    <div class="sm:col-span-2">
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Nama Lengkap</p>
                        <p class="text-forest-900 font-semibold text-base">{{ $warga['nama'] }}</p>
                    </div>

                    {{-- Tempat & Tanggal Lahir --}}
                    <div>
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Tempat Lahir</p>
                        <p class="text-gray-700 text-sm font-medium">{{ $warga['tempat_lahir'] }}</p>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Tanggal Lahir</p>
                        <div class="flex items-center gap-2">
                            <p class="text-gray-700 text-sm font-medium">{{ $tanggal->isoFormat('D MMMM Y') }}</p>
                            <span class="text-[11px] bg-forest-50 text-forest-600 font-bold px-2 py-0.5 rounded-full border border-forest-100">{{ $umur }} tahun</span>
                        </div>
                    </div>

                    {{-- Jenis Kelamin --}}
                    <div>
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Jenis Kelamin</p>
                        @if ($isMale)
                            <span class="inline-flex items-center gap-1.5 text-xs font-semibold bg-blue-50 text-blue-600 px-3 py-1 rounded-full border border-blue-100">
                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z" />
                                </svg>
                                Laki-laki
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1.5 text-xs font-semibold bg-pink-50 text-pink-500 px-3 py-1 rounded-full border border-pink-100">
                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z" />
                                </svg>
                                Perempuan
                            </span>
                        @endif
                    </div>

                    {{-- Agama --}}
                    <div>
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Agama</p>
                        <p class="text-gray-700 text-sm font-medium">{{ $warga['agama'] }}</p>
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
                        <p class="text-gray-400 text-xs">Pekerjaan, status, kontak, dan alamat</p>
                    </div>
                </div>

                <div class="p-6 grid grid-cols-1 sm:grid-cols-2 gap-x-8 gap-y-5">

                    {{-- Pekerjaan --}}
                    <div>
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Pekerjaan</p>
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-gray-400 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 00.75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 00-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0112 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 01-.673-.38m0 0A2.18 2.18 0 013 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 013.413-.387m7.5 0V5.25A2.25 2.25 0 0013.5 3h-3a2.25 2.25 0 00-2.25 2.25v.894m7.5 0a48.667 48.667 0 00-7.5 0M12 12.75h.008v.008H12v-.008z" />
                            </svg>
                            <p class="text-gray-700 text-sm font-medium">{{ $warga['pekerjaan'] }}</p>
                        </div>
                    </div>

                    {{-- Status Perkawinan --}}
                    <div>
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Status Perkawinan</p>
                        @php
                            $statusColors = [
                                'Belum Kawin' => 'bg-gray-50 text-gray-500 border-gray-200',
                                'Kawin'        => 'bg-green-50 text-green-600 border-green-100',
                                'Cerai Hidup'  => 'bg-orange-50 text-orange-500 border-orange-100',
                                'Cerai Mati'   => 'bg-red-50 text-red-500 border-red-100',
                            ];
                            $statusClass = $statusColors[$warga['status_perkawinan']] ?? 'bg-gray-50 text-gray-500 border-gray-200';
                        @endphp
                        <span class="inline-flex text-xs font-semibold px-3 py-1 rounded-full border {{ $statusClass }}">
                            {{ $warga['status_perkawinan'] }}
                        </span>
                    </div>

                    {{-- No. HP --}}
                    <div>
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Nomor Telepon</p>
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-gray-400 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z" />
                            </svg>
                            <p class="text-gray-700 text-sm font-mono font-medium">{{ $warga['nomor_telepon'] }}</p>
                        </div>
                    </div>

                    {{-- Alamat --}}
                    <div class="sm:col-span-2">
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Alamat Lengkap</p>
                        <div class="flex items-start gap-2 px-4 py-3 bg-gray-50 rounded-xl border border-gray-100">
                            <svg class="w-4 h-4 text-gray-400 flex-shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                            </svg>
                            <p class="text-gray-700 text-sm leading-relaxed">{{ $warga['alamat'] }}</p>
                        </div>
                    </div>

                </div>
            </div>

        </div>

        {{-- RIGHT: Profile Card + Timestamps + Actions --}}
        <div class="space-y-5">

            {{-- Profile Card --}}
            <div class="bg-gradient-to-br from-forest-700 to-forest-900 rounded-2xl p-6 text-white shadow-lg animate-fade-up s2">
                <div class="flex flex-col items-center text-center">
                    <div class="avatar-ring p-[3px] rounded-full mb-4">
                        <div class="w-20 h-20 rounded-full flex items-center justify-center {{ $isMale ? 'bg-blue-800' : 'bg-pink-800' }}">
                            <span class="font-bold text-2xl text-white">{{ $initials }}</span>
                        </div>
                    </div>
                    <h4 class="font-bold text-lg leading-tight">{{ $warga['nama'] }}</h4>
                    <p class="text-forest-400 text-xs mt-1 font-mono tracking-widest">{{ $warga['nik'] }}</p>
                    <div class="flex items-center gap-2 mt-3">
                        <span class="text-[11px] font-semibold px-2.5 py-1 rounded-full {{ $isMale ? 'bg-blue-500/30 text-blue-200' : 'bg-pink-500/30 text-pink-200' }}">
                            {{ $warga['jenis_kelamin'] }}
                        </span>
                        <span class="text-[11px] font-semibold bg-forest-600/50 text-forest-200 px-2.5 py-1 rounded-full">
                            {{ $umur }} tahun
                        </span>
                    </div>
                </div>

                <div class="mt-5 pt-4 border-t border-white/10 grid grid-cols-2 gap-3">
                    <div class="text-center">
                        <p class="text-forest-400 text-[10px] uppercase tracking-wider font-bold">Agama</p>
                        <p class="text-white text-xs font-semibold mt-0.5">{{ $warga['agama'] }}</p>
                    </div>
                    <div class="text-center">
                        <p class="text-forest-400 text-[10px] uppercase tracking-wider font-bold">Status</p>
                        <p class="text-white text-xs font-semibold mt-0.5">{{ $warga['status_perkawinan'] }}</p>
                    </div>
                    <div class="col-span-2 text-center">
                        <p class="text-forest-400 text-[10px] uppercase tracking-wider font-bold">Pekerjaan</p>
                        <p class="text-white text-xs font-semibold mt-0.5">{{ $warga['pekerjaan'] }}</p>
                    </div>
                </div>

                {{-- ID Badge --}}
                <div class="mt-4 flex items-center justify-center gap-1.5">
                    <span class="text-[10px] text-forest-500">ID Warga:</span>
                    <span class="font-mono text-[11px] text-forest-300 font-bold">#{{ str_pad($warga['id'], 5, '0', STR_PAD_LEFT) }}</span>
                </div>
            </div>

            {{-- Timestamps --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden animate-fade-up s3">
                <div class="px-5 py-4 border-b border-gray-100 flex items-center gap-3">
                    <div class="w-8 h-8 rounded-lg bg-gray-50 flex items-center justify-center">
                        <svg class="w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <h4 class="font-bold text-forest-900 text-sm">Riwayat Waktu</h4>
                        <p class="text-gray-400 text-xs">Data log sistem</p>
                    </div>
                </div>
                <div class="p-5 space-y-4">
                    <div>
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-1.5">Didaftarkan Pada</p>
                        <div class="flex items-center gap-2 px-3 py-2.5 rounded-xl bg-gray-50 border border-gray-100">
                            <svg class="w-4 h-4 text-forest-400 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 9v7.5" />
                            </svg>
                            <div>
                                <p class="text-xs font-semibold text-gray-700">{{ \Carbon\Carbon::parse($warga['created_at'])->isoFormat('D MMMM Y') }}</p>
                                <p class="text-[11px] text-gray-400">{{ \Carbon\Carbon::parse($warga['created_at'])->format('H:i') }} WIB</p>
                            </div>
                        </div>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-1.5">Terakhir Diperbarui</p>
                        <div class="flex items-center gap-2 px-3 py-2.5 rounded-xl bg-gray-50 border border-gray-100">
                            <svg class="w-4 h-4 text-earth-500 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
                            </svg>
                            <div>
                                <p class="text-xs font-semibold text-gray-700">{{ \Carbon\Carbon::parse($warga['updated_at'])->isoFormat('D MMMM Y') }}</p>
                                <p class="text-[11px] text-gray-400">{{ \Carbon\Carbon::parse($warga['updated_at'])->format('H:i') }} WIB</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Action Buttons --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 space-y-3 animate-fade-up s4">
                <a href="{{ route('warga.edit', $warga->id) }}"
                   class="w-full flex items-center justify-center gap-2 bg-earth-500 hover:bg-earth-600 text-white text-sm font-bold px-4 py-3 rounded-xl transition-all shadow-sm hover:shadow-md">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125" />
                    </svg>
                    Edit Data Warga
                </a>

                <a href="#"
                   class="w-full flex items-center justify-center gap-2 bg-forest-50 hover:bg-forest-100 text-forest-700 text-sm font-semibold px-4 py-2.5 rounded-xl transition-colors border border-forest-100">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 003.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 003.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 00-3.09 3.09zM18.259 8.715L18 9.75l-.259-1.035a3.375 3.375 0 00-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 002.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 002.456 2.456L21.75 6l-1.035.259a3.375 3.375 0 00-2.456 2.456z" />
                    </svg>
                    Generate Surat
                </a>

                <form method="POST" action="{{ route('warga.destroy', $warga->id) }}" id="delete-form-{{ $warga->id }}">
                    @csrf
                    @method('DELETE')
                    <button type="button"
                        onclick="confirmDelete({{ $warga->id }}, '{{ addslashes($warga->nama) }}')"
                        class="w-full flex items-center justify-center gap-2 bg-red-50 hover:bg-red-100 text-red-500 text-sm font-semibold px-4 py-2.5 rounded-xl transition-colors border border-red-100">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                        </svg>
                        Hapus Data Warga
                    </button>
                </form>
            </div>

        </div>
    </div>

</main>

@endsection

{{-- Modal Konfirmasi Hapus --}}
<div id="deleteModal" class="fixed inset-0 z-50 hidden items-center justify-center p-4">
    {{-- Backdrop --}}
    <div class="absolute inset-0 bg-black/40 backdrop-blur-sm" onclick="closeDeleteModal()"></div>

    {{-- Modal Box --}}
    <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-sm p-6 animate-fade-up">
        <div class="flex flex-col items-center text-center">
            <div class="w-14 h-14 rounded-full bg-red-50 flex items-center justify-center mb-4">
                <svg class="w-7 h-7 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                </svg>
            </div>
            <h4 class="text-forest-900 font-bold text-lg">Hapus Data Warga?</h4>
            <p class="text-gray-400 text-sm mt-1">Data <span id="deleteNama" class="font-semibold text-gray-600"></span> akan dihapus permanen dan tidak dapat dikembalikan.</p>
        </div>

        <div class="flex gap-3 mt-6">
            <button onclick="closeDeleteModal()"
                class="flex-1 px-4 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-600 text-sm font-semibold rounded-xl transition-colors">
                Batal
            </button>
            <button id="deleteConfirmBtn"
                class="flex-1 px-4 py-2.5 bg-red-500 hover:bg-red-600 text-white text-sm font-bold rounded-xl transition-colors">
                Ya, Hapus
            </button>
        </div>
    </div>
</div>

<script>
    function confirmDelete(id, nama) {
        document.getElementById('deleteNama').textContent = nama;
        document.getElementById('deleteConfirmBtn').onclick = () => {
            document.getElementById('delete-form-' + id).submit();
        };
        const modal = document.getElementById('deleteModal');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeDeleteModal() {
        const modal = document.getElementById('deleteModal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }
</script>