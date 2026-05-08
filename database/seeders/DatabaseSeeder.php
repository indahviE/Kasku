<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $this->call([
            AdminSeeder::class,
            BendaharaSeeder::class,
            KelasSeeder::class,
            SiswaSeeder::class,
            TagihanSeeder::class,
            WaliKelasSeeder::class,
            PengeluaranSeeder::class,
            PembayaranSeeder::class,
        ]);
    }
}