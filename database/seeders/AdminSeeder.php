<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder 
{
    public function run(): void
    {
        User::create([
            'name' => 'Indah',
            'email' => 'indah@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Chiara',
            'email' => 'chiara@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Ines',
            'email' => 'ines@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Melina',
            'email' => 'melina@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Fathan',
            'email' => 'fathan@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Vetri',
            'email' => 'vetri@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);
    }
}