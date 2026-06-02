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
    Schema::create('tunggakan', function (Blueprint $table) {
        $table->id();
        // Menghubungkan ke tabel induk 'tagihan' milikmu
        $table->foreignId('tagihan_id')->constrained('tagihan')->onDelete('cascade');
        // Menghubungkan ke tabel users (Siswa)
        $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); 
        // Status pembayaran masing-masing siswa
        $table->enum('status', ['belum_bayar', 'lunas'])->default('belum_bayar');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tunggakan');
    }
};
