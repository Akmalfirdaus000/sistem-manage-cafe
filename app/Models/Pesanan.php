<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;

    protected $table = 'pesanans';
    protected $primaryKey = 'id_pesanan';
   protected $fillable = [
    'nama_pelanggan', 'no_hp', 'meja', 'pelayan', 'tipe', 'waktu_pesanan',
];

    public function listPesanan()
    {
        return $this->hasMany(ListPesanan::class, 'kode_pesanan', 'id_pesanan');
    }
    public function pelayanUser()
{
    return $this->belongsTo(User::class, 'pelayan', 'id');
}
public function pembayaran()
{
    return $this->hasOne(Bayar::class, 'id_pesanan', 'id_pesanan');
}
public function pelanggan()
{
    return $this->belongsTo(User::class, 'pelanggan', 'id'); // Jika 'pelanggan' adalah ID dari tabel 'users'
}
// app/Models/Pesanan.php

public function bayar()
{
    return $this->hasOne(Bayar::class, 'id_pesanan', 'id_pesanan');
}



public function getStatusAttribute()
{
    $statusList = $this->listPesanan->pluck('status');

    if ($statusList->contains('pending')) {
        return 'Belum Diproses';
    } elseif ($statusList->contains('dimasak')) {
        return 'Sedang Diproses';
    } else {
        return 'Selesai';
    }
}



}
