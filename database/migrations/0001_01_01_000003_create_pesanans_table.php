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
            $table->string('pelanggan', 200);
            $table->string('meja', 10);
            $table->unsignedBigInteger('pelayan');
            $table->timestamp('waktu_pesanan')->useCurrent();
            $table->timestamps();

            $table->foreign('pelayan')->references('id')->on('users')->onDelete('cascade');
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
