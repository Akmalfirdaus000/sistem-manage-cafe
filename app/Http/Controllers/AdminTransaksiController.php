<?php

namespace App\Http\Controllers;

use App\Models\Bayar;
use Illuminate\Http\Request;

class AdminTransaksiController extends Controller
{
    public function index()
    {
        $transaksi = Bayar::with('pesanan')->latest()->paginate(10);

        return view('admin.transaksi.index', compact('transaksi'));
    }
}
