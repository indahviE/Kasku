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
    Schema::create('kas_keluar', function (Blueprint $table) {
        $table->id();
        $table->string('nama');
        $table->string('kategori');
        $table->bigInteger('jumlah');
        $table->enum('status', ['berhasil', 'diproses', 'gagal'])->default('berhasil');
        $table->date('tanggal');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kas_keluar');
    }
};
