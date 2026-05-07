<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SiswaSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('siswa')->insert([
            [
                'user_id' => 1, 
                'kelas_id' => 1,
                'no_hp' => '081234567890',
                'nis' => '2026001',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 2, 
                'kelas_id' => 1, 
                'no_hp' => '081234567891',
                'nis' => '2026002',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 3, 
                'kelas_id' => 2, 
                'no_hp' => '081234567892',
                'nis' => '2026003',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}