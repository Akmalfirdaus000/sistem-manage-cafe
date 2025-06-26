<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminDataPengguna extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.pengguna.index', compact('users'));
    }

    public function create()
    {
        return view('admin.pengguna.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'username' => 'required|string|max:150|unique:users,username',
            'password' => 'required|string|min:2|confirmed',
            'no_hp' => 'required|string|max:15',
            'alamat' => 'required|string|max:255',
            'level' => 'required|string|max:50',
        ]);

        User::create([
            'nama' => $request->nama,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
            'level' => $request->level,
        ]);

        return redirect()->route('admin.pengguna.index')->with('success', 'Pengguna berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.pengguna.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            // 'username' => 'required|string|max:150|unique:users,username,' . $id,
            // 'password' => 'nullable|string|min:2|confirmed',
            'no_hp' => 'required|string|max:15',
            'alamat' => 'required|string|max:255',
            'level' => 'required|string|max:50',
        ]);

        $user = User::findOrFail($id);

        $data = [
            'nama' => $request->nama,
            'username' => $request->username,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
            'level' => $request->level,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('admin.pengguna.index')->with('success', 'Data pengguna berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.pengguna.index')->with('success', 'Pengguna berhasil dihapus!');
    }
}
