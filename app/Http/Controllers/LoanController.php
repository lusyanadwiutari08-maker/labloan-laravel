<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Loan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoanController extends Controller
{
    /**
     * Menampilkan halaman scanner kamera di dalam dashboard (Khusus User Login)
     */
    public function scanner()
    {
        return view('dashboard.laporan_user.scanner');
    }

    /**
     * Menampilkan halaman form peminjaman setelah QR di-scan
     */
    public function scan($item_code)
    {
        // Cari alat berdasarkan kode dari QR
        $item = Item::where('item_code', $item_code)->firstOrFail();

        // JIKA USER SUDAH LOGIN: Tampilkan form ringkas (tanpa input username/password)
        if (Auth::check()) {
            return view('dashboard.laporan_user.quick_loan_auth', compact('item'));
        }

        // JIKA USER BELUM LOGIN (Publik): Tampilkan form lengkap seperti sebelumnya
        return view('dashboard.peminjaman_user.index', compact('item'));
    }

    /**
     * Memproses Peminjaman (Bisa untuk user login maupun publik)
     */
    public function store(Request $request)
    {
        // 1. Validasi dasar (berlaku untuk semua: login maupun publik)
        $request->validate([
            'item_id'     => 'required|exists:items,id',
            'return_date' => 'required|date|after:now',
        ]);

        // 2. Jika user BELUM login, lakukan validasi form publik dan proses autentikasinya
        if (!Auth::check()) {
            $request->validate([
                'username' => 'required|string',
                'password' => 'required|string',
            ]);

            // Coba login dengan data yang dimasukkan
            if (!Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
                $item = Item::find($request->item_id);
                return view('dashboard.peminjaman_user.error', [
                    'item'         => $item,
                    'message'      => 'Kredensial tidak valid. Pastikan Username dan Password Anda benar atau akun telah terdaftar.',
                    'status_label' => 'Autentikasi Gagal'
                ]);
            }
        }

        // Jika sampai baris ini, berarti user sudah pasti login (baik dari awal maupun baru saja login via form publik)
        $item = Item::findOrFail($request->item_id);

        // 3. Cek Ketersediaan Alat
        if ($item->status !== 'available') {
            // Jika user baru saja login dari form publik, kita logout kembali agar tidak ada sesi yang tertinggal
            if ($request->has('username')) { 
                Auth::logout(); 
            } 
            
            $statusTeks = $item->status === 'maintenance' ? 'Maintenance Mode' : 'Sedang Dipinjam';
            
            return view('dashboard.peminjaman_user.error', [
                'item'         => $item,
                'message'      => 'Maaf, alat ini sedang ' . strtolower($statusTeks) . ' dan tidak dapat dipinjam saat ini.',
                'status_label' => 'Status: ' . $statusTeks
            ]);
        }

        // 4. Catat ke tabel Loans
        $loan = Loan::create([
            'user_id'     => Auth::id(),
            'item_id'     => $item->id,
            'loan_date'   => now(),
            'return_date' => $request->return_date,
            'status'      => 'active',
        ]);

        // 5. Ubah status barang
        $item->update(['status' => 'borrowed']);

        // 6. Tampilkan Halaman Sukses
        return view('dashboard.peminjaman_user.success', [
            'item' => $item,
            'loan' => $loan,
            'user' => Auth::user()
        ]);
    }
}