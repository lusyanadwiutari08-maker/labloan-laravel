@extends('layouts.app')

@section('title', 'Edit Pengguna - LabLoans')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <nav class="flex items-center gap-2 text-sm font-medium text-slate-500 dark:text-slate-400">
        <a class="hover:text-primary transition-colors" href="{{ route('users.index') }}">Manajemen User</a>
        <span class="material-symbols-outlined text-sm">chevron_right</span>
        <span class="text-slate-900 dark:text-white">Edit Pengguna</span>
    </nav>

    <div class="flex flex-col gap-2">
        <h1 class="text-2xl font-bold text-slate-800 dark:text-white">Edit Pengguna</h1>
        <p class="text-sm text-slate-500 dark:text-slate-400">Perbarui informasi pengguna di bawah ini untuk mengubah data akses mereka di sistem.</p>
    </div>

    <div class="glass-effect rounded-2xl p-8 shadow-xl">
        <form action="{{ route('users.update', $user->id) }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @csrf
            @method('PUT')

            <div class="space-y-2 col-span-2">
                <label class="text-sm font-semibold text-slate-700 dark:text-slate-300" for="name">Nama Lengkap</label>
                <input name="name" value="{{ old('name', $user->name) }}" class="w-full px-4 py-3 rounded-xl bg-white dark:bg-[#111a22] border-slate-200 dark:border-border-dark text-slate-900 dark:text-white focus:ring-2 focus:ring-primary focus:border-transparent transition-all" id="name" type="text" required/>
                @error('name') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
            </div>

            <div class="space-y-2">
                <label class="text-sm font-semibold text-slate-700 dark:text-slate-300" for="username">Username</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400">
                        <span class="material-symbols-outlined text-[20px]">alternate_email</span>
                    </span>
                    <input name="username" value="{{ old('username', $user->username) }}" class="w-full pl-11 pr-4 py-3 rounded-xl bg-white dark:bg-[#111a22] border-slate-200 dark:border-border-dark text-slate-900 dark:text-white focus:ring-2 focus:ring-primary focus:border-transparent transition-all" id="username" type="text" required/>
                </div>
                @error('username') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
            </div>

            <div class="space-y-2">
                <label class="text-sm font-semibold text-slate-700 dark:text-slate-300" for="email">Email Institusi</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400">
                        <span class="material-symbols-outlined text-[20px]">mail</span>
                    </span>
                    <input name="email" value="{{ old('email', $user->email) }}" class="w-full pl-11 pr-4 py-3 rounded-xl bg-white dark:bg-[#111a22] border-slate-200 dark:border-border-dark text-slate-900 dark:text-white focus:ring-2 focus:ring-primary focus:border-transparent transition-all" id="email" type="email" required/>
                </div>
                @error('email') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
            </div>

            <div class="space-y-2">
                <label class="text-sm font-semibold text-slate-700 dark:text-slate-300" for="password">Kata Sandi Baru <span class="text-xs font-normal text-slate-400">(Opsional)</span></label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400">
                        <span class="material-symbols-outlined text-[20px]">lock</span>
                    </span>
                    <input name="password" class="w-full pl-11 pr-4 py-3 rounded-xl bg-white dark:bg-[#111a22] border-slate-200 dark:border-border-dark text-slate-900 dark:text-white focus:ring-2 focus:ring-primary focus:border-transparent transition-all" id="password" placeholder="Kosongkan jika tidak diubah" type="password"/>
                </div>
                @error('password') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
            </div>

            <div class="space-y-2">
                <label class="text-sm font-semibold text-slate-700 dark:text-slate-300" for="role">Peran (Role)</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400">
                        <span class="material-symbols-outlined text-[20px]">badge</span>
                    </span>
                    <select name="role" class="w-full pl-11 pr-4 py-3 rounded-xl bg-white dark:bg-[#111a22] border-slate-200 dark:border-border-dark text-slate-900 dark:text-white focus:ring-2 focus:ring-primary focus:border-transparent appearance-none cursor-pointer transition-all" id="role" required>
                        <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="user" {{ old('role', $user->role) == 'user' ? 'selected' : '' }}>User</option>
                    </select>
                    <span class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none text-slate-400">
                        <span class="material-symbols-outlined">expand_more</span>
                    </span>
                </div>
                @error('role') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
            </div>

            <div class="flex items-center justify-between col-span-2 pt-6 mt-4 border-t border-slate-200 dark:border-border-dark">
                <button type="button" onclick="document.getElementById('delete-form-{{ $user->id }}').submit();" class="px-4 py-2.5 text-sm font-semibold text-red-500 border border-red-500/30 hover:bg-red-500/10 rounded-xl transition-colors flex items-center gap-2">
                    <span class="material-symbols-outlined text-[18px]">delete</span>
                    Hapus Pengguna
                </button>

                <div class="flex items-center gap-3">
                    <a href="{{ route('users.index') }}" class="px-6 py-2.5 text-sm font-semibold text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-700/50 rounded-xl transition-colors">
                        Batal
                    </a>
                    <button class="px-8 py-2.5 bg-primary hover:bg-primary-dark text-white font-semibold rounded-xl shadow-lg shadow-primary/20 transition-all flex items-center gap-2" type="submit">
                        <span class="material-symbols-outlined text-[20px]">save</span>
                        Simpan Perubahan
                    </button>
                </div>
            </div>
        </form>

        <form id="delete-form-{{ $user->id }}" action="{{ route('users.destroy', $user->id) }}" method="POST" class="hidden">
            @csrf
            @method('DELETE')
        </form>
    </div>

    <div class="flex items-center gap-3 p-4 bg-yellow-50/50 dark:bg-yellow-900/10 border border-yellow-100 dark:border-yellow-900/20 rounded-xl">
        <span class="material-symbols-outlined text-yellow-600 dark:text-yellow-500">info</span>
        <p class="text-xs text-slate-600 dark:text-slate-400">
            Perubahan pada akun ini akan langsung berdampak pada akses pengguna ke sistem.
        </p>
    </div>
</div>
@endsection