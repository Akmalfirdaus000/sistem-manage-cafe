<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Kategori;
use Illuminate\Support\Facades\Storage;

class AdminDataMenuController extends Controller
{
    public function index()
    {
        $menus = Menu::with('kategoriRelasi')->get();
        $kategoris = Kategori::all();

        return view('admin.menu.index', compact('menus', 'kategoris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_menu' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
            'kategori' => 'required|exists:kategoris,id_kat_menu',
            'harga' => 'required|integer|min:0',
            'stok' => 'nullable|integer|min:0',
            'foto' => 'nullable|image|max:2048',
        ]);

        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('menu_fotos', 'public');
        }

        Menu::create([
            'nama_menu' => $request->nama_menu,
            'keterangan' => $request->keterangan,
            'kategori' => $request->kategori,
            'harga' => $request->harga,
            'stok' => $request->stok ?? 0,
            'foto' => $fotoPath,
        ]);

        return redirect()->route('admin.menu.index')->with('success', 'Menu berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_menu' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
            'kategori' => 'required|exists:kategoris,id_kat_menu',
            'harga' => 'required|integer|min:0',
            'stok' => 'nullable|integer|min:0',
            'foto' => 'nullable|image|max:2048',
        ]);

        $menu = Menu::findOrFail($id);

        // Jika ada foto baru, hapus lama
        if ($request->hasFile('foto')) {
            if ($menu->foto) {
                Storage::disk('public')->delete($menu->foto);
            }
            $menu->foto = $request->file('foto')->store('menu_fotos', 'public');
        }

        $menu->update([
            'nama_menu' => $request->nama_menu,
            'keterangan' => $request->keterangan,
            'kategori' => $request->kategori,
            'harga' => $request->harga,
            'stok' => $request->stok ?? 0,
            'foto' => $menu->foto, // tetap gunakan yang lama kalau tidak ada upload baru
        ]);

        return redirect()->route('admin.menu.index')->with('success', 'Menu berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $menu = Menu::findOrFail($id);

        if ($menu->foto) {
            Storage::disk('public')->delete($menu->foto);
        }

        $menu->delete();

        return redirect()->route('admin.menu.index')->with('success', 'Menu berhasil dihapus!');
    }
}
