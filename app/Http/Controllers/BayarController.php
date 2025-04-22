<?php
namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Bayar;
use App\Models\Pesanan;
use App\Models\ListPesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class BayarController extends Controller
{
    public function index($id_pesanan)
    {
        $pesanan = Pesanan::where('id_pesanan', $id_pesanan)->firstOrFail();

        // Pastikan hanya pesanan dengan status "selesai" yang bisa dibayar
        if (strtolower(trim($pesanan->status)) !== 'selesai') {
            return redirect()->route('kasir.pesanan.index')->with('error', 'Pesanan belum selesai!');
        }

        return view('kasir.pesanan.bayar', compact('pesanan'));
    }


public function bayar(Request $request, $id_pesanan)
{
    $request->validate([
        'nominal_uang' => 'required|numeric|min:0',
    ]);

    // Cek apakah pesanan sudah ada
    $pesanan = Pesanan::find($id_pesanan);
    if (!$pesanan) {
        return redirect()->back()->with('error', 'Pesanan tidak ditemukan!');
    }

    // Hitung total harga pesanan
    $totalBayar = ListPesanan::where('kode_pesanan', $id_pesanan)
        ->join('menus', 'list_pesanans.menu_id', '=', 'menus.id')
        ->selectRaw('SUM(list_pesanans.jumlah * menus.harga) as total')
        ->value('total');

    if (!$totalBayar || $totalBayar <= 0) {
        return redirect()->back()->with('error', 'Total pembayaran tidak valid!');
    }

    // Cek apakah sudah pernah dibayar
    $pembayaranSebelumnya = Bayar::where('id_pesanan', $id_pesanan)->exists();
    if ($pembayaranSebelumnya) {
        return redirect()->back()->with('error', 'Pesanan ini sudah dibayar!');
    }

    // Validasi nominal uang harus cukup
    if ($request->nominal_uang < $totalBayar) {
        return redirect()->back()->with('error', 'Nominal uang kurang dari total bayar!');
    }

    DB::transaction(function () use ($request, $id_pesanan, $totalBayar) {
        // Simpan pembayaran
        Bayar::create([
            'id_pesanan' => $id_pesanan,
            'nominal_uang' => $request->nominal_uang,
            'total_bayar' => $totalBayar,
            'waktu_bayar' => now(),
        ]);

        // Update status semua pesanan di list_pesanans menjadi "sudah bayar"
        ListPesanan::where('kode_pesanan', $id_pesanan)->update(['status' => 'sudah bayar']);
    });

    return redirect()->route('kasir.pesanan.index')->with('success', 'Pembayaran berhasil!');
}

}
