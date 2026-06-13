<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Loan;
use App\Models\User;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Tampilkan halaman utama Dashboard.
     */
    public function index()
    {
        $user = Auth::user();

        // ==========================================
        // 1. DATA UNTUK ADMIN
        // ==========================================
        if ($user->role === 'admin') {
            
            // Tarik data statistik untuk Admin
            $totalUsers       = User::count();
            $activeLoans      = Loan::where('status', 'active')->count();
            $maintenanceItems = Item::where('status', 'maintenance')->count();
            $totalItems       = Item::count();
            
            // Ambil 5 peminjaman terbaru untuk tabel peminjaman admin
            $latestLoans = Loan::with(['user', 'item'])->latest()->take(5)->get();

            // PERBAIKAN: Ambil 5 Log Aktivitas terbaru (Semua aktivitas tanpa filter role)
            $activityLogs = ActivityLog::with('user')
                ->latest()
                ->take(5)
                ->get();

            // Grafik aktivitas peminjaman 7 hari terakhir (data riil)
            $hari = ['Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab'];
            $weekActivity = [];
            $weekMax = 0;
            for ($i = 6; $i >= 0; $i--) {
                $date  = now()->subDays($i);
                $count = Loan::whereDate('loan_date', $date->toDateString())->count();
                $weekMax = max($weekMax, $count);
                $weekActivity[] = [
                    'label'   => $hari[$date->dayOfWeek],
                    'count'   => $count,
                    'isToday' => $i === 0,
                ];
            }

            // Pastikan nama view ('index') sesuai dengan struktur folder kamu
            return view('index', compact(
                'totalUsers',
                'activeLoans',
                'maintenanceItems',
                'totalItems',
                'latestLoans',
                'activityLogs', // Kirim data log ke view
                'weekActivity',
                'weekMax'
            ));
            
        } 
        // ==========================================
        // 2. DATA UNTUK USER BIASA (MAHASISWA)
        // ==========================================
        else {
            
            // Menghitung jumlah barang yang saat ini sedang dipinjam oleh user tersebut
            $activeLoansCount = Loan::where('user_id', $user->id)
                                    ->where('status', 'active')
                                    ->count();
            
            // Menghitung total semua riwayat peminjaman yang pernah dilakukan user tersebut
            $totalHistoryCount = Loan::where('user_id', $user->id)->count();

            // Ambil 5 Log Aktivitas sistem terbaru (User hanya melihat saat ada barang baru ditambahkan)
            $activityLogs = ActivityLog::where('action', 'add_item')
                ->latest()
                ->take(5)
                ->get();

            return view('index', compact(
                'activeLoansCount', 
                'totalHistoryCount',
                'activityLogs' // Kirim data log ke view
            ));
        }
    }
}