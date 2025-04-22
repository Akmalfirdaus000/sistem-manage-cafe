<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListPesanan extends Model
{
    use HasFactory;

    protected $table = 'list_pesanans';
    protected $primaryKey = 'id_list_pesanan';
    protected $fillable = ['menu_id', 'kode_pesanan', 'jumlah', 'catatan', 'status'];

    public function pesanan()
    {
        return $this->belongsTo(Pesanan::class, 'kode_pesanan', 'id_pesanan');
    }

//   public function menu()
// {
//     return $this->belongsTo(Menu::class, 'menu', 'id');
// }
public function menu()
{
    return $this->belongsTo(Menu::class, 'menu_id', 'id');
}




}
