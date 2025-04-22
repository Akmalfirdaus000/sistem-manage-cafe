<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bayar;
use App\Models\Pesanan;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TransaksiController extends Controller
{
 public function index(Request $request)
{
    $query = Bayar::with(['pesanan.listPesanan'])->orderBy('waktu_bayar', 'desc');

    if ($request->filled('search')) {
        $query->whereHas('pesanan', function ($q) use ($request) {
            $q->where('pelanggan', 'like', '%' . $request->search . '%');
        });
    }

    if ($request->filled('status')) {
        $query->whereHas('pesanan.listPesanan', function ($q) use ($request) {
            $q->where('status', $request->status);
        });
    }

    $transaksi = $query->paginate(10);

    return view('kasir.transaksi.index', compact('transaksi'));
}


    public function show($id)
    {
        $transaksi = Bayar::with(['pesanan.listPesanan.menu'])->findOrFail($id);

        return view('kasir.transaksi.show', compact('transaksi'));
    }
}
