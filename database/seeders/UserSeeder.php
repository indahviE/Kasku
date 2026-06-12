<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // 1. SEEDER ADMIN
        $admins = [
            [
                'name' => 'Afika Awwaliyah Rozaaq S.Pd.',
                'email' => 'afika@example.com',
                'nis' => '11111111',
                'role' => 'admin',
                'password' => 'admin123'
            ],
        ];

        foreach ($admins as $admin) {
            User::create([
                'name'     => $admin['name'],
                'email'    => $admin['email'],
                'password' => Hash::make($admin['password']),
                'role'     => $admin['role'],
                'kelas_id' => null, // Admin tidak butuh kelas_id
            ]);
        }

        // 2. SEEDER BENDAHARA (Ditambahkan kelas_id)
        $bendaharas = [
            ['name' => 'NAFISAH ADELIA PUTRI', 'email' => 'nafisah@example.com', 'nis' => '12430136', 'password' => 'bendahara123', 'kelas_id' => 2],
            ['name' => 'FATHAN APRIAN', 'email' => 'fathan.aprian@example.com', 'nis' => '12430125', 'password' => 'bendahara123', 'kelas_id' => 2],
        ];

        foreach ($bendaharas as $bendahara) {
            User::create([
                'name'     => $bendahara['name'],
                'email'    => $bendahara['email'],
                'password' => Hash::make($bendahara['password']),
                'role'     => 'bendahara',
                'kelas_id' => $bendahara['kelas_id'], // ✅ Sekarang bendahara punya kelas!
            ]);
        }

        // 3. SEEDER SISWA (Ditambahkan kelas_id)
        $allStudents = [
            ['nis' => '12430117', 'name' => 'ABDUL MUGHNI NUGRAHA'],
            ['nis' => '12430118', 'name' => 'AHMAD FATHAN ARROYYAN'],
            ['nis' => '12430119', 'name' => 'AMELIA AGUSTIN'],
            ['nis' => '12430120', 'name' => 'AMMAR NUR FAISHOL'],
            ['nis' => '12430121', 'name' => 'ARYA MILITO'],
            ['nis' => '12430122', 'name' => 'ATHALLAH ASYARIF KHOIRULINSAN'],
            ['nis' => '12430123', 'name' => 'CHIARA DEWI CHATLINA'],
            ['nis' => '12430124', 'name' => 'DIYANA PUTRI RAMADAN'],
            ['nis' => '12430125', 'name' => 'FATHAN APRIAN'],
            ['nis' => '12430126', 'name' => 'FERDY PRATAMA SURADI'],
            ['nis' => '12430127', 'name' => 'INDAH NURAISYAH'],
            ['nis' => '12430128', 'name' => 'JIHAN RIESTY APRILIA'],
            ['nis' => '12430129', 'name' => 'JIHAN SYAHIRA'],
            ['nis' => '12430130', 'name' => 'KAYNDRA NUR FAIQ'],
            ['nis' => '12430131', 'name' => 'MELANI DETIANI'],
            ['nis' => '12430132', 'name' => 'MELINA DETIANA'],
            ['nis' => '12430133', 'name' => 'MOCHAMAD BINTANG LAKSAMANA SUMARDI'],
            ['nis' => '12430134', 'name' => 'MOHAMMAD RIDHO OKTOBERYL NUGRAHA'],
            ['nis' => '12430135', 'name' => 'MUHAIMIN'],
            ['nis' => '12430136', 'name' => 'NAFISAH ADELIA PUTRI'],
            ['nis' => '12430137', 'name' => 'NINO ADITYO NUGROHO'],
            ['nis' => '12430138', 'name' => 'NOVAL MAULANA'],
            ['nis' => '12430139', 'name' => 'NOVVALINO PUTRA GIANTO'],
            ['nis' => '12430140', 'name' => 'NUR FAJRINA RAMADANI'],
            ['nis' => '12430141', 'name' => 'OKTA PUTRI SYLLAWATI HASSAN'],
            ['nis' => '12430142', 'name' => 'PRIMA AL RASYID IRAWAN'],
            ['nis' => '12430143', 'name' => 'PUJI WIJAYANTO'],
            ['nis' => '12430144', 'name' => 'RADHITYA RIZKI RAMADHAN'],
            ['nis' => '12430145', 'name' => 'SAEFUDIN PUTRA MAGHFIROHTI'],
            ['nis' => '12430146', 'name' => 'SARIF HIDAYAT'],
            ['nis' => '12430147', 'name' => 'SINDI MAULIDIYA'],
            ['nis' => '12430148', 'name' => 'SYAFA INESYA'],
            ['nis' => '12430149', 'name' => 'SYILLA MULYA RAMADHANI'],
            ['nis' => '12430150', 'name' => 'TIARA AFPACILA'],
            ['nis' => '12430151', 'name' => 'VETRI PUTRI RANTIKA'],
        ];

        $existingNis = array_column($bendaharas, 'nis');

        foreach ($allStudents as $student) {
            if (!in_array($student['nis'], $existingNis)) {
                User::create([
                    'name'     => $student['name'],
                    'email'    => strtolower(str_replace(' ', '.', explode(' ', $student['name'])[0])) . $student['nis'] . '@siswa.com',
                    'password' => Hash::make($student['nis']),
                    'role'     => 'siswa',
                    'kelas_id' => 2, // ✅ Siswa biasa juga langsung dimasukkan ke kelas 2
                ]);
            }
        }

        // 4. SEEDER WALI KELAS
        $waliKelasData = [
            [
                'name' => 'Riyan Triana',
                'email' => 'riyan@example.com',
                'password' => 'walikelas123',
                'nip' => 198501012010011001,
                'no_hp' => '081234567890',
                'kelas_id' => 2
            ],
        ];

        foreach ($waliKelasData as $wali) {
            $user = User::create([
                'name'     => $wali['name'],
                'email'    => $wali['email'],
                'password' => Hash::make($wali['password']),
                'role'     => 'wali_kelas',
                'kelas_id' => $wali['kelas_id'], // Tambahkan kelas_id ke user wali kelas jika diperlukan
            ]);

            \App\Models\WaliKelas::create([
                'user_id'  => $user->id,
                'kelas_id' => $wali['kelas_id'],
                'nip'      => $wali['nip'],
                'no_hp'    => $wali['no_hp'],
            ]);
        }
    }
}