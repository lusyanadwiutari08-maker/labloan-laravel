<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ActivityLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 
        'action', 
        'description'
    ];

    // --- Relasi ---

    // Log ini dilakukan oleh 1 User (Belongs To)
    // Bisa mengembalikan nilai null jika aktivitas dilakukan oleh sistem (tanpa login)
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}