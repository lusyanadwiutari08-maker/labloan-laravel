@extends('layouts.app')

@section('title', 'Peminjaman Alat - LabLoans')

@section('content')
<div class="max-w-[800px] mx-auto space-y-6">
    <div class="bg-white dark:bg-[#1F2937] p-6 sm:p-10 rounded-xl border border-slate-200 dark:border-border-dark shadow-sm">
        
        <div class="flex items-center gap-4 border-b border-slate-200 dark:border-slate-800 pb-6 mb-6">
            <div class="w-14 h-14 bg-primary/10 text-primary rounded-xl flex items-center justify-center flex-shrink-0">
                <span class="material-symbols-outlined text-3xl">science</span>
            </div>
            <div>
                <h2 class="text-2xl font-bold text-slate-800 dark:text-white">{{ $item->name }}</h2>
                <p class="text-primary font-mono text-sm mt-1">{{ $item->item_code }}</p>
            </div>
        </div>

        <form action="{{ route('quick-loan.store') }}" method="POST" class="space-y-6">
            @csrf
            <input type="hidden" name="item_id" value="{{ $item->id }}">

            <div class="bg-blue-50 dark:bg-blue-900/10 border border-blue-200 dark:border-blue-900/30 rounded-xl p-4 flex gap-3">
                <span class="material-symbols-outlined text-primary">info</span>
                <div>
                    <p class="text-sm font-semibold text-slate-800 dark:text-slate-200">Peminjaman Terautentikasi</p>
                    <p class="text-xs text-slate-600 dark:text-slate-400 mt-1">Anda meminjam sebagai <strong class="text-primary">{{ Auth::user()->name }}</strong>. Peminjaman ini akan langsung tercatat di riwayat Anda.</p>
                </div>
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Batas Waktu Pengembalian</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400 pointer-events-none">
                        <span class="material-symbols-outlined">event</span>
                    </span>
                    <input type="datetime-local" name="return_date" required min="{{ now()->format('Y-m-d\TH:i') }}" class="w-full py-3 pl-12 pr-4 text-slate-900 bg-slate-50 border border-slate-200 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary dark:bg-[#111a22] dark:border-slate-800 dark:text-white transition-all">
                </div>
            </div>

            <button type="submit" class="w-full py-3.5 bg-primary hover:bg-primary-dark text-white font-bold rounded-xl shadow-lg shadow-primary/20 transition-all flex items-center justify-center gap-2">
                <span class="material-symbols-outlined">check_circle</span>
                Konfirmasi Peminjaman
            </button>
        </form>
        
    </div>
</div>
@endsection