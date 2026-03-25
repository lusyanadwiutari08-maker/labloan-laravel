@extends('layouts.app')

@section('title', 'Dashboard Admin - LabLoans')

@section('content')
<div class="max-w-[1600px] mx-auto space-y-6">
    
    <div class="relative overflow-hidden rounded-xl bg-gradient-to-r from-[#233648] to-[#111a22] dark:from-[#1F2937] dark:to-[#111827] border border-slate-200 dark:border-border-dark p-6 sm:p-10 shadow-sm">
        <div class="relative z-10 max-w-2xl">
            <h1 class="text-3xl font-bold text-white mb-2">Halo {{ Auth::user()->name }}, Selamat Datang Kembali!</h1>
            <p class="text-slate-300 text-lg">Tinjau aktivitas laboratorium dan kelola permintaan peminjaman hari ini.</p>
            <div class="mt-6 flex flex-wrap gap-3">
                <a href="{{ route('admin.loans.index') }}" class="px-5 py-2.5 bg-primary hover:bg-primary-dark text-white font-semibold rounded-lg shadow-lg shadow-primary/30 transition-all flex items-center gap-2">
                    <span class="material-symbols-outlined text-[20px]">list_alt</span>
                    Kelola Peminjaman
                </a>
                <a href="{{ route('items.index') }}" class="px-5 py-2.5 bg-slate-700/50 hover:bg-slate-700 text-white font-semibold rounded-lg border border-slate-600 transition-all flex items-center gap-2">
                    Kelola Inventaris
                </a>
            </div>
        </div>
        <div class="absolute right-0 top-0 h-full w-1/3 opacity-20 pointer-events-none bg-[url('https://images.unsplash.com/photo-1532094349884-543bc11b234d?q=80&w=2070&auto=format&fit=crop')] bg-cover bg-center mix-blend-overlay"></div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        
        <div class="lg:col-span-2 xl:col-span-3 space-y-6">
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                <div class="bg-white dark:bg-[#1F2937] p-5 rounded-xl border border-slate-200 dark:border-border-dark shadow-sm flex flex-col justify-between h-32 group hover:border-primary/50 transition-colors">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-sm font-medium text-slate-500 dark:text-slate-400">Total Pengguna</p>
                            <h3 class="text-2xl font-bold text-slate-800 dark:text-white mt-1">{{ $totalUsers ?? 0 }}</h3>
                        </div>
                        <div class="p-2 bg-blue-50 dark:bg-blue-900/20 rounded-lg text-primary">
                            <span class="material-symbols-outlined">group</span>
                        </div>
                    </div>
                    <div class="flex items-center gap-1 text-xs text-green-500 font-medium">
                        <span class="material-symbols-outlined text-[14px]">trending_up</span>
                        <span>LabLoans System</span>
                    </div>
                </div>
                
                <div class="bg-white dark:bg-[#1F2937] p-5 rounded-xl border border-slate-200 dark:border-border-dark shadow-sm flex flex-col justify-between h-32 group hover:border-primary/50 transition-colors relative overflow-hidden">
                    <div class="absolute right-0 top-0 w-16 h-16 bg-blue-500/10 rounded-bl-full -mr-4 -mt-4 transition-transform group-hover:scale-110"></div>
                    <div class="flex justify-between items-start relative z-10">
                        <div>
                            <p class="text-sm font-medium text-slate-500 dark:text-slate-400">Sedang Dipinjam</p>
                            <h3 class="text-2xl font-bold text-primary mt-1">{{ $activeLoans ?? 0 }}</h3>
                        </div>
                        <div class="p-2 bg-blue-50 dark:bg-blue-900/20 rounded-lg text-primary">
                            <span class="material-symbols-outlined">sync_alt</span>
                        </div>
                    </div>
                    <p class="text-xs text-slate-500 dark:text-slate-400 relative z-10">Alat di luar lab</p>
                </div>
                
                <div class="bg-white dark:bg-[#1F2937] p-5 rounded-xl border border-slate-200 dark:border-border-dark shadow-sm flex flex-col justify-between h-32 group hover:border-red-500/50 transition-colors">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-sm font-medium text-slate-500 dark:text-slate-400">Alat Perlu Servis</p>
                            <h3 class="text-2xl font-bold text-slate-800 dark:text-white mt-1">{{ $maintenanceItems ?? 0 }}</h3>
                        </div>
                        <div class="p-2 bg-red-50 dark:bg-red-900/20 rounded-lg text-red-500">
                            <span class="material-symbols-outlined">build</span>
                        </div>
                    </div>
                    <p class="text-xs text-red-400 font-medium">Status Maintenance</p>
                </div>
                
                <div class="bg-white dark:bg-[#1F2937] p-5 rounded-xl border border-slate-200 dark:border-border-dark shadow-sm flex flex-col justify-between h-32 group hover:border-amber-500/50 transition-colors">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-sm font-medium text-slate-500 dark:text-slate-400">Total Alat Lab</p>
                            <h3 class="text-2xl font-bold text-slate-800 dark:text-white mt-1">{{ $totalItems ?? 0 }} Item</h3>
                        </div>
                        <div class="p-2 bg-amber-50 dark:bg-amber-900/20 rounded-lg text-amber-500">
                            <span class="material-symbols-outlined">inventory</span>
                        </div>
                    </div>
                    <p class="text-xs text-slate-500 dark:text-slate-400">Terdaftar di inventaris</p>
                </div>
            </div>

            <div class="bg-white dark:bg-[#1F2937] rounded-xl border border-slate-200 dark:border-border-dark shadow-sm overflow-hidden flex flex-col">
                <div class="p-6 border-b border-slate-200 dark:border-border-dark flex flex-wrap justify-between items-center gap-4">
                    <h3 class="text-lg font-bold text-slate-800 dark:text-white flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary">table_view</span>
                        Peminjaman Terbaru (Admin View)
                    </h3>
                    <div class="flex gap-2">
                        <a href="{{ route('admin.loans.index') }}" class="px-3 py-1.5 text-sm font-medium text-primary bg-primary/10 rounded hover:bg-primary/20 transition-colors">
                            Lihat Semua
                        </a>
                    </div>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm text-slate-600 dark:text-slate-300">
                        <thead class="bg-slate-50 dark:bg-[#111827] text-xs uppercase font-semibold text-slate-500 dark:text-slate-400">
                            <tr>
                                <th class="px-6 py-4">Nama Alat</th>
                                <th class="px-6 py-4">Nama Peminjam</th>
                                <th class="px-6 py-4">Batas Kembali</th>
                                <th class="px-6 py-4">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-200 dark:divide-border-dark">
                            
                            @forelse($latestLoans ?? [] as $loan)
                                @php
                                    $isOverdue = $loan->status === 'active' && \Carbon\Carbon::now()->greaterThan($loan->return_date);
                                @endphp
                                <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors group {{ $loan->status === 'returned' ? 'opacity-80' : '' }}">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            <div class="flex-shrink-0 w-10 h-10 rounded bg-slate-100 dark:bg-slate-800 flex items-center justify-center text-primary">
                                                <span class="material-symbols-outlined">science</span>
                                            </div>
                                            <div>
                                                <p class="font-semibold text-slate-800 dark:text-white">{{ $loan->item->name ?? 'Alat Dihapus' }}</p>
                                                <p class="text-xs text-slate-500 font-mono">{{ $loan->item->item_code ?? '-' }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-2">
                                            <div class="w-6 h-6 rounded-full bg-primary/20 flex items-center justify-center text-xs text-primary font-bold">
                                                {{ strtoupper(substr($loan->user->name ?? 'U', 0, 2)) }}
                                            </div>
                                            <span class="text-slate-700 dark:text-slate-300 font-medium">{{ $loan->user->name ?? 'User Dihapus' }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 {{ $isOverdue ? 'text-red-500 font-bold' : '' }}">
                                        {{ \Carbon\Carbon::parse($loan->return_date)->format('d M Y, H:i') }}
                                    </td>
                                    <td class="px-6 py-4">
                                        @if($loan->status === 'returned')
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400 border border-green-200 dark:border-green-800">
                                                Returned
                                            </span>
                                        @elseif($isOverdue)
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400 border border-red-200 dark:border-red-800">
                                                Overdue
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-400 border border-blue-200 dark:border-blue-800">
                                                <span class="w-1.5 h-1.5 mr-1.5 bg-blue-500 rounded-full animate-pulse"></span> Active
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-8 text-center text-slate-500">Belum ada peminjaman terbaru.</td>
                                </tr>
                            @endforelse
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="lg:col-span-1 space-y-6">
            
            <div class="bg-white dark:bg-[#1F2937] rounded-xl border border-slate-200 dark:border-border-dark shadow-sm p-5">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="font-bold text-slate-800 dark:text-white">Pemberitahuan Sistem</h3>
                    <button class="text-xs text-primary hover:underline">Mark all read</button>
                </div>
                <div class="space-y-4">
                    <div class="flex gap-3">
                        <div class="flex-shrink-0 w-8 h-8 rounded-full bg-blue-100 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 flex items-center justify-center">
                            <span class="material-symbols-outlined text-[18px]">info</span>
                        </div>
                        <div>
                            <p class="text-sm text-slate-800 dark:text-white leading-snug">Fitur <span class="font-semibold">Activity Logs</span> akan segera diintegrasikan di sini.</p>
                            <p class="text-xs text-slate-500 mt-0.5">Sistem Info</p>
                        </div>
                    </div>
                    <div class="flex gap-3 opacity-60">
                        <div class="flex-shrink-0 w-8 h-8 rounded-full bg-orange-100 dark:bg-orange-900/30 text-orange-600 dark:text-orange-400 flex items-center justify-center">
                            <span class="material-symbols-outlined text-[18px]">person_add</span>
                        </div>
                        <div>
                            <p class="text-sm text-slate-800 dark:text-white leading-snug">Registrasi user baru: <span class="font-semibold">Mahasiswa S2</span></p>
                            <p class="text-xs text-slate-500 mt-0.5">30 menit yang lalu</p>
                        </div>
                    </div>
                    <div class="flex gap-3 opacity-60">
                        <div class="flex-shrink-0 w-8 h-8 rounded-full bg-red-100 dark:bg-red-900/30 text-red-600 dark:text-red-400 flex items-center justify-center">
                            <span class="material-symbols-outlined text-[18px]">report_problem</span>
                        </div>
                        <div>
                            <p class="text-sm text-slate-800 dark:text-white leading-snug">Laporan kerusakan: Mikroskop Lab 3</p>
                            <p class="text-xs text-slate-500 mt-0.5">1 hari yang lalu</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-[#1F2937] rounded-xl border border-slate-200 dark:border-border-dark shadow-sm p-5">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="font-bold text-slate-800 dark:text-white">Aktivitas Lab</h3>
                    <select class="bg-transparent text-xs font-medium text-slate-500 border-none focus:ring-0 cursor-pointer dark:bg-transparent">
                        <option>Minggu Ini</option>
                    </select>
                </div>
                <div class="flex items-end justify-between gap-2 h-40">
                    <div class="flex flex-col items-center gap-2 w-full">
                        <div class="w-full bg-slate-100 dark:bg-slate-700 rounded-t-sm relative h-full flex items-end">
                            <div class="w-full bg-primary/40 dark:bg-primary/30 rounded-t-sm" style="height: 40%"></div>
                        </div>
                        <span class="text-xs text-slate-500">Sen</span>
                    </div>
                    <div class="flex flex-col items-center gap-2 w-full">
                        <div class="w-full bg-slate-100 dark:bg-slate-700 rounded-t-sm relative h-full flex items-end">
                            <div class="w-full bg-primary/40 dark:bg-primary/30 rounded-t-sm" style="height: 65%"></div>
                        </div>
                        <span class="text-xs text-slate-500">Sel</span>
                    </div>
                    <div class="flex flex-col items-center gap-2 w-full">
                        <div class="w-full bg-slate-100 dark:bg-slate-700 rounded-t-sm relative h-full flex items-end">
                            <div class="w-full bg-primary rounded-t-sm shadow-[0_0_10px_rgba(19,127,236,0.5)]" style="height: 85%"></div>
                        </div>
                        <span class="text-xs font-bold text-primary">Rab</span>
                    </div>
                    <div class="flex flex-col items-center gap-2 w-full">
                        <div class="w-full bg-slate-100 dark:bg-slate-700 rounded-t-sm relative h-full flex items-end">
                            <div class="w-full bg-primary/40 dark:bg-primary/30 rounded-t-sm" style="height: 55%"></div>
                        </div>
                        <span class="text-xs text-slate-500">Kam</span>
                    </div>
                    <div class="flex flex-col items-center gap-2 w-full">
                        <div class="w-full bg-slate-100 dark:bg-slate-700 rounded-t-sm relative h-full flex items-end">
                            <div class="w-full bg-primary/40 dark:bg-primary/30 rounded-t-sm" style="height: 30%"></div>
                        </div>
                        <span class="text-xs text-slate-500">Jum</span>
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-br from-primary to-primary-dark rounded-xl shadow-lg p-5 text-white">
                <h3 class="font-bold mb-2">Manajemen Cepat</h3>
                <p class="text-sm text-blue-100 mb-4 opacity-90">Akses cepat untuk pengaturan sistem dan inventaris.</p>
                <a href="{{ route('items.create') }}" class="block text-center w-full py-2 bg-white text-primary font-semibold text-sm rounded-lg hover:bg-blue-50 transition-colors">
                    + Tambah Alat Lab
                </a>
            </div>

        </div>
    </div>
</div>
@endsection