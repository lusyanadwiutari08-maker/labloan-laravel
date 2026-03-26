<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\ActivityLog; // <-- Tambahan
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required'],
        ]);

        $remember = $request->has('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();

            // --- CATAT LOG AKTIVITAS ---
            ActivityLog::create([
                'user_id' => Auth::id(),
                'action' => 'login',
                'description' => Auth::user()->name . ' berhasil login ke sistem.',
            ]);

            return redirect()->intended('/dashboard')->with('success', 'Selamat datang kembali! Anda berhasil masuk ke sistem.');
        }

        return back()->withErrors(['username' => 'Username atau password salah.'])->onlyInput('username');
    }

    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->username . '@lab.local',
            'password' => Hash::make($request->password),
            'role' => 'user',
        ]);
        
        Auth::login($user);

        // --- CATAT LOG AKTIVITAS ---
        ActivityLog::create([
            'user_id' => $user->id,
            'action' => 'register',
            'description' => $user->name . ' mendaftar akun baru dan otomatis login.',
        ]);

        return redirect('/dashboard')->with('success', 'Pendaftaran berhasil! Akun Anda telah siap digunakan.');
    }

    public function logout(Request $request)
    {
        // --- CATAT LOG AKTIVITAS SEBELUM LOGOUT ---
        $user = Auth::user();
        if ($user) {
            ActivityLog::create([
                'user_id' => $user->id,
                'action' => 'logout',
                'description' => $user->name . ' telah logout dari sistem.',
            ]);
        }

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/login');
    }
}