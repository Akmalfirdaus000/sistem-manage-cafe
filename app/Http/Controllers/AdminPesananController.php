<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use App\Models\Bayar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminPesananController extends Controller
{
    // Menampilkan daftar pesanan yang belum dibayar
    public function index()
    {
        // Hanya tampilkan pesanan yang belum ada transaksi pembayarannya
        $pesanans = Pesanan::with('listPesanan.menu')
    ->whereDoesntHave('bayar') // Belum dibayar
    ->orderByDesc('waktu_pesanan')
    ->paginate(10);
        

        return view('admin.pesanan.index', compact('pesanans'));
    }

    // Menyimpan data transaksi pembayaran
    public function storePembayaran(Request $request)
    {
        $request->validate([
            'id_pesanan' => 'required|exists:pesanans,id_pesanan',
            'total_bayar' => 'required|numeric|min:1',
            'nominal_uang' => 'required|numeric|min:' . $request->total_bayar,
        ]);

        DB::beginTransaction();

        try {
            Bayar::create([
                'id_pesanan' => $request->id_pesanan,
                'total_bayar' => $request->total_bayar,
                'nominal_uang' => $request->nominal_uang,
                'waktu_bayar' => now(),
            ]);

            DB::commit();
            return redirect()->route('admin.pesanan.index')->with('success', 'Pembayaran berhasil disimpan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan saat menyimpan pembayaran.');
        }
    }
}
