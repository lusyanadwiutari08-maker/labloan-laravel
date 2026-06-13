@extends('layouts.app')

@section('title', 'LabLoans Inventaris Admin')

@push('styles')
<style type="text/tailwindcss">
    .active-glow {
        box-shadow: 0 0 15px rgba(19, 127, 236, 0.3);
    }
    /* Efek Glass untuk Modal sesuai tema */
    .modal-glass {
        background: rgba(31, 41, 55, 0.8);
        backdrop-filter: blur(12px);
        border: 1px solid rgba(255, 255, 255, 0.1);
    }
</style>
@endpush

@section('content')
<div class="max-w-[1600px] mx-auto space-y-6">
    
    @if(session('success'))
        <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400 border border-green-200" role="alert">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 border border-red-200" role="alert">
            {{ session('error') }}
        </div>
    @endif

    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6">
        <div>
            <h1 class="text-2xl font-bold text-slate-800 dark:text-white tracking-tight">Daftar Inventaris</h1>
            <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">Kelola data alat lab dan kelola status peminjaman.</p>
        </div>
        
        <a href="{{ route('items.create') }}" class="inline-flex px-4 py-2 bg-primary hover:bg-primary-dark text-white text-sm font-semibold rounded-lg shadow-lg shadow-primary/20 transition-all items-center justify-center gap-2">
            <span class="material-symbols-outlined text-[20px]">add</span>
            Tambah Alat Baru
        </a>
    </div>

    <div class="bg-white dark:bg-[#1F2937] p-4 sm:p-6 rounded-xl border border-slate-200 dark:border-border-dark shadow-sm">
        
        <div class="flex flex-col md:flex-row gap-4 mb-6">
            <div class="w-full md:w-56">
                <label class="block text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase mb-1.5">Filter Status</label>
                <select id="itemStatusFilter" class="w-full py-2.5 px-4 text-sm bg-slate-50 dark:bg-[#111a22] border border-slate-200 dark:border-border-dark rounded-lg focus:ring-2 focus:ring-primary dark:text-white cursor-pointer">
                    <option value="">Semua Status</option>
                    <option value="Tersedia">Tersedia</option>
                    <option value="Dipinjam">Dipinjam</option>
                    <option value="Perbaikan">Perbaikan</option>
                </select>
            </div>
        </div>

        <div class="overflow-x-auto rounded-lg border border-slate-200 dark:border-border-dark">
            <table id="itemsTable" class="datatable w-full text-left text-sm text-slate-600 dark:text-slate-300">
                <thead class="bg-slate-50 dark:bg-[#111827] text-xs uppercase font-semibold text-slate-500 dark:text-slate-400 border-b border-slate-200 dark:border-border-dark">
                    <tr>
                        <th class="px-6 py-4">Kode Item</th>
                        <th class="px-6 py-4">Nama & Deskripsi</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4 text-center no-sort no-search no-export">QR Code</th>
                        <th class="px-6 py-4 text-right no-sort no-search no-export">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 dark:divide-border-dark">

                    @foreach ($items as $item)
                    <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors">
                        <td class="px-6 py-4 font-mono text-xs font-semibold text-primary dark:text-blue-400">
                            {{ $item->item_code }}
                        </td>
                        
                        <td class="px-6 py-4">
                            <div class="flex flex-col max-w-xs">
                                <p class="font-bold text-slate-800 dark:text-white">{{ $item->name }}</p>
                                <p class="text-xs text-slate-500 truncate" title="{{ $item->description }}">
                                    {{ $item->description ?? 'Tidak ada deskripsi' }}
                                </p>
                            </div>
                        </td>
                        
                        <td class="px-6 py-4">
                            @if ($item->status === 'available')
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400 border border-green-200 dark:border-green-800">
                                    <span class="w-1.5 h-1.5 mr-1.5 bg-green-500 rounded-full"></span> Tersedia
                                </span>
                            @elseif ($item->status === 'borrowed')
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-400 border border-blue-200 dark:border-blue-800">
                                    <span class="w-1.5 h-1.5 mr-1.5 bg-blue-500 rounded-full"></span> Dipinjam
                                </span>
                            @elseif ($item->status === 'maintenance')
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-amber-100 text-amber-800 dark:bg-amber-900/30 dark:text-amber-400 border border-amber-200 dark:border-amber-800">
                                    <span class="w-1.5 h-1.5 mr-1.5 bg-amber-500 rounded-full"></span> Perbaikan
                                </span>
                            @endif
                        </td>
                        
                        <td class="px-6 py-4">
                            @if ($item->qr_code_path)
                                <div class="flex flex-col items-center gap-2">
                                    <div onclick="openQrModal('{{ asset('storage/' . $item->qr_code_path) }}', '{{ $item->item_code }}')" class="p-1 bg-white border border-slate-200 rounded-lg shadow-sm cursor-pointer hover:border-primary hover:shadow-md transition-all group" title="Klik untuk perbesar">
                                        <img src="{{ asset('storage/' . $item->qr_code_path) }}" alt="QR Code" class="w-12 h-12 object-contain group-hover:scale-105 transition-transform">
                                    </div>
                                    <a href="{{ asset('storage/' . $item->qr_code_path) }}" download="QR-{{ $item->item_code }}.svg" class="inline-flex items-center gap-1 text-[10px] font-bold text-primary hover:text-primary-dark transition-colors bg-primary/10 hover:bg-primary/20 px-2 py-1 rounded">
                                        <span class="material-symbols-outlined text-[14px]">download</span>
                                        Unduh
                                    </a>
                                </div>
                            @else
                                <div class="text-center">
                                    <span class="text-xs text-slate-400 italic">Belum dibuat</span>
                                </div>
                            @endif
                        </td>
                        
                        <td class="px-6 py-4 text-right">
                            <div class="flex justify-end gap-2">
                                <a href="{{ route('items.edit', $item->id) }}" class="p-1.5 text-slate-500 hover:text-primary hover:bg-primary/10 rounded-lg transition-colors" title="Edit Alat">
                                    <span class="material-symbols-outlined text-[20px]">edit</span>
                                </a>
                                
                                <button type="button" onclick="openDeleteModal('{{ $item->id }}', '{{ addslashes($item->name) }}')" class="p-1.5 text-slate-500 hover:text-red-500 hover:bg-red-500/10 rounded-lg transition-colors" title="Hapus Alat">
                                    <span class="material-symbols-outlined text-[20px]">delete</span>
                                </button>

                                <form id="delete-form-{{ $item->id }}" action="{{ route('items.destroy', $item->id) }}" method="POST" class="hidden">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
