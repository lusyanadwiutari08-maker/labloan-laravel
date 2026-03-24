@extends('layouts.app')

@section('title', 'Manajemen User Admin - LabLoans')

@push('styles')
<style type="text/tailwindcss">
    .active-glow {
        box-shadow: 0 0 15px rgba(19, 127, 236, 0.3);
    }
</style>
@endpush

@section('content')
<div class="max-w-[1600px] mx-auto space-y-6">
    
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-slate-800 dark:text-white">Daftar Pengguna</h1>
            <p class="text-sm text-slate-500 dark:text-slate-400">Kelola hak akses dan informasi pengguna LabLoans.</p>
        </div>
        <button class="px-5 py-2.5 bg-primary hover:bg-primary-dark text-white font-semibold rounded-lg shadow-lg shadow-primary/30 transition-all flex items-center justify-center gap-2">
            <span class="material-symbols-outlined text-[20px]">person_add</span>
            Tambah User
        </button>
    </div>

    <div class="bg-white dark:bg-[#1F2937] p-4 rounded-xl border border-slate-200 dark:border-border-dark shadow-sm flex flex-col md:flex-row gap-4">
        <div class="relative flex-1">
            <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-slate-400 pointer-events-none">
                <span class="material-symbols-outlined text-[20px]">search</span>
            </span>
            <input class="w-full py-2.5 pl-10 pr-4 text-sm text-slate-900 bg-slate-100 border-none rounded-lg focus:outline-none focus:ring-2 focus:ring-primary dark:bg-[#233648] dark:text-white dark:placeholder-slate-400 transition-all" placeholder="Cari nama, username, atau email..." type="text"/>
        </div>
        <div class="flex gap-2">
            <select class="py-2.5 pl-4 pr-10 text-sm bg-slate-100 border-none rounded-lg focus:ring-2 focus:ring-primary dark:bg-[#233648] dark:text-white cursor-pointer appearance-none">
                <option value="">Semua Role</option>
                <option value="mahasiswa">Mahasiswa</option>
                <option value="dosen">Dosen</option>
                <option value="staf">Staf</option>
            </select>
            <button class="px-4 py-2.5 text-sm font-medium text-slate-600 dark:text-slate-300 bg-slate-100 dark:bg-[#233648] rounded-lg hover:bg-slate-200 dark:hover:bg-slate-700 transition-colors flex items-center gap-2">
                <span class="material-symbols-outlined text-[18px]">filter_list</span> Filter
            </button>
        </div>
    </div>

    <div class="bg-white dark:bg-[#1F2937] rounded-xl border border-slate-200 dark:border-border-dark shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-slate-600 dark:text-slate-300">
                <thead class="bg-slate-50 dark:bg-[#111827] text-xs uppercase font-semibold text-slate-500 dark:text-slate-400">
                    <tr>
                        <th class="px-6 py-4">Pengguna</th>
                        <th class="px-6 py-4">Username</th>
                        <th class="px-6 py-4">Role</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 dark:divide-border-dark">
                    <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors">
                        <td class="px-6 py-4">
                            <div class="flex flex-col">
                                <p class="font-bold text-slate-800 dark:text-white">Budi Santoso</p>
                                <p class="text-xs text-slate-500">budi.s@univ.ac.id</p>
                            </div>
                        </td>
                        <td class="px-6 py-4 font-medium">budisantoso123</td>
                        <td class="px-6 py-4">
                            <span class="px-2.5 py-1 rounded-md text-xs font-semibold bg-blue-50 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400">Mahasiswa</span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400 border border-green-200 dark:border-green-800">
                                <span class="w-1.5 h-1.5 mr-1.5 bg-green-500 rounded-full"></span> Aktif
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex justify-end gap-2">
                                <button class="p-1.5 text-slate-500 hover:text-primary hover:bg-primary/10 rounded-lg transition-colors" title="Edit User">
                                    <span class="material-symbols-outlined text-[20px]">edit</span>
                                </button>
                                <button class="p-1.5 text-slate-500 hover:text-amber-500 hover:bg-amber-500/10 rounded-lg transition-colors" title="Reset Password">
                                    <span class="material-symbols-outlined text-[20px]">lock_reset</span>
                                </button>
                                <button class="p-1.5 text-slate-500 hover:text-red-500 hover:bg-red-500/10 rounded-lg transition-colors" title="Hapus User">
                                    <span class="material-symbols-outlined text-[20px]">delete</span>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors">
                        <td class="px-6 py-4">
                            <div class="flex flex-col">
                                <p class="font-bold text-slate-800 dark:text-white">Dr. Sarah Wijaya</p>
                                <p class="text-xs text-slate-500">sarah.w@univ.ac.id</p>
                            </div>
                        </td>
                        <td class="px-6 py-4 font-medium">sarah_wijaya</td>
                        <td class="px-6 py-4">
                            <span class="px-2.5 py-1 rounded-md text-xs font-semibold bg-purple-50 text-purple-700 dark:bg-purple-900/30 dark:text-purple-400">Dosen</span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400 border border-green-200 dark:border-green-800">
                                <span class="w-1.5 h-1.5 mr-1.5 bg-green-500 rounded-full"></span> Aktif
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex justify-end gap-2">
                                <button class="p-1.5 text-slate-500 hover:text-primary hover:bg-primary/10 rounded-lg transition-colors" title="Edit User">
                                    <span class="material-symbols-outlined text-[20px]">edit</span>
                                </button>
                                <button class="p-1.5 text-slate-500 hover:text-amber-500 hover:bg-amber-500/10 rounded-lg transition-colors" title="Reset Password">
                                    <span class="material-symbols-outlined text-[20px]">lock_reset</span>
                                </button>
                                <button class="p-1.5 text-slate-500 hover:text-red-500 hover:bg-red-500/10 rounded-lg transition-colors" title="Hapus User">
                                    <span class="material-symbols-outlined text-[20px]">delete</span>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors">
                        <td class="px-6 py-4">
                            <div class="flex flex-col">
                                <p class="font-bold text-slate-800 dark:text-white">Andi Kurniawan</p>
                                <p class="text-xs text-slate-500">andi.k@univ.ac.id</p>
                            </div>
                        </td>
                        <td class="px-6 py-4 font-medium">andikurnia</td>
                        <td class="px-6 py-4">
                            <span class="px-2.5 py-1 rounded-md text-xs font-semibold bg-emerald-50 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-400">Staf</span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-slate-100 text-slate-800 dark:bg-slate-800 dark:text-slate-400 border border-slate-200 dark:border-slate-700">
                                <span class="w-1.5 h-1.5 mr-1.5 bg-slate-400 rounded-full"></span> Nonaktif
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex justify-end gap-2">
                                <button class="p-1.5 text-slate-500 hover:text-primary hover:bg-primary/10 rounded-lg transition-colors" title="Edit User">
                                    <span class="material-symbols-outlined text-[20px]">edit</span>
                                </button>
                                <button class="p-1.5 text-slate-500 hover:text-amber-500 hover:bg-amber-500/10 rounded-lg transition-colors" title="Reset Password">
                                    <span class="material-symbols-outlined text-[20px]">lock_reset</span>
                                </button>
                                <button class="p-1.5 text-slate-500 hover:text-red-500 hover:bg-red-500/10 rounded-lg transition-colors" title="Hapus User">
                                    <span class="material-symbols-outlined text-[20px]">delete</span>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors">
                        <td class="px-6 py-4">
                            <div class="flex flex-col">
                                <p class="font-bold text-slate-800 dark:text-white">Rizky Ramadhan</p>
                                <p class="text-xs text-slate-500">rizky.r@univ.ac.id</p>
                            </div>
                        </td>
                        <td class="px-6 py-4 font-medium">rizkyram</td>
                        <td class="px-6 py-4">
                            <span class="px-2.5 py-1 rounded-md text-xs font-semibold bg-blue-50 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400">Mahasiswa</span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400 border border-green-200 dark:border-green-800">
                                <span class="w-1.5 h-1.5 mr-1.5 bg-green-500 rounded-full"></span> Aktif
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex justify-end gap-2">
                                <button class="p-1.5 text-slate-500 hover:text-primary hover:bg-primary/10 rounded-lg transition-colors" title="Edit User">
                                    <span class="material-symbols-outlined text-[20px]">edit</span>
                                </button>
                                <button class="p-1.5 text-slate-500 hover:text-amber-500 hover:bg-amber-500/10 rounded-lg transition-colors" title="Reset Password">
                                    <span class="material-symbols-outlined text-[20px]">lock_reset</span>
                                </button>
                                <button class="p-1.5 text-slate-500 hover:text-red-500 hover:bg-red-500/10 rounded-lg transition-colors" title="Hapus User">
                                    <span class="material-symbols-outlined text-[20px]">delete</span>
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="p-4 border-t border-slate-200 dark:border-border-dark bg-slate-50 dark:bg-[#111827] flex items-center justify-between">
            <p class="text-xs text-slate-500 dark:text-slate-400">Menampilkan 4 dari 248 pengguna</p>
            <div class="flex gap-2">
                <button class="px-3 py-1 text-xs font-medium text-slate-600 dark:text-slate-300 bg-white dark:bg-[#1F2937] border border-slate-200 dark:border-border-dark rounded hover:bg-slate-50 transition-colors">Sebelumnya</button>
                <button class="px-3 py-1 text-xs font-medium text-white bg-primary rounded hover:bg-primary-dark transition-colors">1</button>
                <button class="px-3 py-1 text-xs font-medium text-slate-600 dark:text-slate-300 bg-white dark:bg-[#1F2937] border border-slate-200 dark:border-border-dark rounded hover:bg-slate-50 transition-colors">2</button>
                <button class="px-3 py-1 text-xs font-medium text-slate-600 dark:text-slate-300 bg-white dark:bg-[#1F2937] border border-slate-200 dark:border-border-dark rounded hover:bg-slate-50 transition-colors">Berikutnya</button>
            </div>
        </div>
    </div>
</div>
@endsection