<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KelasSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('kelas')->insert([
            [
                'nama_kelas' => 'X-RPL-1',
                'tahun_ajaran' => '2025/2026',
                'code' => 'KLS-001',
                'status' => 'aktif',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_kelas' => 'XI-RPL-2',
                'tahun_ajaran' => '2025/2026',
                'code' => 'KLS-002',
                'status' => 'aktif',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_kelas' => 'XII-TKJ-1',
                'tahun_ajaran' => '2024/2025',
                'code' => 'KLS-003',
                'status' => 'arsip',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_kelas' => 'XI-RPL-1',
                'tahun_ajaran' => '2025/2026',
                'code' => 'KLS-004',
                'status' => 'aktif',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