</div>

@include('partials.datatables')

<div id="qrModal" class="fixed inset-0 z-[110] hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity" onclick="closeQrModal()"></div>

    <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0 pointer-events-none">
        <div class="relative transform overflow-hidden rounded-3xl bg-white dark:bg-[#1F2937] text-left shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-sm border border-slate-200 dark:border-border-dark pointer-events-auto">
            
            <div class="absolute right-0 top-0 hidden pr-4 pt-4 sm:block z-10">
                <button type="button" onclick="closeQrModal()" class="rounded-full p-1 bg-slate-100 dark:bg-slate-800 text-slate-400 hover:text-slate-600 dark:hover:text-white hover:bg-slate-200 dark:hover:bg-slate-700 focus:outline-none transition-all">
                    <span class="sr-only">Tutup</span>
                    <span class="material-symbols-outlined text-[20px]">close</span>
                </button>
            </div>

            <div class="p-8 text-center">
                <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-6 font-mono tracking-tight" id="qrModalTitle">QR Code</h3>
                
                <div class="bg-white p-4 rounded-2xl shadow-inner border-2 border-slate-100 dark:border-slate-700 inline-block relative">
                    <img id="qrModalImage" src="" alt="QR Code Besar" class="w-64 h-64 object-contain">
                </div>
                
                <p class="mt-6 text-sm text-slate-500 dark:text-slate-400 flex items-center justify-center gap-2">
                    <span class="material-symbols-outlined text-[18px] text-primary">qr_code_scanner</span>
                    Arahkan kamera ke kode di atas
                </p>
            </div>
        </div>
    </div>
</div>

