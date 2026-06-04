<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\WaliKelas;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pembayaran;
use App\Models\Pengeluaran;
use App\Models\Tagihan;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

class WalkelController extends Controller
{
    public function dashboard()
    {
        $wali = WaliKelas::where('user_id', Auth::id())->firstOrFail();

        $siswa = Siswa::with('user')
            ->where('kelas_id', $wali->kelas_id)
            ->get();

        $userIds = $siswa->pluck('user_id');

        $tagihanTerbaru = Tagihan::whereIn('user_id', $userIds)->latest('periode')->first();

        $jumlahLunas = 0;
        $jumlahBelumBayar = 0;
        if ($tagihanTerbaru) {
            $jumlahLunas = Pembayaran::where('tagihan_id', $tagihanTerbaru->id)
                ->whereIn('user_id', $userIds)
                ->where('status', 'lunas')
                ->count();
            $jumlahBelumBayar = $siswa->count() - $jumlahLunas;
        }

        $kasMasuk  = Pembayaran::whereIn('user_id', $userIds)->where('status', 'lunas')->sum('jml_bayar');
        $kasKeluar = Pengeluaran::where('kelas_id', $wali->kelas_id)->sum('nominal');

        $jumlahTagihanAktif = Tagihan::whereIn('user_id', $userIds)
            ->whereMonth('batas_bayar', now()->month)
            ->whereYear('batas_bayar', now()->year)
            ->count();

        $jumlahBendahara = $siswa->filter(
            fn($s) => $s->user->role === 'bendahara'
        )->count();

        return view('admin.wali_kelas.dashboard', compact(
            'wali',
            'siswa',
            'jumlahBendahara',
            'jumlahLunas',
            'jumlahBelumBayar',
            'jumlahTagihanAktif',
            'kasKeluar',
            'kasMasuk'
        ));
    }

