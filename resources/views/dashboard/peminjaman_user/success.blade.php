<!DOCTYPE html>
<html class="dark" lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>LabLoans - Peminjaman Berhasil</title>
    <link href="https://fonts.googleapis.com" rel="preconnect"/>
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-background-dark font-display text-slate-100 min-h-screen flex flex-col antialiased selection:bg-primary/30">
    <div class="layout-container flex h-full grow flex-col mx-auto w-full max-w-[480px] shadow-2xl shadow-black/50 min-h-screen relative border-x border-border-dark/50 bg-background-dark">
        <main class="flex flex-1 flex-col items-center justify-center px-6 py-12 text-center">
            <div class="mb-10 relative">
                <div class="size-32 rounded-full bg-success-neon/10 flex items-center justify-center border-4 border-success-neon/20 glow-success relative z-10">
                    <span class="material-symbols-outlined text-[80px] text-success-neon" style="font-variation-settings: 'FILL' 1, 'wght' 400">check_circle</span>
                </div>
                <div class="absolute -inset-4 bg-success-neon/5 rounded-full blur-2xl -z-10"></div>
            </div>
            
            <div class="space-y-3 mb-10">
                <h1 class="text-3xl font-bold tracking-tight text-white">Peminjaman Berhasil!</h1>
                <p class="text-text-secondary leading-relaxed">
                    Alat laboratorium telah berhasil dipinjam dan tercatat dalam sistem.
                </p>
            </div>
            
            <div class="w-full bg-surface-dark border border-border-dark rounded-2xl overflow-hidden mb-12">
                <div class="p-5 border-b border-border-dark/50">
                    <div class="flex flex-col gap-1 items-start text-left">
                        <span class="text-xs font-semibold uppercase tracking-wider text-text-secondary">Detail Alat</span>
                        <div class="flex justify-between w-full items-center mt-2 gap-2">
                            <h3 class="text-lg font-bold text-white truncate">{{ $item->name }}</h3>
                            <span class="text-[10px] font-mono bg-background-dark px-2 py-1 rounded border border-border-dark/50 text-primary whitespace-nowrap">{{ $item->item_code }}</span>
                        </div>
                    </div>
                </div>
                
                <div class="p-5 bg-background-dark/30 flex flex-col gap-4">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-[18px] text-text-secondary">event_repeat</span>
                            <span class="text-sm text-text-secondary">Batas Pengembalian</span>
                        </div>
                        <span class="text-sm font-semibold text-white">{{ \Carbon\Carbon::parse($loan->return_date)->format('d M Y, H:i') }}</span>
                    </div>
                    
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-[18px] text-text-secondary">person_check</span>
                            <span class="text-sm text-text-secondary">Peminjam</span>
                        </div>
                        <span class="text-sm font-semibold text-white">{{ $user->name }}</span>
                    </div>
                </div>
            </div>
            
            <div class="w-full flex items-start gap-4 p-4 bg-primary/5 rounded-xl border border-primary/10 text-left mb-8">
                <span class="material-symbols-outlined text-primary text-[22px]">info</span>
                <p class="text-[13px] text-slate-300 leading-normal">
                    Pastikan untuk meletakkan kembali alat pada rak yang sesuai setelah pemakaian selesai.
                </p>
            </div>
        </main>
        
        <footer class="p-6 pb-10 flex flex-col gap-4 w-full bg-background-dark">
            @if(!empty($wasGuest))
                <a href="{{ route('login') }}" class="w-full bg-primary hover:bg-primary-dark text-white font-bold py-4 px-6 rounded-xl shadow-lg shadow-primary/20 flex items-center justify-center gap-3 transition-all active:scale-[0.98]">
                    <span>Masuk ke Akun Saya</span>
                    <span class="material-symbols-outlined text-[20px]">login</span>
                </a>
            @else
                <a href="{{ route('dashboard') }}" class="w-full bg-primary hover:bg-primary-dark text-white font-bold py-4 px-6 rounded-xl shadow-lg shadow-primary/20 flex items-center justify-center gap-3 transition-all active:scale-[0.98]">
                    <span>Ke Dashboard Saya</span>
                    <span class="material-symbols-outlined text-[20px]">dashboard</span>
                </a>
            @endif
            <a href="/" class="w-full py-3 text-text-secondary hover:text-white font-medium transition-colors text-center text-sm">
                Tutup Halaman
            </a>
        </footer>
    </div>
</body>
</html>