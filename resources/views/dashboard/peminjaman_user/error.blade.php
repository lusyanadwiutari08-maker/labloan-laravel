<!DOCTYPE html>
<html class="dark" lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>LabLoans - Peminjaman Gagal</title>
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
              "error": "#ef4444",
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
    <style type="text/tailwindcss">
        .error-glow {
            box-shadow: 0 0 40px -10px rgba(239, 68, 68, 0.3);
        }
    </style>
</head>
<body class="bg-background-light dark:bg-background-dark font-display text-slate-900 dark:text-slate-100 min-h-screen flex flex-col antialiased selection:bg-error/30">
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
        
        <main class="flex flex-1 flex-col items-center justify-center px-6 py-12 text-center">
            <div class="mb-8 relative">
                <div class="size-24 rounded-full bg-error/10 border-2 border-error/20 flex items-center justify-center error-glow">
                    <span class="material-symbols-outlined text-error text-[56px] font-light">error</span>
                </div>
            </div>
            <h1 class="text-slate-100 tracking-tight text-3xl font-bold leading-tight mb-4">
                Peminjaman Gagal
            </h1>
            
            <div class="w-full bg-surface-dark/50 border border-border-dark rounded-xl p-4 mb-6">
                <div class="flex flex-col gap-1">
                    <span class="text-text-secondary text-xs uppercase tracking-wider font-semibold">Alat yang dipindai:</span>
                    <span class="text-slate-100 font-medium">{{ $item->name }} ({{ $item->item_code }})</span>
                </div>
            </div>
            
            <div class="space-y-4 max-w-[320px]">
                <p class="text-text-secondary leading-relaxed text-base">
                    {{ $message }}
                </p>
                <div class="py-2 px-4 bg-error/5 rounded-lg border border-error/10 inline-block">
                    <p class="text-error text-sm font-medium">{{ $status_label }}</p>
                </div>
            </div>
        </main>
        
        <footer class="mt-auto p-6 space-y-4 bg-background-dark">
            <a href="{{ route('quick-loan.scan', $item->item_code) }}" class="w-full bg-primary hover:bg-primary-dark text-white font-bold py-4 px-6 rounded-xl shadow-lg shadow-primary/20 flex items-center justify-center gap-3 transition-all active:scale-[0.98]">
                <span class="material-symbols-outlined">refresh</span>
                <span>Coba Lagi</span>
            </a>
            <a class="w-full flex items-center justify-center py-3 text-text-secondary hover:text-white transition-colors gap-2 text-sm font-medium" href="#">
                <span class="material-symbols-outlined text-[18px]">support_agent</span>
                <span>Hubungi Admin</span>
            </a>
            <div class="pt-4 text-center">
                <p class="text-text-secondary/40 text-[10px] uppercase tracking-[0.2em]">LabLoans System</p>
            </div>
        </footer>
    </div>
</body>
</html>