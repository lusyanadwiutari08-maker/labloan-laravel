@extends('layouts.app')

@section('title', 'LabLoans Inventaris Admin')

@push('styles')
<style type="text/tailwindcss">
    /* Taruh css khusus halaman inventaris di sini jika ada */
</style>
@endpush

@section('content')
<div class="max-w-[1600px] mx-auto space-y-6">
    
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6">
        <div>
            <h1 class="text-2xl font-bold text-slate-800 dark:text-white tracking-tight">Daftar Inventaris</h1>
            <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">Kelola data alat lab dan generate QR Code.</p>
        </div>
        
        <a href="#" class="inline-flex px-4 py-2 bg-primary hover:bg-primary-dark text-white text-sm font-semibold rounded-lg shadow-lg shadow-primary/20 transition-all items-center justify-center gap-2">
            <span class="material-symbols-outlined text-[20px]">add</span>
            Tambah Alat Baru
        </a>
    </div>

    <div class="bg-white dark:bg-[#1F2937] p-6 rounded-xl border border-slate-200 dark:border-border-dark shadow-sm">
        
        <div class="flex flex-col md:flex-row gap-4 mb-6">
            <div class="relative flex-1">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-slate-400 pointer-events-none">
                    <span class="material-symbols-outlined text-[20px]">search</span>
                </span>
                <input type="text" class="w-full py-2.5 pl-10 pr-4 text-sm text-slate-900 bg-slate-50 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary dark:bg-[#111a22] dark:border-border-dark dark:text-white transition-all" placeholder="Cari nama alat atau kode item...">
            </div>
        </div>

        <div class="text-center py-10 border-2 border-dashed border-slate-200 dark:border-border-dark rounded-lg">
            <span class="material-symbols-outlined text-4xl text-slate-400 mb-2">inventory_2</span>
            <p class="text-slate-500 dark:text-slate-400">Tabel data alat dan QR Code akan kita buat di sini.</p>
        </div>

    </div>

</div>
@endsection