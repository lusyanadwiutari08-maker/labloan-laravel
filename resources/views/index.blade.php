@extends('layouts.app')

@section('title', 'Dashboard - LabLoans')

@section('content')
<div class="max-w-[1600px] mx-auto space-y-6">
    
    <div class="relative overflow-hidden rounded-xl bg-gradient-to-r from-[#233648] to-[#111a22] dark:from-[#1F2937] dark:to-[#111827] border border-slate-200 dark:border-border-dark p-6 sm:p-10 shadow-sm">
        <div class="relative z-10 max-w-2xl">
            <h1 class="text-3xl font-bold text-white mb-2">Halo {{ Auth::user()->name }}, Selamat Datang!</h1>
            <p class="text-slate-300 text-lg">
                {{ Auth::user()->role === 'admin' 
                    ? 'Tinjau aktivitas laboratorium dan kelola permintaan hari ini.' 
                    : 'Siap untuk praktikum? Scan QR code alat lab untuk meminjam dengan cepat.' }}
            </p>
            
            <div class="mt-6 flex gap-3">
                @if(Auth::user()->role === 'admin')
                    <button class="px-5 py-2.5 bg-primary hover:bg-primary-dark text-white font-semibold rounded-lg transition-all flex items-center gap-2">
                        <span class="material-symbols-outlined text-[20px]">inventory_2</span> Tambah Barang
                    </button>
                @else
                    <button class="px-5 py-2.5 bg-primary hover:bg-primary-dark text-white font-semibold rounded-lg transition-all flex items-center gap-2">
                        <span class="material-symbols-outlined text-[20px]">qr_code_scanner</span> Mulai Scan QR
                    </button>
                @endif
            </div>
        </div>
        <div class="absolute right-0 top-0 h-full w-1/3 opacity-20 pointer-events-none bg-[url('https://images.unsplash.com/photo-1532094349884-543bc11b234d?q=80&w=2070&auto=format&fit=crop')] bg-cover bg-center mix-blend-overlay"></div>
    </div>

    @if(Auth::user()->role === 'admin')
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <div class="bg-white dark:bg-[#1F2937] p-5 rounded-xl border border-slate-200 shadow-sm">
                <p class="text-sm text-slate-500">Total Pengguna</p>
                <h3 class="text-2xl font-bold">248</h3>
            </div>
            </div>
        
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div class="bg-white dark:bg-[#1F2937] p-5 rounded-xl border border-slate-200 border-l-4 border-l-primary shadow-sm flex items-center gap-4">
                <div class="p-3 bg-blue-50 dark:bg-blue-900/20 rounded-full text-primary">
                    <span class="material-symbols-outlined text-3xl">science</span>
                </div>
                <div>
                    <p class="text-sm font-medium text-slate-500">Sedang Dipinjam</p>
                    <h3 class="text-2xl font-bold text-slate-800 dark:text-white">2 Alat</h3>
                </div>
            </div>

            <div class="bg-white dark:bg-[#1F2937] p-5 rounded-xl border border-slate-200 border-l-4 border-l-green-500 shadow-sm flex items-center gap-4">
                <div class="p-3 bg-green-50 dark:bg-green-900/20 rounded-full text-green-500">
                    <span class="material-symbols-outlined text-3xl">history</span>
                </div>
                <div>
                    <p class="text-sm font-medium text-slate-500">Total Riwayat</p>
                    <h3 class="text-2xl font-bold text-slate-800 dark:text-white">15 Peminjaman</h3>
                </div>
            </div>
        </div>
    @endif

</div>
@endsection