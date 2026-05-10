<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder 
{
    public function run(): void
    {
        // 1. Data Admin (Password menggunakan NIS sesuai permintaan)
        $admins = [
            ['name' => 'INDAH NURAISYAH', 'email' => 'indah@example.com', 'nis' => '12430127', 'role' => 'admin'],
            ['name' => 'CHIARA DEWI CHATLINA', 'email' => 'chiara@example.com', 'nis' => '12430123', 'role' => 'admin'],
            ['name' => 'SYAFA INESYA', 'email' => 'ines@example.com', 'nis' => '12430148', 'role' => 'admin'],
            ['name' => 'MELINA DETIANA', 'email' => 'melina@example.com', 'nis' => '12430132', 'role' => 'admin'],
            ['name' => 'AHMAD FATHAN ARROYYAN', 'email' => 'fathan@example.com', 'nis' => '12430118', 'role' => 'admin'],
            ['name' => 'VETRI PUTRI RANTIKA', 'email' => 'vetri@example.com', 'nis' => '12430151', 'role' => 'admin'],
        ];

        foreach ($admins as $admin) {
            User::create([
                'name'     => $admin['name'],
                'email'    => $admin['email'],
                'password' => Hash::make($admin['nis']), // Password menggunakan NIS
                'role'     => $admin['role'],
            ]);
        }

        // 2. Data Bendahara
        $bendaharas = [
            ['name' => 'NAFISAH ADELIA PUTRI', 'email' => 'nafisah@example.com', 'nis' => '12430136'],
            ['name' => 'FATHAN APRIAN', 'email' => 'fathan.aprian@example.com', 'nis' => '12430125'],
        ];

        foreach ($bendaharas as $bendahara) {
            User::create([
                'name'     => $bendahara['name'],
                'email'    => $bendahara['email'],
                'password' => Hash::make($bendahara['nis']), // Password menggunakan NIS
                'role'     => 'bendahara',
            ]);
        }

        // 3. Data Seluruh Siswa dari Foto
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

        // Ambil semua NIS yang sudah terdaftar sebagai Admin/Bendahara agar tidak double
        $existingNis = array_merge(
            array_column($admins, 'nis'),
            array_column($bendaharas, 'nis')
        );

        foreach ($allStudents as $student) {
            // Jika NIS belum ada di list Admin atau Bendahara, masukkan sebagai Siswa
            if (!in_array($student['nis'], $existingNis)) {
                User::create([
                    'name'     => $student['name'],
                    'email'    => strtolower(str_replace(' ', '.', explode(' ', $student['name'])[0])) . $student['nis'] . '@example.com',
                    'password' => Hash::make($student['nis']), // Password menggunakan NIS
                    'role'     => 'siswa',
                ]);
            }
        }
    }
}