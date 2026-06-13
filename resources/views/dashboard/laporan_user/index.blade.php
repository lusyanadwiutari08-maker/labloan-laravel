@extends('layouts.app')

@section('title', 'Riwayat Peminjaman - LabLoans')

@section('content')
<div class="max-w-[1600px] mx-auto space-y-6">
    
    <div class="bg-white dark:bg-[#1F2937] p-6 rounded-xl border border-slate-200 dark:border-border-dark shadow-sm">
        <div class="w-full md:w-56">
            <label class="block text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase mb-2">Filter Status</label>
            <select id="userLoanStatusFilter" class="w-full py-2.5 px-4 text-sm bg-slate-100 dark:bg-[#111a22] border-none rounded-lg focus:ring-2 focus:ring-primary dark:text-white cursor-pointer">
                <option value="">Semua Status</option>
                <option value="Sedang Dipinjam">Sedang Dipinjam</option>
                <option value="Selesai">Selesai</option>
                <option value="Terlambat">Terlambat</option>
            </select>
        </div>
    </div>

    <div class="bg-white dark:bg-[#1F2937] rounded-xl border border-slate-200 dark:border-border-dark shadow-sm overflow-hidden flex flex-col">
        <div class="overflow-x-auto p-4 sm:p-6">
            <table id="userLoansTable" class="datatable w-full text-left text-sm text-slate-600 dark:text-slate-300">
                <thead class="bg-slate-50 dark:bg-[#111827] text-xs uppercase font-semibold text-slate-500 dark:text-slate-400">
                    <tr>
                        <th class="px-6 py-4">Nama Alat</th>
                        <th class="px-6 py-4">Kode Alat</th>
                        <th class="px-6 py-4">Tanggal Pinjam</th>
                        <th class="px-6 py-4">Batas Kembali</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4 text-right no-sort no-search no-export">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 dark:divide-border-dark">

                    @foreach($loans as $loan)
                    @php
                        // Cek apakah status active tapi sudah lewat batas waktu
                        $isOverdue = $loan->status === 'active' && \Carbon\Carbon::now()->greaterThan($loan->return_date);
                    @endphp
                    
                    <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors {{ $loan->status === 'returned' ? 'opacity-80' : '' }}">
                        <td class="px-6 py-4 font-semibold text-slate-800 dark:text-white">
                            {{ $loan->item->name ?? 'Alat Tidak Ditemukan' }}
                        </td>
                        <td class="px-6 py-4 font-mono text-xs">
                            {{ $loan->item->item_code ?? '-' }}
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
                                    Selesai
                                </span>
                            @elseif($isOverdue)
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400 border border-red-200 dark:border-red-800">
                                    Terlambat
                                </span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-400 border border-blue-200 dark:border-blue-800">
                                    Sedang Dipinjam
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-right">
                            <button type="button" 
                                onclick="openDetailModal('{{ addslashes($loan->item->name ?? 'Alat Tidak Ditemukan') }}', '{{ $loan->item->item_code ?? '-' }}', '{{ \Carbon\Carbon::parse($loan->loan_date)->format('d M Y, H:i') }}', '{{ \Carbon\Carbon::parse($loan->return_date)->format('d M Y, H:i') }}', '{{ $loan->status }}', '{{ $isOverdue ? 'true' : 'false' }}')" 
                                class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-slate-100 hover:bg-slate-200 dark:bg-slate-800 dark:hover:bg-slate-700 text-slate-700 dark:text-slate-200 text-xs font-semibold rounded border border-slate-200 dark:border-slate-700 transition-all">
                                <span class="material-symbols-outlined text-[16px]">visibility</span> Detail
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="p-4 border-t border-slate-200 dark:border-border-dark bg-slate-50 dark:bg-[#111827] px-6">
            <p class="text-sm font-medium text-slate-600 dark:text-slate-400">
                Total Alat Pernah Dipinjam: <span class="text-slate-900 dark:text-white font-bold ml-1">{{ $totalBorrowedItems }} Alat</span>
            </p>
        </div>
    </div>
</div>

@include('partials.datatables')

