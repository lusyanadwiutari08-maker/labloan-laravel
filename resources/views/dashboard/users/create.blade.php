@extends('layouts.app')

@section('title', 'Tambah User Baru - LabLoans')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <nav class="flex items-center gap-2 text-sm font-medium text-slate-500 dark:text-slate-400">
        <a class="hover:text-primary transition-colors" href="{{ route('users.index') }}">Manajemen User</a>
        <span class="material-symbols-outlined text-sm">chevron_right</span>
        <span class="text-slate-900 dark:text-white">Tambah User Baru</span>
    </nav>

    <div class="flex flex-col gap-2">
        <h1 class="text-2xl font-bold text-slate-800 dark:text-white">Tambah Pengguna Baru</h1>
        <p class="text-sm text-slate-500 dark:text-slate-400">Silakan lengkapi formulir di bawah ini untuk menambahkan akses pengguna baru ke sistem.</p>
    </div>

    <div class="glass-effect rounded-2xl p-8 shadow-xl">
        <form action="{{ route('users.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @csrf

            <div class="space-y-2 col-span-2">
                <label class="text-sm font-semibold text-slate-700 dark:text-slate-300" for="name">Nama Lengkap</label>
                <input name="name" value="{{ old('name') }}" class="w-full px-4 py-3 rounded-xl bg-white dark:bg-[#111a22] border-slate-200 dark:border-border-dark text-slate-900 dark:text-white focus:ring-2 focus:ring-primary focus:border-transparent transition-all" id="name" placeholder="Masukkan nama lengkap" type="text" required/>
                @error('name')
                    <span class="text-xs text-red-500 font-medium">{{ $message }}</span>
                @enderror
            </div>

            <div class="space-y-2">
                <label class="text-sm font-semibold text-slate-700 dark:text-slate-300" for="username">Username</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400">
                        <span class="material-symbols-outlined text-[20px]">alternate_email</span>
                    </span>
                    <input name="username" value="{{ old('username') }}" class="w-full pl-11 pr-4 py-3 rounded-xl bg-white dark:bg-[#111a22] border-slate-200 dark:border-border-dark text-slate-900 dark:text-white focus:ring-2 focus:ring-primary focus:border-transparent transition-all" id="username" placeholder="username_pengguna" type="text" required/>
                </div>
                @error('username')
                    <span class="text-xs text-red-500 font-medium">{{ $message }}</span>
                @enderror
            </div>

            <div class="space-y-2">
                <label class="text-sm font-semibold text-slate-700 dark:text-slate-300" for="email">Email Institusi</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400">
                        <span class="material-symbols-outlined text-[20px]">mail</span>
                    </span>
                    <input name="email" value="{{ old('email') }}" class="w-full pl-11 pr-4 py-3 rounded-xl bg-white dark:bg-[#111a22] border-slate-200 dark:border-border-dark text-slate-900 dark:text-white focus:ring-2 focus:ring-primary focus:border-transparent transition-all" id="email" placeholder="contoh@univ.ac.id" type="email" required/>
                </div>
                @error('email')
                    <span class="text-xs text-red-500 font-medium">{{ $message }}</span>
                @enderror
            </div>

            <div class="space-y-2">
                <label class="text-sm font-semibold text-slate-700 dark:text-slate-300" for="password">Kata Sandi</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400">
                        <span class="material-symbols-outlined text-[20px]">lock</span>
                    </span>
                    <input name="password" class="w-full pl-11 pr-4 py-3 rounded-xl bg-white dark:bg-[#111a22] border-slate-200 dark:border-border-dark text-slate-900 dark:text-white focus:ring-2 focus:ring-primary focus:border-transparent transition-all" id="password" placeholder="••••••••" type="password" required/>
                </div>
                @error('password')
                    <span class="text-xs text-red-500 font-medium">{{ $message }}</span>
                @enderror
            </div>

            <div class="space-y-2">
                <label class="text-sm font-semibold text-slate-700 dark:text-slate-300" for="role">Peran (Role)</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400">
                        <span class="material-symbols-outlined text-[20px]">badge</span>
                    </span>
                    <select name="role" class="w-full pl-11 pr-4 py-3 rounded-xl bg-white dark:bg-[#111a22] border-slate-200 dark:border-border-dark text-slate-900 dark:text-white focus:ring-2 focus:ring-primary focus:border-transparent appearance-none cursor-pointer transition-all" id="role" required>
                        <option disabled selected value="">Pilih Peran</option>
                        <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User (Peminjam)</option>
                    </select>
                    <span class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none text-slate-400">
                        <span class="material-symbols-outlined">expand_more</span>
                    </span>
                </div>
                @error('role')
                    <span class="text-xs text-red-500 font-medium">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex items-center justify-end gap-3 col-span-2 pt-6 mt-4 border-t border-slate-200 dark:border-border-dark">
                <a href="{{ route('users.index') }}" class="px-6 py-2.5 text-sm font-semibold text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-700/50 rounded-xl transition-colors">
                    Batal
                </a>
                <button class="px-8 py-2.5 bg-primary hover:bg-primary-dark text-white font-semibold rounded-xl shadow-lg shadow-primary/20 transition-all flex items-center gap-2" type="submit">
                    <span class="material-symbols-outlined text-[20px]">save</span>
                    Simpan Pengguna
                </button>
            </div>
        </form>
    </div>

    <div class="flex items-center gap-3 p-4 bg-blue-50/50 dark:bg-blue-900/10 border border-blue-100 dark:border-blue-900/20 rounded-xl">
        <span class="material-symbols-outlined text-primary">info</span>
        <p class="text-xs text-slate-600 dark:text-slate-400">
            Akun yang ditambahkan akan dapat langsung mengakses sistem menggunakan kredensial yang didaftarkan. Pastikan email institusi valid.
        </p>
    </div>
</div>
@endsection