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
          Schema::create('list_pesanans', function (Blueprint $table) {
            $table->id('id_list_pesanan');
            $table->unsignedBigInteger('menu_id');
            $table->unsignedBigInteger('kode_pesanan');
            $table->integer('jumlah');
            $table->text('catatan')->nullable();
            $table->enum('status', ['pending', 'dimasak', 'selesai'])->default('pending');
            $table->timestamps();

            // $table->foreign('menu')->references('id')->on('menus')->onDelete('cascade');
            $table->foreign('menu_id')->references('id')->on('menus')->onDelete('cascade');

            $table->foreign('kode_pesanan')->references('id_pesanan')->on('pesanans')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('list_pesanans');
    }
};
