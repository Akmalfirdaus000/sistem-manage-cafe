<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;

class AdminDataCategoriController extends Controller
{
    // Menampilkan daftar kategori
    public function index()
    {
        $kategoris = Kategori::all();  // Ambil semua kategori
        return view('admin.kategori.index', compact('kategoris'));
    }

    // Menampilkan form untuk membuat kategori baru
    public function create()
    {
        return view('admin.kategori.create');
    }

    // Menyimpan kategori baru
    public function store(Request $request)
    {
        $request->validate([
            'jenis_menu' => 'required|string|max:255',
            'kategori_menu' => 'required|string|max:255',
        ]);

        Kategori::create([
            'jenis_menu' => $request->jenis_menu,
            'kategori_menu' => $request->kategori_menu,
        ]);

        return redirect()->route('admin.kategori.index')->with('success', 'Kategori berhasil ditambahkan');
    }

    // Menampilkan form untuk mengedit kategori
    public function edit(Kategori $kategori)
    {
        return view('admin.kategori.edit', compact('kategori'));
    }

    // Memperbarui kategori yang sudah ada
    public function update(Request $request, Kategori $kategori)
    {
        $request->validate([
            'jenis_menu' => 'required|string|max:255',
            'kategori_menu' => 'required|string|max:255',
        ]);

        $kategori->update([
            'jenis_menu' => $request->jenis_menu,
            'kategori_menu' => $request->kategori_menu,
        ]);

        return redirect()->route('admin.kategori.index')->with('success', 'Kategori berhasil diperbarui');
    }

    // Menghapus kategori
    public function destroy(Kategori $kategori)
    {
        $kategori->delete();

        return redirect()->route('admin.kategori.index')->with('success', 'Kategori berhasil dihapus');
    }
}
