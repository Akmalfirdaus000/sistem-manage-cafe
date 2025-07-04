<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Pesanan;
use App\Models\Kategori;
use App\Models\Reservasi;
use App\Models\ListPesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class LandingController extends Controller
{
    public function index()
    {
        $menus = Menu::latest()->take(6)->get();
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
            'nama_pelanggan' => 'required|string|max:255',
            'no_hp' => 'required|string|max:20',
            'email' => 'required|email',
            'jumlah_orang' => 'required|integer|min:1',
            'meja' => 'required|in:Indoor,Outdoor,Sofa',
            'tanggal_reservasi' => 'required|date',
            'jam_reservasi' => 'required|date_format:H:i',
            'bukti_transfer' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Upload bukti transfer
        $path = $request->file('bukti_transfer')->store('bukti_transfer', 'public');

        // Simpan ke database
        Reservasi::create([
            'nama_pelanggan' => $validated['nama_pelanggan'],
            'no_hp' => $validated['no_hp'],
            'email' => $validated['email'],
            'tanggal_reservasi' => $validated['tanggal_reservasi'],
            'jam_reservasi' => $validated['jam_reservasi'],
            'jumlah_orang' => $validated['jumlah_orang'],
            'meja' => $validated['meja'],
            'status_reservasi' => 'menunggu',
            'status_pembayaran' => 'belum bayar',
            'bukti_transfer' => $path,
        ]);

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
        // Buat pesanan utama
        $pesanan = Pesanan::create([
            'nama_pelanggan' => $request->nama_pelanggan,
            'no_hp' => $request->no_hp,
            'meja' => $request->meja,
            'pelayan' => null,
            'tipe' => 'langsung',
            'waktu_pesanan' => now(),
        ]);

        // Loop menu & buat list pesanan
        foreach ($request->menu_id as $index => $menuId) {
            $jumlah = $request->jumlah[$index];

            $menu = Menu::findOrFail($menuId);

            if ($menu->stok < $jumlah) {
                throw new \Exception("Stok untuk {$menu->nama_menu} tidak mencukupi.");
            }

            // Kurangi stok
            $menu->stok -= $jumlah;
            $menu->save();

            // Simpan ke list_pesanans
            ListPesanan::create([
                'menu_id' => $menuId,
                'kode_pesanan' => $pesanan->id_pesanan,
                'jumlah' => $jumlah,
                'catatan' => $request->catatan[$index] ?? null,
                'status' => 'pending',
            ]);
        }

        DB::commit();
       return redirect()->route('landing.pesan')->with('success', 'Pesanan Anda sedang diproses. Mohon tunggu, makanan sedang disiapkan.');

    } catch (\Exception $e) {
        DB::rollBack();
        return back()->with('error', 'Gagal menyimpan pesanan. ' . $e->getMessage());
    }
}

}
