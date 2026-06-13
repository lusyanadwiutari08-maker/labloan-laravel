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

        // Semua riwayat user dimuat; cari/filter/sort/paginasi ditangani DataTables (client-side)
        $loans = Loan::with('item')
                     ->where('user_id', $user->id)
                     ->latest()
                     ->get();

        // Menghitung total alat yang pernah/sedang dipinjam (distinct per item_id)
        $totalBorrowedItems = Loan::where('user_id', $user->id)
                                  ->distinct('item_id')
                                  ->count('item_id');

        // Pastikan nama folder view di bawah ini sesuai dengan struktur folder kamu
        return view('dashboard.laporan_user.index', compact('loans', 'totalBorrowedItems'));
    }
}