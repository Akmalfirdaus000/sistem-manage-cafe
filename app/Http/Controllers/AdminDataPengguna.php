<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminDataPengguna extends Controller
{
    public function index()
    {
        $users = User::all(); // Atau query lainnya sesuai kebutuhan
        return view('admin.pengguna.index', compact('users'));
    }
      // Menampilkan form untuk menambah pengguna
      public function create()
      {
          return view('admin.pengguna.add');
      }

      // Menyimpan pengguna baru
      public function store(Request $request)
      {
          // Validasi data yang diterima dari form
          $request->validate([
              'nama' => 'required|string|max:255',
              'no_hp' => 'required|string|max:15',
              'alamat' => 'required|string|max:255',
              'level' => 'required|string|max:50',
          ]);

          // Menyimpan data pengguna baru
          User::create([
              'nama' => $request->nama,
              'no_hp' => $request->no_hp,
              'alamat' => $request->alamat,
              'level' => $request->level,
          ]);

          // Mengalihkan kembali dengan pesan sukses
          return redirect()->route('admin.pengguna.index')->with('success', 'Pengguna berhasil ditambahkan!');
      }

      // Menampilkan form untuk mengedit pengguna
      public function edit($id)
      {
          // Mengambil data pengguna berdasarkan ID
          $user = User::findOrFail($id);

          // Mengembalikan view edit dengan data pengguna
          return view('admin.pengguna.edit', compact('user'));
      }

      // Memperbarui data pengguna
      public function update(Request $request, $id)
      {
          // Validasi data yang diterima dari form
          $request->validate([
              'nama' => 'required|string|max:255',
              'no_hp' => 'required|string|max:15',
              'alamat' => 'required|string|max:255',
              'level' => 'required|string|max:50',
          ]);

          // Mencari data pengguna berdasarkan ID
          $user = User::findOrFail($id);

          // Memperbarui data pengguna
          $user->update([
              'nama' => $request->nama,
              'no_hp' => $request->no_hp,
              'alamat' => $request->alamat,
              'level' => $request->level,
          ]);

          // Mengalihkan kembali dengan pesan sukses
          return redirect()->route('admin.pengguna.index')->with('success', 'Data pengguna berhasil diperbarui!');
      }

      // Menghapus data pengguna
      public function destroy($id)
      {
          // Mencari dan menghapus pengguna berdasarkan ID
          $user = User::findOrFail($id);
          $user->delete();

          // Mengalihkan kembali dengan pesan sukses
          return redirect()->route('admin.pengguna.index')->with('success', 'Pengguna berhasil dihapus!');
      }
}
