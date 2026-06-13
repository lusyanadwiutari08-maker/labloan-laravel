<!DOCTYPE html>
<html class="dark" lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>LabLoans - Register</title>
    <link href="https://fonts.googleapis.com" rel="preconnect"/>
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;700;800&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-display bg-background-light dark:bg-background-dark text-slate-900 dark:text-slate-100 antialiased">
<div class="flex min-h-screen w-full flex-row overflow-hidden">
    <div class="hidden lg:flex relative w-1/2 flex-col justify-between bg-slate-900 p-12 text-white">
        <div class="absolute inset-0 z-0">
            <img class="h-full w-full object-cover opacity-40 mix-blend-overlay" src="https://images.unsplash.com/photo-1532094349884-543bc11b234d?q=80&w=2070&auto=format&fit=crop"/>
            <div class="absolute inset-0 bg-gradient-to-br from-slate-900 via-slate-900/90 to-primary/20 mix-blend-multiply"></div>
        </div>
        <div class="relative z-10 flex items-center gap-3">
            <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-primary/20 backdrop-blur-md border border-primary/30 text-primary">
                <span class="material-symbols-outlined text-2xl">science</span>
            </div>
            <span class="text-xl font-bold tracking-tight">LabLoans</span>
        </div>
        <div class="relative z-10 flex justify-between text-sm font-medium text-slate-400">
            <p>© 2024 LabLoans Inc.</p>
        </div>
    </div>

    <div class="flex w-full lg:w-1/2 flex-col items-center justify-center overflow-y-auto bg-background-light dark:bg-background-dark p-6 md:p-12 lg:p-20">
        <div class="w-full max-w-md space-y-8">
            <div class="text-center lg:text-left">
                <h2 class="text-3xl font-bold tracking-tight text-slate-900 dark:text-white">Buat akun Anda</h2>
                <p class="mt-2 text-sm text-slate-600 dark:text-slate-400">Masukkan detail Anda untuk bergabung</p>
            </div>

            @if ($errors->any())
                <div class="bg-red-500/10 border border-red-500/50 text-red-500 rounded-lg p-3 text-sm">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}" class="space-y-6">
                @csrf
                <div>
                    <label class="block text-sm font-medium leading-6 text-slate-900 dark:text-slate-200" for="name">Nama Lengkap</label>
                    <div class="relative mt-2">
                        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                            <span class="material-symbols-outlined text-slate-400 text-xl">person</span>
                        </div>
                        <input name="name" value="{{ old('name') }}" class="block w-full rounded-lg border-0 py-3 pl-10 text-slate-900 dark:text-white bg-white dark:bg-[#1a2632] shadow-sm ring-1 ring-inset ring-slate-300 dark:ring-slate-700 focus:ring-2 focus:ring-primary sm:text-sm" id="name" required type="text"/>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium leading-6 text-slate-900 dark:text-slate-200" for="username">Username</label>
                    <div class="relative mt-2">
                        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                            <span class="material-symbols-outlined text-slate-400 text-xl">account_circle</span>
                        </div>
                        <input name="username" value="{{ old('username') }}" class="block w-full rounded-lg border-0 py-3 pl-10 text-slate-900 dark:text-white bg-white dark:bg-[#1a2632] shadow-sm ring-1 ring-inset ring-slate-300 dark:ring-slate-700 focus:ring-2 focus:ring-primary sm:text-sm" id="username" required type="text"/>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium leading-6 text-slate-900 dark:text-slate-200" for="password">Kata Sandi</label>
                    <div class="relative mt-2">
                        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                            <span class="material-symbols-outlined text-slate-400 text-xl">lock</span>
                        </div>
                        <input name="password" class="block w-full rounded-lg border-0 py-3 pl-10 pr-10 text-slate-900 dark:text-white bg-white dark:bg-[#1a2632] shadow-sm ring-1 ring-inset ring-slate-300 dark:ring-slate-700 focus:ring-2 focus:ring-primary sm:text-sm" id="password" required type="password"/>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium leading-6 text-slate-900 dark:text-slate-200" for="password_confirmation">Konfirmasi Kata Sandi</label>
                    <div class="relative mt-2">
                        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                            <span class="material-symbols-outlined text-slate-400 text-xl">lock_reset</span>
                        </div>
                        <input name="password_confirmation" class="block w-full rounded-lg border-0 py-3 pl-10 pr-10 text-slate-900 dark:text-white bg-white dark:bg-[#1a2632] shadow-sm ring-1 ring-inset ring-slate-300 dark:ring-slate-700 focus:ring-2 focus:ring-primary sm:text-sm" id="password_confirmation" required type="password"/>
                    </div>
                </div>

                <div>
                    <button type="submit" class="flex w-full justify-center rounded-lg bg-primary px-3 py-3 text-sm font-bold leading-6 text-white shadow-sm hover:bg-blue-600 transition-all duration-200">
                        Buat Akun
                    </button>
                </div>
            </form>

            <div class="relative">
                <div aria-hidden="true" class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-slate-300 dark:border-slate-700"></div>
                </div>
                <div class="relative flex justify-center text-sm font-medium leading-6">
                    <span class="bg-background-light dark:bg-background-dark px-6 text-slate-500 dark:text-slate-400">Sudah punya akun?</span>
                </div>
            </div>
            
            <div class="flex justify-center">
                <a href="{{ route('login') }}" class="flex items-center gap-2 text-sm font-bold text-primary hover:text-primary/80 transition-colors">
                    Masuk ke akun Anda
                    <span class="material-symbols-outlined text-lg">arrow_forward</span>
                </a>
            </div>
        </div>
    </div>
</div>
</body>
</html>