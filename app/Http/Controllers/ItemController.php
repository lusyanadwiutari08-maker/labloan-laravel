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
            'stock'       => 'required|integer|min:1',
            'status'      => 'required|in:available,maintenance',
            'description' => 'nullable|string',
        ]);

        // Jika item_code kosong, generate otomatis di backend
        if (empty($validated['item_code'])) {
            $validated['item_code'] = 'LAB-' . strtoupper(Str::random(6));
        }

        // 2. Simpan Data ke Database terlebih dahulu
        $item = Item::create($validated);

        // 3. GENERATE QR CODE
        // Kita buat URL yang mengarah ke halaman scan alat berdasarkan item_code-nya
        $scanUrl = url('/user/scan/' . $item->item_code);
        
        // Nama file gambar QR Code
        $fileName = 'qrcodes/' . $item->item_code . '.svg';

        // Buat folder qrcodes jika belum ada di dalam public storage
        if (!Storage::disk('public')->exists('qrcodes')) {
            Storage::disk('public')->makeDirectory('qrcodes');
        }

        // Generate QR Code SVG dan simpan ke Storage
        QrCode::size(300)->margin(2)->generate($scanUrl, storage_path('app/public/' . $fileName));

        // Update database untuk menyimpan path lokasi QR Code tersebut
        $item->update([
            'qr_code_path' => $fileName
        ]);

        // Selesai! Redirect dengan pesan sukses (Modal ala SweetAlert-mu akan muncul)
        return redirect()->route('items.index')->with('success', 'Alat berhasil ditambahkan dan QR Code telah dicetak otomatis!');
    }

    // ... (method edit, update, destroy dsb)
}