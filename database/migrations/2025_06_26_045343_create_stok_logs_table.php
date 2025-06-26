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
      Schema::create('stok_logs', function (Blueprint $table) {
    $table->id();
    $table->unsignedBigInteger('menu_id');
    $table->enum('jenis', ['masuk', 'keluar']);
    $table->integer('jumlah');
    $table->string('keterangan')->nullable();
    $table->unsignedBigInteger('user_id'); // hanya admin yang bisa input stok
    $table->timestamps();

    $table->foreign('menu_id')->references('id')->on('menus')->onDelete('cascade');
    $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stok_logs');
    }
};
