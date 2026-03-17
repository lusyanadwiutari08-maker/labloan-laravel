<!DOCTYPE html>
<html class="dark" lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>LabLoans - Masuk</title>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com" rel="preconnect"/>
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@300;400;500;600;700;800&display=swap" rel="stylesheet"/>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#137fec",
                        "background-light": "#f6f7f8",
                        "background-dark": "#101922",
                    },
                    fontFamily: {
                        "display": ["Manrope", "sans-serif"]
                    },
                    borderRadius: {"DEFAULT": "0.25rem", "lg": "0.5rem", "xl": "0.75rem", "full": "9999px"},
                },
            },
        }
    </script>
    <style>
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #111a22; }
        ::-webkit-scrollbar-thumb { background: #324d67; border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: #476c8f; }
    </style>
</head>
<body class="bg-background-light dark:bg-background-dark font-display text-slate-900 dark:text-slate-100 antialiased overflow-hidden">
<div class="flex h-screen w-full flex-row">
    <div class="hidden lg:flex lg:w-1/2 xl:w-7/12 relative bg-cover bg-center overflow-hidden group" style='background-image: url("https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?q=80&w=2070&auto=format&fit=crop");'>
        <div class="absolute inset-0 bg-gradient-to-t from-background-dark/90 via-background-dark/40 to-transparent"></div>
        <div class="absolute inset-0 bg-primary/20 mix-blend-overlay"></div>
        <div class="absolute bottom-0 left-0 p-12 z-10 max-w-2xl">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/10 backdrop-blur-md border border-white/10 mb-6">
                <span class="w-2 h-2 rounded-full bg-primary animate-pulse"></span>
                <span class="text-xs font-medium text-white tracking-wide uppercase">SISTEM BEROPERASI</span>
            </div>
        </div>
    </div>

    <div class="flex-1 flex flex-col h-full relative z-0 bg-background-light dark:bg-background-dark overflow-y-auto">
        <div class="absolute top-0 right-0 -mt-20 -mr-20 w-80 h-80 bg-primary/10 rounded-full blur-[100px] pointer-events-none"></div>
        <div class="flex-1 flex flex-col justify-center px-4 sm:px-12 xl:px-24 py-12 max-w-[640px] mx-auto w-full z-10">
            <div class="mb-10">
                <div class="flex items-center gap-2 mb-8">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-primary to-blue-600 flex items-center justify-center text-white shadow-lg shadow-primary/25">
                        <span class="material-symbols-outlined text-2xl">science</span>
                    </div>
                    <span class="text-2xl font-bold tracking-tight text-slate-900 dark:text-white">LabLoans</span>
                </div>
                <h2 class="text-3xl font-bold text-slate-900 dark:text-white mb-2">Selamat datang kembali</h2>
                <p class="text-slate-500 dark:text-slate-400">Silakan masukkan kredensial Anda untuk mengakses dashboard.</p>
            </div>

            @if ($errors->any())
                <div class="mb-4 bg-red-500/10 border border-red-500/50 text-red-500 rounded-lg p-3 text-sm">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="flex flex-col gap-5">
                @csrf
                <div class="space-y-2">
                    <label class="text-sm font-medium text-slate-900 dark:text-slate-200" for="username">Username</label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-500 dark:text-slate-400 group-focus-within:text-primary transition-colors">
                            <span class="material-symbols-outlined text-[20px]">person</span>
                        </div>
                        <input name="username" value="{{ old('username') }}" class="w-full pl-10 pr-4 py-3 rounded-lg border border-slate-200 dark:border-slate-700 bg-white/50 dark:bg-white/5 backdrop-blur-sm text-slate-900 dark:text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-primary/50 focus:border-primary transition-all duration-200 shadow-sm" id="username" placeholder="Masukkan username Anda" required type="text"/>
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="text-sm font-medium text-slate-900 dark:text-slate-200" for="password">Kata Sandi</label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-500 dark:text-slate-400 group-focus-within:text-primary transition-colors">
                            <span class="material-symbols-outlined text-[20px]">lock</span>
                        </div>
                        <input name="password" class="w-full pl-10 pr-4 py-3 rounded-lg border border-slate-200 dark:border-slate-700 bg-white/50 dark:bg-white/5 backdrop-blur-sm text-slate-900 dark:text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-primary/50 focus:border-primary transition-all duration-200 shadow-sm" id="password" placeholder="••••••••" required type="password"/>
                    </div>
                </div>

                <div class="flex items-center justify-between pt-1">
                    <label class="flex items-center gap-2 cursor-pointer group">
                        <div class="relative flex items-center">
                            <input name="remember" class="peer h-4 w-4 appearance-none rounded border border-slate-300 dark:border-slate-600 bg-transparent checked:border-primary checked:bg-primary focus:ring-1 focus:ring-primary/50 focus:ring-offset-0 transition-all cursor-pointer" type="checkbox"/>
                            <span class="material-symbols-outlined absolute left-0 top-0 text-white opacity-0 peer-checked:opacity-100 text-[16px] pointer-events-none">check</span>
                        </div>
                        <span class="text-sm text-slate-600 dark:text-slate-400 group-hover:text-slate-800 dark:group-hover:text-slate-200 transition-colors">Ingat saya</span>
                    </label>
                </div>

                <button type="submit" class="mt-2 w-full bg-gradient-to-r from-primary to-blue-600 hover:from-blue-500 hover:to-primary text-white font-bold py-3.5 px-4 rounded-lg shadow-lg shadow-primary/20 transition-all duration-300 transform hover:-translate-y-0.5 active:translate-y-0 focus:ring-4 focus:ring-primary/30 flex items-center justify-center gap-2 group">
                    <span>Masuk</span>
                    <span class="material-symbols-outlined text-lg transition-transform group-hover:translate-x-1">arrow_forward</span>
                </button>

                <p class="text-center text-sm text-slate-500 dark:text-slate-400 mt-6">
                    Belum punya akun? 
                    <a href="{{ route('register') }}" class="font-semibold text-primary hover:text-blue-400 transition-colors">Daftar</a>
                </p>
            </form>
        </div>
    </div>
</div>
</body>
</html>