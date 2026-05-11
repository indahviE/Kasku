<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Pembayaran;
use App\Models\Pengeluaran;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard(Request $request)
    {
        // Summary data
        $totalMasuk = Pembayaran::where('status', 'lunas')->sum('jml_bayar');
        $totalKeluar = Pengeluaran::sum('nominal');
        $saldoKeseluruhan = $totalMasuk - $totalKeluar;
        $jumlahKelas = Kelas::count();

        // List user dengan filter
        $roleFilter = $request->get('role');
        $query = User::with('kelas');

        if ($roleFilter) {
            $query->where('role', $roleFilter);
        }

        $users = $query->paginate(6);
        $roles = ['admin', 'bendahara', 'siswa', 'wali_kelas'];

        return view('admin.index', [
            'totalMasuk' => $totalMasuk,
            'totalKeluar' => $totalKeluar,
            'saldoKeseluruhan' => $saldoKeseluruhan,
            'jumlahKelas' => $jumlahKelas,
            'users' => $users,
            'roles' => $roles,
            'roleFilter' => $roleFilter
        ]);
    }
}
