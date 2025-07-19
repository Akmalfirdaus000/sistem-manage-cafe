<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Pesanan;

class StrukController extends Controller
{
    public function show($id)
    {
        $pesanan = Pesanan::with(['listPesanan.menu', 'pembayaran'])->findOrFail($id);
        return view('admin.pesanan.struk', compact('pesanan'));
    }
}
