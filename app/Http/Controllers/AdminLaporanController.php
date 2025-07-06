<?php

namespace App\Http\Controllers;

use App\Models\Bayar;
use Illuminate\Http\Request;

class AdminLaporanController extends Controller
{
//     public function index(Request $request)
// {
//     $start = $request->start ?? now()->startOfMonth()->toDateString();
//     $end = $request->end ?? now()->endOfMonth()->toDateString();

//    $transaksi = Bayar::with('pesanan')
//     ->whereBetween('waktu_bayar', [$start, $end])
//     ->orderBy('waktu_bayar', 'desc')
//     ->paginate(10); // ← tambahkan paginate di sini


//     $totalPendapatan = $transaksi->sum('total_bayar');

//    return view('admin.laporan.index', [
//     'laporan' => $transaksi,
//     'totalPendapatan' => $totalPendapatan,
//     'start' => $start,
//     'end' => $end,
// ]);

// }
public function index(Request $request)
{
    $start = $request->start ?? now()->startOfMonth()->toDateString();
    $end = $request->end ?? now()->endOfMonth()->toDateString();

    // Ambil semua data sesuai filter untuk total
    $totalPendapatan = Bayar::whereBetween('waktu_bayar', [$start, $end])
        ->sum('total_bayar');

    // Ambil data transaksi untuk ditampilkan (dengan paginate)
    $transaksi = Bayar::with('pesanan')
        ->whereBetween('waktu_bayar', [$start, $end])
        ->orderBy('waktu_bayar', 'desc')
        ->paginate(10);

    return view('admin.laporan.index', [
        'laporan' => $transaksi,
        'totalPendapatan' => $totalPendapatan,
        'start' => $start,
        'end' => $end,
    ]);
}


}
