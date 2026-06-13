<!DOCTYPE html>
<html class="dark" lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>LabLoans Mobile QR Loan</title>
    
    <link href="https://fonts.googleapis.com" rel="preconnect"/>
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700&display=swap" rel="stylesheet"/>
    
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    
    <script id="tailwind-config">
      tailwind.config = {
        darkMode: "class",
        theme: {
          extend: {
            colors: {
              "primary": "#137fec",
              "primary-dark": "#0b5bb0",
              "background-light": "#f6f7f8",
              "background-dark": "#101922",
              "surface-dark": "#1a2632",
              "border-dark": "#2a3b4c",
              "text-secondary": "#92adc9",
            },
            fontFamily: {
              "display": ["Space Grotesk", "sans-serif"]
            },
            borderRadius: {"DEFAULT": "0.25rem", "lg": "0.5rem", "xl": "0.75rem", "full": "9999px"},
          },
        },
      }
    </script>
</head>
<body class="bg-background-light dark:bg-background-dark font-display text-slate-900 dark:text-slate-100 min-h-screen flex flex-col antialiased selection:bg-primary/30">
<div class="layout-container flex h-full grow flex-col mx-auto w-full max-w-[480px] shadow-2xl dark:shadow-black/50 min-h-screen relative border-x border-border-dark/50">
    
    <header class="flex items-center justify-between whitespace-nowrap border-b border-solid border-border-dark bg-background-dark/95 backdrop-blur-md sticky top-0 z-50 px-5 py-4">
        <div class="flex items-center gap-3">
            <div class="size-8 flex items-center justify-center rounded-lg bg-primary/10 text-primary">
                <span class="material-symbols-outlined text-[24px]">science</span>
            </div>
            <h2 class="text-slate-100 text-lg font-bold leading-tight tracking-[-0.015em]">LabLoans</h2>
        </div>
        <a href="/" class="flex size-9 cursor-pointer items-center justify-center rounded-full bg-surface-dark text-slate-100 hover:bg-border-dark transition-colors">
            <span class="material-symbols-outlined text-[20px]">close</span>
        </a>
    </header>

    <form action="{{ route('quick-loan.store') }}" method="POST" class="flex flex-1 flex-col pb-24">
        @csrf
        <input type="hidden" name="item_id" value="{{ $item->id }}">

        <div class="px-5 pt-6 pb-4">
            <div class="flex flex-col gap-2">
                <h1 class="text-slate-100 tracking-tight text-3xl font-bold leading-tight">Peminjaman Ekspres</h1>

                @if($errors->any())
                    <div class="flex flex-col gap-1 p-3 bg-red-500/10 border border-red-500/20 rounded-lg text-red-400">
                        <div class="flex items-center gap-2 text-red-500">
                            <span class="material-symbols-outlined text-[18px]">error</span>
                            <p class="text-sm font-semibold">Periksa kembali isian Anda:</p>
                        </div>
                        <ul class="text-xs list-disc list-inside pl-1 space-y-0.5">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if(session('error'))
                    <div class="flex items-center gap-2 p-3 bg-red-500/10 border border-red-500/20 rounded-lg text-red-500">
                        <span class="material-symbols-outlined text-[18px]">error</span>
                        <p class="text-sm font-medium">{{ session('error') }}</p>
                    </div>
                @else
                    @if($item->status === 'available')
                        <div class="flex items-center gap-2 text-primary">
                            <span class="material-symbols-outlined text-[18px]">check_circle</span>
                            <p class="text-sm font-medium">Pindai QR berhasil. Silakan lengkapi data.</p>
                        </div>
                    @else
                        <div class="flex items-center gap-2 text-red-500">
                            <span class="material-symbols-outlined text-[18px]">cancel</span>
                            <p class="text-sm font-medium">Alat ini sedang tidak tersedia untuk dipinjam.</p>
                        </div>
                    @endif
                @endif
            </div>
        </div>

        <section class="px-5 py-2">
            <h3 class="text-slate-100 text-lg font-bold leading-tight mb-4 flex items-center gap-2">
                <span class="material-symbols-outlined text-text-secondary text-[20px]">inventory_2</span>
                Data Alat
            </h3>
            <div class="bg-surface-dark rounded-xl overflow-hidden border border-border-dark">
                <div class="flex justify-between items-center p-4 border-b border-border-dark/50">
                    <span class="text-text-secondary text-sm">ID Alat</span>
                    <span class="text-slate-100 text-sm font-semibold font-mono bg-background-dark px-2 py-1 rounded border border-border-dark/50">
                        {{ $item->item_code }}
                    </span>
                </div>
                <div class="flex justify-between items-center p-4 border-b border-border-dark/50">
                    <span class="text-text-secondary text-sm">Nama Alat</span>
                    <span class="text-slate-100 text-sm font-medium text-right max-w-[60%] truncate">
                        {{ $item->name }}
                    </span>
                </div>
                <div class="flex justify-between items-center p-4">
                    <span class="text-text-secondary text-sm">Status Fisik</span>
                    @if($item->status === 'available')
                        <span class="text-green-400 text-sm font-medium text-right flex items-center gap-1">
                            <span class="material-symbols-outlined text-[16px]">check_circle</span> Tersedia
                        </span>
                    @elseif($item->status === 'maintenance')
                        <span class="text-amber-400 text-sm font-medium text-right flex items-center gap-1">
                            <span class="material-symbols-outlined text-[16px]">build</span> Perbaikan
                        </span>
                    @else
                        <span class="text-blue-400 text-sm font-medium text-right flex items-center gap-1">
                            <span class="material-symbols-outlined text-[16px]">shopping_bag</span> Dipinjam
                        </span>
                    @endif
                </div>
            </div>
        </section>

        <section class="px-5 py-4">
            <h3 class="text-slate-100 text-lg font-bold leading-tight mb-4 flex items-center gap-2">
                <span class="material-symbols-outlined text-text-secondary text-[20px]">verified_user</span>
                Verifikasi Peminjam
            </h3>
            <div class="bg-surface-dark rounded-xl p-5 border border-border-dark space-y-4">
                <div class="flex items-start gap-3 p-3 bg-primary/10 rounded-lg border border-primary/20 mb-2">
                    <span class="material-symbols-outlined text-primary text-[20px] mt-0.5">info</span>
                    <p class="text-xs text-slate-300 leading-relaxed">Masukkan kredensial akun LabLoans Anda untuk memverifikasi identitas peminjam.</p>
                </div>
                
                <div class="space-y-1">
                    <label class="text-sm font-medium text-text-secondary ml-1" for="username">Username / NIP</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <span class="material-symbols-outlined text-text-secondary text-[20px]">person</span>
                        </div>
                        <input name="username" value="{{ old('username') }}" class="block w-full pl-10 pr-3 py-3 bg-background-dark border border-border-dark rounded-lg text-slate-100 placeholder-text-secondary/50 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all" id="username" placeholder="Contoh: lab.budi123" type="text" required/>
                    </div>
                </div>

                <div class="space-y-1">
                    <label class="text-sm font-medium text-text-secondary ml-1" for="password">Kata Sandi</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <span class="material-symbols-outlined text-text-secondary text-[20px]">lock</span>
                        </div>
                        <input name="password" class="block w-full pl-10 pr-10 py-3 bg-background-dark border border-border-dark rounded-lg text-slate-100 placeholder-text-secondary/50 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all" id="password" placeholder="••••••••" type="password" required/>
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center cursor-pointer" onclick="togglePassword()">
                            <span id="eyeIcon" class="material-symbols-outlined text-text-secondary text-[20px] hover:text-primary transition-colors">visibility</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="px-5 py-2">
            <h3 class="text-slate-100 text-lg font-bold leading-tight mb-4 flex items-center gap-2">
                <span class="material-symbols-outlined text-text-secondary text-[20px]">edit_calendar</span>
                Detail Peminjaman
            </h3>
            <div class="space-y-4">
                <div class="space-y-1">
                    <label class="text-sm font-medium text-text-secondary ml-1" for="return_date">Batas Waktu Pengembalian</label>
                    <div class="relative">
                        <input type="datetime-local" name="return_date" id="return_date" required class="block w-full px-4 py-3 bg-surface-dark border border-border-dark rounded-lg text-slate-100 focus:outline-none focus:ring-2 focus:ring-primary cursor-pointer appearance-none"/>
                        <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                            <span class="material-symbols-outlined text-text-secondary text-[20px]">calendar_month</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <footer class="fixed bottom-0 left-0 right-0 z-40 bg-background-dark/80 backdrop-blur-xl border-t border-border-dark p-5 flex justify-center">
            <div class="w-full max-w-[480px]">
                @if($item->status === 'available')
                    <button type="submit" class="w-full bg-primary hover:bg-primary-dark text-white font-bold py-4 px-6 rounded-xl shadow-lg shadow-primary/20 flex items-center justify-center gap-3 transition-all active:scale-[0.98]">
                        <span>Konfirmasi & Pinjam Sekarang</span>
                        <span class="material-symbols-outlined">arrow_forward</span>
                    </button>
                @else
                    <button type="button" disabled class="w-full bg-border-dark text-text-secondary font-bold py-4 px-6 rounded-xl flex items-center justify-center gap-3 cursor-not-allowed">
                        <span class="material-symbols-outlined">block</span>
                        <span>Alat Tidak Tersedia</span>
                    </button>
                @endif
            </div>
        </footer>
    </form>
</div>

<script>
    function togglePassword() {
        const passwordInput = document.getElementById("password");
        const eyeIcon = document.getElementById("eyeIcon");
        
        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            eyeIcon.textContent = "visibility_off";
        } else {
            passwordInput.type = "password";
            eyeIcon.textContent = "visibility";
        }
    }
</script>
</body>
</html>