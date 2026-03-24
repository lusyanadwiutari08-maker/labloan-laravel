<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    /**
     * Tampilkan daftar User
     */
    public function index()
    {
        // Mengambil user di mana role BUKAN admin, diurutkan dari yang terbaru, lalu dipaginasi (10 per halaman)
        $users = User::where('role', '!=', 'admin')->latest()->paginate(10);

        return view('dashboard.users.index', compact('users'));
    }

    /**
     * Tampilkan form tambah User
     */
    public function create()
    {
        return view('dashboard.users.create');
    }

    /**
     * Simpan User baru ke database
     */
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users',
            'username' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:6',
            'role'     => 'required|in:admin,user',
        ]);

        // Hash password sebelum disimpan
        $validated['password'] = Hash::make($validated['password']);

        // Simpan ke database
        User::create($validated);

        return redirect()->route('users.index')->with('success', 'Pengguna berhasil ditambahkan!');
    }

    /**
     * Tampilkan form edit User
     */
    public function edit(User $user)
    {
        return view('dashboard.users.edit', compact('user'));
    }

    /**
     * Update data User di database
     */
    public function update(Request $request, User $user)
    {
        // Validasi input (email dan username mengecualikan ID user yang sedang diedit agar tidak error unique)
        $rules = [
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'role'     => 'required|in:admin,user',
        ];

        // Jika password diisi, berarti admin ingin mengganti password user tersebut
        if ($request->filled('password')) {
            $rules['password'] = 'string|min:6';
        }

        $validated = $request->validate($rules);

        // Hash password jika ada input password baru
        if ($request->filled('password')) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            // Jika kosong, hapus dari array agar password lama tidak tertimpa string kosong
            unset($validated['password']);
        }

        // Update data
        $user->update($validated);

        return redirect()->route('users.index')->with('success', 'Data pengguna berhasil diperbarui!');
    }

    /**
     * Hapus User dari database
     */
    public function destroy(User $user)
    {
        // Lalu ubah if-nya menjadi:
        if (Auth::id() === $user->id) {
            return redirect()->route('users.index')->with('error', 'Anda tidak dapat menghapus akun Anda sendiri!');
        }

        $user->delete();

        return redirect()->route('users.index')->with('success', 'Pengguna berhasil dihapus!');
    }
}
