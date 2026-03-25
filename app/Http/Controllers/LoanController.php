<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Loan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoanController extends Controller
{
    /**
     * Menampilkan halaman scan QR Code secara PUBLIK (Tanpa Login)
     */
    public function scan($item_code)
    {
        // Cari alat berdasarkan kode dari QR
        $item = Item::where('item_code', $item_code)->firstOrFail();

        return view('dashboard.peminjaman_user.index', compact('item'));
    }

    /**
     * Memproses Peminjaman Sekaligus Autentikasi User
     */
    public function store(Request $request)
    {
        // 1. Validasi Input form
        $request->validate([
            'item_id'     => 'required|exists:items,id',
            'username'    => 'required|string',
            'password'    => 'required|string',
            'return_date' => 'required|date|after:now',
        ]);

        $item = Item::findOrFail($request->item_id);

        // 2. Autentikasi User (Jika Gagal -> Tampilkan Halaman Error)
        if (!Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            return view('dashboard.peminjaman_user.error', [
                'item'         => $item,
                'message'      => 'Kredensial tidak valid. Pastikan Username dan Password Anda benar atau akun telah terdaftar.',
                'status_label' => 'Autentikasi Gagal'
            ]);
        }

        // 3. Cek Ketersediaan Alat (Jika Gagal -> Logout & Tampilkan Halaman Error)
        if ($item->status !== 'available') {
            Auth::logout(); // Logout karena peminjaman batal
            $statusTeks = $item->status === 'maintenance' ? 'Maintenance Mode' : 'Sedang Dipinjam';
            
            return view('dashboard.peminjaman_user.error', [
                'item'         => $item,
                'message'      => 'Maaf, alat ini sedang ' . strtolower($statusTeks) . ' dan tidak dapat dipinjam saat ini.',
                'status_label' => 'Status: ' . $statusTeks
            ]);
        }

        // 4. Catat ke tabel Loans (Jika Sukses)
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