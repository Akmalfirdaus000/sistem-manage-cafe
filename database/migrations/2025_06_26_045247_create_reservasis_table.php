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
    $table->integer('jumlah_orang');
    $table->string('meja')->nullable();
    $table->timestamp('waktu_reservasi');
    $table->enum('status', ['menunggu', 'diterima', 'dibatalkan'])->default('menunggu');
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
