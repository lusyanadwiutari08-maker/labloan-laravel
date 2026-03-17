<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\ActivityLog;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username', // Ditambahkan untuk login manual
        'email',
        'password',
        'role',     // Ditambahkan untuk otorisasi admin/user
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // --- Relasi ---

    // 1 User bisa memiliki banyak riwayat peminjaman (One-to-Many)
    public function loans(): HasMany
    {
        return $this->hasMany(Loan::class);
    }

    // 1 User bisa memiliki banyak catatan aktivitas (One-to-Many)
    public function activityLogs(): HasMany
    {
        return $this->hasMany(ActivityLog::class);
    }
}