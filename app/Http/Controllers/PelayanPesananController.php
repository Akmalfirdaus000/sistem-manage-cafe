<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesanan;
use App\Models\ListPesanan;
use App\Models\Menu;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PelayanPesananController extends Controller
{
 public function index()
{
    $pesanans = Pesanan::with('listPesanan.menu', 'pelayanUser')
        ->whereHas('listPesanan', function ($query) {
            $query->where('status', '!=', 'selesai');
        })
        ->orderBy('waktu_pesanan', 'desc')
        ->paginate(10); // Pagination

    return view('pelayan.pesanan.index', compact('pesanans'));
}


    public function create()
    {
        $menus = Menu::all();
        return view('pelayan.pesanan.create', compact('menus'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pelanggan' => 'required|string|max:200',
            'meja' => 'nullable|string|max:10', // Meja tidak wajib diisi
            'menus' => 'required|array',
            'menus.*.id' => 'required|exists:menus,id',
            'menus.*.jumlah' => 'required|integer|min:1',
        ]);

        $pesanan = Pesanan::create([
            'pelanggan' => $request->pelanggan,
            'meja' => $request->meja ?? null, // Jika kosong, simpan sebagai null
            'pelayan' => Auth::id(),
        ]);

        foreach ($request->menus as $menu) {
            ListPesanan::create([
                'menu_id' => $menu['id'],
                'kode_pesanan' => $pesanan->id_pesanan,
                'jumlah' => $menu['jumlah'],
                'catatan' => $menu['catatan'] ?? null,
            ]);
        }

        Log::info('Pesanan dibuat', [
            'user_id' => Auth::id(),
            'pelanggan' => $request->pelanggan,
            'meja' => $request->meja,
            'menus' => $request->menus,
        ]);

        return redirect()->route('pelayan.pesanan.index')->with('success', 'Pesanan berhasil dibuat!');
    }
public function show($id)
{
    $pesanan = Pesanan::with(['listPesanan.menu', 'pelayanUser'])->findOrFail($id);

    return view('pelayan.pesanan.show', compact('pesanan'));
}
public function riwayat(Request $request)
{
    $query = Pesanan::with('pelayanUser')
        ->whereHas('listPesanan', function ($q) {
            $q->where('status', 'selesai');
        });

    if ($request->filled('tanggal')) {
        $query->whereDate('waktu_pesanan', $request->tanggal);
    }

    if ($request->filled('status')) {
        $query->where('status', $request->status);
    }

    $pesanans = $query->orderBy('waktu_pesanan', 'desc')->paginate(2);

    return view('pelayan.riwayat.index', compact('pesanans'));
}











}
