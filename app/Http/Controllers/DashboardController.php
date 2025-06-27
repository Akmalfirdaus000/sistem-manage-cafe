<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Reservasi;
use App\Models\ListPesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function admin_dashboard()
{
    return view('admin.dashboard', [
        'jumlahMenu' => \App\Models\Menu::count(),
        'jumlahKategori' => \App\Models\Kategori::count(),
        'jumlahUser' => \App\Models\User::whereIn('level', ['admin', 'pelayan'])->count(),
        'jumlahReservasi' => \App\Models\Reservasi::count(), // nanti buat tabel ini
        'pesananHariIni' => \App\Models\Pesanan::whereDate('created_at', now())->count(),
    ]);
}


public function pelayan_dashboard()
{
    $today = now()->toDateString(); // Format: YYYY-MM-DD

    $jumlahPesananMasuk = ListPesanan::where('status', 'pending')->count();

    $jumlahPesananDiproses = ListPesanan::where('status', 'dimasak')->count();

    $jumlahSelesaiHariIni = ListPesanan::where('status', 'selesai')
        // ->whereDate('created_at', $today)
        ->count();

    $jumlahReservasiHariIni = Reservasi::where('tanggal_reservasi', $today)->count();

    return view('pelayan.dashboard', compact(
        'jumlahPesananMasuk',
        'jumlahPesananDiproses',
        'jumlahSelesaiHariIni',
        'jumlahReservasiHariIni'
    ));
}




}
