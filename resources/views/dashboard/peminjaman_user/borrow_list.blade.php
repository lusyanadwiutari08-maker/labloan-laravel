@extends('layouts.app')

@section('title', 'Katalog Alat - LabLoans')

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<link rel="stylesheet" type="text/css" href="https://npmcdn.com/flatpickr/dist/themes/dark.css">
<style>
    /* Penyesuaian kursor agar terlihat bisa diklik */
    .flatpickr-input[readonly] {
        cursor: pointer !important;
        background-color: transparent;
    }
</style>
@endpush

@section('content')
<div class="max-w-[1600px] mx-auto space-y-6">
    
    <div class="bg-white dark:bg-[#1F2937] p-6 rounded-xl border border-slate-200 dark:border-border-dark shadow-sm flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <div>
            <h2 class="text-xl font-bold text-slate-800 dark:text-white flex items-center gap-2">
                <span class="material-symbols-outlined text-primary">category</span>
                Katalog Alat Laboratorium
            </h2>
            <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">Pilih alat yang tersedia dan tentukan tanggal pengembalian untuk meminjam.</p>
        </div>
        
        <div class="relative w-full md:w-64">
            <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-slate-400 pointer-events-none">
                <span class="material-symbols-outlined text-[18px]">search</span>
            </span>
            <input type="text" class="w-full py-2.5 pl-10 pr-4 text-sm bg-slate-100 dark:bg-[#111a22] border-none rounded-lg focus:ring-2 focus:ring-primary dark:text-white" placeholder="Cari alat...">
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @forelse($items as $item)
        <div class="bg-white dark:bg-[#1F2937] p-5 rounded-xl border border-slate-200 dark:border-border-dark shadow-sm flex flex-col justify-between group hover:border-primary/50 transition-colors">
            
            <div class="flex justify-between items-start mb-4">
                @if($item->qr_code_path)
                    <button type="button" onclick="openQrModal('{{ asset('storage/' . $item->qr_code_path) }}', '{{ addslashes($item->name) }}')" class="w-14 h-14 bg-white p-1 rounded-xl border border-slate-200 dark:border-slate-600 shadow-sm flex-shrink-0 flex items-center justify-center transition-transform group-hover:scale-110 cursor-pointer focus:outline-none focus:ring-2 focus:ring-primary" title="Perbesar QR Code">
                        <img src="{{ asset('storage/' . $item->qr_code_path) }}" alt="QR {{ $item->item_code }}" class="w-full h-full object-contain rounded-lg">
                    </button>
                @else
                    <div class="w-14 h-14 bg-primary/10 text-primary rounded-xl flex items-center justify-center flex-shrink-0 transition-transform group-hover:scale-110">
                        <span class="material-symbols-outlined text-2xl">science</span>
                    </div>
                @endif
                
                @if($item->status === 'available')
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400 border border-green-200 dark:border-green-800">
                        Tersedia
                    </span>
                @elseif($item->status === 'maintenance')
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400 border border-red-200 dark:border-red-800">
                        Maintenance
                    </span>
                @else
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-amber-100 text-amber-800 dark:bg-amber-900/30 dark:text-amber-400 border border-amber-200 dark:border-amber-800">
                        Dipinjam
                    </span>
                @endif
            </div>
            
            <div class="mb-5 flex-grow">
                <h3 class="font-bold text-slate-800 dark:text-white text-lg leading-tight">{{ $item->name }}</h3>
                <p class="text-xs font-mono text-slate-500 dark:text-slate-400 mt-1">{{ $item->item_code }}</p>
                <p class="text-sm text-slate-600 dark:text-slate-400 mt-2 line-clamp-2">
                    {{ $item->description ?? 'Tidak ada deskripsi untuk alat ini.' }}
                </p>
            </div>
            
            <div>
                @if($item->status === 'available')
                    <button type="button" onclick="openBorrowModal('{{ $item->id }}', '{{ addslashes($item->name) }}', '{{ $item->item_code }}')" class="w-full py-2.5 bg-primary hover:bg-primary-dark text-white font-semibold rounded-lg shadow-md shadow-primary/20 transition-all flex items-center justify-center gap-2">
                        <span class="material-symbols-outlined text-[18px]">add_circle</span> Pinjam Alat
                    </button>
                @else
                    <button disabled class="w-full py-2.5 bg-slate-100 dark:bg-slate-800 text-slate-400 dark:text-slate-500 font-semibold rounded-lg cursor-not-allowed flex items-center justify-center gap-2">
                        <span class="material-symbols-outlined text-[18px]">block</span> Tidak Tersedia
                    </button>
                @endif
            </div>
        </div>
        @empty
        <div class="col-span-full py-12 text-center text-slate-500">
            <span class="material-symbols-outlined text-5xl opacity-20 block mb-2">inventory_2</span>
            Belum ada alat yang terdaftar di sistem.
        </div>
        @endforelse
    </div>

    @if($items->hasPages())
    <div class="p-4 border-t border-slate-200 dark:border-border-dark bg-slate-50 dark:bg-[#111827] rounded-xl flex justify-center">
        {{ $items->links() }}
    </div>
    @endif
