<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("ALTER TABLE pembayaran MODIFY COLUMN status ENUM('lunas', 'belum', 'nunggak', 'pending', 'ditolak') DEFAULT 'belum'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("ALTER TABLE pembayaran MODIFY COLUMN status ENUM('lunas', 'belum', 'nunggak') DEFAULT 'belum'");
    }
};