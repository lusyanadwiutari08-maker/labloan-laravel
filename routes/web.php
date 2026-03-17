<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return redirect('/login');
});

// Route Guest (Belum Login)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    
    // Tambahan Route Register
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

// Route Harus Login
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Route Khusus Admin
    Route::middleware('role:admin')->prefix('admin')->group(function () {
        Route::get('/dashboard', function () {
            return 'Selamat datang di Dashboard Admin Lab!';
        });
        // Nanti route CRUD barang taruh di sini
    });

    // Route Khusus User (Peminjam)
    Route::middleware('role:user')->prefix('user')->group(function () {
        Route::get('/dashboard', function () {
            return 'Selamat datang di Dashboard Peminjam!';
        });
        // Nanti route history peminjaman user taruh di sini
    });
});