</div>

<div id="borrowModal" class="fixed inset-0 z-[100] hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity" onclick="closeBorrowModal()"></div>

    <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0 pointer-events-none">
        <div class="relative transform overflow-visible rounded-2xl bg-white dark:bg-[#1F2937] text-left shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-md border border-slate-200 dark:border-border-dark pointer-events-auto">
            
            <div class="flex items-center justify-between p-5 border-b border-slate-200 dark:border-border-dark bg-slate-50 dark:bg-white/5">
                <div class="flex items-center gap-2">
                    <span class="material-symbols-outlined text-primary">add_shopping_cart</span>
                    <h3 class="font-bold text-slate-800 dark:text-white">Form Peminjaman</h3>
                </div>
                <button type="button" onclick="closeBorrowModal()" class="text-slate-400 hover:text-red-500 transition-colors p-1">
                    <span class="material-symbols-outlined">close</span>
                </button>
            </div>

            <form action="{{ route('quick-loan.store') }}" method="POST">
                @csrf
                <input type="hidden" name="item_id" id="modal_item_id" value="">
                
                <div class="p-6 space-y-5">
                    <div class="p-4 bg-blue-50 dark:bg-blue-900/10 border border-blue-200 dark:border-blue-900/30 rounded-xl flex items-start gap-3">
                        <span class="material-symbols-outlined text-primary mt-0.5">science</span>
                        <div>
                            <p class="text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-1">Alat yang dipinjam</p>
                            <p id="modal_item_name" class="font-bold text-slate-800 dark:text-slate-200 text-lg"></p>
                            <p id="modal_item_code" class="text-xs font-mono text-primary mt-0.5"></p>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Batas Waktu Pengembalian <span class="text-red-500">*</span></label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400 pointer-events-none">
                                <span class="material-symbols-outlined">event</span>
                            </span>
                            <input type="text" id="return_date_picker" name="return_date" required placeholder="Pilih tanggal dan jam..." class="w-full py-3 pl-12 pr-4 text-sm text-slate-900 bg-slate-50 border border-slate-200 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary dark:bg-[#111a22] dark:border-slate-800 dark:text-white transition-all bg-white">
                        </div>
                    </div>
                </div>

                <div class="bg-slate-50 dark:bg-[#111827]/40 px-6 py-4 border-t border-slate-100 dark:border-border-dark/50 flex flex-col sm:flex-row-reverse gap-3">
                    <button type="submit" class="inline-flex w-full justify-center items-center gap-2 rounded-xl bg-primary px-6 py-2.5 text-sm font-bold text-white shadow-lg shadow-primary/20 hover:bg-primary-dark transition-all sm:w-auto">
                        Konfirmasi Pinjam
                    </button>
                    <button type="button" onclick="closeBorrowModal()" class="inline-flex w-full justify-center rounded-xl bg-white dark:bg-slate-800 px-6 py-2.5 text-sm font-bold text-slate-700 dark:text-slate-300 border border-slate-200 dark:border-border-dark hover:bg-slate-100 dark:hover:bg-slate-700 transition-all sm:w-auto">
                        Batal
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>

