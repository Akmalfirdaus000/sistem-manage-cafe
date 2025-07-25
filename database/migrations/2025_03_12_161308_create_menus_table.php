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
Schema::create('menus', function (Blueprint $table) {
    $table->id();
    $table->string('foto')->nullable(); // Menyimpan nama file / path gambar
    $table->string('nama_menu');
    $table->text('keterangan')->nullable();
    $table->unsignedBigInteger('kategori');
    $table->integer('harga');
    $table->integer('stok')->default(0);
    $table->timestamps();

    $table->foreign('kategori')->references('id_kat_menu')->on('kategoris')->onDelete('cascade');
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};
