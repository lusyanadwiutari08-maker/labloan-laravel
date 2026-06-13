<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_code',
        'name',
        'description',
        'qr_code_path',
        'status'
    ];

    // --- Relasi ---

    // 1 Barang bisa memiliki banyak riwayat dipinjam (One-to-Many)
    public function loans(): HasMany
    {
        return $this->hasMany(Loan::class);
    }
}