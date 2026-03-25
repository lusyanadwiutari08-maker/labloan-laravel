<aside
    class="w-64 flex-shrink-0 border-r border-slate-200 dark:border-border-dark bg-white dark:bg-[#111a22] flex flex-col justify-between hidden md:flex transition-all duration-300">
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
            <a href="{{ route('dashboard') }}"
                class="flex items-center gap-3 px-3 py-2.5 rounded-lg group transition-colors {{ request()->routeIs('dashboard') ? 'bg-primary/10 dark:bg-[#233648] text-primary dark:text-white' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-[#1e2a35] hover:text-slate-900 dark:hover:text-white' }}">
                <span
                    class="material-symbols-outlined group-hover:scale-110 transition-transform {{ request()->routeIs('dashboard') ? 'text-primary dark:text-white' : '' }}">dashboard</span>
                <span
                    class="text-sm {{ request()->routeIs('dashboard') ? 'font-semibold' : 'font-medium' }}">Dashboard</span>
            </a>

            @if (Auth::user()->role === 'admin')
                <a href="{{ route('items.index') }}"
                    class="flex items-center gap-3 px-3 py-2.5 rounded-lg group transition-colors {{ request()->routeIs('items.*') ? 'bg-primary/10 dark:bg-[#233648] text-primary dark:text-white' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-[#1e2a35] hover:text-slate-900 dark:hover:text-white' }}">
                    <span
                        class="material-symbols-outlined group-hover:scale-110 transition-transform {{ request()->routeIs('items.*') ? 'text-primary dark:text-white' : '' }}">inventory_2</span>
                    <span
                        class="text-sm {{ request()->routeIs('items.*') ? 'font-semibold' : 'font-medium' }}">Inventaris
                        Lab</span>
                </a>

                <a href="{{ route('admin.loans.index') }}"
                    class="flex items-center gap-3 px-3 py-2.5 rounded-lg group transition-colors {{ request()->routeIs('admin.loans.*') ? 'bg-primary/10 dark:bg-[#233648] text-primary dark:text-white' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-[#1e2a35] hover:text-slate-900 dark:hover:text-white' }}">
                    <span
                        class="material-symbols-outlined group-hover:scale-110 transition-transform {{ request()->routeIs('admin.loans.*') ? 'text-primary dark:text-white' : '' }}">list_alt</span>
                    <span
                        class="text-sm {{ request()->routeIs('admin.loans.*') ? 'font-semibold' : 'font-medium' }}">Semua
                        Peminjaman</span>
                </a>

                <a href="{{ route('users.index') }}"
                    class="flex items-center gap-3 px-3 py-2.5 rounded-lg group transition-colors {{ request()->routeIs('users.*') ? 'bg-primary/10 dark:bg-[#233648] text-primary dark:text-white' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-[#1e2a35] hover:text-slate-900 dark:hover:text-white' }}">
                    <span
                        class="material-symbols-outlined group-hover:scale-110 transition-transform {{ request()->routeIs('users.*') ? 'text-primary dark:text-white' : '' }}">people</span>
                    <span
                        class="text-sm {{ request()->routeIs('users.*') ? 'font-semibold' : 'font-medium' }}">Manajemen
                        User</span>
                </a>
            @else
                <a href="#"
                    class="flex items-center gap-3 px-3 py-2.5 rounded-lg group transition-colors {{ request()->routeIs('scan.*') ? 'bg-primary/10 dark:bg-[#233648] text-primary dark:text-white' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-[#1e2a35] hover:text-slate-900 dark:hover:text-white' }}">
                    <span
                        class="material-symbols-outlined group-hover:scale-110 transition-transform {{ request()->routeIs('scan.*') ? 'text-primary dark:text-white' : '' }}">qr_code_scanner</span>
                    <span class="text-sm {{ request()->routeIs('scan.*') ? 'font-semibold' : 'font-medium' }}">Scan
                        Quick Loan</span>
                </a>

                <a href="#"
                    class="flex items-center gap-3 px-3 py-2.5 rounded-lg group transition-colors {{ request()->routeIs('user.loans.*') ? 'bg-primary/10 dark:bg-[#233648] text-primary dark:text-white' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-[#1e2a35] hover:text-slate-900 dark:hover:text-white' }}">
                    <span
                        class="material-symbols-outlined group-hover:scale-110 transition-transform {{ request()->routeIs('user.loans.*') ? 'text-primary dark:text-white' : '' }}">history</span>
                    <span
                        class="text-sm {{ request()->routeIs('user.loans.*') ? 'font-semibold' : 'font-medium' }}">Riwayat
                        Peminjaman</span>
                </a>
            @endif
        </nav>
    </div>

    <div class="p-4 border-t border-slate-200 dark:border-border-dark">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                class="w-full flex items-center gap-3 px-3 py-2.5 rounded-lg text-red-500 hover:bg-red-50 dark:hover:bg-red-900/20 hover:text-red-600 transition-colors group">
                <span class="material-symbols-outlined group-hover:scale-110 transition-transform">logout</span>
                <span class="text-sm font-medium">Keluar</span>
            </button>
        </form>
    </div>
</aside>
