<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use App\Models\ListPesanan;
use Illuminate\Http\Request;

class PelayanPesananController extends Controller
{
    public function index()
    {
        $pesanans = Pesanan::with(['listPesanan.menu', 'pelayanUser'])
            ->whereHas('listPesanan')
            ->orderByDesc('waktu_pesanan')
            ->paginate(10);

        return view('pelayan.pesanan.index', compact('pesanans'));
    }

    public function show($id)
    {
        $pesanan = Pesanan::with(['listPesanan.menu', 'pelayanUser'])
            ->findOrFail($id);

        return view('pelayan.pesanan.show', compact('pesanan'));
    }

    public function ubahStatus($id)
    {
        $item = ListPesanan::findOrFail($id);

        // Naikkan status ke tahap selanjutnya
        switch ($item->status) {
            case 'pending':
                $item->status = 'dimasak';
                break;
            case 'dimasak':
                $item->status = 'selesai';
                break;
        }

        $item->save();

        return redirect()->back()->with('success', 'Status pesanan berhasil diperbarui.');
    }
}
