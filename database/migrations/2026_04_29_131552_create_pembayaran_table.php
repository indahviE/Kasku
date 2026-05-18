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
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tagihan_id')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('dicatat_oleh');
            $table->decimal('jml_bayar', 10, 2);
            $table->date('tanggal_bayar');
            $table->enum('metode', ['tunai', 'transfer'])->default('tunai');
            $table->enum('status', ['lunas', 'belum', 'nunggak'])->default('belum');
            $table->string('bukti_bayar');
            $table->timestamps();

            $table->foreign('tagihan_id')->references('id')->on('tagihan')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('dicatat_oleh')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayaran');
    }
};
