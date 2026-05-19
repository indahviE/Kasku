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
        Schema::table('users', function (Blueprint $table) {
            // Check if column doesn't exist before adding
            if (!Schema::hasColumn('users', 'kelas_id')) {
                // Add kelas_id column as foreign key
                // Positioned after 'role' column for logical grouping
                $table->unsignedBigInteger('kelas_id')
                    ->nullable()
                    ->after('role')
                    ->comment('Reference ke tabel kelas');

                // Add foreign key constraint
                $table->foreign('kelas_id')
                    ->references('id')
                    ->on('kelas')
                    ->onDelete('set null')
                    ->onUpdate('cascade');

                // Add index untuk query performance
                $table->index('kelas_id');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Check if column exists before dropping
            if (Schema::hasColumn('users', 'kelas_id')) {
                // Drop foreign key constraint
                $table->dropForeignKey(['kelas_id']);

                // Drop index
                $table->dropIndex(['kelas_id']);

                // Drop column
                $table->dropColumn('kelas_id');
            }
        });
    }
};
