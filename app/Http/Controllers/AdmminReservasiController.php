<?php

namespace App\Http\Controllers;

use App\Models\Reservasi;
use App\Models\ListPesanan;
use Illuminate\Http\Request;

class AdmminReservasiController extends Controller
{
    public function index()
    {
        $reservasis = Reservasi::orderByDesc('waktu_reservasi')->paginate(10);
        return view('admin.reservasi.index', compact('reservasis'));
    }

    // Admin menyetujui atau membatalkan reservasi
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:diterima,dibatalkan',
        ]);

        $reservasi = Reservasi::findOrFail($id);
        $reservasi->status = $request->status;
        $reservasi->save();

        return redirect()->route('admin.reservasi.index')->with('success', 'Status reservasi diperbarui.');
    }

}
