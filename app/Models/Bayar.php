<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bayar extends Model
{
    use HasFactory;

    protected $table = 'bayar'; // Nama tabel

    protected $primaryKey = 'id_bayar'; // Primary Key

    protected $fillable = [
        'id_pesanan', 
        'nominal_uang', 
        'total_bayar', 
        'waktu_bayar'
    ];

    public function pesanan()
    {
        return $this->belongsTo(Pesanan::class, 'id_pesanan');
    }
}

