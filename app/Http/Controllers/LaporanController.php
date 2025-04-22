<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bayar;
use Barryvdh\DomPDF\Facade as PDF;
class LaporanController extends Controller
{
    public function index(Request $request)
    {
        // Ambil tanggal awal dan akhir dari filter (default: bulan ini)
        $tanggal_awal = $request->tanggal_awal ?? now()->startOfMonth()->toDateString();
        $tanggal_akhir = $request->tanggal_akhir ?? now()->endOfMonth()->toDateString();

        // Query transaksi berdasarkan rentang tanggal
        $transaksi = Bayar::whereBetween('waktu_bayar', [$tanggal_awal, $tanggal_akhir])
            ->with('pesanan.listPesanan.menu') // Pastikan relasi ke menu
            ->orderBy('waktu_bayar', 'desc')
            ->get();

        // Hitung total subtotal (harga per item * jumlah)
        $totalSubTotal = $transaksi->sum(function ($t) {
            return $t->pesanan->listPesanan->sum(fn($item) => ($item->menu->harga ?? 0) * $item->jumlah);
        });

        // Hitung total penjualan (jumlah total bayar)
        $totalPenjualan = $transaksi->sum('total_bayar');

        // Hitung total pembayaran (jumlah uang yang diterima)
        $totalPembayaran = $transaksi->sum('nominal_uang');

        // Hitung total pendapatan (anggap total penjualan sebagai pendapatan)
        $totalPendapatan = $totalPenjualan;

        // Hitung jumlah transaksi
        $jumlahTransaksi = $transaksi->count();

        // Hitung total item terjual dari semua pesanan
        $totalItemTerjual = $transaksi->sum(function ($t) {
            return $t->pesanan->listPesanan->sum('jumlah') ?? 0;
        });

        return view('kasir.laporan.index', [
            'transaksi' => $transaksi,
            'totalSubTotal' => $totalSubTotal,
            'totalPenjualan' => $totalPenjualan,
            'totalPembayaran' => $totalPembayaran,
            'totalPendapatan' => $totalPendapatan,
            'jumlahTransaksi' => $jumlahTransaksi,
            'totalItemTerjual' => $totalItemTerjual,
        ]);
    }

public function cetakPDF(Request $request)
{
    $tanggal_awal = $request->tanggal_awal ?? now()->startOfMonth()->toDateString();
    $tanggal_akhir = $request->tanggal_akhir ?? now()->endOfMonth()->toDateString();

    // Ambil transaksi dengan relasi
    $transaksi = Bayar::whereBetween('created_at', [$tanggal_awal, $tanggal_akhir])
        ->with('pesanan.listPesanan')
        ->orderBy('created_at', 'desc')
        ->get();

    // Pastikan tidak error jika relasi kosong
    $totalSubTotal = $transaksi->sum(fn($t) => optional(optional($t->pesanan)->listPesanan)->sum('harga') ?? 0);
    $totalPenjualan = $transaksi->sum('total_bayar');
    $totalPembayaran = $transaksi->sum('nominal_uang');
    $totalPendapatan = $totalPenjualan;

    $data = [
        'transaksi' => $transaksi,
        'totalSubTotal' => $totalSubTotal,
        'totalPenjualan' => $totalPenjualan,
        'totalPembayaran' => $totalPembayaran,
        'totalPendapatan' => $totalPendapatan,
    ];

    // Debugging: cek apakah data benar-benar ada
    if ($transaksi->isEmpty()) {
        return response()->json(['message' => 'Tidak ada transaksi pada rentang tanggal ini.'], 404);
    }

    // Jika masih bermasalah, uncomment untuk debug
    // dd($data);

    // Generate PDF
    $pdf = app('dompdf.wrapper')->loadView('kasir.laporan.cetak', $data);

    return $pdf->stream('laporan.pdf'); // Bisa diganti dengan `download('laporan.pdf')`
}

}
