@extends('layouts.app')

@section('title', 'Log Aktivitas - LabLoans')

@php
    // Label ramah-baca untuk tiap jenis aksi
    $actionLabels = [
        'login'        => 'Login',
        'logout'       => 'Logout',
        'register'     => 'Registrasi',
        'borrow'       => 'Peminjaman',
        'return_item'  => 'Pengembalian',
        'add_item'     => 'Tambah Alat',
        'update_item'  => 'Ubah Alat',
        'delete_item'  => 'Hapus Alat',
        'add_user'     => 'Tambah User',
        'update_user'  => 'Ubah User',
        'delete_user'  => 'Hapus User',
        'delete_loan'  => 'Hapus Peminjaman',
    ];
@endphp

@section('content')
<div class="max-w-[1600px] mx-auto space-y-6">

    <div class="bg-white dark:bg-[#1F2937] p-6 rounded-xl border border-slate-200 dark:border-border-dark shadow-sm">
        <div class="flex items-center gap-3 mb-5">
            <div class="w-11 h-11 bg-primary/10 text-primary rounded-xl flex items-center justify-center flex-shrink-0">
                <span class="material-symbols-outlined">history</span>
            </div>
            <div>
                <h2 class="text-xl font-bold text-slate-800 dark:text-white">Log Aktivitas Sistem</h2>
                <p class="text-sm text-slate-500 dark:text-slate-400">Seluruh jejak aktivitas pengguna dan admin.</p>
            </div>
        </div>

        <div class="w-full sm:w-56">
            <label class="block text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase mb-1.5">Filter Jenis Aksi</label>
            <select id="logActionFilter" class="w-full py-2.5 px-4 text-sm bg-slate-100 dark:bg-[#111a22] border-none rounded-lg focus:ring-2 focus:ring-primary dark:text-white cursor-pointer">
                <option value="">Semua Aksi</option>
                @foreach($actions as $action)
                    @php $label = $actionLabels[$action] ?? ucfirst(str_replace('_', ' ', $action)); @endphp
                    <option value="{{ $label }}">{{ $label }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="bg-white dark:bg-[#1F2937] rounded-xl border border-slate-200 dark:border-border-dark shadow-sm overflow-hidden">
        <div class="overflow-x-auto p-4 sm:p-6">
            <table id="logsTable" class="datatable w-full text-left text-sm text-slate-600 dark:text-slate-300">
                <thead class="bg-slate-50 dark:bg-[#111827] text-xs uppercase font-semibold text-slate-500 dark:text-slate-400">
                    <tr>
                        <th class="px-6 py-4">Aktivitas</th>
                        <th class="px-6 py-4">Pelaku</th>
                        <th class="px-6 py-4">Jenis</th>
                        <th class="px-6 py-4 text-right">Waktu</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 dark:divide-border-dark">
                    @foreach($logs as $log)
                        <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="flex-shrink-0 w-9 h-9 rounded-full flex items-center justify-center
                                        @if(in_array($log->action, ['add_item', 'return_item'])) bg-green-100 text-green-600 dark:bg-green-900/30 dark:text-green-400
                                        @elseif($log->action === 'borrow') bg-blue-100 text-blue-600 dark:bg-blue-900/30 dark:text-blue-400
                                        @elseif(in_array($log->action, ['login', 'logout', 'register'])) bg-slate-100 text-slate-600 dark:bg-slate-800 dark:text-slate-400
                                        @elseif(str_contains($log->action, 'delete')) bg-red-100 text-red-600 dark:bg-red-900/30 dark:text-red-400
                                        @else bg-primary/10 text-primary @endif">
                                        <span class="material-symbols-outlined text-[18px]">
                                            @if(in_array($log->action, ['add_item', 'update_item'])) inventory_2
                                            @elseif($log->action === 'return_item') check_circle
                                            @elseif($log->action === 'borrow') science
                                            @elseif($log->action === 'login') login
                                            @elseif($log->action === 'logout') logout
                                            @elseif($log->action === 'register') person_add
                                            @elseif(str_contains($log->action, 'user')) group
                                            @elseif(str_contains($log->action, 'delete')) delete
                                            @else info @endif
                                        </span>
                                    </div>
                                    <p class="text-slate-800 dark:text-white leading-snug">{{ $log->description }}</p>
                                </div>
                            </td>
                            <td class="px-6 py-4 font-medium text-slate-700 dark:text-slate-300">
                                {{ $log->user->name ?? 'Sistem / Dihapus' }}
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-slate-100 text-slate-700 dark:bg-slate-800 dark:text-slate-300 border border-slate-200 dark:border-slate-700">
                                    {{ $actionLabels[$log->action] ?? ucfirst(str_replace('_', ' ', $log->action)) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right whitespace-nowrap" data-order="{{ $log->created_at->timestamp }}">
                                <span class="text-slate-700 dark:text-slate-300">{{ $log->created_at->format('d M Y, H:i') }}</span>
                                <span class="block text-xs text-slate-400">{{ $log->created_at->diffForHumans() }}</span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@include('partials.datatables')
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var logsTable = initLabDataTable('#logsTable', {
            order: [[3, 'desc']], // urut Waktu terbaru
            buttons: LAB_DT_BUTTONS('Log Aktivitas Sistem')
        });

        // Dropdown filter jenis aksi menyetir pencarian kolom Jenis (indeks 2)
        document.getElementById('logActionFilter').addEventListener('change', function () {
            logsTable.column(2).search(this.value).draw();
        });
    });
</script>
@endpush
