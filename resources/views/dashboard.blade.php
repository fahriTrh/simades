@extends('app')

@section('content')
{{-- Dashboard Content --}}
<main class="flex-1 overflow-y-auto p-5 lg:p-8">

    {{-- Welcome Banner --}}
    <div class="relative bg-gradient-to-r from-forest-800 to-forest-600 rounded-2xl p-6 mb-7 overflow-hidden animate-fade-up s1">
        <div class="absolute right-0 top-0 w-64 h-full opacity-10">
            <svg viewBox="0 0 200 200" fill="white" class="w-full h-full">
                <path d="M20 180 C20 180, 80 160, 100 100 C120 40, 180 20, 180 20 C180 20, 160 80, 100 100 C40 120, 20 180, 20 180 Z" />
                <path d="M50 160 C50 160, 100 140, 120 90 C140 40, 180 30, 180 30" stroke="white" stroke-width="2" fill="none" />
                <circle cx="160" cy="40" r="20" fill="white" opacity="0.3" />
                <circle cx="40" cy="170" r="15" fill="white" opacity="0.2" />
            </svg>
        </div>
        <div class="relative z-10">
            <p class="text-forest-200 text-sm font-medium mb-1">Selamat datang kembali 👋</p>
            <h3 class="text-white text-2xl font-bold font-serif italic">{{ auth()->user()->username ?? 'Admin' }}</h3>
            <p class="text-forest-300 text-sm mt-1.5">
                Kelola data warga dan administrasi surat desa dengan mudah.
            </p>
            <a href="" class="mt-4 inline-flex items-center gap-2 bg-white/15 hover:bg-white/25 text-white text-sm font-semibold px-4 py-2 rounded-xl transition-colors border border-white/20">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                Generate Surat Baru
            </a>
        </div>
    </div>

    {{-- Stat Cards --}}
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-7">

        {{-- Total Warga --}}
        <div class="stat-card bg-white rounded-2xl p-5 shadow-sm border border-gray-100 animate-fade-up s2">
            <div class="flex items-center justify-between mb-3">
                <div class="w-10 h-10 rounded-xl bg-forest-50 flex items-center justify-center">
                    <svg class="w-5 h-5 text-forest-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                    </svg>
                </div>
                <span class="text-xs text-green-600 font-semibold bg-green-50 px-2 py-0.5 rounded-full">+3%</span>
            </div>
            <p class="text-2xl font-bold text-forest-900">{{ $totalWarga ?? '1.284' }}</p>
            <p class="text-gray-500 text-xs font-medium mt-0.5">Total Warga</p>
            <div class="mt-3 h-1 bg-gray-100 rounded-full">
                <div class="progress-bar h-1 bg-forest-400 rounded-full w-[72%]"></div>
            </div>
        </div>

        {{-- Surat Bulan Ini --}}
        <div class="stat-card bg-white rounded-2xl p-5 shadow-sm border border-gray-100 animate-fade-up s3">
            <div class="flex items-center justify-between mb-3">
                <div class="w-10 h-10 rounded-xl bg-earth-50 flex items-center justify-center">
                    <svg class="w-5 h-5 text-earth-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                    </svg>
                </div>
                <span class="text-xs text-earth-600 font-semibold bg-earth-50 px-2 py-0.5 rounded-full">Bulan ini</span>
            </div>
            <p class="text-2xl font-bold text-forest-900">{{ $suratBulanIni ?? '47' }}</p>
            <p class="text-gray-500 text-xs font-medium mt-0.5">Surat Dibuat</p>
            <div class="mt-3 h-1 bg-gray-100 rounded-full">
                <div class="progress-bar h-1 bg-earth-400 rounded-full w-[55%]"></div>
            </div>
        </div>

        {{-- Template Surat --}}
        <div class="stat-card bg-white rounded-2xl p-5 shadow-sm border border-gray-100 animate-fade-up s4">
            <div class="flex items-center justify-between mb-3">
                <div class="w-10 h-10 rounded-xl bg-blue-50 flex items-center justify-center">
                    <svg class="w-5 h-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 9.776c.112-.017.227-.026.344-.026h15.812c.117 0 .232.009.344.026m-16.5 0a2.25 2.25 0 00-1.883 2.542l.857 6a2.25 2.25 0 002.227 1.932H19.05a2.25 2.25 0 002.227-1.932l.857-6a2.25 2.25 0 00-1.883-2.542m-16.5 0V6A2.25 2.25 0 016 3.75h3.879a1.5 1.5 0 011.06.44l2.122 2.12a1.5 1.5 0 001.06.44H18A2.25 2.25 0 0120.25 9v.776" />
                    </svg>
                </div>
                <span class="text-xs text-blue-600 font-semibold bg-blue-50 px-2 py-0.5 rounded-full">Aktif</span>
            </div>
            <p class="text-2xl font-bold text-forest-900">{{ $totalTemplate ?? '12' }}</p>
            <p class="text-gray-500 text-xs font-medium mt-0.5">Template Surat</p>
            <div class="mt-3 h-1 bg-gray-100 rounded-full">
                <div class="progress-bar h-1 bg-blue-400 rounded-full w-[40%]"></div>
            </div>
        </div>

        {{-- Total Arsip --}}
        <div class="stat-card bg-white rounded-2xl p-5 shadow-sm border border-gray-100 animate-fade-up s5">
            <div class="flex items-center justify-between mb-3">
                <div class="w-10 h-10 rounded-xl bg-violet-50 flex items-center justify-center">
                    <svg class="w-5 h-5 text-violet-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5m8.25 3v6.75m0 0l-3-3m3 3l3-3M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />
                    </svg>
                </div>
                <span class="text-xs text-violet-600 font-semibold bg-violet-50 px-2 py-0.5 rounded-full">Total</span>
            </div>
            <p class="text-2xl font-bold text-forest-900">{{ $totalArsip ?? '326' }}</p>
            <p class="text-gray-500 text-xs font-medium mt-0.5">Arsip Surat</p>
            <div class="mt-3 h-1 bg-gray-100 rounded-full">
                <div class="progress-bar h-1 bg-violet-400 rounded-full w-[80%]"></div>
            </div>
        </div>
    </div>

    {{-- Two column layout --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-5 mb-7">

        {{-- Aktivitas Terbaru --}}
        <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden animate-fade-up s3">
            <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
                <h4 class="font-bold text-forest-900">Surat Terbaru Dibuat</h4>
                <a href="" class="text-forest-600 text-xs font-semibold hover:underline">Lihat semua →</a>
            </div>
            <div class="divide-y divide-gray-50">
                @forelse ($suratTerbaru ?? [] as $surat)
                <div class="px-6 py-3.5 flex items-center justify-between hover:bg-gray-50/50 transition-colors">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-lg bg-forest-50 flex items-center justify-center flex-shrink-0">
                            <svg class="w-4 h-4 text-forest-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-forest-900 text-sm font-semibold">{{ $surat->nama_warga }}</p>
                            <p class="text-gray-400 text-xs">{{ $surat->jenis_surat }}</p>
                        </div>
                    </div>
                    <div class="text-right flex-shrink-0 ml-4">
                        <span class="text-xs text-gray-400">{{ $surat->created_at->diffForHumans() }}</span>
                        <div class="mt-0.5">
                            <span class="text-[10px] bg-forest-50 text-forest-700 font-semibold px-2 py-0.5 rounded-full">Selesai</span>
                        </div>
                    </div>
                </div>
                @empty
                {{-- Static fallback rows --}}
                @foreach ([
                ['Budi Santoso', 'Surat Keterangan Domisili', '2 menit lalu'],
                ['Siti Rahayu', 'Surat Keterangan Tidak Mampu','15 menit lalu'],
                ['Ahmad Fauzi', 'Surat Pengantar KTP', '1 jam lalu'],
                ['Dewi Lestari', 'Surat Keterangan Usaha', '3 jam lalu'],
                ['Rudi Hermawan', 'Surat Keterangan Kelahiran', 'Kemarin'],
                ] as $row)
                <div class="px-6 py-3.5 flex items-center justify-between hover:bg-gray-50/50 transition-colors">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-lg bg-forest-50 flex items-center justify-center flex-shrink-0">
                            <svg class="w-4 h-4 text-forest-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-forest-900 text-sm font-semibold">{{ $row[0] }}</p>
                            <p class="text-gray-400 text-xs">{{ $row[1] }}</p>
                        </div>
                    </div>
                    <div class="text-right flex-shrink-0 ml-4">
                        <span class="text-xs text-gray-400">{{ $row[2] }}</span>
                        <div class="mt-0.5">
                            <span class="text-[10px] bg-forest-50 text-forest-700 font-semibold px-2 py-0.5 rounded-full">Selesai</span>
                        </div>
                    </div>
                </div>
                @endforeach
                @endforelse
            </div>
        </div>

        {{-- Quick Actions --}}
        <div class="space-y-4 animate-fade-up s4">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-5 py-4 border-b border-gray-100">
                    <h4 class="font-bold text-forest-900">Aksi Cepat</h4>
                </div>
                <div class="p-4 grid grid-cols-2 gap-3">
                    <a href="" class="flex flex-col items-center gap-2 p-3 rounded-xl bg-forest-50 hover:bg-forest-100 transition-colors group text-center">
                        <div class="w-10 h-10 rounded-xl bg-forest-600 group-hover:bg-forest-700 flex items-center justify-center transition-colors shadow">
                            <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 003.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 003.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 00-3.09 3.09z" />
                            </svg>
                        </div>
                        <span class="text-xs font-semibold text-forest-800">Generate Surat</span>
                    </a>
                    <a href="" class="flex flex-col items-center gap-2 p-3 rounded-xl bg-blue-50 hover:bg-blue-100 transition-colors group text-center">
                        <div class="w-10 h-10 rounded-xl bg-blue-600 group-hover:bg-blue-700 flex items-center justify-center transition-colors shadow">
                            <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM4 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 0110.374 21c-2.331 0-4.512-.645-6.374-1.766z" />
                            </svg>
                        </div>
                        <span class="text-xs font-semibold text-blue-800">Tambah Warga</span>
                    </a>
                    <a href="" class="flex flex-col items-center gap-2 p-3 rounded-xl bg-earth-50 hover:bg-earth-100 transition-colors group text-center">
                        <div class="w-10 h-10 rounded-xl bg-earth-500 group-hover:bg-earth-600 flex items-center justify-center transition-colors shadow">
                            <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 10.5v6m3-3H9m4.06-7.19l-2.12-2.12a1.5 1.5 0 00-1.061-.44H4.5A2.25 2.25 0 002.25 6v12a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9a2.25 2.25 0 00-2.25-2.25h-5.379a1.5 1.5 0 01-1.06-.44z" />
                            </svg>
                        </div>
                        <span class="text-xs font-semibold text-earth-800">Tambah Template</span>
                    </a>
                    <a href="" class="flex flex-col items-center gap-2 p-3 rounded-xl bg-violet-50 hover:bg-violet-100 transition-colors group text-center">
                        <div class="w-10 h-10 rounded-xl bg-violet-600 group-hover:bg-violet-700 flex items-center justify-center transition-colors shadow">
                            <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5m8.25 3v6.75m0 0l-3-3m3 3l3-3M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />
                            </svg>
                        </div>
                        <span class="text-xs font-semibold text-violet-800">Lihat Arsip</span>
                    </a>
                </div>
            </div>

            {{-- Jenis surat terbanyak --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-5 py-4 border-b border-gray-100">
                    <h4 class="font-bold text-forest-900 text-sm">Surat Terbanyak</h4>
                </div>
                <div class="p-4 space-y-3">
                    @foreach ([
                    ['Ket. Domisili', 38, 'bg-forest-500'],
                    ['Ket. Tdk Mampu', 24, 'bg-earth-400'],
                    ['Pengantar KTP', 18, 'bg-blue-500'],
                    ['Ket. Usaha', 12, 'bg-violet-500'],
                    ] as $item)
                    <div>
                        <div class="flex justify-between text-xs mb-1">
                            <span class="text-gray-600 font-medium">{{ $item[0] }}</span>
                            <span class="text-gray-400">{{ $item[1] }}</span>
                        </div>
                        <div class="h-1.5 bg-gray-100 rounded-full">
                            <div class="progress-bar h-1.5 {{ $item[2] }} rounded-full" style="width: {{ $item[1] }}%"></div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

</main>
@endsection