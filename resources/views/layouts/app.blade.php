<!DOCTYPE html>
<html class="dark" lang="id">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>@yield('title', 'LabLoans')</title>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap"
        rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('styles')
</head>

<body
    class="bg-background-light dark:bg-background-dark text-slate-900 dark:text-slate-100 font-display min-h-screen flex overflow-hidden">

    @include('partials.sidebar')

    <div class="flex-1 flex flex-col h-screen overflow-hidden relative">
        @include('partials.header')

        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-slate-50 dark:bg-background-dark p-6">
            @yield('content')
        </main>
    </div>

    {{-- Modal sukses global (muncul saat ada session('success')) --}}
    <div id="globalSuccessModal" class="fixed inset-0 z-[100] hidden overflow-y-auto" aria-labelledby="modal-title"
        role="dialog" aria-modal="true">
        <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-md transition-opacity"></div>

        <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
            <div class="relative transform overflow-hidden rounded-2xl bg-white dark:bg-[#1F2937] text-center shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-sm border border-slate-200 dark:border-border-dark scale-95 opacity-0 duration-300 ease-out"
                id="successModalContent">

                <div class="p-8">
                    <div
                        class="mx-auto flex h-20 w-20 items-center justify-center rounded-full bg-green-100 dark:bg-green-500/10 mb-6 shadow-inner ring-4 ring-green-50 dark:ring-green-900/20">
                        <span
                            class="material-symbols-outlined text-5xl text-green-600 dark:text-green-500">check_circle</span>
                    </div>

                    <h3 class="text-2xl font-extrabold text-slate-900 dark:text-white tracking-tight mb-2">Berhasil!</h3>

                    <div class="mt-2">
                        <p class="text-sm leading-relaxed text-slate-500 dark:text-slate-400">
                            {{ session('success') }}
                        </p>
                    </div>
                </div>

                <div
                    class="bg-slate-50 dark:bg-[#111827]/40 px-8 py-5 border-t border-slate-100 dark:border-border-dark/50">
                    <button type="button" onclick="closeSuccessModal()"
                        class="w-full inline-flex justify-center rounded-xl bg-primary px-6 py-3 text-sm font-bold text-white shadow-lg shadow-primary/20 hover:bg-primary-dark hover:-translate-y-0.5 transition-all duration-200">
                        Lanjutkan
                    </button>
                </div>
            </div>
        </div>
    </div>

    @stack('scripts')

    <script>
        function closeSuccessModal() {
            const modal = document.getElementById('globalSuccessModal');
            const content = document.getElementById('successModalContent');

            // Animasi mengecil dan hilang
            content.classList.remove('scale-100', 'opacity-100');
            content.classList.add('scale-95', 'opacity-0');

            setTimeout(() => {
                modal.classList.add('hidden');
                document.body.classList.remove('overflow-hidden');
            }, 200);
        }

        // Cek apakah ada session 'success' dari Laravel
        @if (session('success'))
            document.addEventListener("DOMContentLoaded", function() {
                const modal = document.getElementById('globalSuccessModal');
                const content = document.getElementById('successModalContent');

                // Tampilkan Modal
                modal.classList.remove('hidden');
                document.body.classList.add('overflow-hidden');

                // Trigger Animasi Pop-up
                setTimeout(() => {
                    content.classList.remove('scale-95', 'opacity-0');
                    content.classList.add('scale-100', 'opacity-100');
                }, 10);
            });
        @endif

        // Fungsi untuk membuka dan menutup Sidebar di Mobile
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebar-overlay');

            // Toggle posisi sidebar (masuk/keluar layar)
            sidebar.classList.toggle('-translate-x-full');

            // Jika sidebar tertutup (-translate-x-full ada)
            if (sidebar.classList.contains('-translate-x-full')) {
                overlay.classList.remove('opacity-100');
                overlay.classList.add('opacity-0');
                setTimeout(() => {
                    overlay.classList.add('hidden');
                }, 300); // Sesuaikan dengan durasi animasi
                document.body.classList.remove('overflow-hidden'); // Kembalikan scroll body
            }
            // Jika sidebar terbuka
            else {
                overlay.classList.remove('hidden');
                setTimeout(() => {
                    overlay.classList.remove('opacity-0');
                    overlay.classList.add('opacity-100');
                }, 10);
                document.body.classList.add('overflow-hidden'); // Matikan scroll body agar tidak berantakan
            }
        }
    </script>
</body>

</html>
