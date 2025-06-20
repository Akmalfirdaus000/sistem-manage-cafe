<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        DB::table('users')->insert([
            [
                'nama' => 'Pemilik Utama',
                'username' => 'pemilik',
                'password' => Hash::make('password'),
                'level' => 'pemilik',
                'no_hp' => '081234567890',
                'alamat' => 'Jl. Utama No.1',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama' => 'Kasir A',
                'username' => 'kasir1',
                'password' => Hash::make('password'),
                'level' => 'kasir',
                'no_hp' => '081111111111',
                'alamat' => 'Jl. Kasir No.2',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama' => 'Pelayan A',
                'username' => 'pelayan1',
                'password' => Hash::make('password'),
                'level' => 'pelayan',
                'no_hp' => '082222222222',
                'alamat' => 'Jl. Pelayan No.3',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama' => 'Staff Dapur',
    'username' => 'dapur1',
    'password' => bcrypt('password'), // Ganti dengan password aman
    'level' => 'dapur',
    'no_hp' => '081345678912',
    'alamat' => 'Area Dapur Restoran',
    'created_at' => now(),
    'updated_at' => now()
            ],
        ]);

        // KATEGORI MENU
        DB::table('kategoris')->insert([
            [
                'jenis_menu' => 'Makanan',
                'kategori_menu' => 'Utama',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'jenis_menu' => 'Minuman',
                'kategori_menu' => 'Dingin',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);

        // MENUS
        DB::table('menus')->insert([
            [
                'foto' => null,
                'nama_menu' => 'Nasi Goreng',
                'keterangan' => 'Nasi goreng dengan ayam dan telur',
                'kategori' => 1,
                'harga' => 20000,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'foto' => null,
                'nama_menu' => 'Es Teh Manis',
                'keterangan' => 'Teh manis dingin',
                'kategori' => 2,
                'harga' => 5000,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);

        // PESANANS
        DB::table('pesanans')->insert([
            [
                'pelanggan' => 'Budi',
                'meja' => 'A1',
                'pelayan' => 3,
                'waktu_pesanan' => Carbon::now(),
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);

        // LIST PESANANS
        DB::table('list_pesanans')->insert([
            [
                'menu_id' => 1,
                'kode_pesanan' => 1,
                'jumlah' => 2,
                'catatan' => 'Pedas',
                'status' => 'pending',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'menu_id' => 2,
                'kode_pesanan' => 1,
                'jumlah' => 2,
                'catatan' => null,
                'status' => 'pending',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);

        // PEMBAYARAN
        DB::table('bayar')->insert([
            [
                'id_pesanan' => 1,
                'nominal_uang' => 50000,
                'total_bayar' => 50000,
                'waktu_bayar' => Carbon::now(),
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }

}
