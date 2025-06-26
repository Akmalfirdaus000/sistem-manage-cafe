<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservasi extends Model
{
    protected $fillable = [
        'nama_pelanggan',
        'no_hp',
        'jumlah_orang',
        'meja',
        'waktu_reservasi',
        'status',
    ];

    protected $casts = [
        'waktu_reservasi' => 'datetime',
    ];
}
