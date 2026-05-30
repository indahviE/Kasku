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
        Schema::create('transaksi', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kelas_id');
            $table->unsignedBigInteger('user_id');
            $table->enum('tipe_transaksi', ['masuk', 'keluar'])->default('masuk');
            $table->string('kategori'); // spp, seragam, buku, kegiatan, dll
            $table->decimal('nominal', 12, 2);
            $table->date('tanggal');
            $table->text('keterangan')->nullable();
            $table->string('bukti_file')->nullable(); // untuk menyimpan file bukti
            $table->enum('status', ['approved', 'pending', 'rejected'])->default('pending');
            $table->unsignedBigInteger('disetujui_oleh')->nullable();
            $table->text('catatan_admin')->nullable();
            $table->timestamps();

            $table->foreign('kelas_id')->references('id')->on('kelas')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('disetujui_oleh')->references('id')->on('users')->onDelete('set null');

            // Indexes untuk performa query
            $table->index('kelas_id');
            $table->index('user_id');
            $table->index('tipe_transaksi');
            $table->index('status');
            $table->index('tanggal');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi');
    }
};
