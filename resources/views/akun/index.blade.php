@extends('app')

@section('content')
<div class="flex-1 p-5 lg:p-8 animate-fade-up s1">

    {{-- Header --}}
    <div class="mb-6">
        <h2 class="text-forest-900 font-bold text-xl">Pengaturan Akun</h2>
        <p class="text-gray-400 text-sm mt-0.5">Kelola username, email, dan password Anda</p>
    </div>

    <form method="POST" action="{{ route('akun.update') }}" class="max-w-2xl space-y-6">
        @csrf
        @method('PUT')

        {{-- Informasi Akun --}}
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100 flex items-center gap-3">
                <div class="w-8 h-8 rounded-lg bg-forest-50 flex items-center justify-center">
                    <svg class="w-4 h-4 text-forest-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                    </svg>
                </div>
                <h3 class="font-semibold text-forest-900 text-sm">Informasi Akun</h3>
            </div>
            <div class="px-6 py-5 space-y-4">

                {{-- Username --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Username</label>
                    <input
                        type="text"
                        name="username"
                        value="{{ old('username', auth()->user()->username) }}"
                        class="w-full px-4 py-2.5 rounded-xl border @error('username') border-red-400 bg-red-50 @else border-gray-200 @enderror text-sm text-gray-800 focus:outline-none focus:ring-2 focus:ring-forest-400 focus:border-transparent transition"
                        placeholder="Username">
                    @error('username')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Email --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Email</label>
                    <input
                        type="email"
                        name="email"
                        value="{{ old('email', auth()->user()->email) }}"
                        class="w-full px-4 py-2.5 rounded-xl border @error('email') border-red-400 bg-red-50 @else border-gray-200 @enderror text-sm text-gray-800 focus:outline-none focus:ring-2 focus:ring-forest-400 focus:border-transparent transition"
                        placeholder="email@contoh.com">
                    @error('email')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

            </div>
        </div>

        {{-- Ubah Password --}}
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100 flex items-center gap-3">
                <div class="w-8 h-8 rounded-lg bg-earth-50 flex items-center justify-center">
                    <svg class="w-4 h-4 text-earth-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                    </svg>
                </div>
                <div>
                    <h3 class="font-semibold text-forest-900 text-sm">Ubah Password</h3>
                    <p class="text-xs text-gray-400">Kosongkan jika tidak ingin mengubah password</p>
                </div>
            </div>
            <div class="px-6 py-5 space-y-4">

                {{-- Password Lama --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Password Lama</label>
                    <input
                        type="password"
                        name="password_lama"
                        class="w-full px-4 py-2.5 rounded-xl border @error('password_lama') border-red-400 bg-red-50 @else border-gray-200 @enderror text-sm text-gray-800 focus:outline-none focus:ring-2 focus:ring-forest-400 focus:border-transparent transition"
                        placeholder="Masukkan password lama">
                    @error('password_lama')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Password Baru --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Password Baru</label>
                    <input
                        type="password"
                        name="password"
                        class="w-full px-4 py-2.5 rounded-xl border @error('password') border-red-400 bg-red-50 @else border-gray-200 @enderror text-sm text-gray-800 focus:outline-none focus:ring-2 focus:ring-forest-400 focus:border-transparent transition"
                        placeholder="Minimal 8 karakter">
                    @error('password')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Konfirmasi Password --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Konfirmasi Password Baru</label>
                    <input
                        type="password"
                        name="password_confirmation"
                        class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm text-gray-800 focus:outline-none focus:ring-2 focus:ring-forest-400 focus:border-transparent transition"
                        placeholder="Ulangi password baru">
                </div>

            </div>
        </div>

        {{-- Tombol Simpan --}}
        <div class="flex justify-end">
            <button type="submit" class="inline-flex items-center gap-2 bg-forest-600 hover:bg-forest-700 text-white text-sm font-semibold px-6 py-2.5 rounded-xl transition-colors shadow-sm">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0111.186 0z" />
                </svg>
                Simpan Perubahan
            </button>
        </div>

    </form>
</div>
@endsection