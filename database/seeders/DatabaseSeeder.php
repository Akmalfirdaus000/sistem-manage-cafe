<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // === USER: Admin & Pelayan ===
        DB::table('users')->insert([
            [
                'id' => 1,
                'nama' => 'Admin Cafe',
                'username' => 'admin',
                'password' => Hash::make('123'),
                'level' => 'admin',
                'no_hp' => '081234567890',
                'alamat' => 'Jl. Admin No. 1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'nama' => 'Pelayan Satu',
                'username' => 'pelayan',
                'password' => Hash::make('123'),
                'level' => 'pelayan',
                'no_hp' => '081234567891',
                'alamat' => 'Jl. Pelayan No. 2',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);

        // === KATEGORI MENU ===
        DB::table('kategoris')->insert([
            [
                'id_kat_menu' => 1,
                'jenis_menu' => 'Makanan',
                'kategori_menu' => 'Makanan Berat',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_kat_menu' => 2,
                'jenis_menu' => 'Minuman',
                'kategori_menu' => 'Minuman Dingin',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);

        // === MENU ===
        DB::table('menus')->insert([
            [
                'id' => 1,
                'nama_menu' => 'Nasi Goreng Spesial',
                'foto' => 'nasi_goreng.jpg',
                'keterangan' => 'Dilengkapi dengan telur dan ayam',
                'kategori' => 1,
                'harga' => 20000,
                'stok' => 30,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'nama_menu' => 'Es Teh Manis',
                'foto' => 'es_teh.jpg',
                'keterangan' => 'Dingin dan menyegarkan',
                'kategori' => 2,
                'harga' => 5000,
                'stok' => 50,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);

        // === STOK LOG (otomatis dari menu stok awal) ===
        DB::table('stok_logs')->insert([
            [
                'menu_id' => 1,
                'jenis' => 'masuk',
                'jumlah' => 30,
                'keterangan' => 'Stok awal saat setup',
                'user_id' => 1, // admin
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'menu_id' => 2,
                'jenis' => 'masuk',
                'jumlah' => 50,
                'keterangan' => 'Stok awal saat setup',
                'user_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
