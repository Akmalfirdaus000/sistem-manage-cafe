<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Pesanan;
use App\Models\ListPesanan;
use Illuminate\Http\Request;

class PelayanPesananController extends Controller
{
    public function index()
    {
        $pesanans = Pesanan::with(['listPesanan.menu', 'pelayanUser'])
            ->whereHas('listPesanan')
            ->orderByDesc('waktu_pesanan')
            ->paginate(10);

        return view('pelayan.pesanan.index', compact('pesanans'));
    }

    public function show($id)
    {
        $pesanan = Pesanan::with(['listPesanan.menu', 'pelayanUser'])
            ->findOrFail($id);

        return view('pelayan.pesanan.show', compact('pesanan'));
    }

    public function ubahStatus($id)
    {
        $item = ListPesanan::findOrFail($id);

        // Naikkan status ke tahap selanjutnya
        switch ($item->status) {
            case 'pending':
                $item->status = 'dimasak';
                break;
            case 'dimasak':
                $item->status = 'selesai';
                break;
        }

        $item->save();

        return redirect()->back()->with('success', 'Status pesanan berhasil diperbarui.');
    }
    public function create()
{
    $menus = Menu::where('stok', '>', 0)->get();
    return view('pelayan.pesanan.create', compact('menus'));
}
public function store(Request $request)
{
    $request->validate([
        'nama_pelanggan' => 'required',
        'meja' => 'nullable|string',
        'menu_id.*' => 'required|exists:menus,id',
        'jumlah.*' => 'required|numeric|min:1',
    ]);

    $pesanan = Pesanan::create([
        'nama_pelanggan' => $request->nama_pelanggan,
        'meja' => $request->meja,
        'waktu_pesanan' => now(),
    ]);

    foreach ($request->menu_id as $index => $menu_id) {
        $menu = Menu::find($menu_id);
        $jumlah = $request->jumlah[$index];

        ListPesanan::create([
            'id_pesanan' => $pesanan->id_pesanan,
            'id_menu' => $menu_id,
            'jumlah' => $jumlah,
            'status' => 'pending',
        ]);

        $menu->stok -= $jumlah;
        $menu->save();
    }

    return redirect()->route('pelayan.pesanan.index')->with('success', 'Pesanan berhasil ditambahkan.');
}
public function edit($id)
{
    $pesanan = Pesanan::with('listPesanan.menu')->findOrFail($id);
    $menus = Menu::where('stok', '>', 0)->get();

    return view('pelayan.pesanan.edit', compact('pesanan', 'menus'));
}
public function update(Request $request, $id_pesanan)
{
    $request->validate([
        'nama_pelanggan' => 'required|string|max:100',
        'meja' => 'nullable|string|max:20',
        'menu_id' => 'required|array',
        'jumlah' => 'required|array',
        'catatan' => 'nullable|array',
    ]);

    $pesanan = Pesanan::findOrFail($id_pesanan);
    $pesanan->nama_pelanggan = $request->nama_pelanggan;
    $pesanan->meja = $request->meja;
    $pesanan->save();

    // Hapus semua list sebelumnya dan buat ulang
    $pesanan->listPesanan()->delete();

    foreach ($request->menu_id as $index => $menuId) {
        $jumlah = $request->jumlah[$index];
        $catatan = $request->catatan[$index] ?? null;

        $pesanan->listPesanan()->create([
            'menu_id' => $menuId,
            'jumlah' => $jumlah,
            'catatan' => $catatan,
            'status' => 'pending', // status default
        ]);
    }

    return redirect()->route('pelayan.pesanan.index')->with('success', 'Pesanan berhasil diperbarui.');
}

}
