<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index(): View
    {
        $users = User::orderByDesc('created_at')->get(['id', 'name', 'username', 'role', 'created_at']);

        return view('admin.users', compact('users'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:150'],
            'username' => ['required', 'string', 'max:100', 'unique:users,username'],
            'password' => ['required', 'string', 'min:4'],
            'role' => ['required', 'in:admin,user'],
        ], [
            'name.required' => 'Semua kolom wajib diisi.',
            'username.required' => 'Semua kolom wajib diisi.',
            'username.unique' => 'Username sudah digunakan.',
            'password.required' => 'Semua kolom wajib diisi.',
            'password.min' => 'Password minimal 4 karakter.',
        ]);

        User::create([
            'name' => $data['name'],
            'username' => $data['username'],
            'password' => Hash::make($data['password']),
            'role' => $data['role'],
        ]);

        return redirect()->route('admin.users')->with('success', 'Pengguna baru berhasil ditambahkan.');
    }
}