<div id="deleteModal" class="fixed inset-0 z-[100] hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="fixed inset-0 bg-slate-900/40 backdrop-blur-md transition-opacity" onclick="closeDeleteModal()"></div>

    <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0 pointer-events-none">
        <div class="relative transform overflow-hidden rounded-2xl bg-white dark:bg-[#1F2937] text-left shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-lg border border-slate-200 dark:border-border-dark pointer-events-auto">
            <div class="p-8">
                <div class="sm:flex sm:items-start">
                    <div class="mx-auto flex h-14 w-14 flex-shrink-0 items-center justify-center rounded-2xl bg-red-100 dark:bg-red-500/10 text-red-600 dark:text-red-500 sm:mx-0 sm:h-12 sm:w-12 shadow-inner">
                        <span class="material-symbols-outlined text-3xl">delete_forever</span>
                    </div>
                    <div class="mt-4 text-center sm:ml-5 sm:mt-0 sm:text-left">
                        <h3 class="text-xl font-extrabold text-slate-900 dark:text-white tracking-tight" id="modal-title">Hapus Alat Lab?</h3>
                        <div class="mt-2">
                            <p class="text-sm leading-relaxed text-slate-500 dark:text-slate-400">
                                Anda akan menghapus alat <span id="deleteItemName" class="font-bold text-slate-900 dark:text-white underline decoration-red-500/30"></span> secara permanen. Tindakan ini tidak dapat dibatalkan.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="bg-slate-50 dark:bg-[#111827]/40 px-8 py-5 flex flex-col sm:flex-row-reverse gap-3 border-t border-slate-100 dark:border-border-dark/50">
                <button type="button" onclick="submitDeleteForm()" class="inline-flex w-full justify-center rounded-xl bg-red-600 px-6 py-3 text-sm font-bold text-white shadow-lg shadow-red-600/20 hover:bg-red-700 transition-all sm:w-auto">
                    Ya, Hapus Permanen
                </button>
                <button type="button" onclick="closeDeleteModal()" class="inline-flex w-full justify-center rounded-xl bg-white dark:bg-slate-800 px-6 py-3 text-sm font-bold text-slate-700 dark:text-slate-300 border border-slate-200 dark:border-border-dark hover:bg-slate-100 dark:hover:bg-slate-700 transition-all sm:w-auto">
                    Batal
                </button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // --- INISIALISASI DATATABLES ---
    document.addEventListener('DOMContentLoaded', function () {
        var itemsTable = initLabDataTable('#itemsTable', {
            order: [[0, 'asc']],
            buttons: LAB_DT_BUTTONS('Daftar Inventaris Alat Lab')
        });

        // Dropdown filter status menyetir pencarian kolom Status (indeks 2)
        document.getElementById('itemStatusFilter').addEventListener('change', function () {
            itemsTable.column(2).search(this.value).draw();
        });
    });

    // --- LOGIKA MODAL HAPUS ---
    let itemIdToDelete = null;

    function openDeleteModal(id, name) {
        itemIdToDelete = id;
        document.getElementById('deleteItemName').innerText = name;
        
        const modal = document.getElementById('deleteModal');
        modal.classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
    }

    function closeDeleteModal() {
        const modal = document.getElementById('deleteModal');
        modal.classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
        itemIdToDelete = null;
    }

    function submitDeleteForm() {
        if (itemIdToDelete) {
            document.getElementById('delete-form-' + itemIdToDelete).submit();
        }
    }

    // --- LOGIKA MODAL PREVIEW QR CODE ---
    function openQrModal(imageUrl, itemCode) {
        // Set gambar dan judul
        document.getElementById('qrModalImage').src = imageUrl;
        document.getElementById('qrModalTitle').innerText = itemCode;
        
        // Tampilkan modal
        const modal = document.getElementById('qrModal');
        modal.classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
    }

    function closeQrModal() {
        const modal = document.getElementById('qrModal');
        modal.classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
        
        // Bersihkan gambar agar tidak berkedip saat membuka QR lain
        setTimeout(() => {
            document.getElementById('qrModalImage').src = '';
        }, 300);
    }

    // Tombol ESC untuk menutup modal apa pun
    document.addEventListener('keydown', function(event) {
        if (event.key === "Escape") {
            closeDeleteModal();
            closeQrModal();
        }
    });
</script>
@endpush