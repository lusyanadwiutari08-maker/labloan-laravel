@extends('layouts.app')

@section('title', 'Manajemen Peminjaman - LabLoans')

@section('content')
<div class="max-w-[1600px] mx-auto space-y-6">
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="bg-white dark:bg-[#1F2937] p-4 rounded-xl border border-slate-200 dark:border-border-dark shadow-sm flex flex-col justify-between h-28 group hover:border-primary/50 transition-colors">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">Total Pinjam</p>
                    <h3 class="text-2xl font-bold text-slate-800 dark:text-white mt-1">1,284</h3>
                </div>
                <div class="p-2 bg-blue-50 dark:bg-blue-900/20 rounded-lg text-primary">
                    <span class="material-symbols-outlined">analytics</span>
                </div>
            </div>
        </div>
        <div class="bg-white dark:bg-[#1F2937] p-4 rounded-xl border border-slate-200 dark:border-border-dark shadow-sm flex flex-col justify-between h-28 group hover:border-primary/50 transition-colors">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">Sedang Dipinjam</p>
                    <h3 class="text-2xl font-bold text-primary mt-1">42</h3>
                </div>
                <div class="p-2 bg-blue-50 dark:bg-blue-900/20 rounded-lg text-primary">
                    <span class="material-symbols-outlined">sync_alt</span>
                </div>
            </div>
        </div>
        <div class="bg-white dark:bg-[#1F2937] p-4 rounded-xl border border-slate-200 dark:border-border-dark shadow-sm flex flex-col justify-between h-28 group hover:border-red-500/50 transition-colors">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">Terlambat</p>
                    <h3 class="text-2xl font-bold text-red-500 mt-1">8</h3>
                </div>
                <div class="p-2 bg-red-50 dark:bg-red-900/20 rounded-lg text-red-500">
                    <span class="material-symbols-outlined">warning</span>
                </div>
            </div>
        </div>
        <div class="bg-white dark:bg-[#1F2937] p-4 rounded-xl border border-slate-200 dark:border-border-dark shadow-sm flex flex-col justify-between h-28 group hover:border-amber-500/50 transition-colors">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">Butuh Verifikasi</p>
                    <h3 class="text-2xl font-bold text-amber-500 mt-1">15</h3>
                </div>
                <div class="p-2 bg-amber-50 dark:bg-amber-900/20 rounded-lg text-amber-500">
                    <span class="material-symbols-outlined">rule</span>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white dark:bg-[#1F2937] rounded-xl border border-slate-200 dark:border-border-dark shadow-sm overflow-hidden flex flex-col">
        <div class="p-6 border-b border-slate-200 dark:border-border-dark flex flex-wrap justify-between items-center gap-4">
            <div class="flex items-center gap-4">
                <h3 class="text-lg font-bold text-slate-800 dark:text-white">Daftar Peminjaman</h3>
                <div class="flex bg-slate-100 dark:bg-slate-800 p-1 rounded-lg">
                    <button class="px-3 py-1 text-xs font-semibold bg-white dark:bg-[#233648] shadow-sm rounded-md">Semua</button>
                    <button class="px-3 py-1 text-xs font-medium text-slate-500 hover:text-slate-800 dark:hover:text-white transition-colors">Aktif</button>
                    <button class="px-3 py-1 text-xs font-medium text-slate-500 hover:text-slate-800 dark:hover:text-white transition-colors">Pending</button>
                </div>
            </div>
            <div class="flex gap-2">
                <button class="flex items-center gap-2 px-4 py-2 text-sm font-medium text-slate-700 dark:text-slate-300 bg-white dark:bg-slate-800 border border-slate-200 dark:border-border-dark rounded-lg hover:bg-slate-50 dark:hover:bg-slate-700 transition-colors">
                    <span class="material-symbols-outlined text-[18px]">filter_list</span> Filter
                </button>
                <button class="flex items-center gap-2 px-4 py-2 text-sm font-medium text-white bg-primary rounded-lg hover:bg-primary-dark transition-colors">
                    <span class="material-symbols-outlined text-[18px]">download</span> Ekspor Data
                </button>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-slate-600 dark:text-slate-300 border-collapse">
                <thead class="bg-slate-50 dark:bg-[#111827] text-xs uppercase font-semibold text-slate-500 dark:text-slate-400">
                    <tr>
                        <th class="px-6 py-4 border-b border-slate-200 dark:border-border-dark">ID Pinjam</th>
                        <th class="px-6 py-4 border-b border-slate-200 dark:border-border-dark">Nama Alat</th>
                        <th class="px-6 py-4 border-b border-slate-200 dark:border-border-dark">Peminjam</th>
                        <th class="px-6 py-4 border-b border-slate-200 dark:border-border-dark">Instansi</th>
                        <th class="px-6 py-4 border-b border-slate-200 dark:border-border-dark">Tgl Pinjam</th>
                        <th class="px-6 py-4 border-b border-slate-200 dark:border-border-dark">Tgl Kembali</th>
                        <th class="px-6 py-4 border-b border-slate-200 dark:border-border-dark">Status</th>
                        <th class="px-6 py-4 border-b border-slate-200 dark:border-border-dark text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 dark:divide-border-dark">
                    <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors group bg-amber-50/20 dark:bg-amber-500/5">
                        <td class="px-6 py-4 font-mono text-xs text-slate-500">#LP-240105</td>
                        <td class="px-6 py-4">
                            <span class="font-semibold text-slate-800 dark:text-white">Centrifuge 5000</span>
                        </td>
                        <td class="px-6 py-4 font-medium">Budi Pratama</td>
                        <td class="px-6 py-4 text-xs">Fakultas Teknik</td>
                        <td class="px-6 py-4">14 Okt 2023</td>
                        <td class="px-6 py-4 text-slate-400">—</td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-amber-100 text-amber-800 dark:bg-amber-900/30 dark:text-amber-400 border border-amber-200 dark:border-amber-800">
                                Pending
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex justify-end gap-2">
                                <button class="p-1.5 bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400 rounded hover:bg-green-200 transition-colors" title="Verifikasi">
                                    <span class="material-symbols-outlined text-[18px]">verified</span>
                                </button>
                                <button class="p-1.5 bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400 rounded hover:bg-red-200 transition-colors" title="Tolak">
                                    <span class="material-symbols-outlined text-[18px]">cancel</span>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors group">
                        <td class="px-6 py-4 font-mono text-xs text-slate-500">#LP-240101</td>
                        <td class="px-6 py-4">
                            <span class="font-semibold text-slate-800 dark:text-white">Mikroskop Elektron</span>
                        </td>
                        <td class="px-6 py-4 font-medium">Dr. Ahmad</td>
                        <td class="px-6 py-4 text-xs">Laboratorium Biologi</td>
                        <td class="px-6 py-4">12 Okt 2023</td>
                        <td class="px-6 py-4">19 Okt 2023</td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-400 border border-blue-200 dark:border-blue-800">
                                Active
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex justify-end gap-2">
                                <button class="p-1.5 bg-slate-100 text-slate-700 dark:bg-slate-800 dark:text-slate-300 rounded hover:bg-slate-200 transition-colors" title="Selesai">
                                    <span class="material-symbols-outlined text-[18px]">check_circle</span>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors group">
                        <td class="px-6 py-4 font-mono text-xs text-slate-500">#LP-240098</td>
                        <td class="px-6 py-4">
                            <span class="font-semibold text-slate-800 dark:text-white">Spectrophotometer</span>
                        </td>
                        <td class="px-6 py-4 font-medium">Rina Rose</td>
                        <td class="px-6 py-4 text-xs">Farmasi Madya</td>
                        <td class="px-6 py-4">05 Okt 2023</td>
                        <td class="px-6 py-4 text-red-500 font-medium">12 Okt 2023</td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400 border border-red-200 dark:border-red-800">
                                Overdue
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex justify-end gap-2">
                                <button class="p-1.5 bg-orange-100 text-orange-700 dark:bg-orange-900/30 dark:text-orange-400 rounded hover:bg-orange-200 transition-colors" title="Ingatkan">
                                    <span class="material-symbols-outlined text-[18px]">notifications_active</span>
                                </button>
                                <button class="p-1.5 bg-slate-100 text-slate-700 dark:bg-slate-800 dark:text-slate-300 rounded hover:bg-slate-200 transition-colors" title="Selesai">
                                    <span class="material-symbols-outlined text-[18px]">check_circle</span>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors group opacity-80">
                        <td class="px-6 py-4 font-mono text-xs text-slate-500">#LP-240092</td>
                        <td class="px-6 py-4">
                            <span class="font-semibold text-slate-800 dark:text-white">Pipet Volumetrik</span>
                        </td>
                        <td class="px-6 py-4 font-medium">Siti Badriah</td>
                        <td class="px-6 py-4 text-xs">Kesehatan Lingkungan</td>
                        <td class="px-6 py-4">02 Okt 2023</td>
                        <td class="px-6 py-4">10 Okt 2023</td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400 border border-green-200 dark:border-green-800">
                                Returned
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <button class="text-xs px-2 py-1 bg-slate-100 dark:bg-slate-800 rounded text-slate-600 dark:text-slate-400 hover:text-primary transition-colors">Detail</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="p-4 border-t border-slate-200 dark:border-border-dark bg-slate-50 dark:bg-[#111827] flex items-center justify-between">
            <p class="text-xs text-slate-500">Menampilkan 1-10 dari 1,284 peminjaman</p>
            <div class="flex gap-1">
                <button class="px-2 py-1 text-xs border border-slate-200 dark:border-border-dark rounded disabled:opacity-50" disabled="">
                    <span class="material-symbols-outlined text-[14px]">chevron_left</span>
                </button>
                <button class="px-3 py-1 text-xs bg-primary text-white rounded">1</button>
                <button class="px-3 py-1 text-xs border border-slate-200 dark:border-border-dark rounded">2</button>
                <button class="px-3 py-1 text-xs border border-slate-200 dark:border-border-dark rounded">3</button>
                <button class="px-2 py-1 text-xs border border-slate-200 dark:border-border-dark rounded">
                    <span class="material-symbols-outlined text-[14px]">chevron_right</span>
                </button>
            </div>
        </div>
    </div>
</div>
@endsection