<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WaliKelasSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('wali_kelas')->insert([
            [
                'kelas_id' => 1,
                'user_id' => 1,
                'nip' => 19880101201501,
                'no_hp' => '081222333444',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kelas_id' => 2,
                'user_id' => 2,
                'nip' => 19880101201502,
                'no_hp' => '081222333555',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kelas_id' => 3,
                'user_id' => 3,
                'nip' => 19880101201503,
                'no_hp' => '081222333666',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}