<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Pesanan;
use App\Models\ListPesanan;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        'nama_pelanggan' => 'required|string|max:200',
        'no_hp' => 'required|string|max:20',
        'meja' => 'nullable|string|max:20',
        'menu_id.*' => 'required|exists:menus,id',
        'jumlah.*' => 'required|integer|min:1',
        'catatan.*' => 'nullable|string|max:255',
    ]);

    DB::beginTransaction();

    try {
        $kodePesanan = 'KP-' . strtoupper(Str::random(6));

        $pesanan = Pesanan::create([
            'kode_pesanan'   => $kodePesanan,
            'nama_pelanggan' => $request->nama_pelanggan,
            'no_hp'          => $request->no_hp,
            'meja'           => $request->meja,
            'pelayan'        => auth()->user()->name ?? null, // jika pelayan login
            'tipe'           => 'langsung',
            'waktu_pesanan'  => now(),
        ]);

        foreach ($request->menu_id as $index => $menuId) {
            $jumlah = $request->jumlah[$index];
            $catatan = $request->catatan[$index] ?? null;

            $menu = Menu::findOrFail($menuId);

            if ($menu->stok < $jumlah) {
                throw new \Exception("Stok tidak cukup untuk menu: {$menu->nama_menu}");
            }

            $menu->stok -= $jumlah;
            $menu->save();

            ListPesanan::create([
                'menu_id'      => $menuId,
                'kode_pesanan' => $pesanan->id_pesanan,

                'jumlah'       => $jumlah,
                'catatan'      => $catatan,
                'status'       => 'pending',
            ]);
        }

        DB::commit();
        return redirect()->route('pelayan.pesanan.index')->with('success', 'Pesanan berhasil ditambahkan.');
    } catch (\Exception $e) {
        DB::rollBack();
        return back()->with('error', 'Gagal menambah pesanan. ' . $e->getMessage());
    }
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
