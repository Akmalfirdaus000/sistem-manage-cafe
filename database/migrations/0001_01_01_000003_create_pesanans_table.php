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
Schema::create('pesanans', function (Blueprint $table) {
    $table->id('id_pesanan');
    $table->string('nama_pelanggan', 200);
    $table->string('no_hp', 15);
    $table->string('meja', 10)->nullable();
    $table->unsignedBigInteger('pelayan')->nullable();
    $table->enum('tipe', ['langsung', 'reservasi'])->default('langsung');
    $table->timestamp('waktu_pesanan')->useCurrent();
    $table->timestamps();

    $table->foreign('pelayan')->references('id')->on('users')->onDelete('set null');
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesanans');
    }
};
