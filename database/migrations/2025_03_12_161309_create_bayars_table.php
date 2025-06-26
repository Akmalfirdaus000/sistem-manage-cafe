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
Schema::create('bayar', function (Blueprint $table) {
    $table->id('id_bayar');
    $table->unsignedBigInteger('id_pesanan');
    $table->decimal('total_bayar', 15, 2);
    $table->decimal('nominal_uang', 15, 2);
    $table->timestamp('waktu_bayar')->useCurrent();
    $table->timestamps();

    $table->foreign('id_pesanan')->references('id_pesanan')->on('pesanans')->onDelete('cascade');
});


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bayars');
    }
};
