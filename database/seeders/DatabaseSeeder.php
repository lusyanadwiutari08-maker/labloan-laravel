<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Membuat akun Admin & User default (lihat UserSeeder)
        $this->call([
            UserSeeder::class,
        ]);
    }
}
