<?php
namespace App\Http\Controllers;

use App\Models\Bayar;
use App\Models\Pesanan;
use App\Models\ListPesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KasirController extends Controller
{
    // Menampilkan dashboard kasir
    public function index()
    {
         $total_pesanan = Pesanan::count(); // Total semua pesanan

        // Hitung jumlah pesanan yang sudah selesai berdasarkan list_pesanans
        $total_selesai = ListPesanan::where('status', 'selesai')->count();

        // Hitung total pendapatan dari tabel bayar
        $total_pendapatan = Bayar::sum('total_bayar');

        return view('kasir.dashboard', compact('total_pesanan', 'total_selesai', 'total_pendapatan'));
    }
public function pesananIndex()
{
    // Ambil semua pesanan dengan pagination (10 per halaman)
    $pesanans = Pesanan::with('listPesanan')->paginate(10);

    return view('kasir.pesanan.index', compact('pesanans'));
}
public function show($id)
{
    // Ambil pesanan berdasarkan ID dengan relasi listPesanan dan menu
    $pesanan = Pesanan::with('listPesanan.menu')->findOrFail($id);

    return view('kasir.pesanan.show', compact('pesanan'));
}



}