<div id="detailModal" class="fixed inset-0 z-[100] hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity" onclick="closeDetailModal()"></div>

    <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0 pointer-events-none">
        <div class="relative transform overflow-hidden rounded-2xl bg-white dark:bg-[#1F2937] text-left shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-md border border-slate-200 dark:border-border-dark pointer-events-auto">
            
            <div class="flex items-center justify-between p-5 border-b border-slate-200 dark:border-border-dark bg-slate-50 dark:bg-white/5">
                <div class="flex items-center gap-2">
                    <span class="material-symbols-outlined text-primary">info</span>
                    <h3 class="font-bold text-slate-800 dark:text-white">Detail Peminjaman</h3>
                </div>
                <button type="button" onclick="closeDetailModal()" class="text-slate-400 hover:text-red-500 transition-colors p-1">
                    <span class="material-symbols-outlined">close</span>
                </button>
            </div>

            <div class="p-6 space-y-5">
                <div>
                    <p class="text-xs font-medium text-slate-500 uppercase tracking-wider">Informasi Alat</p>
                    <p id="modalItemName" class="font-bold text-slate-800 dark:text-white text-lg mt-1"></p>
                    <div class="flex items-center gap-2 mt-1">
                        <span class="material-symbols-outlined text-primary text-[16px]">qr_code_2</span>
                        <p id="modalItemCode" class="text-xs font-mono text-primary bg-primary/10 px-2 py-0.5 rounded border border-primary/20"></p>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div class="p-3 bg-slate-50 dark:bg-slate-800/50 rounded-xl border border-slate-100 dark:border-slate-700">
                        <p class="text-xs font-medium text-slate-500 mb-1 flex items-center gap-1">
                            <span class="material-symbols-outlined text-[14px]">calendar_today</span> Tgl Pinjam
                        </p>
                        <p id="modalLoanDate" class="text-sm font-semibold text-slate-800 dark:text-slate-200"></p>
                    </div>
                    <div class="p-3 bg-slate-50 dark:bg-slate-800/50 rounded-xl border border-slate-100 dark:border-slate-700">
                        <p class="text-xs font-medium text-slate-500 mb-1 flex items-center gap-1">
                            <span class="material-symbols-outlined text-[14px]">event_busy</span> Batas Kembali
                        </p>
                        <p id="modalReturnDate" class="text-sm font-semibold text-slate-800 dark:text-slate-200"></p>
                    </div>
                </div>

                <div class="pt-2 border-t border-slate-100 dark:border-slate-700/50">
                    <p class="text-xs font-medium text-slate-500 uppercase tracking-wider mb-2">Status Peminjaman</p>
                    <div id="modalStatusBadge"></div>
                </div>
            </div>

            <div class="bg-slate-50 dark:bg-[#111827]/40 px-6 py-4 border-t border-slate-100 dark:border-border-dark/50 text-right">
                <button type="button" onclick="closeDetailModal()" class="inline-flex justify-center rounded-xl bg-white dark:bg-slate-800 px-6 py-2.5 text-sm font-bold text-slate-700 dark:text-slate-300 border border-slate-200 dark:border-border-dark hover:bg-slate-100 dark:hover:bg-slate-700 transition-all w-full sm:w-auto">
                    Tutup
                </button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var userLoansTable = initLabDataTable('#userLoansTable', {
            order: [[2, 'desc']], // urut Tanggal Pinjam terbaru
            buttons: LAB_DT_BUTTONS('Riwayat Peminjaman Saya')
        });

        // Dropdown filter status menyetir pencarian kolom Status (indeks 4)
        document.getElementById('userLoanStatusFilter').addEventListener('change', function () {
            userLoansTable.column(4).search(this.value).draw();
        });
    });

    function openDetailModal(itemName, itemCode, loanDate, returnDate, status, isOverdue) {
        // Masukkan data ke dalam elemen modal
        document.getElementById('modalItemName').innerText = itemName;
        document.getElementById('modalItemCode').innerText = itemCode;
        document.getElementById('modalLoanDate').innerText = loanDate;
        document.getElementById('modalReturnDate').innerText = returnDate;

        // Render badge status yang sesuai
        let badgeHtml = '';
        if (status === 'returned') {
            badgeHtml = '<span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400 border border-green-200 dark:border-green-800"><span class="material-symbols-outlined text-[14px] mr-1">check_circle</span> Selesai</span>';
        } else if (isOverdue === 'true') {
            badgeHtml = '<span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400 border border-red-200 dark:border-red-800"><span class="material-symbols-outlined text-[14px] mr-1">warning</span> Terlambat</span>';
        } else {
            badgeHtml = '<span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-400 border border-blue-200 dark:border-blue-800"><span class="material-symbols-outlined text-[14px] mr-1">sync</span> Sedang Dipinjam</span>';
        }
        document.getElementById('modalStatusBadge').innerHTML = badgeHtml;

        // Tampilkan modal
        document.getElementById('detailModal').classList.remove('hidden');
        document.body.classList.add('overflow-hidden'); // Mencegah scrolling pada background
    }

    function closeDetailModal() {
        document.getElementById('detailModal').classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
    }

    // Fitur menutup modal menggunakan tombol ESC di keyboard
    document.addEventListener('keydown', function(event) {
        if (event.key === "Escape") {
            closeDetailModal();
        }
    });
</script>
@endpush