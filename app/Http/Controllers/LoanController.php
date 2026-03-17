<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Loan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 
        'item_id', 
        'loan_date', 
        'return_date', 
        'status'
    ];

    // Mengubah format kolom tanggal menjadi object Carbon agar mudah dimanipulasi
    protected $casts = [
        'loan_date' => 'datetime',
        'return_date' => 'datetime',
    ];

    // --- Relasi ---

    // Peminjaman ini milik 1 User (Belongs To)
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Peminjaman ini untuk 1 Barang tertentu (Belongs To)
    public function item(): BelongsTo
    {
        return $this->belongsTo(Item::class);
    }
}