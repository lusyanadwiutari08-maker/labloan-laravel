<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // --- Bagian Login ---
    public function showLoginForm() {
        return view('auth.login');
    }

    public function login(Request $request) {
        $credentials = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required'],
        ]);

        // Cek apakah user menceklis "Ingat Saya"
        $remember = $request->has('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            
            if (Auth::user()->role === 'admin') {
                return redirect()->intended('admin/dashboard');
            }
            return redirect()->intended('user/dashboard');
        }

        return back()->withErrors(['username' => 'Username atau password salah.'])->onlyInput('username');
    }

    // --- Bagian Register ---
    public function showRegisterForm() {
        return view('auth.register');
    }

    public function register(Request $request) {
        // Validasi data form
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'], // Ini butuh name="password_confirmation" di form
        ]);

        // Simpan ke database dengan role 'user' secara default
        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->username . '@lab.local', // Dummy email sementara jika diperlukan
            'password' => Hash::make($request->password),
            'role' => 'user', 
        ]);

        // Otomatis login setelah register
        Auth::login($user);

        return redirect('/user/dashboard');
    }

    // --- Logout ---
    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}