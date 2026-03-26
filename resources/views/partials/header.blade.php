<header class="flex items-center justify-between px-6 py-4 bg-white dark:bg-[#111a22] border-b border-slate-200 dark:border-border-dark flex-shrink-0 z-10">
    <div class="flex items-center flex-1 gap-4">
        <button class="md:hidden p-2 rounded-lg text-slate-500 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800">
            <span class="material-symbols-outlined">menu</span>
        </button>
        <h2 class="hidden md:block text-xl font-bold text-slate-800 dark:text-white tracking-tight">Dashboard Admin</h2>
        
    </div>
    <div class="flex items-center gap-4">
        <button class="relative p-2 rounded-full text-slate-500 hover:bg-slate-100 dark:text-slate-400 dark:hover:bg-[#233648] transition-colors">
            <span class="material-symbols-outlined">notifications</span>
            <span class="absolute top-1.5 right-2 w-2 h-2 bg-red-500 rounded-full border-2 border-white dark:border-[#111a22]"></span>
        </button>
        <div class="w-px h-8 bg-slate-200 dark:bg-border-dark mx-1"></div>
        <div class="flex items-center gap-3 cursor-pointer">
        <div class="text-right hidden md:block">
            <p class="text-sm font-semibold text-slate-800 dark:text-white">{{ Auth::user()->name }}</p>
            <p class="text-xs text-slate-500 dark:text-slate-400">
                {{ Auth::user()->role === 'admin' ? 'Administrator' : 'Mahasiswa' }}
            </p>
        </div>
        </div>
    </div>
</header>