<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Tampilkan halaman utama Dashboard.
     */
    public function index()
    {
        $user = Auth::user();

        // Nanti kita bisa siapkan data yang berbeda berdasarkan Role
        if ($user->role === 'admin') {
            
            // TODO: Tarik data statistik untuk Admin (Total User, Total Peminjaman, dll)
            // Contoh: $totalUsers = \App\Models\User::count();

            return view('index'); // Nanti jadi: return view('index', compact('totalUsers', ...));
            
        } else {
            
            // TODO: Tarik data khusus untuk User biasa (Barang yang sedang dipinjam, Riwayat)
            // Contoh: $myActiveLoans = \App\Models\Loan::where('user_id', $user->id)->get();

            return view('index'); // Nanti jadi: return view('index', compact('myActiveLoans', ...));
        }
    }
}