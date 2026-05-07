<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PembayaranSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('pembayaran')->insert([
            [
                'tagihan_id' => 1,
                'user_id' => 1,
                'dicatat_oleh' => 1,
                'jml_bayar' => 50000.00,
                'tanggal_bayar' => '2026-05-05',
                'metode' => 'tunai',
                'status' => 'lunas',
                'bukti_bayar' => 'bukti_kas_mei_budi.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tagihan_id' => 1,
                'user_id' => 2,
                'dicatat_oleh' => 1,
                'jml_bayar' => 50000.00,
                'tanggal_bayar' => '2026-05-06',
                'metode' => 'transfer',
                'status' => 'lunas',
                'bukti_bayar' => 'tf_chiara.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tagihan_id' => 2,
                'user_id' => 1,
                'dicatat_oleh' => 2,
                'jml_bayar' => 150000.00,
                'tanggal_bayar' => '2026-05-07',
                'metode' => 'tunai',
                'status' => 'lunas',
                'bukti_bayar' => 'bukti_perpisahan_budi.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tagihan_id' => 1,
                'user_id' => 3,
                'dicatat_oleh' => 1,
                'jml_bayar' => 0.00,
                'tanggal_bayar' => '2026-05-07',
                'metode' => 'tunai',
                'status' => 'nunggak',
                'bukti_bayar' => 'default.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}