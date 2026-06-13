@extends('layouts.app')

@section('title', 'Manajemen Semua Peminjaman - LabLoans')

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

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="bg-white dark:bg-[#1F2937] p-4 rounded-xl border border-slate-200 dark:border-border-dark shadow-sm flex flex-col justify-between h-28 group hover:border-primary/50 transition-colors">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">Total Pinjam</p>
                    <h3 class="text-2xl font-bold text-slate-800 dark:text-white mt-1">{{ $totalLoans ?? 0 }}</h3>
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
                    <h3 class="text-2xl font-bold text-primary mt-1">{{ $activeLoans ?? 0 }}</h3>
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
                    <h3 class="text-2xl font-bold text-red-500 mt-1">{{ $overdueLoans ?? 0 }}</h3>
                </div>
                <div class="p-2 bg-red-50 dark:bg-red-900/20 rounded-lg text-red-500">
                    <span class="material-symbols-outlined">warning</span>
                </div>
            </div>
        </div>
        
        <div class="bg-white dark:bg-[#1F2937] p-4 rounded-xl border border-slate-200 dark:border-border-dark shadow-sm flex flex-col justify-between h-28 group hover:border-green-500/50 transition-colors">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">Telah Selesai</p>
                    <h3 class="text-2xl font-bold text-green-500 mt-1">{{ $returnedLoans ?? 0 }}</h3>
                </div>
                <div class="p-2 bg-green-50 dark:bg-green-900/20 rounded-lg text-green-500">
                    <span class="material-symbols-outlined">check_circle</span>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white dark:bg-[#1F2937] rounded-xl border border-slate-200 dark:border-border-dark shadow-sm overflow-hidden flex flex-col">
        
        <div class="p-6 border-b border-slate-200 dark:border-border-dark flex flex-wrap justify-between items-end gap-4">
            <h3 class="text-lg font-bold text-slate-800 dark:text-white">Daftar Peminjaman</h3>
            <div class="w-full sm:w-56">
                <label class="block text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase mb-1.5">Filter Status</label>
                <select id="loanStatusFilter" class="w-full py-2.5 px-4 text-sm bg-slate-100 dark:bg-[#111a22] border-none rounded-lg focus:ring-2 focus:ring-primary dark:text-white cursor-pointer">
                    <option value="">Semua Status</option>
                    <option value="Active">Sedang Dipinjam</option>
                    <option value="Overdue">Terlambat</option>
                    <option value="Returned">Selesai</option>
                </select>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table id="loansTable" class="datatable w-full text-left text-sm text-slate-600 dark:text-slate-300 border-collapse">
                <thead class="bg-slate-50 dark:bg-[#111827] text-xs uppercase font-semibold text-slate-500 dark:text-slate-400">
                    <tr>
                        <th class="px-6 py-4 border-b border-slate-200 dark:border-border-dark">ID Pinjam</th>
                        <th class="px-6 py-4 border-b border-slate-200 dark:border-border-dark">Nama Alat</th>
                        <th class="px-6 py-4 border-b border-slate-200 dark:border-border-dark">Peminjam</th>
                        <th class="px-6 py-4 border-b border-slate-200 dark:border-border-dark">Tgl Pinjam</th>
                        <th class="px-6 py-4 border-b border-slate-200 dark:border-border-dark">Batas Kembali</th>
                        <th class="px-6 py-4 border-b border-slate-200 dark:border-border-dark">Status</th>
                        <th class="px-6 py-4 border-b border-slate-200 dark:border-border-dark text-right no-sort no-search no-export">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 dark:divide-border-dark">

                    @foreach($loans as $loan)
                    @php
                        // Cek apakah status active tapi tanggal sekarang sudah melewati batas kembali
                        $isOverdue = $loan->status === 'active' && \Carbon\Carbon::now()->greaterThan($loan->return_date);
                    @endphp
                    
                    <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors group {{ $loan->status === 'returned' ? 'opacity-80' : '' }}">
                        <td class="px-6 py-4 font-mono text-xs text-slate-500">
                            #LP-{{ str_pad($loan->id, 5, '0', STR_PAD_LEFT) }}
                        </td>
                        <td class="px-6 py-4">
                            <span class="font-semibold text-slate-800 dark:text-white">{{ $loan->item->name ?? 'Alat Dihapus' }}</span>
                        </td>
                        <td class="px-6 py-4 font-medium">
                            {{ $loan->user->name ?? 'User Dihapus' }}
                        </td>
                        <td class="px-6 py-4" data-order="{{ optional($loan->loan_date)->timestamp }}">
                            {{ \Carbon\Carbon::parse($loan->loan_date)->format('d M Y, H:i') }}
                        </td>
                        <td class="px-6 py-4 {{ $isOverdue ? 'text-red-500 font-bold' : '' }}" data-order="{{ optional($loan->return_date)->timestamp }}">
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
                                    Active
                                </span>
                            @endif
                        </td>
                        
                        <td class="px-6 py-4 text-right">
                            <div class="flex justify-end gap-1">
                                @if($loan->status === 'active')
                                    <form id="return-form-{{ $loan->id }}" action="{{ route('admin.loans.return', $loan->id) }}" method="POST" class="inline-block">
                                        @csrf
                                        <button type="button" onclick="openReturnModal('return-form-{{ $loan->id }}', '{{ addslashes($loan->item->name ?? 'Alat') }}', '{{ addslashes($loan->user->name ?? 'User') }}')" class="p-1.5 bg-green-50 text-green-600 dark:bg-green-900/20 dark:text-green-400 rounded hover:bg-green-100 dark:hover:bg-green-900/40 transition-colors" title="Tandai Dikembalikan">
                                            <span class="material-symbols-outlined text-[18px]">check_circle</span>
                                        </button>
                                    </form>
                                @endif
                                
                                <button type="button" onclick="openDeleteModal('{{ $loan->id }}')" class="p-1.5 bg-red-50 text-red-600 dark:bg-red-900/20 dark:text-red-400 rounded hover:bg-red-100 dark:hover:bg-red-900/40 transition-colors" title="Hapus Riwayat">
                                    <span class="material-symbols-outlined text-[18px]">delete</span>
                                </button>

                                <form id="delete-form-{{ $loan->id }}" action="{{ route('admin.loans.destroy', $loan->id) }}" method="POST" class="hidden">
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

<div id="returnModal" class="fixed inset-0 z-[100] hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity" onclick="closeReturnModal()"></div>

    <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0 pointer-events-none">
        <div class="relative transform overflow-hidden rounded-2xl bg-white dark:bg-[#1F2937] text-left shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-lg border border-slate-200 dark:border-border-dark pointer-events-auto">
            <div class="p-8">
                <div class="sm:flex sm:items-start">
                    <div class="mx-auto flex h-14 w-14 flex-shrink-0 items-center justify-center rounded-2xl bg-green-100 dark:bg-green-500/10 text-green-600 dark:text-green-500 sm:mx-0 sm:h-12 sm:w-12 shadow-inner">
                        <span class="material-symbols-outlined text-3xl">assignment_return</span>
                    </div>
                    <div class="mt-4 text-center sm:ml-5 sm:mt-0 sm:text-left">
                        <h3 class="text-xl font-extrabold text-slate-900 dark:text-white tracking-tight">Konfirmasi Pengembalian</h3>
                        <div class="mt-3 space-y-2">
                            <p class="text-sm leading-relaxed text-slate-500 dark:text-slate-400">
                                Anda akan menandai peminjaman ini sebagai telah selesai. Alat akan dikembalikan ke status <strong>Tersedia</strong>.
                            </p>
                            <div class="p-3 bg-slate-50 dark:bg-slate-800/50 rounded-lg border border-slate-100 dark:border-slate-700 mt-3">
                                <p class="text-xs text-slate-500 dark:text-slate-400 mb-1">Detail Pengembalian:</p>
                                <p class="text-sm text-slate-800 dark:text-slate-200 font-medium">Alat: <span id="returnItemName" class="text-primary"></span></p>
                                <p class="text-sm text-slate-800 dark:text-slate-200 font-medium">Oleh: <span id="returnUserName"></span></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-slate-50 dark:bg-[#111827]/40 px-8 py-5 flex flex-col sm:flex-row-reverse gap-3 border-t border-slate-100 dark:border-border-dark/50">
                <button type="button" onclick="submitReturnForm()" class="inline-flex w-full justify-center rounded-xl bg-green-600 px-6 py-3 text-sm font-bold text-white shadow-lg shadow-green-600/20 hover:bg-green-700 transition-all sm:w-auto">
                    Ya, Tandai Selesai
                </button>
                <button type="button" onclick="closeReturnModal()" class="inline-flex w-full justify-center rounded-xl bg-white dark:bg-slate-800 px-6 py-3 text-sm font-bold text-slate-700 dark:text-slate-300 border border-slate-200 dark:border-border-dark hover:bg-slate-100 dark:hover:bg-slate-700 transition-all sm:w-auto">
                    Batal
                </button>
            </div>
        </div>
    </div>
</div>

<div id="deleteModal" class="fixed inset-0 z-[100] hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity" onclick="closeDeleteModal()"></div>

    <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0 pointer-events-none">
        <div class="relative transform overflow-hidden rounded-2xl bg-white dark:bg-[#1F2937] text-left shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-lg border border-slate-200 dark:border-border-dark pointer-events-auto">
            <div class="p-8">
                <div class="sm:flex sm:items-start">
                    <div class="mx-auto flex h-14 w-14 flex-shrink-0 items-center justify-center rounded-2xl bg-red-100 dark:bg-red-500/10 text-red-600 dark:text-red-500 sm:mx-0 sm:h-12 sm:w-12 shadow-inner">
                        <span class="material-symbols-outlined text-3xl">delete_forever</span>
                    </div>
                    <div class="mt-4 text-center sm:ml-5 sm:mt-0 sm:text-left">
                        <h3 class="text-xl font-extrabold text-slate-900 dark:text-white tracking-tight">Hapus Riwayat Peminjaman?</h3>
                        <div class="mt-3">
                            <p class="text-sm leading-relaxed text-slate-500 dark:text-slate-400">
                                Anda akan menghapus catatan peminjaman ini secara <strong class="text-red-500">permanen</strong> dari sistem. Tindakan ini tidak dapat dibatalkan.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-slate-50 dark:bg-[#111827]/40 px-8 py-5 flex flex-col sm:flex-row-reverse gap-3 border-t border-slate-100 dark:border-border-dark/50">
                <button type="button" onclick="submitDeleteForm()" class="inline-flex w-full justify-center rounded-xl bg-red-600 px-6 py-3 text-sm font-bold text-white shadow-lg shadow-red-600/20 hover:bg-red-700 transition-all sm:w-auto">
                    Ya, Hapus
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
    // === INISIALISASI DATATABLES ===
    document.addEventListener('DOMContentLoaded', function () {
        var loansTable = initLabDataTable('#loansTable', {
            order: [[3, 'desc']], // urut Tgl Pinjam terbaru
            buttons: LAB_DT_BUTTONS('Laporan Peminjaman')
        });

        // Dropdown filter status menyetir pencarian kolom Status (indeks 5)
        document.getElementById('loanStatusFilter').addEventListener('change', function () {
            loansTable.column(5).search(this.value).draw();
        });
    });

    // === LOGIKA MODAL RETURN ===
    let formReturnIdToSubmit = null;

    function openReturnModal(formId, itemName, userName) {
        formReturnIdToSubmit = formId;
        document.getElementById('returnItemName').innerText = itemName;
        document.getElementById('returnUserName').innerText = userName;
        
        document.getElementById('returnModal').classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
    }

    function closeReturnModal() {
        document.getElementById('returnModal').classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
        formReturnIdToSubmit = null;
    }

    function submitReturnForm() {
        if (formReturnIdToSubmit) {
            document.getElementById(formReturnIdToSubmit).submit();
        }
    }

    // === LOGIKA MODAL DELETE ===
    let formDeleteIdToSubmit = null;

    function openDeleteModal(id) {
        formDeleteIdToSubmit = 'delete-form-' + id;
        document.getElementById('deleteModal').classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
    }

    function closeDeleteModal() {
        document.getElementById('deleteModal').classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
        formDeleteIdToSubmit = null;
    }

    function submitDeleteForm() {
        if (formDeleteIdToSubmit) {
            document.getElementById(formDeleteIdToSubmit).submit();
        }
    }

    // Tutup semua modal dengan tombol ESC
    document.addEventListener('keydown', function(event) {
        if (event.key === "Escape") {
            closeReturnModal();
            closeDeleteModal();
        }
    });
</script>
@endpush