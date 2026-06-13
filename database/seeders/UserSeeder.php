<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Membuat Akun Admin (idempoten: aman dijalankan berulang)
        User::updateOrCreate(
            ['username' => 'adminlab'],
            [
                'name' => 'Administrator Lab',
                'email' => 'admin@lab.com',
                'password' => Hash::make('password123'),
                'role' => 'admin',
            ]
        );

        // Membuat Akun User (Peminjam)
        User::updateOrCreate(
            ['username' => 'mahasiswa01'],
            [
                'name' => 'Mahasiswa Peminjam',
                'email' => 'mahasiswa01@kampus.com',
                'password' => Hash::make('password123'),
                'role' => 'user',
            ]
        );
    }
}