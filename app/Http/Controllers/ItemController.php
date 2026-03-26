<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\ActivityLog; // <-- Tambahan
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth; // <-- Tambahan

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
        $validated = $request->validate([
            'item_code'   => 'nullable|string|unique:items,item_code',
            'name'        => 'required|string|max:255',
            'status'      => 'required|in:available,maintenance',
            'description' => 'nullable|string',
        ]);

        if (empty($validated['item_code'])) {
            $validated['item_code'] = 'LAB-' . strtoupper(Str::random(6));
        }

        $item = Item::create($validated);

        // --- CATAT LOG AKTIVITAS ---
        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'add_item',
            'description' => 'Admin menambahkan alat baru: ' . $item->name,
        ]);

        $scanUrl = route('quick-loan.scan', ['item_code' => $item->item_code]);
        $fileName = 'qrcodes/' . $item->item_code . '.svg';

        if (!Storage::disk('public')->exists('qrcodes')) {
            Storage::disk('public')->makeDirectory('qrcodes');
        }

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

        // --- CATAT LOG AKTIVITAS ---
        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'update_item',
            'description' => 'Admin memperbarui data alat: ' . $item->name,
        ]);

        return redirect()->route('items.index')->with('success', 'Informasi alat berhasil diperbarui!');
    }

    public function destroy(Item $item)
    {
        try {
            if ($item->qr_code_path && Storage::disk('public')->exists($item->qr_code_path)) {
                Storage::disk('public')->delete($item->qr_code_path);
            }

            $itemName = $item->name;
            $item->delete();

            // --- CATAT LOG AKTIVITAS ---
            ActivityLog::create([
                'user_id' => Auth::id(),
                'action' => 'delete_item',
                'description' => 'Admin menghapus alat: ' . $itemName,
            ]);

            return redirect()->route('items.index')->with('success', 'Alat lab berhasil dihapus.');
            
        } catch (\Exception $e) {
            return redirect()->route('items.index')->with('error', 'Gagal menghapus alat.');
        }
    }
}