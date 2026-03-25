@extends('layouts.app')

@section('title', 'Tambah Alat Baru - LabLoans')

@push('styles')
<style type="text/tailwindcss">
    .glass-card {
        background: rgba(31, 41, 55, 0.6);
        backdrop-filter: blur(12px);
        border: 1px solid rgba(255, 255, 255, 0.1);
    }
    .neon-glow {
        box-shadow: 0 0 15px rgba(19, 127, 236, 0.3);
    }
    .form-input-focus {
        @apply focus:ring-2 focus:ring-primary focus:border-transparent outline-none transition-all;
    }
</style>
@endpush

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <div class="flex flex-col">
        <div class="flex items-center gap-2 text-xs text-slate-500 dark:text-slate-400 mb-1">
            <a href="{{ route('items.index') }}" class="hover:text-primary transition-colors">Inventaris</a>
            <span class="material-symbols-outlined text-[14px]">chevron_right</span>
            <span class="text-primary dark:text-blue-400 font-medium">Tambah Alat Baru</span>
        </div>
        <h2 class="text-2xl font-bold text-slate-800 dark:text-white tracking-tight">Tambah Alat Baru</h2>
    </div>

    <div class="glass-card rounded-2xl overflow-hidden shadow-2xl">
        <div class="p-8 space-y-8">
            <form action="{{ route('items.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
                @csrf
                
                <div class="space-y-6">
                    <div class="space-y-2">
                        <label class="text-sm font-semibold text-slate-700 dark:text-slate-300" for="name">Nama Alat</label>
                        <input name="name" value="{{ old('name') }}" class="w-full px-4 py-2.5 bg-white dark:bg-slate-800/50 border border-slate-200 dark:border-slate-700 rounded-lg dark:text-white form-input-focus" id="name" placeholder="Contoh: Mikroskop Olympus CX23" type="text" required/>
                        @error('name') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="text-sm font-semibold text-slate-700 dark:text-slate-300" for="item_code">Kode / ID Alat (Unik)</label>
                        <div class="relative">
                            <input name="item_code" value="{{ old('item_code') }}" class="w-full px-4 py-2.5 bg-white dark:bg-slate-800/50 border border-slate-200 dark:border-slate-700 rounded-lg dark:text-white form-input-focus font-mono" id="item_code" placeholder="Kosongkan untuk auto-generate" type="text"/>
                            
                            <button onclick="generateRandomID()" class="absolute right-2 top-2 p-1 text-primary hover:text-primary-dark transition-colors bg-white dark:bg-slate-800 rounded shadow-sm" title="Generate ID Acak" type="button">
                                <span class="material-symbols-outlined text-[20px]">refresh</span>
                            </button>
                        </div>
                        <p class="text-[10px] text-slate-500 mt-1">Kode ini akan menjadi dasar identifikasi pada QR Code.</p>
                        @error('item_code') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                    </div>

                    <div class="space-y-3">
                        <label class="text-sm font-semibold text-slate-700 dark:text-slate-300">Status Awal</label>
                        <div class="flex gap-4">
                            <label class="flex-1 relative cursor-pointer group">
                                <input type="radio" name="status" value="available" class="peer hidden" {{ old('status', 'available') == 'available' ? 'checked' : '' }}/>
                                <div class="h-full flex items-center justify-center gap-2 p-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800/30 transition-all group-hover:border-primary/50 peer-checked:bg-primary/10 peer-checked:border-primary">
                                    <span class="material-symbols-outlined text-green-500">check_circle</span>
                                    <span class="text-sm font-bold text-slate-600 dark:text-slate-300">Tersedia</span>
                                </div>
                            </label>
                            
                            <label class="flex-1 relative cursor-pointer group">
                                <input type="radio" name="status" value="maintenance" class="peer hidden" {{ old('status') == 'maintenance' ? 'checked' : '' }}/>
                                <div class="h-full flex items-center justify-center gap-2 p-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800/30 transition-all group-hover:border-red-500/50 peer-checked:bg-red-500/10 peer-checked:border-red-500">
                                    <span class="material-symbols-outlined text-red-500">build</span>
                                    <span class="text-sm font-bold text-slate-600 dark:text-slate-300">Perbaikan</span>
                                </div>
                            </label>
                        </div>
                        @error('status') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="space-y-6">
                    <div class="space-y-2">
                        <label class="text-sm font-semibold text-slate-700 dark:text-slate-300" for="description">Deskripsi Alat</label>
                        <textarea name="description" class="w-full px-4 py-2.5 bg-white dark:bg-slate-800/50 border border-slate-200 dark:border-slate-700 rounded-lg dark:text-white form-input-focus resize-none h-[116px]" id="description" placeholder="Tambahkan detail spesifikasi atau catatan tambahan untuk alat ini...">{{ old('description') }}</textarea>
                        @error('description') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                    </div>
                    
                    <div class="p-6 rounded-2xl bg-slate-100/50 dark:bg-slate-800/80 border border-dashed border-slate-300 dark:border-slate-600 flex flex-col items-center justify-center text-center space-y-4">
                        <div class="w-32 h-32 bg-white rounded-xl p-2 flex items-center justify-center shadow-lg relative overflow-hidden">
                            <div class="absolute inset-0 bg-gradient-to-b from-transparent via-primary/20 to-transparent w-full h-[200%] animate-[scan_2s_ease-in-out_infinite]"></div>
                            <div class="w-full h-full text-slate-900 flex items-center justify-center opacity-40 z-10">
                                <span class="material-symbols-outlined !text-[80px]">qr_code_2</span>
                            </div>
                        </div>
                        <div>
                            <h4 class="text-sm font-bold text-slate-800 dark:text-white">QR Code Otomatis</h4>
                            <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">QR Code akan diperbarui secara otomatis setelah data disimpan.</p>
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-end gap-4 pt-6 border-t border-slate-200 dark:border-slate-700 col-span-1 md:col-span-2 mt-4">
                    <a href="{{ route('items.index') }}" class="px-6 py-2.5 text-sm font-bold text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800 rounded-xl transition-all">
                        Batal
                    </a>
                    <button type="submit" class="px-8 py-2.5 bg-primary hover:bg-primary-dark text-white text-sm font-bold rounded-xl shadow-lg shadow-primary/20 transition-all flex items-center gap-2">
                        <span class="material-symbols-outlined text-[20px]">save</span>
                        Simpan Alat & Generate QR
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<style>
    @keyframes scan {
        0% { transform: translateY(-100%); }
        100% { transform: translateY(50%); }
    }
</style>
<script>
    /**
     * Fungsi untuk menghasilkan Kode Alat acak (contoh: LAB-XJ29A1)
     */
    function generateRandomID() {
        const chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        let result = 'LAB-';
        for (let i = 0; i < 6; i++) {
            result += chars.charAt(Math.floor(Math.random() * chars.length));
        }
        
        // Memasukkan hasil ke input dengan id="item_code"
        const inputField = document.getElementById('item_code');
        if (inputField) {
            inputField.value = result;
        } else {
            console.error("Input field item_code tidak ditemukan!");
        }
    }
</script>
@endpush