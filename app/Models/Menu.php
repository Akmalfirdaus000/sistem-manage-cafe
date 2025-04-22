<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Menu extends Model
{
    use HasFactory;
       protected $table = 'menus';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
        'nama_menu',
        'keterangan',
        'kategori',
        'harga',
        'foto',
    ];


    public function listPesanan()
    {
        return $this->hasMany(ListPesanan::class, 'menu_id', 'id');
    }
    public function kategoriRelasi()
{
    return $this->belongsTo(Kategori::class, 'kategori', 'id_kat_menu');
}

}
