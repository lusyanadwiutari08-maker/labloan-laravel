@extends('layouts.app')

@section('title', 'Edit Informasi Alat - LabLoans')

@section('content')
<div class="max-w-5xl mx-auto">
    <div class="flex items-center gap-2 text-xs text-slate-500 dark:text-slate-400 mb-4">
        <a href="{{ route('items.index') }}" class="hover:text-primary transition-colors">Inventaris</a>
        <span class="material-symbols-outlined text-[14px]">chevron_right</span>
        <span class="text-primary dark:text-blue-400 font-medium">Edit Alat</span>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
        <div class="lg:col-span-8">
            <div class="glass-card rounded-2xl overflow-hidden shadow-2xl">
                <div class="p-8 space-y-8">
                    <form action="{{ route('items.update', $item->id) }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <div class="space-y-6">
                            <div class="space-y-2">
                                <label class="text-sm font-semibold text-slate-700 dark:text-slate-300" for="name">Nama Alat</label>
                                <input name="name" value="{{ old('name', $item->name) }}" class="w-full px-4 py-2.5 bg-white dark:bg-slate-800/50 border border-slate-200 dark:border-slate-700 rounded-lg dark:text-white form-input-focus" id="name" type="text" required/>
                                @error('name') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                            </div>

                            <div class="space-y-2">
                                <label class="text-sm font-semibold text-slate-700 dark:text-slate-300" for="item_code">ID Alat (Permanen)</label>
                                <input class="w-full px-4 py-2.5 bg-slate-100 dark:bg-slate-800/30 border border-slate-200 dark:border-slate-700 rounded-lg dark:text-slate-400 cursor-not-allowed font-mono" id="item_code" readonly type="text" value="{{ $item->item_code }}"/>
                            </div>

                            <div class="space-y-3">
                                <label class="text-sm font-semibold text-slate-700 dark:text-slate-300">Status Saat Ini</label>
                                <div class="flex flex-wrap gap-4">
                                    <label class="flex-1 min-w-[120px] relative cursor-pointer group">
                                        <input type="radio" name="status" value="available" class="peer hidden" {{ old('status', $item->status) == 'available' ? 'checked' : '' }}/>
                                        <div class="h-full flex items-center justify-center gap-2 p-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800/30 transition-all group-hover:border-primary/50 peer-checked:bg-primary/10 peer-checked:border-primary">
                                            <span class="material-symbols-outlined text-green-500">check_circle</span>
                                            <span class="text-sm font-bold text-slate-600 dark:text-slate-300">Tersedia</span>
                                        </div>
                                    </label>
                                    <label class="flex-1 min-w-[120px] relative cursor-pointer group">
                                        <input type="radio" name="status" value="maintenance" class="peer hidden" {{ old('status', $item->status) == 'maintenance' ? 'checked' : '' }}/>
                                        <div class="h-full flex items-center justify-center gap-2 p-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800/30 transition-all group-hover:border-red-500/50 peer-checked:bg-red-500/10 peer-checked:border-red-500">
                                            <span class="material-symbols-outlined text-red-500">build</span>
                                            <span class="text-sm font-bold text-slate-600 dark:text-slate-300">Perbaikan</span>
                                        </div>
                                    </label>
                                    <label class="flex-1 min-w-[120px] relative cursor-pointer group">
                                        <input type="radio" name="status" value="borrowed" class="peer hidden" {{ old('status', $item->status) == 'borrowed' ? 'checked' : '' }}/>
                                        <div class="h-full flex items-center justify-center gap-2 p-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800/30 transition-all group-hover:border-blue-500/50 peer-checked:bg-blue-500/10 peer-checked:border-blue-500">
                                            <span class="material-symbols-outlined text-blue-500">shopping_bag</span>
                                            <span class="text-sm font-bold text-slate-600 dark:text-slate-300">Dipinjam</span>
                                        </div>
                                    </label>
                                </div>
                                @error('status') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                            </div>

                            <div class="space-y-2">
                                <label class="text-sm font-semibold text-slate-700 dark:text-slate-300" for="description">Deskripsi Alat</label>
                                <textarea name="description" class="w-full px-4 py-2.5 bg-white dark:bg-slate-800/50 border border-slate-200 dark:border-slate-700 rounded-lg dark:text-white form-input-focus resize-none h-[140px]" id="description">{{ old('description', $item->description) }}</textarea>
                                @error('description') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="flex items-center justify-end gap-4 pt-6 border-t border-slate-200 dark:border-slate-700">
                            <a href="{{ route('items.index') }}" class="px-6 py-2.5 text-sm font-bold text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800 rounded-xl transition-all">
                                Batal
                            </a>
                            <button type="submit" class="px-8 py-2.5 bg-primary hover:bg-primary-dark text-white text-sm font-bold rounded-xl shadow-lg shadow-primary/20 transition-all flex items-center gap-2">
                                <span class="material-symbols-outlined text-[20px]">save</span>
                                Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="lg:col-span-4 space-y-6">
            <div class="glass-card rounded-2xl p-6 text-center space-y-6">
                <h4 class="text-sm font-bold text-slate-800 dark:text-white uppercase tracking-wider">Identitas QR Alat</h4>
                <div class="bg-white rounded-2xl p-4 flex items-center justify-center shadow-xl mx-auto w-48 h-48 border-4 border-slate-100 dark:border-slate-700">
                    @if($item->qr_code_path)
                        <img src="{{ asset('storage/' . $item->qr_code_path) }}" alt="QR Code" class="w-full h-full object-contain">
                    @else
                        <div class="text-slate-300 flex flex-col items-center justify-center">
                            <span class="material-symbols-outlined !text-[100px]">qr_code_2</span>
                            <p class="text-[10px] mt-2">Belum ada QR</p>
                        </div>
                    @endif
                </div>
                <div class="space-y-2">
                    <p class="text-lg font-bold text-slate-800 dark:text-white font-mono">{{ $item->item_code }}</p>
                </div>
                <a href="{{ asset('storage/' . $item->qr_code_path) }}" download="QR-{{ $item->item_code }}.svg" class="w-full py-3 bg-slate-100 dark:bg-slate-800 hover:bg-slate-200 dark:hover:bg-slate-700 text-slate-700 dark:text-slate-200 text-sm font-bold rounded-xl transition-all flex items-center justify-center gap-2 border border-slate-200 dark:border-slate-700">
                    <span class="material-symbols-outlined text-[20px]">download</span>
                    Unduh QR Code
                </a>
            </div>
        </div>
    </div>
</div>
@endsection