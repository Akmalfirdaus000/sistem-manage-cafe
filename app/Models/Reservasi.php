<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservasi extends Model
{
    use HasFactory;

    protected $table = 'reservasis';

    protected $fillable = [
        'nama_pelanggan',
        'no_hp',
        'email',
        'tanggal_reservasi',
        'jam_reservasi',
        'jumlah_orang',
        'meja',
        'status_reservasi',
        'status_pembayaran',
        'bukti_transfer',
    ];

    protected $casts = [
        'tanggal_reservasi' => 'date',
        'jam_reservasi' => 'datetime:H:i',
    ];
}