    public function jadikanBendahara($id)
    {
        $wali = WaliKelas::where('user_id', Auth::id())->firstOrFail();

        $siswa = Siswa::with('user')->findOrFail($id);

        if ($siswa->kelas_id !== $wali->kelas_id) {
            return redirect()->route('wali.dashboard')
                ->with('error', 'Siswa tidak berada di kelas Anda');
        }

        $user = User::findOrFail($siswa->user_id);

        if ($user->role === 'bendahara') {
            User::where('id', $siswa->user_id)->update(['role' => 'siswa']);
            return redirect()->route('wali.dashboard')
                ->with('success', "{$user->name} dikembalikan menjadi siswa");
        }

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

public function transaksiKas()
    {
        $wali    = WaliKelas::where('user_id', Auth::id())->firstOrFail();
        $siswa   = Siswa::with('user')->where('kelas_id', $wali->kelas_id)->get();
        $userIds = $siswa->pluck('user_id');

        $masuk = Pembayaran::with(['siswa', 'tagihan'])
            ->whereIn('user_id', $userIds)
            ->where('status', 'lunas')
            ->get()
            ->map(fn($p) => [
                'tipe'       => 'masuk',
                'nominal'    => $p->jml_bayar,
                'tanggal'    => $p->tanggal_bayar,
                'keterangan' => $p->tagihan->nama_tagihan ?? 'Pembayaran kas',
                'nama'       => $p->siswa->name ?? '-',
                'metode'     => $p->metode,
            ]);

            $keluar = Pengeluaran::with('pencatat') // ← Ganti 'user' jadi 'pencatat' sesuai model
            ->where('kelas_id', $wali->kelas_id)
            ->get()
            ->map(fn($p) => [
                'tipe'       => 'keluar',
                'nominal'    => $p->nominal,
                'tanggal'    => $p->tanggal,
                'keterangan' => $p->keterangan,
                // Ambil namanya lewat relasi 'pencatat' (kolom dicatat_oleh)
                'nama'       => 'Bendahara (' . ($p->pencatat->name ?? 'Tidak Diketahui') . ')',
                'metode'     => '-',
            ]);

        $allTransaksi = $masuk->concat($keluar)->sortByDesc('tanggal')->values();
        $totalMasuk  = $masuk->sum('nominal');
        $totalKeluar = $keluar->sum('nominal');
        $saldo       = $totalMasuk - $totalKeluar;

        // ---- PROSES PAGINASI MANUAL DISINI ----
        $perPage     = 5;
        $currentPage = Paginator::resolveCurrentPage();
        $collection  = collect($allTransaksi);

        $transaksi = new LengthAwarePaginator(
            $collection->forPage($currentPage, $perPage)->values(),
            $collection->count(),
            $perPage,
            $currentPage,
            ['path' => Paginator::resolveCurrentPath()]
        );

        return view('admin.wali_kelas.transaksi-kas', compact(
            'wali', 'transaksi', 'totalMasuk', 'totalKeluar', 'saldo'
        ));
    }
public function rekapPembayaran()
{
    $wali    = WaliKelas::where('user_id', Auth::id())->firstOrFail();
    $siswa   = Siswa::with('user')->where('kelas_id', $wali->kelas_id)->get();
    $userIds = $siswa->pluck('user_id');

    // Ambil semua tagihan unik berdasarkan nama
    $tagihan = Tagihan::whereIn('user_id', $userIds)
        ->orderBy('periode', 'desc')
        ->get()
        ->unique('nama_tagihan')
        ->values();

    $rekapTagihanRaw = $tagihan->map(function ($t) use ($userIds, $siswa) {
        $sudahBayar = Pembayaran::where('tagihan_id', $t->id)
            ->whereIn('user_id', $userIds)
            ->where('status', 'lunas')
            ->count();
        $totalSiswa = $siswa->count();
        return [
            'tagihan'     => $t,
            'sudah_bayar' => $sudahBayar,
            'belum_bayar' => $totalSiswa - $sudahBayar,
            'total_siswa' => $totalSiswa,
            'persen'      => $totalSiswa > 0 ? round(($sudahBayar / $totalSiswa) * 100) : 0,
        ];
    });

    // Proses Paginasi Manual (5 data per halaman)
    $perPage     = 5;
    $currentPage = Paginator::resolveCurrentPage();
    $collection  = collect($rekapTagihanRaw);

    $rekapTagihan = new LengthAwarePaginator(
        $collection->forPage($currentPage, $perPage)->values(),
        $collection->count(),
        $perPage,
        $currentPage,
        ['path' => Paginator::resolveCurrentPath()]
    );

    return view('admin.wali_kelas.rekap-pembayaran', compact('wali', 'rekapTagihan'));
}

public function tunggakan()
{
    $wali    = WaliKelas::where('user_id', Auth::id())->firstOrFail();
    $siswa   = Siswa::with('user')->where('kelas_id', $wali->kelas_id)->get();
    $userIds = $siswa->pluck('user_id');

    $tagihanLewat = Tagihan::whereIn('user_id', $userIds)
        ->where('batas_bayar', '<', now()->toDateString())
        ->orderBy('batas_bayar', 'desc')
        ->get()
        // ->unique('nama_tagihan')
        ->values();

    $tunggakanRaw = [];
    foreach ($tagihanLewat as $t) {
        $belumBayar = $siswa->filter(function ($s) use ($t) {
            return !Pembayaran::where('user_id', $s->user_id)
                ->where('tagihan_id', $t->id)
                ->where('status', 'lunas')
                ->exists();
        });

        if ($belumBayar->count() > 0) {
            $tunggakanRaw[] = ['tagihan' => $t, 'siswa' => $belumBayar];
        }
    }

    $perPage     = 5;
    $currentPage = Paginator::resolveCurrentPage();  // ← ini yang penting
    $collection  = collect($tunggakanRaw);

    $tunggakan = new LengthAwarePaginator(
        $collection->forPage($currentPage, $perPage)->values(),
        $collection->count(),
        $perPage,
        $currentPage,
        ['path' => Paginator::resolveCurrentPath()]  // ← dan ini
    );

    return view('admin.wali_kelas.tunggakan', compact('wali', 'tunggakan'));
}
}
