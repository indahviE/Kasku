<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PengeluaranSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('pengeluaran')->insert([
            [
                'kelas_id' => 1,
                'dicatat_oleh' => 3,
                'nominal' => 25000.00,
                'tanggal' => '2026-05-01',
                'keterangan' => 'Pembelian Sapu dan Pengki',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kelas_id' => 1,
                'dicatat_oleh' => 2,
                'nominal' => 15000.00,
                'tanggal' => '2026-05-03',
                'keterangan' => 'Isi Ulang Spidol Boardmarker',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kelas_id' => 2,
                'dicatat_oleh' => 2,
                'nominal' => 50000.00,
                'tanggal' => '2026-05-05',
                'keterangan' => 'Kas Kelas untuk Dekorasi Jendela',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kelas_id' => 2,
                'dicatat_oleh' => 3,
                'nominal' => 10000.00,
                'tanggal' => '2026-05-07',
                'keterangan' => 'Fotokopi Absensi Kelas',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
