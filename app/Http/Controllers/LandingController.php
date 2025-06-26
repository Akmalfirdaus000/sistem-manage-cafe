<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Pesanan;
use App\Models\Kategori;
use App\Models\Reservasi;
use App\Models\ListPesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LandingController extends Controller
{
public function index()
{
    $menus = Menu::latest()->take(6)->get(); // ambil menu terbaru, bisa disesuaikan jumlahnya

    return view('landing.index', compact('menus'));
}


    public function menu()
{
    $menus = Menu::with('kategori')->get();

    return view('landing.menu', compact('menus'));
}


    public function reservasi()
    {
        return view('landing.reservasi');
    }

    public function reservasiStore(Request $request)
    {
        $validated = $request->validate([
            'nama_pelanggan' => 'required',
            'no_hp' => 'required',
            'jumlah_orang' => 'required|integer|min:1',
            'waktu_reservasi' => 'required|date',
        ]);

        Reservasi::create($validated + ['status' => 'menunggu']);
        return redirect()->route('landing.reservasi')->with('success', 'Reservasi berhasil dikirim.');
    }

    public function kontak()
    {
        return view('landing.kontak');
    }

    public function pesan()
    {
        $menus = Menu::all();
        return view('landing.pesan', compact('menus'));
    }

   public function pesanStore(Request $request)
{
    $request->validate([
        'nama_pelanggan' => 'required|string|max:200',
        'no_hp' => 'required|string|max:15',
        'meja' => 'nullable|string|max:10',
        'menu_id.*' => 'required|exists:menus,id',
        'jumlah.*' => 'required|integer|min:1',
        'catatan.*' => 'nullable|string|max:255',
    ]);

    DB::beginTransaction();

    try {
        // 1. Buat Pesanan
        $pesanan = Pesanan::create([
            'nama_pelanggan' => $request->nama_pelanggan,
            'no_hp' => $request->no_hp,
            'meja' => $request->meja,
            'pelayan' => null, // belum ditugaskan
            'tipe' => 'langsung',
            'waktu_pesanan' => now(),
        ]);

        // 2. Buat List Pesanan
        foreach ($request->menu_id as $index => $menuId) {
            ListPesanan::create([
                'menu_id' => $menuId,
                'kode_pesanan' => $pesanan->id_pesanan,
                'jumlah' => $request->jumlah[$index],
                'catatan' => $request->catatan[$index] ?? null,
                'status' => 'pending',
            ]);
        }

        DB::commit();

        return redirect()->route('landing.index')->with('success', 'Pesanan Anda telah berhasil dikirim!');
    } catch (\Exception $e) {
        DB::rollBack();
        return back()->with('error', 'Gagal menyimpan pesanan. ' . $e->getMessage());
    }
}
}
