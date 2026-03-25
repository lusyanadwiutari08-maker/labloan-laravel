<?php

namespace App\Http\Controllers;

use App\Models\Loan;


class AdminReportController extends Controller
{
    public function index()
    {
        // Ambil data peminjaman beserta relasi user dan item
        $loans = Loan::with(['user', 'item'])->latest()->paginate(10);
        
        // Hitung statistik untuk cards
        $totalLoans    = Loan::count();
        $activeLoans   = Loan::where('status', 'active')->count();
        $returnedLoans = Loan::where('status', 'returned')->count();
        
        // Hitung yang terlambat (active dan tanggal kembali < hari ini)
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
        
        // Pastikan statusnya masih active
        if ($loan->status === 'active') {
            // Ubah status loan menjadi returned
            $loan->update(['status' => 'returned']);
            
            // Kembalikan status barang menjadi available
            if ($loan->item) {
                $loan->item->update(['status' => 'available']);
            }
            
            return back()->with('success', 'Peminjaman berhasil diselesaikan. Alat telah tersedia kembali.');
        }

        return back()->with('error', 'Peminjaman ini sudah diselesaikan sebelumnya.');
    }

    public function destroy($id)
    {
        $loan = Loan::findOrFail($id);
        
        // (Opsional) Jika barang sedang dipinjam (active), kita kembalikan statusnya jadi available dulu sebelum log-nya dihapus
        if ($loan->status === 'active' && $loan->item) {
            $loan->item->update(['status' => 'available']);
        }

        // Hapus riwayat dari database
        $loan->delete();

        return back()->with('success', 'Riwayat peminjaman berhasil dihapus secara permanen.');
    }
}