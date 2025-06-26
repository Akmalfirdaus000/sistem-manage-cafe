<?php

// app/Models/Bayar.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bayar extends Model
{
    protected $table = 'bayar';
    protected $primaryKey = 'id_bayar';

    protected $fillable = [
        'id_pesanan',
        'total_bayar',
        'nominal_uang',
        'waktu_bayar',
    ];

    public function pesanan()
    {
        return $this->belongsTo(Pesanan::class, 'id_pesanan', 'id_pesanan');
    }
}
