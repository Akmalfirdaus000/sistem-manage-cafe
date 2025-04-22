<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BayarController;
use App\Http\Controllers\KasirController;
use App\Http\Controllers\AdminDataPengguna;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\DapurPesananController;
use App\Http\Controllers\AdminDataMenuController;
use App\Http\Controllers\PelayanPesananController;
use App\Http\Controllers\AdminDataCategoriController;

Route::get('/', function () {
    return view('welcome');
});
Route::controller(AuthController::class)->group(function (){
    Route::get('login', 'login')->name('login');
    Route::post('login/action', 'login_action')->name('login.action');

    Route::get('register', 'register')->name('register');
    Route::post('register/action', 'register_action')->name('register.action');

    Route::get('logout', 'logout')->name('logout');
});

//route admin
// Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
//     Route::controller(DashboardController::class)->group(function () {
//         Route::get('dashboard', 'admin_dashboard')->name('admin.dashboard');
//     });
// });
// Route untuk masing-masing role
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    // Dashboard untuk Admin
    Route::get('/dashboard', [DashboardController::class, 'admin_dashboard'])->name('admin.dashboard');

    // Data Pengguna
    Route::get('/data-user', [AdminDataPengguna::class, 'index'])->name('admin.pengguna.index');
    Route::get('/data-user/create', [AdminDataPengguna::class, 'create'])->name('admin.pengguna.add');
    Route::post('/data-user', [AdminDataPengguna::class, 'store'])->name('admin.pengguna.store');
    Route::get('/data-user/{id}/edit', [AdminDataPengguna::class, 'edit'])->name('admin.pengguna.edit');
    Route::put('/data-user/{id}', [AdminDataPengguna::class, 'update'])->name('admin.pengguna.update');
    Route::delete('/data-user/{id}', [AdminDataPengguna::class, 'destroy'])->name('admin.pengguna.destroy');
    Route::get('/data-menu', [AdminDataMenuController::class, 'index'])->name('admin.menu.index');
    Route::post('/data-menu', [AdminDataMenuController::class, 'store'])->name('admin.menu.store');
    Route::delete('/data-menu/{id}', [AdminDataMenuController::class, 'destroy'])->name('admin.menu.destroy');
    Route::put('/menu/{id}', [AdminDataMenuController::class, 'update'])->name('admin.menu.update'); // Update route

    // Route::resource('kategori', AdminDataCategoriController::class);
    Route::get('kategori', [AdminDataCategoriController::class, 'index'])->name('admin.kategori.index');

    // Menampilkan form tambah kategori
    Route::get('kategori/create', [AdminDataCategoriController::class, 'create'])->name('admin.kategori.create');

    // Menyimpan kategori baru
    Route::post('kategori', [AdminDataCategoriController::class, 'store'])->name('admin.kategori.store');

    // Menampilkan form edit kategori
    Route::get('kategori/{kategori}/edit', [AdminDataCategoriController::class, 'edit'])->name('admin.kategori.edit');

    // Memperbarui kategori
    Route::put('kategori/{kategori}', [AdminDataCategoriController::class, 'update'])->name('admin.kategori.update');

    // Menghapus kategori
    Route::delete('kategori/{kategori}', [AdminDataCategoriController::class, 'destroy'])->name('admin.kategori.destroy');
});
// khusus pelayan
Route::middleware(['auth', 'pelayan'])->prefix('pelayan')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'pelayan_dashboard'])->name('pelayan.dashboard');
      Route::controller(PelayanPesananController::class)->group(function () {
        Route::get('pesanan', 'index')->name('pelayan.pesanan.index');
        Route::get('pesanan/create', 'create')->name('pelayan.pesanan.create');
        Route::post('pesanan/store', 'store')->name('pelayan.pesanan.store');
        Route::get('/pesanan/{id}', [PelayanPesananController::class, 'show'])->name('pesanan.show');
Route::get('/pelayan/pesanan/riwayat', [PelayanPesananController::class, 'riwayat'])->name('pelayan.riwayat.index');

    });

});

Route::middleware(['auth', 'kasir'])->prefix('kasir')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'kasir_dashboard'])->name('kasir.dashboard');
     Route::get('/dashboard', [KasirController::class, 'index'])->name('kasir.dashboard');
       Route::get('/pesanan', [KasirController::class, 'pesananIndex'])->name('kasir.pesanan.index');
    Route::get('/kasir/pesanan/{id}', [KasirController::class, 'show'])->name('kasir.pesanan.show');

Route::get('/kasir/pesanan/{id}/bayar', [BayarController::class, 'index'])
     ->name('kasir.pesanan.bayar');

Route::post('/kasir/pesanan/{id}/bayar', [BayarController::class, 'bayar']);
 Route::get('/transaksi', [TransaksiController::class, 'index'])->name('kasir.transaksi.index');
    Route::get('/transaksi/{id}', [TransaksiController::class, 'show'])->name('kasir.transaksi.show');

     Route::get('/kasir/laporan', [LaporanController::class, 'index'])->name('kasir.laporan.index');
     Route::get('/kasir/laporan/cetak', [LaporanController::class, 'cetakPDF'])->name('kasir.laporan.cetak');




    //    Route::get('/pesanan', [KasirController::class, 'pesananIndex'])->name('kasir.pesanan.show');
});

Route::middleware(['auth', 'pemilik'])->prefix('pemilik')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'pemilik_dashboard'])->name('pemilik.dashboard');
});

Route::middleware(['auth', 'dapur'])->prefix('dapur')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'dapur_dashboard'])->name('dapur.dashboard');
     Route::get('/pesanan', [DapurPesananController::class, 'index'])->name('dapur.pesanan.index');
    // Route::get('/pesanan/{id}', [DapurPesananController::class, 'show'])->name('pesanan.show');
    Route::post('/dapur/pesanan/{listPesanan}/status', [DapurPesananController::class, 'updateStatus'])
    ->name('dapur.pesanan.updateStatus');

    Route::get('/riwayat', [DapurPesananController::class, 'riwayat'])->name('dapur.riwayat.index');
});

