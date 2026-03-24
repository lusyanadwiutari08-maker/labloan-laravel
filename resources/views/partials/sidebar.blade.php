<aside class="w-64 flex-shrink-0 border-r border-slate-200 dark:border-border-dark bg-white dark:bg-[#111a22] flex flex-col justify-between hidden md:flex transition-all duration-300">
    <div class="flex flex-col gap-4 p-4">
        <div class="flex items-center gap-3 px-2 mb-4">
            <div class="flex items-center justify-center w-10 h-10 rounded-xl bg-primary text-white">
                <span class="material-symbols-outlined">science</span>
            </div>
            <div class="flex flex-col">
                <h1 class="text-slate-900 dark:text-white text-lg font-bold leading-tight">LabLoans</h1>
                <p class="text-slate-500 dark:text-slate-400 text-xs font-medium">
                    {{ Auth::user()->role === 'admin' ? 'Sistem Admin' : 'Panel Mahasiswa' }}
                </p>
            </div>
        </div>

        <nav class="flex flex-col gap-2">
            <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg bg-primary/10 dark:bg-[#233648] text-primary dark:text-white group transition-colors" href="/dashboard">
                <span class="material-symbols-outlined text-primary dark:text-white group-hover:scale-110 transition-transform">dashboard</span>
                <span class="text-sm font-semibold">Dashboard</span>
            </a>

            @if (Auth::user()->role === 'admin')
                <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-[#1e2a35] hover:text-slate-900 dark:hover:text-white transition-colors group" href="#">
                    <span class="material-symbols-outlined group-hover:scale-110 transition-transform">inventory_2</span>
                    <span class="text-sm font-medium">Inventaris Lab</span>
                </a>
                <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-[#1e2a35] hover:text-slate-900 dark:hover:text-white transition-colors group" href="#">
                    <span class="material-symbols-outlined group-hover:scale-110 transition-transform">list_alt</span>
                    <span class="text-sm font-medium">Semua Peminjaman</span>
                </a>
                <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-[#1e2a35] hover:text-slate-900 dark:hover:text-white transition-colors group" href="#">
                    <span class="material-symbols-outlined group-hover:scale-110 transition-transform">people</span>
                    <span class="text-sm font-medium">Manajemen User</span>
                </a>
            @else
                <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-[#1e2a35] hover:text-slate-900 dark:hover:text-white transition-colors group" href="#">
                    <span class="material-symbols-outlined group-hover:scale-110 transition-transform">qr_code_scanner</span>
                    <span class="text-sm font-medium">Scan Quick Loan</span>
                </a>
                <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-[#1e2a35] hover:text-slate-900 dark:hover:text-white transition-colors group" href="#">
                    <span class="material-symbols-outlined group-hover:scale-110 transition-transform">history</span>
                    <span class="text-sm font-medium">Riwayat Peminjaman</span>
                </a>
            @endif
        </nav>
    </div>
    
    <div class="p-4 border-t border-slate-200 dark:border-border-dark">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full flex items-center gap-3 px-3 py-2.5 rounded-lg text-red-500 hover:bg-red-50 dark:hover:bg-red-900/20 hover:text-red-600 transition-colors group">
                <span class="material-symbols-outlined group-hover:scale-110 transition-transform">logout</span>
                <span class="text-sm font-medium">Keluar</span>
            </button>
        </form>
    </div>
</aside>