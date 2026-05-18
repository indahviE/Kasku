<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TagihanSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('tagihan')->insert([
            [
                'user_id' => 1,
                'created_by' => 1,
                'nama_tagihan' => 'Uang Kas Mei 2026',
                'nominal' => 50000,
                'periode' => '2026-05-01',
                'batas_bayar' => '2026-05-10',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'created_by' => 1,
                'nama_tagihan' => 'Iuran Perpisahan',
                'nominal' => 150000,
                'periode' => '2026-05-01',
                'batas_bayar' => '2026-05-25',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 2,
                'created_by' => 2,
                'nama_tagihan' => 'Uang Kas Mei 2026',
                'nominal' => 50000,
                'periode' => '2026-05-01',
                'batas_bayar' => '2026-05-10',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'created_by' => 3,
                'nama_tagihan' => 'Foto Album Kenangan',
                'nominal' => 100000,
                'periode' => '2026-06-01',
                'batas_bayar' => '2026-06-15',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}