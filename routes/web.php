<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminDataPengguna;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminLaporanController;
use App\Http\Controllers\AdminPesananController;
use App\Http\Controllers\AdminDataMenuController;
use App\Http\Controllers\AdminTransaksiController;
use App\Http\Controllers\PelayanPesananController;
use App\Http\Controllers\AdmminReservasiController;
use App\Http\Controllers\AdminDataCategoriController;


Route::get('/', [LandingController::class, 'index'])->name('landing.index');
Route::get('/menu', [LandingController::class, 'menu'])->name('landing.menu');
Route::get('/reservasi', [LandingController::class, 'reservasi'])->name('landing.reservasi');
Route::post('/reservasi', [LandingController::class, 'reservasiStore'])->name('landing.reservasi.store');
Route::get('/kontak', [LandingController::class, 'kontak'])->name('landing.kontak');
Route::get('/pesan', [LandingController::class, 'pesan'])->name('landing.pesan');
Route::post('/pesan', [LandingController::class, 'pesanStore'])->name('landing.pesan.store');


// === AUTH ===
Route::controller(AuthController::class)->group(function () {
    Route::get('login', 'login')->name('login');
    Route::post('login/action', 'login_action')->name('login.action');
    Route::get('logout', 'logout')->name('logout');
});

// === ADMIN ===
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'admin_dashboard'])->name('admin.dashboard');

    // Data pengguna
    Route::resource('data-user', AdminDataPengguna::class)->names('admin.pengguna');
Route::prefix('admin')->middleware('auth', 'admin')->group(function () {
    Route::get('/pesanan', [AdminPesananController::class, 'index'])->name('admin.pesanan.index');
    Route::post('/pesanan/bayar', [AdminPesananController::class, 'storePembayaran'])->name('admin.pesanan.bayar.store');
});

    // Menu
    Route::get('/data-menu', [AdminDataMenuController::class, 'index'])->name('admin.menu.index');
    Route::post('/data-menu', [AdminDataMenuController::class, 'store'])->name('admin.menu.store');
    Route::delete('/data-menu/{id}', [AdminDataMenuController::class, 'destroy'])->name('admin.menu.destroy');
    Route::put('/menu/{id}', [AdminDataMenuController::class, 'update'])->name('admin.menu.update');

    // Kategori
    Route::resource('kategori', AdminDataCategoriController::class)->names('admin.kategori');

    // Reservasi & Transaksi
    Route::get('/reservasi', [AdmminReservasiController::class, 'index'])->name('admin.reservasi.index');
    Route::get('/transaksi', [AdminTransaksiController::class, 'index'])->name('admin.transaksi.index');
      Route::get('/reservasi', [AdmminReservasiController::class, 'index'])->name('admin.reservasi.index');
    Route::put('/reservasi/{id}/status', [AdmminReservasiController::class, 'updateStatus'])->name('admin.reservasi.updateStatus');
    Route::get('/laporan-penjualan', [AdminLaporanController::class, 'index'])->name('admin.laporan.index');

});

// === PELAYAN ===
Route::middleware(['auth', 'pelayan'])->prefix('pelayan')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'pelayan_dashboard'])->name('pelayan.dashboard');
 Route::get('/pesanan/create', [PelayanPesananController::class, 'create'])->name('pelayan.pesanan.create');
    Route::post('/pesanan', [PelayanPesananController::class, 'store'])->name('pelayan.pesanan.store');
    Route::get('/pesanan/{id}/edit', [PelayanPesananController::class, 'edit'])->name('pelayan.pesanan.edit');
    Route::put('/pesanan/{id}', [PelayanPesananController::class, 'update'])->name('pelayan.pesanan.update');
    Route::controller(PelayanPesananController::class)->group(function () {
 Route::get('/pesanan', [PelayanPesananController::class, 'index'])->name('pelayan.pesanan.index');
    Route::get('/pesanan/{id}', [PelayanPesananController::class, 'show'])->name('pelayan.pesanan.show');
    Route::put('/pesanan/ubah-status/{id}', [PelayanPesananController::class, 'ubahStatus'])->name('pelayan.pesanan.ubahStatus');
        Route::get('/riwayat', 'riwayat')->name('pelayan.riwayat.index');
    });

});


