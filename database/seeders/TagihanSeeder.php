<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TagihanSeeder extends Seeder
{
    public function run(): void
    {
        $siswaIds = DB::table('users')
            ->where('role', 'siswa')
            ->pluck('id');

        $bendaharaIds = DB::table('users')
            ->where('role', 'bendahara')
            ->pluck('id')
            ->toArray();

        $tagihanList = [
            [
                'nama_tagihan' => 'Uang Kas Mei 2026',
                'nominal' => 50000,
                'periode' => '2026-05-01',
                'batas_bayar' => '2026-05-10',
            ],
            [
                'nama_tagihan' => 'Iuran Perpisahan',
                'nominal' => 150000,
                'periode' => '2026-05-01',
                'batas_bayar' => '2026-05-25',
            ],
            [
                'nama_tagihan' => 'Foto Album Kenangan',
                'nominal' => 100000,
                'periode' => '2026-06-01',
                'batas_bayar' => '2026-06-15',
            ],
            [
                'nama_tagihan' => 'Study Tour',
                'nominal' => 250000,
                'periode' => '2026-06-01',
                'batas_bayar' => '2026-06-20',
            ],
            [
                'nama_tagihan' => 'Iuran Pentas Seni',
                'nominal' => 90000,
                'periode' => '2026-05-15',
                'batas_bayar' => '2026-05-30',
            ],
        ];

        $data = [];

        foreach ($siswaIds as $userId) {

            // setiap siswa dapat 2-3 tagihan random
            $randomTagihan = collect($tagihanList)->random(rand(2,3));

            foreach ($randomTagihan as $tagihan) {

                $data[] = [
                    'user_id' => $userId,
                    'created_by' => $bendaharaIds[array_rand($bendaharaIds)],
                    'nama_tagihan' => $tagihan['nama_tagihan'],
                    'nominal' => $tagihan['nominal'],
                    'periode' => $tagihan['periode'],
                    'batas_bayar' => $tagihan['batas_bayar'],
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ];
            }
        }

        // Dummy khusus bendahara
        foreach ($bendaharaIds as $bendaharaId) {

            $data[] = [
                'user_id' => $bendaharaId,
                'created_by' => 1,
                'nama_tagihan' => 'Administrasi Bendahara',
                'nominal' => 200000,
                'periode' => '2026-05-01',
                'batas_bayar' => '2026-05-20',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];

            $data[] = [
                'user_id' => $bendaharaId,
                'created_by' => 1,
                'nama_tagihan' => 'Pengelolaan Event Kelas',
                'nominal' => 175000,
                'periode' => '2026-05-01',
                'batas_bayar' => '2026-05-25',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
        }

        DB::table('tagihan')->insert($data);
    }
}