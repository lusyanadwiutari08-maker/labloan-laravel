<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ItemController extends Controller
{
    public function index()
    {
        $items = Item::latest()->paginate(10);
        return view('dashboard.inventaris_admin.index', compact('items'));
    }

    public function create()
    {
        return view('dashboard.inventaris_admin.create');
    }

    public function store(Request $request)
    {
        // 1. Validasi Input
        $validated = $request->validate([
            'item_code'   => 'nullable|string|unique:items,item_code',
            'name'        => 'required|string|max:255',
            'status'      => 'required|in:available,maintenance',
            'description' => 'nullable|string',
        ]);

        if (empty($validated['item_code'])) {
            $validated['item_code'] = 'LAB-' . strtoupper(Str::random(6));
        }

        // 2. Simpan Data ke Database
        $item = Item::create($validated);

        // 3. GENERATE QR CODE
        // Rute ini akan otomatis diarahkan ke LoanController@scan
        // Di mana Controller tersebut sudah punya logika Auth::check()
        $scanUrl = route('quick-loan.scan', ['item_code' => $item->item_code]);
        $fileName = 'qrcodes/' . $item->item_code . '.svg';

        if (!Storage::disk('public')->exists('qrcodes')) {
            Storage::disk('public')->makeDirectory('qrcodes');
        }

        // Generate dan simpan QR Code
        QrCode::size(300)->margin(2)->generate($scanUrl, storage_path('app/public/' . $fileName));

        $item->update([
            'qr_code_path' => $fileName
        ]);

        return redirect()->route('items.index')->with('success', 'Alat berhasil ditambahkan dan QR Code telah dicetak!');
    }

    public function edit(Item $item)
    {
        return view('dashboard.inventaris_admin.edit', compact('item'));
    }

    public function update(Request $request, Item $item)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'status'      => 'required|in:available,maintenance,borrowed',
            'description' => 'nullable|string',
        ]);

        $item->update($validated);

        return redirect()->route('items.index')->with('success', 'Informasi alat berhasil diperbarui!');
    }

    public function destroy(Item $item)
    {
        try {
            // Hapus file QR Code dari storage jika ada
            if ($item->qr_code_path && Storage::disk('public')->exists($item->qr_code_path)) {
                Storage::disk('public')->delete($item->qr_code_path);
            }

            $item->delete();
            return redirect()->route('items.index')->with('success', 'Alat lab berhasil dihapus.');
            
        } catch (\Exception $e) {
            return redirect()->route('items.index')->with('error', 'Gagal menghapus alat.');
        }
    }
}