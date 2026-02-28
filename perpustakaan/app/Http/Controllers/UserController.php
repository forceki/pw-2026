<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->paginate(10);

        return view('admin.user.index', compact('users'));
    }

    public function create()
    {
        return view('admin.user.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'nim'      => 'required|string|unique:users,nim',
            'role'     => 'required|in:admin,siswa',
            'password' => 'required|string|min:6',
        ]);

        User::create([
            'name'     => $validated['name'],
            'email'    => $validated['email'],
            'nim'      => $validated['nim'],
            'role'     => $validated['role'],
            'password' => bcrypt($validated['password']),
        ]);

        return redirect()->route('admin.user.index')
                         ->with('success', 'User berhasil ditambahkan.');
    }

    public function edit(User $user)
    {
        return view('admin.user.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email,' . $user->id,
            'nim'      => 'required|string|unique:users,nim,' . $user->id,
            'role'     => 'required|in:admin,siswa',
            'password' => 'nullable|string|min:6',
        ]);

        $data = [
            'name'  => $validated['name'],
            'email' => $validated['email'],
            'nim'   => $validated['nim'],
            'role'  => $validated['role'],
        ];

        if (!empty($validated['password'])) {
            $data['password'] = bcrypt($validated['password']);
        }

        $user->update($data);

        return redirect()->route('admin.user.index')
                         ->with('success', 'Data user berhasil diperbarui.');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('admin.user.index')
                         ->with('success', 'User berhasil dihapus.');
    }
}
