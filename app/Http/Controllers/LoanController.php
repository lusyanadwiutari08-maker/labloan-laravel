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
        $items = Item::orderByRaw("FIELD(status, 'available') DESC")
                     ->latest()
                     ->paginate(12);

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
        $request->validate([
            'item_id'     => 'required|exists:items,id',
            'return_date' => 'required|date|after:now',
        ]);

        if (!Auth::check()) {
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

        $loan = Loan::create([
            'user_id'     => Auth::id(),
            'item_id'     => $item->id,
            'loan_date'   => now(),
            'return_date' => $request->return_date,
            'status'      => 'active',
        ]);

        $item->update(['status' => 'borrowed']);

        // --- CATAT LOG AKTIVITAS ---
        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'borrow',
            'description' => Auth::user()->name . ' meminjam alat: ' . $item->name,
        ]);

        return view('dashboard.peminjaman_user.success', [
            'item' => $item,
            'loan' => $loan,
            'user' => Auth::user()
        ]);
    }
}