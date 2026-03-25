<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminReportController; 
use Illuminate\Support\Facades\Route;

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


// ROUTE PUBLIK QUICK LOAN (SCAN QR)
Route::get('/scan/{item_code}', [LoanController::class, 'scan'])->name('quick-loan.scan');
Route::post('/scan/process', [LoanController::class, 'store'])->name('quick-loan.store');

// Route Harus Login
Route::middleware('auth')->group(function () {
    // Logout menggunakan POST demi keamanan (sesuai form di Blade)
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // SATU ROUTE DASHBOARD UNTUK SEMUA ROLE (Sekarang menggunakan Controller)
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');



    // Route Khusus Admin (Akses Dibatasi Middleware)
    Route::middleware('role:admin')->prefix('admin')->group(function () {
        // CRUD Manajemen User
        Route::resource('users', UserController::class);
        // BARU: CRUD Manajemen Inventaris (Menangani halaman index, create, store, dll)
        Route::resource('items', ItemController::class);
        // --- RUTE MANAJEMEN PEMINJAMAN ---
        Route::get('/loans', [AdminReportController::class, 'index'])->name('admin.loans.index');
        Route::post('/loans/{id}/return', [AdminReportController::class, 'markAsReturned'])->name('admin.loans.return');
        Route::delete('/loans/{id}', [AdminReportController::class, 'destroy'])->name('admin.loans.destroy');
    });

    // Route Khusus User/Peminjam (Akses Dibatasi Middleware)
    Route::middleware('role:user')->prefix('user')->group(function () {
        // Nanti route history peminjaman user taruh di sini
        // Contoh: Route::get('/history', [LoanController::class, 'userHistory']);
    });
});

