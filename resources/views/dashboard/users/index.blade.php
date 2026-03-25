@extends('layouts.app')

@section('title', 'Manajemen User Admin - LabLoans')

@push('styles')
<style type="text/tailwindcss">
    .active-glow {
        box-shadow: 0 0 15px rgba(19, 127, 236, 0.3);
    }
    /* Glass Effect untuk Modal */
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

    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-slate-800 dark:text-white">Daftar Pengguna</h1>
            <p class="text-sm text-slate-500 dark:text-slate-400">Kelola hak akses dan informasi pengguna LabLoans.</p>
        </div>
        <a href="{{ route('users.create') }}" class="px-5 py-2.5 bg-primary hover:bg-primary-dark text-white font-semibold rounded-lg shadow-lg shadow-primary/30 transition-all flex items-center justify-center gap-2">
            <span class="material-symbols-outlined text-[20px]">person_add</span>
            Tambah User
        </a>
    </div>

    <div class="bg-white dark:bg-[#1F2937] p-4 rounded-xl border border-slate-200 dark:border-border-dark shadow-sm">
        <div class="relative flex-1">
            <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-slate-400 pointer-events-none">
                <span class="material-symbols-outlined text-[20px]">search</span>
            </span>
            <input class="w-full py-2.5 pl-10 pr-4 text-sm text-slate-900 bg-slate-100 border-none rounded-lg focus:outline-none focus:ring-2 focus:ring-primary dark:bg-[#233648] dark:text-white dark:placeholder-slate-400 transition-all" placeholder="Cari nama, username, atau email..." type="text"/>
        </div>
    </div>

    <div class="bg-white dark:bg-[#1F2937] rounded-xl border border-slate-200 dark:border-border-dark shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-slate-600 dark:text-slate-300">
                <thead class="bg-slate-50 dark:bg-[#111827] text-xs uppercase font-semibold text-slate-500 dark:text-slate-400">
                    <tr>
                        <th class="px-6 py-4">Pengguna</th>
                        <th class="px-6 py-4">Username</th>
                        <th class="px-6 py-4">Role</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 dark:divide-border-dark">
                    @forelse ($users as $user)
                    <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors">
                        <td class="px-6 py-4">
                            <div class="flex flex-col">
                                <p class="font-bold text-slate-800 dark:text-white">{{ $user->name }}</p>
                                <p class="text-xs text-slate-500">{{ $user->email }}</p>
                            </div>
                        </td>
                        <td class="px-6 py-4 font-medium">{{ $user->username }}</td>
                        <td class="px-6 py-4">
                            <span class="px-2.5 py-1 rounded-md text-xs font-semibold bg-blue-50 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400 capitalize">
                                {{ $user->role }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400 border border-green-200 dark:border-green-800">
                                <span class="w-1.5 h-1.5 mr-1.5 bg-green-500 rounded-full"></span> Aktif
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex justify-end gap-2">
                                <a href="{{ route('users.edit', $user->id) }}" class="p-1.5 text-slate-500 hover:text-primary hover:bg-primary/10 rounded-lg transition-colors" title="Edit User">
                                    <span class="material-symbols-outlined text-[20px]">edit</span>
                                </a>
                                
                                <button type="button" 
                                        onclick="openDeleteModal('{{ $user->id }}', '{{ $user->name }}')"
                                        class="p-1.5 text-slate-500 hover:text-red-500 hover:bg-red-500/10 rounded-lg transition-colors">
                                    <span class="material-symbols-outlined text-[20px]">delete</span>
                                </button>

                                <form id="delete-form-{{ $user->id }}" action="{{ route('users.destroy', $user->id) }}" method="POST" class="hidden">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center text-slate-500">
                            <span class="material-symbols-outlined text-5xl opacity-20 block mb-2">person_off</span>
                            Data pengguna tidak ditemukan.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if ($users->hasPages())
        <div class="p-4 border-t border-slate-200 dark:border-border-dark bg-slate-50 dark:bg-[#111827]">
            {{ $users->links() }}
        </div>
        @endif
    </div>
</div>

<div id="deleteModal" class="fixed inset-0 z-[100] hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="fixed inset-0 bg-slate-900/40 backdrop-blur-md transition-opacity"></div>

    <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
        <div class="relative transform overflow-hidden rounded-2xl bg-white dark:bg-[#1F2937] text-left shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-lg border border-slate-200 dark:border-border-dark">
            <div class="p-8">
                <div class="sm:flex sm:items-start">
                    <div class="mx-auto flex h-14 w-14 flex-shrink-0 items-center justify-center rounded-2xl bg-red-100 dark:bg-red-500/10 text-red-600 dark:text-red-500 sm:mx-0 sm:h-12 sm:w-12 shadow-inner">
                        <span class="material-symbols-outlined text-3xl">delete_forever</span>
                    </div>
                    <div class="mt-4 text-center sm:ml-5 sm:mt-0 sm:text-left">
                        <h3 class="text-xl font-extrabold text-slate-900 dark:text-white tracking-tight" id="modal-title">Hapus Pengguna?</h3>
                        <div class="mt-2">
                            <p class="text-sm leading-relaxed text-slate-500 dark:text-slate-400">
                                Anda akan menghapus akun <span id="deleteUserName" class="font-bold text-slate-900 dark:text-white underline decoration-red-500/30"></span> secara permanen. Seluruh data akses dan riwayat terkait akan ikut terhapus.
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
    let userIdToDelete = null;

    function openDeleteModal(id, name) {
        userIdToDelete = id;
        document.getElementById('deleteUserName').innerText = name;
        
        const modal = document.getElementById('deleteModal');
        modal.classList.remove('hidden');
        // Mencegah scroll pada body saat modal terbuka
        document.body.classList.add('overflow-hidden');
    }

    function closeDeleteModal() {
        const modal = document.getElementById('deleteModal');
        modal.classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
        userIdToDelete = null;
    }

    // Fungsi Eksekusi Hapus yang BARU
    function submitDeleteForm() {
        if (userIdToDelete) {
            // Mencari form yang sesuai dengan ID user, lalu men-submitnya
            document.getElementById('delete-form-' + userIdToDelete).submit();
        }
    }

    // Menutup modal jika area di luar kotak modal diklik
    window.addEventListener('click', function(event) {
        const modal = document.getElementById('deleteModal');
        if (event.target === modal) {
            closeDeleteModal();
        }
    });
</script>
@endpush