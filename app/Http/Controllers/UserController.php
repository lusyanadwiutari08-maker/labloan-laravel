<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\ActivityLog; // <-- Tambahan
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('id', '!=', Auth::id())
            ->latest()
            ->paginate(10);

        return view('dashboard.users.index', compact('users'));
    }

    public function create()
    {
        return view('dashboard.users.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users',
            'username' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:6',
            'role'     => 'required|in:admin,user',
        ]);

        $validated['password'] = Hash::make($validated['password']);

        $user = User::create($validated);

        // --- CATAT LOG AKTIVITAS ---
        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'add_user',
            'description' => 'Admin menambahkan pengguna baru: ' . $user->name,
        ]);

        return redirect()->route('users.index')->with('success', 'Pengguna berhasil ditambahkan!');
    }

    public function edit(User $user)
    {
        return view('dashboard.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $rules = [
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'role'     => 'required|in:admin,user',
        ];

        if ($request->filled('password')) {
            $rules['password'] = 'string|min:6';
        }

        $validated = $request->validate($rules);

        if ($request->filled('password')) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);

        // --- CATAT LOG AKTIVITAS ---
        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'update_user',
            'description' => 'Admin memperbarui data pengguna: ' . $user->name,
        ]);

        return redirect()->route('users.index')->with('success', 'Data pengguna berhasil diperbarui!');
    }

    public function destroy(User $user)
    {
        if (Auth::id() === $user->id) {
            return redirect()->route('users.index')->with('error', 'Anda tidak dapat menghapus akun Anda sendiri!');
        }

        $userName = $user->name;
        $user->delete();

        // --- CATAT LOG AKTIVITAS ---
        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'delete_user',
            'description' => 'Admin menghapus pengguna: ' . $userName,
        ]);

        return redirect()->route('users.index')->with('success', 'Pengguna berhasil dihapus!');
    }
}