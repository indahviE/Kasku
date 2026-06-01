<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class SiswaSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil ID kelas XI RPL 2
        $kelas = DB::table('kelas')->where('nama_kelas', 'XI-RPL-2')->first();
        $kelasId = $kelas ? $kelas->id : 1;

        $dataSiswa = [
            ['nis' => '12430117', 'nama' => 'ABDUL MUGHNI NUGRAHA', 'hp' => '085383222286'],
            ['nis' => '12430118', 'nama' => 'AHMAD FATHAN ARROYYAN', 'hp' => '085721200049'],
            ['nis' => '12430119', 'nama' => 'AMELIA AGUSTIN', 'hp' => '000000000000'],
            ['nis' => '12430120', 'nama' => 'AMMAR NUR FAISHOL', 'hp' => '08156005739'],
            ['nis' => '12430121', 'nama' => 'ARYA MILITO', 'hp' => '0882000277091'],
            ['nis' => '12430122', 'nama' => 'ATHALLAH ASYARIF KHOIRULINSAN', 'hp' => '085864841735  '],
            ['nis' => '12430123', 'nama' => 'CHIARA DEWI CHATLINA', 'hp' => '082115901755'],
            ['nis' => '12430124', 'nama' => 'DIYANA PUTRI RAMADAN', 'hp' => '082114115229'],
            ['nis' => '12430125', 'nama' => 'FATHAN APRIAN', 'hp' => '081313790379'],
            ['nis' => '12430126', 'nama' => 'FERDY PRATAMA SURADI', 'hp' => '000000000000'],
            ['nis' => '12430127', 'nama' => 'INDAH NURAISYAH', 'hp' => '08996733553'],
            ['nis' => '12430128', 'nama' => 'JIHAN RIESTY APRILIA', 'hp' => '085864621425'],
            ['nis' => '12430129', 'nama' => 'JIHAN SYAHIRA', 'hp' => '085236231112'],
            ['nis' => '12430130', 'nama' => 'KAYNDRA NUR FAIQ', 'hp' => '000000000000'],
            ['nis' => '12430131', 'nama' => 'MELANI DETIANI', 'hp' => '087841015544'],
            ['nis' => '12430132', 'nama' => 'MELINA DETIANA', 'hp' => '087726834345'],
            ['nis' => '12430133', 'nama' => 'MOCHAMAD BINTANG LAKSAMANA SUMARDI', 'hp' => '085161891811'],
            ['nis' => '12430134', 'nama' => 'MOHAMMAD RIDHO OKTOBERYL NUGRAHA', 'hp' => '085723558104'],
            ['nis' => '12430135', 'nama' => 'MUHAIMIN', 'hp' => '00000000000'],
            ['nis' => '12430136', 'nama' => 'NAFISAH ADELIA PUTRI', 'hp' => '089501969988'],
            ['nis' => '12430137', 'nama' => 'NINO ADITYO NUGROHO', 'hp' => '087740864657'],
            ['nis' => '12430138', 'nama' => 'NOVAL MAULANA', 'hp' => '0882001197073'],
            ['nis' => '12430139', 'nama' => 'NOVVALINO PUTRA GIANTO', 'hp' => '088222116744'],
            ['nis' => '12430140', 'nama' => 'NUR FAJRINA RAMADANI', 'hp' => '0895326777933'],
            ['nis' => '12430141', 'nama' => 'OKTA PUTRI SYLLAWATI HASSAN', 'hp' => '0895636819392'],
            ['nis' => '12430142', 'nama' => 'PRIMA AL RASYID IRAWAN', 'hp' => '000000000000'],
            ['nis' => '12430143', 'nama' => 'PUJI WIJAYANTO', 'hp' => '000000000000'],
            ['nis' => '12430144', 'nama' => 'RADHITYA RIZKI RAMADHAN', 'hp' => '000000000000'],
            ['nis' => '12430145', 'nama' => 'SAEFUDIN PUTRA MAGHFIROHTI', 'hp' => '082319560767'],
            ['nis' => '12430146', 'nama' => 'SARIF HIDAYAT', 'hp' => '000000000000'],
            ['nis' => '12430147', 'nama' => 'SINDI MAULIDIYA', 'hp' => '089652700838'],
            ['nis' => '12430148', 'nama' => 'SYAFA INESYA', 'hp' => '085189105878'],
            ['nis' => '12430149', 'nama' => 'SYILLA MULYA RAMADHANI', 'hp' => '0895373129211'],
            ['nis' => '12430150', 'nama' => 'TIARA AFPACILA', 'hp' => '083863598389'],
            ['nis' => '12430151', 'nama' => 'VETRI PUTRI RANTIKA', 'hp' => '083144823911'],
        ];

        foreach ($dataSiswa as $item) {
            // Mencari user berdasarkan nama yang diinput di UserSeeder
            $user = User::where('name', $item['nama'])->first();

            if ($user) {
                DB::table('siswa')->insert([
                    'user_id'    => $user->id,
                    'kelas_id'   => $kelasId,
                    'nis'        => $item['nis'],
                    'no_hp'      => $item['hp'], // Kosong dulu, bisa kamu isi nanti
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
