<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Pembayaran;
use App\Models\Pengeluaran;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function dashboard(Request $request)
    {
        // summary data
        $totalMasuk = Pembayaran::where('status', 'lunas')->sum('jml_bayar');
        $totalKeluar = Pengeluaran::sum('nominal');
        $saldoKeseluruhan = $totalMasuk - $totalKeluar;
        $jumlahKelas = Kelas::count();

        // list user
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

    public function generateClassCode(int $id)
    {
        $kelas = Kelas::findOrFail($id);
        $oldCode = $kelas->code;
        $newCode = $this->generateNewCode();

        $kelas->update(['code' => $newCode]);

        return redirect()->route('kelas')->with('success', "Kode kelas diperbarui dari $oldCode menjadi $newCode");
    }

    private function generateNewCode()
    {
        do {
            $code = strtoupper(Str::random(6));
        } while (Kelas::where('code', $code)->exists());

        return $code;
    }
}
