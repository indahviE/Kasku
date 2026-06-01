<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\WaliKelas;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WalkelController extends Controller
{
    /**
     * Dashboard wali kelas — lihat daftar siswa di kelasnya
     */
    public function dashboard()
    {
        $wali = WaliKelas::where('user_id', Auth::id())->firstOrFail();

        $siswa = Siswa::with('user')
            ->where('kelas_id', $wali->kelas_id)
            ->get();

        // Hitung jumlah bendahara di kelas ini
        $jumlahBendahara = $siswa->filter(
            fn($s) => $s->user->role === 'bendahara'
        )->count();

        return view('admin.wali_kelas.dashboard', compact('wali', 'siswa', 'jumlahBendahara'));
    }

    /**
     * Jadikan siswa sebagai bendahara
     */
    public function jadikanBendahara($id)
    {
        $wali = WaliKelas::where('user_id', Auth::id())->firstOrFail();

        $siswa = Siswa::with('user')->findOrFail($id);

        // Pastikan siswa ada di kelas yang sama
        if ($siswa->kelas_id !== $wali->kelas_id) {
            return redirect()->route('wali.dashboard')
                ->with('error', 'Siswa tidak berada di kelas Anda');
        }

        $user = User::findOrFail($siswa->user_id);

        // Kalau sudah bendahara, kembalikan ke siswa
        if ($user->role === 'bendahara') {
            User::where('id', $siswa->user_id)->update(['role' => 'siswa']);
            return redirect()->route('wali.dashboard')
                ->with('success', "{$user->name} dikembalikan menjadi siswa");
        }

        // Maksimal 2 bendahara per kelas
        $jumlahBendahara = Siswa::where('kelas_id', $wali->kelas_id)
            ->whereHas('user', fn($q) => $q->where('role', 'bendahara'))
            ->count();

        if ($jumlahBendahara >= 2) {
            return redirect()->route('wali.dashboard')
                ->with('error', 'Maksimal 2 bendahara per kelas');
        }

        User::where('id', $siswa->user_id)->update(['role' => 'bendahara']);

        return redirect()->route('wali.dashboard')
            ->with('success', "{$user->name} berhasil dijadikan bendahara");
    }
}
