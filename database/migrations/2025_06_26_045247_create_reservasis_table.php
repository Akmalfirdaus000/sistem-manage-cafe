<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
Schema::create('reservasis', function (Blueprint $table) {
    $table->id();

    $table->string('nama_pelanggan');
    $table->string('no_hp');
    $table->string('email');

    $table->date('tanggal_reservasi');             // format Y-m-d
    $table->time('jam_reservasi');                 // format H:i:s
    $table->integer('jumlah_orang');

    $table->enum('meja', ['Indoor', 'Outdoor', 'Sofa']); // pilihan

    $table->enum('status_reservasi', ['menunggu', 'diterima', 'dibatalkan'])->default('menunggu');
    $table->enum('status_pembayaran', ['belum bayar', 'sudah bayar'])->default('belum bayar');

    $table->string('bukti_transfer')->nullable();  // path gambar
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservasis');
    }
};
