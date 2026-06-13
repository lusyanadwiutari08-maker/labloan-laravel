<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;

class AdminReportController extends Controller
{
    public function index()
    {
        // Semua baris dimuat; cari/filter/sort/paginasi/ekspor ditangani DataTables (client-side)
        $loans = Loan::with(['user', 'item'])->latest()->get();

        $totalLoans    = Loan::count();
        $activeLoans   = Loan::where('status', 'active')->count();
        $returnedLoans = Loan::where('status', 'returned')->count();

        $overdueLoans  = Loan::where('status', 'active')
                             ->where('return_date', '<', now())
                             ->count();

        return view('dashboard.laporan_admin.index', compact(
            'loans', 'totalLoans', 'activeLoans', 'returnedLoans', 'overdueLoans'
        ));
    }

    public function markAsReturned($id)
    {
        $loan = Loan::findOrFail($id);

        if ($loan->status === 'active') {
            $loan->update(['status' => 'returned']);

            if ($loan->item) {
                $loan->item->update(['status' => 'available']);
            }

            // --- CATAT LOG AKTIVITAS ---
            ActivityLog::create([
                'user_id' => Auth::id(),
                'action' => 'return_item',
                'description' => 'Admin menyelesaikan peminjaman alat: ' . ($loan->item->name ?? 'Unknown') . ' oleh ' . ($loan->user->name ?? 'Unknown'),
            ]);

            return back()->with('success', 'Peminjaman berhasil diselesaikan. Alat telah tersedia kembali.');
        }

        return back()->with('error', 'Peminjaman ini sudah diselesaikan sebelumnya.');
    }

    public function destroy($id)
    {
        $loan = Loan::findOrFail($id);

        if ($loan->status === 'active' && $loan->item) {
            $loan->item->update(['status' => 'available']);
        }

        $itemName = $loan->item->name ?? 'Alat Dihapus';
        $loan->delete();

        // --- CATAT LOG AKTIVITAS ---
        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'delete_loan',
            'description' => 'Admin menghapus riwayat peminjaman untuk alat: ' . $itemName,
        ]);

        return back()->with('success', 'Riwayat peminjaman berhasil dihapus secara permanen.');
    }
}
