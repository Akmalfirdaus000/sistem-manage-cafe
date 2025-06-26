<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kategori extends Model
{
    use HasFactory;
    protected $table = 'kategoris';
    protected $primaryKey = 'id_kat_menu'; // Menggunakan id_kat_menu sebagai primary key
    public $timestamps = true;

    protected $fillable = [
        'jenis_menu',
        'kategori_menu',
    ];
    public function daftarMenu()
    {
        return $this->hasMany(Menu::class, 'kategori', 'id_kat_menu');
    }
}
