@extends('layouts.app')

@section('title', 'Riwayat Peminjaman - LabLoans')

@section('content')
<div class="max-w-[1600px] mx-auto space-y-6">
    <div class="bg-white dark:bg-[#1F2937] p-6 rounded-xl border border-slate-200 dark:border-border-dark shadow-sm">
        <div class="flex flex-col md:flex-row gap-4 items-end">
            <div class="w-full md:w-64">
                <label class="block text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase mb-2">Rentang Tanggal</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-slate-400 pointer-events-none">
                        <span class="material-symbols-outlined text-[20px]">calendar_today</span>
                    </span>
                    <input class="w-full py-2.5 pl-10 pr-4 text-sm bg-slate-100 dark:bg-[#111a22] border-none rounded-lg focus:ring-2 focus:ring-primary dark:text-white" placeholder="Pilih tanggal..." readonly="" type="text" value="01 Okt 2023 - 31 Okt 2023"/>
                </div>
            </div>
            <div class="w-full md:w-56">
                <label class="block text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase mb-2">Kategori Alat</label>
                <select class="w-full py-2.5 px-4 text-sm bg-slate-100 dark:bg-[#111a22] border-none rounded-lg focus:ring-2 focus:ring-primary dark:text-white">
                    <option>Semua Kategori</option>
                    <option>Optik</option>
                    <option>Gelas Ukur</option>
                    <option>Elektronik</option>
                    <option>Kimia</option>
                </select>
            </div>
            <div class="w-full md:w-56">
                <label class="block text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase mb-2">Status</label>
                <select class="w-full py-2.5 px-4 text-sm bg-slate-100 dark:bg-[#111a22] border-none rounded-lg focus:ring-2 focus:ring-primary dark:text-white">
                    <option>Semua Status</option>
                    <option>Selesai</option>
                    <option>Dibatalkan</option>
                    <option>Terlambat</option>
                </select>
            </div>
            <button class="bg-primary hover:bg-primary-dark text-white px-6 py-2.5 rounded-lg font-semibold text-sm transition-all flex items-center gap-2">
                <span class="material-symbols-outlined text-[20px]">filter_list</span> Terapkan Filter
            </button>
        </div>
    </div>

    <div class="bg-white dark:bg-[#1F2937] rounded-xl border border-slate-200 dark:border-border-dark shadow-sm overflow-hidden flex flex-col">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-slate-600 dark:text-slate-300">
                <thead class="bg-slate-50 dark:bg-[#111827] text-xs uppercase font-semibold text-slate-500 dark:text-slate-400">
                    <tr>
                        <th class="px-6 py-4">Nama Alat</th>
                        <th class="px-6 py-4">ID Alat</th>
                        <th class="px-6 py-4">Tanggal Pinjam</th>
                        <th class="px-6 py-4">Tanggal Kembali</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 dark:divide-border-dark">
                    <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors">
                        <td class="px-6 py-4 font-semibold text-slate-800 dark:text-white">Mikroskop Binokuler X-12</td>
                        <td class="px-6 py-4 font-mono text-xs">#LAB-OPT-2023-088</td>
                        <td class="px-6 py-4">12 Okt 2023</td>
                        <td class="px-6 py-4">15 Okt 2023</td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400 border border-green-200 dark:border-green-800">Selesai</span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <button class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-slate-100 hover:bg-slate-200 dark:bg-slate-800 dark:hover:bg-slate-700 text-slate-700 dark:text-slate-200 text-xs font-semibold rounded border border-slate-200 dark:border-slate-700 transition-all">
                                <span class="material-symbols-outlined text-[16px]">print</span> Cetak Bukti
                            </button>
                        </td>
                    </tr>
                    
                    <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors">
                        <td class="px-6 py-4 font-semibold text-slate-800 dark:text-white">Centrifuge Digital Model C</td>
                        <td class="px-6 py-4 font-mono text-xs">#LAB-ELC-2023-012</td>
                        <td class="px-6 py-4">08 Okt 2023</td>
                        <td class="px-6 py-4">10 Okt 2023</td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400 border border-red-200 dark:border-red-800">Terlambat</span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <button class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-slate-100 hover:bg-slate-200 dark:bg-slate-800 dark:hover:bg-slate-700 text-slate-700 dark:text-slate-200 text-xs font-semibold rounded border border-slate-200 dark:border-slate-700 transition-all">
                                <span class="material-symbols-outlined text-[16px]">visibility</span> Detail
                            </button>
                        </td>
                    </tr>
                    
                    <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors">
                        <td class="px-6 py-4 font-semibold text-slate-800 dark:text-white">Gelas Ukur 500ml Pyrex</td>
                        <td class="px-6 py-4 font-mono text-xs">#LAB-GLS-2023-501</td>
                        <td class="px-6 py-4">05 Okt 2023</td>
                        <td class="px-6 py-4">06 Okt 2023</td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-slate-100 text-slate-800 dark:bg-slate-800 dark:text-slate-400 border border-slate-200 dark:border-slate-700">Dibatalkan</span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <button class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-slate-100 hover:bg-slate-200 dark:bg-slate-800 dark:hover:bg-slate-700 text-slate-700 dark:text-slate-200 text-xs font-semibold rounded border border-slate-200 dark:border-slate-700 transition-all">
                                <span class="material-symbols-outlined text-[16px]">visibility</span> Detail
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        
        <div class="p-4 border-t border-slate-200 dark:border-border-dark bg-slate-50 dark:bg-[#111827] flex justify-between items-center px-6">
            <p class="text-sm font-medium text-slate-600 dark:text-slate-400">
                Total Alat Pernah Dipinjam: <span class="text-slate-900 dark:text-white font-bold ml-1">12 Alat</span>
            </p>
            <div class="flex gap-2">
                <button class="px-3 py-1 text-sm bg-white dark:bg-slate-800 border border-slate-200 dark:border-border-dark rounded disabled:opacity-50" disabled="">Sebelumnya</button>
                <button class="px-3 py-1 text-sm bg-primary text-white rounded">1</button>
                <button class="px-3 py-1 text-sm bg-white dark:bg-slate-800 border border-slate-200 dark:border-border-dark rounded">2</button>
                <button class="px-3 py-1 text-sm bg-white dark:bg-slate-800 border border-slate-200 dark:border-border-dark rounded">Berikutnya</button>
            </div>
        </div>
    </div>
</div>
@endsection