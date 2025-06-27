<?php

namespace App\Http\Controllers;

use App\Models\Reservasi;
use Illuminate\Http\Request;

class AdmminReservasiController extends Controller
{
    // Menampilkan daftar reservasi untuk admin
    public function index()
    {
        $reservasis = Reservasi::orderByDesc('tanggal_reservasi')->orderByDesc('jam_reservasi')->paginate(10);
        return view('admin.reservasi.index', compact('reservasis'));
    }

    // Admin mengubah status reservasi: diterima / dibatalkan
public function updateStatus(Request $request, $id)
{
    $request->validate([
        'status_reservasi' => 'required|in:diterima,dibatalkan',
    ]);

    $reservasi = Reservasi::findOrFail($id);
    $reservasi->status_reservasi = $request->status_reservasi;

    // Jika diterima, otomatis ubah status pembayaran jadi "sudah bayar"
    if ($request->status_reservasi === 'diterima') {
        $reservasi->status_pembayaran = 'sudah bayar';
    }

    $reservasi->save();

    return redirect()->route('admin.reservasi.index')->with('success', 'Status reservasi & pembayaran berhasil diperbarui.');
}


    // Melihat detail reservasi (jika ingin ditambahkan fitur modal/detail)
    public function show($id)
    {
        $reservasi = Reservasi::findOrFail($id);
        return view('admin.reservasi.show', compact('reservasi'));
    }
}
