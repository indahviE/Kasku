<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class BendaharaSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Nafisah',
            'email' => 'nafisah@example.com',
            'password' => Hash::make('password'),
            'role' => 'bendahara',
        ]);
    }
}