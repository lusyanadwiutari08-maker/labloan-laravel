<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserHistoryController extends Controller
{
    /**
     * Menampilkan halaman riwayat peminjaman khusus untuk user yang sedang login.
     */
    public function index(Request $request)
    {
        $user = Auth::user();

        // Query dasar: Ambil peminjaman milik user ini beserta relasi data alatnya
        $query = Loan::with('item')->where('user_id', $user->id);

        // FITUR FILTER STATUS (Merespon dropdown dari view)
        if ($request->has('status') && $request->status !== 'Semua Status') {
            if ($request->status === 'Selesai') {
                $query->where('status', 'returned');
            } elseif ($request->status === 'Terlambat') {
                // Status active tapi waktu saat ini sudah melewati batas kembali
                $query->where('status', 'active')->where('return_date', '<', now());
            } elseif ($request->status === 'Sedang Dipinjam') {
                // Status active dan waktu saat ini belum melewati batas kembali
                $query->where('status', 'active')->where('return_date', '>=', now());
            }
        }

        // Tampilkan 10 data per halaman, urutkan dari yang terbaru
        $loans = $query->latest()->paginate(10);

        // Menghitung total alat yang pernah/sedang dipinjam (distinct per item_id)
        $totalBorrowedItems = Loan::where('user_id', $user->id)
                                  ->distinct('item_id')
                                  ->count('item_id');

        // Pastikan nama folder view di bawah ini sesuai dengan struktur folder kamu
        return view('dashboard.laporan_user.index', compact('loans', 'totalBorrowedItems'));
    }
}