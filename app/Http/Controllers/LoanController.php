<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Loan;
use App\Models\ActivityLog; // <-- Tambahan
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoanController extends Controller
{
    public function scanner()
    {
        return view('dashboard.laporan_user.scanner');
    }

    public function borrowList(Request $request)
    {
        $query = Item::query();

        // Pencarian berdasarkan nama atau kode alat
        if ($search = trim((string) $request->input('search'))) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('item_code', 'like', "%{$search}%");
            });
        }

        $items = $query->orderByRaw("FIELD(status, 'available') DESC")
                       ->latest()
                       ->paginate(12)
                       ->withQueryString();

        return view('dashboard.peminjaman_user.borrow_list', compact('items'));
    }

    public function scan($item_code)
    {
        $item = Item::where('item_code', $item_code)->firstOrFail();

        if (Auth::check()) {
            return view('dashboard.laporan_user.quick_loan_auth', compact('item'));
        }

        return view('dashboard.peminjaman_user.index', compact('item'));
    }

    public function store(Request $request)
    {
        // Tandai apakah peminjaman ini berasal dari tamu (scan QR publik tanpa login)
        $wasGuest = !Auth::check();

        $request->validate([
            'item_id'     => 'required|exists:items,id',
            'return_date' => 'required|date|after:now',
        ]);

        if ($wasGuest) {
            $request->validate([
                'username' => 'required|string',
                'password' => 'required|string',
            ]);

            if (!Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
                $item = Item::find($request->item_id);
                return view('dashboard.peminjaman_user.error', [
                    'item'         => $item,
                    'message'      => 'Kredensial tidak valid. Pastikan Username dan Password Anda benar atau akun telah terdaftar.',
                    'status_label' => 'Autentikasi Gagal'
                ]);
            }
        }

        $item = Item::findOrFail($request->item_id);

        if ($item->status !== 'available') {
            // Tamu yang sempat login untuk verifikasi tidak boleh meninggalkan sesi aktif
            if ($wasGuest) {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
            }

            $statusTeks = $item->status === 'maintenance' ? 'Maintenance Mode' : 'Sedang Dipinjam';

            return view('dashboard.peminjaman_user.error', [
                'item'         => $item,
                'message'      => 'Maaf, alat ini sedang ' . strtolower($statusTeks) . ' dan tidak dapat dipinjam saat ini.',
                'status_label' => 'Status: ' . $statusTeks
            ]);
        }

        $borrower = Auth::user();

        $loan = Loan::create([
            'user_id'     => $borrower->id,
            'item_id'     => $item->id,
            'loan_date'   => now(),
            'return_date' => $request->return_date,
            'status'      => 'active',
        ]);

        $item->update(['status' => 'borrowed']);

        // --- CATAT LOG AKTIVITAS ---
        ActivityLog::create([
            'user_id' => $borrower->id,
            'action' => 'borrow',
            'description' => $borrower->name . ' meminjam alat: ' . $item->name,
        ]);

        // Untuk peminjaman tamu (scan publik), akhiri sesi agar tidak tertinggal di perangkat bersama
        if ($wasGuest) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
        }

        return view('dashboard.peminjaman_user.success', [
            'item'     => $item,
            'loan'     => $loan,
            'user'     => $borrower,
            'wasGuest' => $wasGuest,
        ]);
    }
}