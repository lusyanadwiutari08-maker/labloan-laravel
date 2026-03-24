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
    // Logout menggunakan POST demi keamanan (sesuai form di Blade)
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // SATU ROUTE DASHBOARD UNTUK SEMUA ROLE
    Route::get('/dashboard', function () {
        return view('index');
    })->name('dashboard');

    // Route Khusus Admin (Akses Dibatasi Middleware)
    Route::middleware('role:admin')->prefix('admin')->group(function () {
        // Nanti route CRUD barang taruh di sini
        // Contoh: Route::resource('items', ItemController::class);
    });

    // Route Khusus User/Peminjam (Akses Dibatasi Middleware)
    Route::middleware('role:user')->prefix('user')->group(function () {
        // Nanti route history peminjaman user taruh di sini
        // Contoh: Route::get('/history', [LoanController::class, 'userHistory']);
    });
});