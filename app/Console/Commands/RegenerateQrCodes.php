<?php

namespace App\Console\Commands;

use App\Models\Item;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class RegenerateQrCodes extends Command
{
    /**
     * Nama & cara pakai perintah.
     * Jalankan dengan:  php artisan qr:regenerate
     */
    protected $signature = 'qr:regenerate';

    /**
     * Penjelasan singkat (muncul di daftar "php artisan list").
     */
    protected $description = 'Buat ulang semua QR code alat memakai APP_URL saat ini (pakai setelah ganti domain ngrok).';

    public function handle(): int
    {
        $baseUrl = config('app.url');
        $this->info("Membuat ulang QR code memakai alamat: {$baseUrl}");

        // Pastikan folder & symlink storage siap.
        if (! Storage::disk('public')->exists('qrcodes')) {
            Storage::disk('public')->makeDirectory('qrcodes');
        }

        $items = Item::all();

        if ($items->isEmpty()) {
            $this->warn('Tidak ada alat di database. Tidak ada yang dibuat.');
            return self::SUCCESS;
        }

        $bar = $this->output->createProgressBar($items->count());
        $bar->start();

        foreach ($items as $item) {
            $scanUrl  = route('quick-loan.scan', ['item_code' => $item->item_code]);
            $fileName = 'qrcodes/' . $item->item_code . '.svg';

            QrCode::size(300)->margin(2)->generate($scanUrl, storage_path('app/public/' . $fileName));

            $item->update(['qr_code_path' => $fileName]);
            $bar->advance();
        }

        $bar->finish();
        $this->newLine(2);
        $this->info("Selesai! {$items->count()} QR code berhasil dibuat ulang.");
        $this->line('Sekarang QR sudah mengarah ke: ' . $baseUrl . '/scan/...');

        return self::SUCCESS;
    }
}
