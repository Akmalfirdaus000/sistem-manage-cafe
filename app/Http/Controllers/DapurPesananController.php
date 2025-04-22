<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesanan;
use App\Models\ListPesanan;

class DapurPesananController extends Controller
{
    // Menampilkan daftar pesanan yang belum selesai
    public function index()
    {
        $pesanans = Pesanan::with('listPesanan.menu')
            ->whereHas('listPesanan', function ($query) {
                $query->whereIn('status', ['pending', 'dimasak']);
            })
            ->orderBy('waktu_pesanan', 'asc')
            ->get();

        return view('dapur.pesanan.index', compact('pesanans'));
    }

    // Menampilkan detail pesanan di dapur
    public function show($id)
    {
        $pesanan = Pesanan::with('listPesanan.menu')->findOrFail($id);
        return view('dapur.pesanan.show', compact('pesanan'));
    }

    // Mengupdate status pesanan
 public function updateStatus(Request $request, ListPesanan $listPesanan)
{
    $request->validate([
        'status' => 'required|in:pending,dimasak,selesai'
    ]);

    $listPesanan->update([
        'status' => $request->status
    ]);

    return redirect()->back()->with('success', 'Status pesanan diperbarui!');
}


    // Menampilkan riwayat pesanan yang sudah selesai
  public function riwayat()
{
    $pesanans = Pesanan::with(['listPesanan.menu'])
        ->whereHas('listPesanan', fn($query) => $query->where('status', 'selesai'))
        ->orderByDesc('waktu_pesanan')
        ->get();

    return view('dapur.riwayat.index', compact('pesanans'));
}

}
