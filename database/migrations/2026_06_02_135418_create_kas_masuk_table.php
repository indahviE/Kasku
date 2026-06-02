<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
{
    Schema::create('kas_masuk', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
        $table->string('kategori');
        $table->bigInteger('jumlah');
        $table->enum('status', ['berhasil', 'diproses', 'gagal'])->default('berhasil');
        $table->date('tanggal');
        $table->timestamps();
    });
}

    public function down(): void
    {
        Schema::dropIfExists('kas_masuk');
    }
};