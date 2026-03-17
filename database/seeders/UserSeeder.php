<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Membuat Akun Admin
        User::create([
            'name' => 'Administrator Lab',
            'username' => 'adminlab',
            'email' => 'admin@lab.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
        ]);

        // Membuat Akun User (Peminjam)
        User::create([
            'name' => 'Mahasiswa Peminjam',
            'username' => 'mahasiswa01',
            'email' => 'mahasiswa01@kampus.com',
            'password' => Hash::make('password123'),
            'role' => 'user',
        ]);
    }
}