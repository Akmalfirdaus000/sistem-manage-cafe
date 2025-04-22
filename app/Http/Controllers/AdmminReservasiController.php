<?php

namespace App\Http\Controllers;

use App\Models\ListPesanan;
use Illuminate\Http\Request;

class AdmminReservasiController extends Controller
{
    public function index()
    {
        // Mengambil data dari ListPesanan dengan kondisi status = 'sudah bayar' dan 'selesai', serta memastikan ada pembayaran
        $reservasi = ListPesanan::with(['pesanan.pelayanUser', 'pesanan.pelanggan', 'menu'])
            ->whereIn('status', ['sudah bayar', 'selesai']) // Menggunakan whereIn karena dua status
            ->whereHas('pesanan', function ($query) {
                // Memastikan pesanan memiliki data di tabel 'bayar'
                $query->whereHas('pembayaran'); // Mengecek apakah ada pembayaran di tabel 'bayar'
            })
            // ->get();
            ->orderBy('id_list_pesanan', 'desc') // Data terbaru di atas
            ->paginate(10); // Pagination 10 item per halaman

        return view('admin.reservasi.index', compact('reservasi'));
    }


}
