@extends('layouts.app')

@section('title', 'Scan Alat - LabLoans')

@push('styles')
<style>
    #reader { border: none !important; }
    #reader video { 
        object-fit: cover !important; 
        border-radius: 0.75rem !important; 
        width: 100% !important; 
        height: 100% !important;
    }
</style>
@endpush

@section('content')
<div class="max-w-[800px] mx-auto space-y-6">
    <div class="bg-white dark:bg-[#1F2937] p-6 rounded-xl border border-slate-200 dark:border-border-dark shadow-sm text-center">
        
        <div class="mb-6 flex flex-col items-center">
            <div class="w-16 h-16 bg-primary/10 text-primary rounded-full flex items-center justify-center mb-4">
                <span class="material-symbols-outlined text-3xl">qr_code_scanner</span>
            </div>
            <h2 class="text-2xl font-bold text-slate-800 dark:text-white">Pindai QR Code Alat</h2>
            <p class="text-slate-500 dark:text-slate-400 mt-2 text-sm max-w-md">
                Arahkan kamera ke QR Code yang tertempel pada alat atau unggah gambar QR dari galeri Anda.
            </p>
        </div>

        <div class="max-w-md mx-auto p-2 bg-slate-100 dark:bg-[#111a22] rounded-2xl border border-slate-200 dark:border-slate-800 relative">
            <div id="reader" class="w-full bg-black rounded-xl aspect-square flex items-center justify-center overflow-hidden relative shadow-inner">
                <p id="loading-text" class="text-white text-sm absolute z-0 animate-pulse">Meminta izin kamera...</p>
            </div>
        </div>

        <div id="file-reader" class="hidden"></div>

        <div class="mt-6">
            <label for="qr-upload" class="cursor-pointer inline-flex items-center justify-center gap-2 px-6 py-3 bg-slate-50 dark:bg-[#111827] text-slate-700 dark:text-slate-300 font-semibold rounded-xl border border-slate-200 dark:border-border-dark hover:bg-slate-100 dark:hover:bg-slate-800 transition-all shadow-sm">
                <span class="material-symbols-outlined text-[20px]" id="upload-icon">image</span>
                <span id="upload-text">Unggah Gambar QR</span>
            </label>
            <input type="file" id="qr-upload" class="hidden" accept="image/*">
            
            <p id="upload-error" class="text-red-500 text-sm mt-3 hidden font-medium">
                QR Code tidak terdeteksi pada gambar. Coba gambar lain!
            </p>
        </div>

    </div>
</div>
@endsection

@push('scripts')
<script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        if (window.isScannerInitialized) return;
        window.isScannerInitialized = true;

        // --- 1. KAMERA LANGSUNG ---
        const html5QrCode = new Html5Qrcode("reader");
        
        const onScanSuccess = (decodedText) => {
            // Matikan kamera seketika jika sedang menyala
            try {
                if (html5QrCode.getState() === 2) { // 2 = SCANNING
                    html5QrCode.stop().then(() => { window.location.href = decodedText; });
                    return;
                }
            } catch (e) {} // Abaikan error state
            
            window.location.href = decodedText;
        };

        const config = { fps: 10, qrbox: { width: 250, height: 250 }, aspectRatio: 1.0 };

        html5QrCode.start({ facingMode: "environment" }, config, onScanSuccess)
            .then(() => {
                document.getElementById('loading-text').style.display = 'none';
            })
            .catch((err) => {
                html5QrCode.start({ facingMode: "user" }, config, onScanSuccess)
                    .then(() => { document.getElementById('loading-text').style.display = 'none'; })
                    .catch((err2) => {
                        document.getElementById('loading-text').innerText = "Kamera tidak diizinkan atau tidak ditemukan.";
                        document.getElementById('loading-text').classList.remove('animate-pulse');
                        document.getElementById('loading-text').classList.add('text-red-500');
                    });
            });

        // --- 2. FITUR UPLOAD GAMBAR QR ---
        // Membuat instance terpisah murni untuk file agar tidak mengganggu kamera di atas
        const fileScanner = new Html5Qrcode("file-reader");
        
        const fileInput = document.getElementById('qr-upload');
        const uploadError = document.getElementById('upload-error');
        const uploadText = document.getElementById('upload-text');
        const uploadIcon = document.getElementById('upload-icon');

        fileInput.addEventListener('change', e => {
            if (e.target.files.length == 0) return;
            
            const imageFile = e.target.files[0];
            uploadError.classList.add('hidden'); 
            
            // Ubah tombol jadi status loading
            const originalText = uploadText.innerText;
            uploadText.innerText = "Memproses...";
            uploadIcon.innerText = "hourglass_empty";
            uploadIcon.classList.add("animate-spin");
            
            fileScanner.scanFile(imageFile, false)
                .then(decodedText => {
                    // Sukses! Arahkan ke form peminjaman
                    window.location.href = decodedText;
                })
                .catch(err => {
                    // Gagal mendeteksi QR di gambar tersebut
                    uploadError.classList.remove('hidden');
                    fileInput.value = ''; 
                })
                .finally(() => {
                    // Kembalikan tombol seperti semula
                    uploadText.innerText = originalText;
                    uploadIcon.innerText = "image";
                    uploadIcon.classList.remove("animate-spin");
                });
        });
    });
</script>
@endpush