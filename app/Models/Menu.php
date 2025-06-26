<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $table = 'menus';

    protected $fillable = [
        'nama_menu',
        'keterangan',
        'kategori',
        'harga',
        'stok',
        'foto',
    ];

    /**
     * Relasi ke tabel kategori
     */
    public function kategoriRelasi()
    {
        return $this->belongsTo(Kategori::class, 'kategori', 'id_kat_menu');
    }
      public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori', 'id_kat_menu');
    }
}