<div id="qrModal" class="fixed inset-0 z-[110] hidden overflow-y-auto" aria-labelledby="qr-modal-title" role="dialog" aria-modal="true">
    <div class="fixed inset-0 bg-slate-900/80 backdrop-blur-sm transition-opacity" onclick="closeQrModal()"></div>

    <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0 pointer-events-none">
        <div class="relative transform overflow-hidden rounded-2xl bg-white dark:bg-[#1F2937] text-left shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-sm border border-slate-200 dark:border-border-dark pointer-events-auto">
            
            <div class="flex items-center justify-between p-4 border-b border-slate-200 dark:border-border-dark bg-slate-50 dark:bg-white/5">
                <h3 class="font-bold text-slate-800 dark:text-white truncate pr-4 text-lg flex items-center gap-2">
                    <span class="material-symbols-outlined text-primary">qr_code_2</span>
                    <span id="qr_modal_title">QR Code</span>
                </h3>
                <button type="button" onclick="closeQrModal()" class="text-slate-400 hover:text-red-500 transition-colors p-1 flex-shrink-0">
                    <span class="material-symbols-outlined">close</span>
                </button>
            </div>

            <div class="p-8 flex flex-col items-center justify-center bg-slate-50 dark:bg-[#111827]">
                <div class="bg-white p-4 rounded-xl shadow-md border border-slate-200">
                    <img id="qr_modal_img" src="" alt="QR Code Besar" class="w-48 h-48 sm:w-64 sm:h-64 object-contain">
                </div>
                <p class="text-sm text-slate-500 dark:text-slate-400 mt-6 text-center max-w-xs font-medium">
                    Arahkan kamera ke layar untuk memindai alat ini.
                </p>
            </div>
            
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://npmcdn.com/flatpickr/dist/l10n/id.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        flatpickr("#return_date_picker", {
            enableTime: true,           
            dateFormat: "Y-m-d H:i",    
            minDate: "today",           
            time_24hr: true,            
            locale: "id",               
            disableMobile: "true",      
            placeholder: "Klik untuk memilih..."
        });
    });

    // --- FUNGSI MODAL PEMINJAMAN ---
    function openBorrowModal(itemId, itemName, itemCode) {
        document.getElementById('modal_item_id').value = itemId;
        document.getElementById('modal_item_name').innerText = itemName;
        document.getElementById('modal_item_code').innerText = itemCode;
        document.getElementById('return_date_picker').value = '';
        
        document.getElementById('borrowModal').classList.remove('hidden');
        document.body.classList.add('overflow-hidden'); 
    }

    function closeBorrowModal() {
        document.getElementById('borrowModal').classList.add('hidden');
        checkModalsAndBodyScroll();
    }

    // --- FUNGSI MODAL QR CODE ---
    function openQrModal(imageSrc, itemName) {
        document.getElementById('qr_modal_img').src = imageSrc;
        document.getElementById('qr_modal_title').innerText = itemName;
        
        document.getElementById('qrModal').classList.remove('hidden');
        document.body.classList.add('overflow-hidden'); 
    }

    function closeQrModal() {
        document.getElementById('qrModal').classList.add('hidden');
        checkModalsAndBodyScroll();
    }

    // Helper untuk memastikan scroll body kembali aktif jika SEMUA modal sudah tertutup
    function checkModalsAndBodyScroll() {
        const isBorrowModalHidden = document.getElementById('borrowModal').classList.contains('hidden');
        const isQrModalHidden = document.getElementById('qrModal').classList.contains('hidden');
        
        if (isBorrowModalHidden && isQrModalHidden) {
            document.body.classList.remove('overflow-hidden');
        }
    }

    // Tutup modal menggunakan tombol ESCAPE
    document.addEventListener('keydown', function(event) {
        if (event.key === "Escape") {
            closeBorrowModal();
            closeQrModal();
        }
    });
</script>
@endpush