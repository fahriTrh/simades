@extends('app')

@section('content')

<main class="flex-1 overflow-y-auto p-5 lg:p-8">

    {{-- Page Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-7 animate-fade-up s1">
        <div>
            <h3 class="text-forest-900 font-bold text-xl">Arsip Surat</h3>
            <p class="text-gray-400 text-sm mt-0.5">Riwayat surat yang telah digenerate</p>
        </div>
    </div>

    {{-- Table Card --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden animate-fade-up s2">

        {{-- Toolbar --}}
        <div class="px-5 py-4 border-b border-gray-100">
            <form method="GET" action="{{ route('arsip.index') }}" class="flex gap-2">
                <div class="relative w-full sm:w-64">
                    <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 15.803a7.5 7.5 0 0010.607 10.607z" />
                    </svg>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nomor atau nama warga..."
                        class="w-full pl-9 pr-4 py-2 text-sm border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-forest-300 bg-gray-50 placeholder-gray-400 text-gray-700">
                </div>
                <button type="submit" class="px-4 py-2 bg-forest-600 hover:bg-forest-700 text-white text-sm font-semibold rounded-xl transition-colors">
                    Cari
                </button>
                @if (request('search'))
                <a href="{{ route('arsip.index') }}" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-600 text-sm font-semibold rounded-xl transition-colors">
                    Reset
                </a>
                @endif
            </form>
        </div>

        {{-- Table --}}
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-gray-50/80 border-b border-gray-100">
                        <th class="text-left px-5 py-3 text-xs font-bold text-gray-400 uppercase tracking-wider w-10">#</th>
                        <th class="text-left px-5 py-3 text-xs font-bold text-gray-400 uppercase tracking-wider">Nomor Surat</th>
                        <th class="text-left px-5 py-3 text-xs font-bold text-gray-400 uppercase tracking-wider">Nama Warga</th>
                        <th class="text-left px-5 py-3 text-xs font-bold text-gray-400 uppercase tracking-wider hidden md:table-cell">Template</th>
                        <th class="text-left px-5 py-3 text-xs font-bold text-gray-400 uppercase tracking-wider hidden lg:table-cell">Tanggal</th>
                        <th class="text-left px-5 py-3 text-xs font-bold text-gray-400 uppercase tracking-wider hidden lg:table-cell">Keterangan</th>
                        <th class="px-5 py-3 text-xs font-bold text-gray-400 uppercase tracking-wider text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse ($arsips as $arsip)
                    <tr class="hover:bg-gray-50/60 transition-colors">
                        <td class="px-5 py-3.5 text-gray-400 text-xs">{{ $loop->iteration }}</td>
                        <td class="px-5 py-3.5">
                            <span class="font-mono text-xs font-semibold text-forest-700 bg-forest-50 px-2 py-1 rounded-lg">
                                {{ $arsip->nomor_surat }}
                            </span>
                        </td>
                        <td class="px-5 py-3.5">
                            <p class="font-semibold text-forest-900 text-sm">{{ $arsip->warga->nama }}</p>
                            <p class="text-xs text-gray-400 font-mono">{{ $arsip->warga->nik }}</p>
                        </td>
                        <td class="px-5 py-3.5 hidden md:table-cell">
                            <span class="text-xs text-gray-600 bg-gray-100 px-2 py-1 rounded-lg">
                                {{ $arsip->template->nama_template }}
                            </span>
                        </td>
                        <td class="px-5 py-3.5 text-gray-500 text-xs hidden lg:table-cell">
                            {{ \Carbon\Carbon::parse($arsip->tanggal_surat)->isoFormat('D MMMM Y') }}
                        </td>
                        <td class="px-5 py-3.5 text-gray-400 text-xs hidden lg:table-cell max-w-[180px] truncate">
                            {{ $arsip->keterangan ?? '-' }}
                        </td>
                        <td class="px-5 py-3.5">
                            <div class="flex items-center justify-center gap-1.5">
                                {{-- Download --}}
                                <a href="{{ asset($arsip->file_surat) }}" download title="Unduh"
                                    class="p-1.5 rounded-lg text-gray-400 hover:text-forest-600 hover:bg-forest-50 transition-colors">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3" />
                                    </svg>
                                </a>
                                {{-- Hapus (form disiapkan, fungsi belakangan) --}}
                                <form class="mt-3.5" method="POST" action="{{ route('arsip.destroy', $arsip->id) }}" id="delete-form-{{ $arsip->id }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" title="Hapus"
                                        onclick="confirmDelete({{ $arsip->id }}, '{{ addslashes($arsip->nomor_surat) }}')"
                                        class="p-1.5 rounded-lg text-gray-400 hover:text-red-500 hover:bg-red-50 transition-colors">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-5 py-12 text-center">
                            <div class="flex flex-col items-center gap-2 text-gray-400">
                                <svg class="w-10 h-10 text-gray-200" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />
                                </svg>
                                <p class="text-sm font-semibold">Belum ada arsip surat</p>
                                <p class="text-xs">Arsip akan muncul setelah surat digenerate</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Footer --}}
        <div class="px-5 py-4 border-t border-gray-100 flex flex-col sm:flex-row items-center justify-between gap-3">
            <p class="text-gray-400 text-xs">
                Menampilkan
                <span class="font-semibold text-forest-700">{{ $arsips->firstItem() ?? 0 }}</span>
                –
                <span class="font-semibold text-forest-700">{{ $arsips->lastItem() ?? 0 }}</span>
                dari
                <span class="font-semibold text-forest-700">{{ $arsips->total() }}</span>
                data
            </p>

            <div class="flex items-center gap-1">
                @if ($arsips->onFirstPage())
                <span class="px-3 py-1.5 text-xs text-gray-300 bg-gray-50 border border-gray-200 rounded-lg cursor-not-allowed">&laquo;</span>
                @else
                <a href="{{ $arsips->previousPageUrl() }}" class="px-3 py-1.5 text-xs text-gray-500 bg-white border border-gray-200 rounded-lg hover:bg-forest-50 hover:text-forest-600 hover:border-forest-200 transition-colors">&laquo;</a>
                @endif

                @foreach ($arsips->getUrlRange(1, $arsips->lastPage()) as $page => $url)
                @if ($page == $arsips->currentPage())
                <span class="px-3 py-1.5 text-xs font-bold text-white bg-forest-600 border border-forest-600 rounded-lg">{{ $page }}</span>
                @else
                <a href="{{ $url }}" class="px-3 py-1.5 text-xs text-gray-500 bg-white border border-gray-200 rounded-lg hover:bg-forest-50 hover:text-forest-600 hover:border-forest-200 transition-colors">{{ $page }}</a>
                @endif
                @endforeach

                @if ($arsips->hasMorePages())
                <a href="{{ $arsips->nextPageUrl() }}" class="px-3 py-1.5 text-xs text-gray-500 bg-white border border-gray-200 rounded-lg hover:bg-forest-50 hover:text-forest-600 hover:border-forest-200 transition-colors">&raquo;</a>
                @else
                <span class="px-3 py-1.5 text-xs text-gray-300 bg-gray-50 border border-gray-200 rounded-lg cursor-not-allowed">&raquo;</span>
                @endif
            </div>
        </div>

    </div>

</main>

@endsection

{{-- Modal Konfirmasi Hapus --}}
<div id="deleteModal" class="fixed inset-0 z-50 hidden items-center justify-center p-4">
    <div class="absolute inset-0 bg-black/40 backdrop-blur-sm" onclick="closeDeleteModal()"></div>
    <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-sm p-6 animate-fade-up">
        <div class="flex flex-col items-center text-center">
            <div class="w-14 h-14 rounded-full bg-red-50 flex items-center justify-center mb-4">
                <svg class="w-7 h-7 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                </svg>
            </div>
            <h4 class="text-forest-900 font-bold text-lg">Hapus Arsip Surat?</h4>
            <p class="text-gray-400 text-sm mt-1">Arsip nomor <span id="deleteNomor" class="font-semibold text-gray-600"></span> akan dihapus permanen.</p>
        </div>
        <div class="flex gap-3 mt-6">
            <button onclick="closeDeleteModal()" class="flex-1 px-4 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-600 text-sm font-semibold rounded-xl transition-colors">
                Batal
            </button>
            <button id="deleteConfirmBtn" class="flex-1 px-4 py-2.5 bg-red-500 hover:bg-red-600 text-white text-sm font-bold rounded-xl transition-colors">
                Ya, Hapus
            </button>
        </div>
    </div>
</div>

<script>
    function confirmDelete(id, nomor) {
        document.getElementById('deleteNomor').textContent = nomor;
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