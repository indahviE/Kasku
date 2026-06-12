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
    public function dashboard(Request $request)
    {
        $wali = WaliKelas::where('user_id', Auth::id())->firstOrFail();

        // Mengambil data pencarian jika ada
        $search = $request->get('search', '');

        // query dasar mengambil siswa di kelas wali kelas tersebut
        $siswaQuery = Siswa::with('user')->where('kelas_id', $wali->kelas_id);

        // LOGIKA FILTER PENCARIAN (Berdasarkan nama siswa)
        if (!empty($search)) {
            $siswaQuery->whereHas('user', function($q) use ($search) {
                $q->where('name', 'LIKE', '%' . $search . '%');
            });
        }

        // Ambil data siswa dengan pagination dan pastikan link halaman mempertahankan query string pencarian
        $siswa = $siswaQuery->paginate(5)->withQueryString();

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

        User::where('id', $siswa->user_id)->update(['role' => 'bendahara', 'kelas_id' => $wali->kelas_id]);

        return redirect()->route('wali.dashboard')
            ->with('success', "{$user->name} berhasil dijadikan bendahara");
    }

    public function transaksiKas(Request $request)
    {
        $wali    = WaliKelas::where('user_id', Auth::id())->firstOrFail();
        $siswa   = Siswa::with('user')->where('kelas_id', $wali->kelas_id)->get();
        $userIds = $siswa->pluck('user_id');

        // Data Pembayaran (Kas Masuk)
        $masuk = Pembayaran::with(['user', 'tagihan'])
            ->whereIn('user_id', $userIds)
            ->where('status', 'lunas')
            ->get()
            ->map(fn($p) => [
                'tipe'       => 'masuk',
                'nominal'    => $p->jml_bayar,
                'tanggal'    => $p->tanggal_bayar,
                'keterangan' => $p->tagihan->nama_tagihan ?? 'Pembayaran kas',
                'nama'       => $p->user->name ?? '-',
                'metode'     => $p->metode,
            ]);

        // Data Pengeluaran (Kas Keluar)
        $keluar = Pengeluaran::with('user')
            ->where('kelas_id', $wali->kelas_id)
            ->get()
            ->map(fn($p) => [
                'tipe'       => 'keluar',
                'nominal'    => $p->nominal,
                'tanggal'    => $p->tanggal,
                'keterangan' => $p->keterangan,
                'nama'       => 'Bendahara (' . ($p->user->name ?? 'Tidak Diketahui') . ')',
                'metode'     => '-',
            ]);

        $allTransaksi = $masuk->concat($keluar)->sortByDesc('tanggal')->values();

        // ---- FILTER LOGIC ----
        $search = $request->get('search', '');
        $dari   = $request->get('dari', '');
        $sampai = $request->get('sampai', '');

        if ($search) {
            $allTransaksi = $allTransaksi->filter(function ($t) use ($search) {
                return stripos($t['keterangan'], $search) !== false;
            })->values();
        }

        if ($dari) {
            $allTransaksi = $allTransaksi->filter(function ($t) use ($dari) {
                return $t['tanggal'] >= $dari;
            })->values();
        }

        if ($sampai) {
            $allTransaksi = $allTransaksi->filter(function ($t) use ($sampai) {
                return $t['tanggal'] <= $sampai;
            })->values();
        }

        $totalMasuk  = $masuk->sum('nominal');
        $totalKeluar = $keluar->sum('nominal');
        $saldo       = $totalMasuk - $totalKeluar;

        // ---- PROSES PAGINASI MANUAL ----
        $perPage     = 5;
        $currentPage = Paginator::resolveCurrentPage();
        $collection  = collect($allTransaksi);

        $transaksi = new LengthAwarePaginator(
            $collection->forPage($currentPage, $perPage)->values(),
            $collection->count(),
            $perPage,
            $currentPage,
            ['path' => Paginator::resolveCurrentPath(), 'query' => $request->query()]
        );

        return view('admin.wali_kelas.transaksi-kas', compact(
            'wali', 'transaksi', 'totalMasuk', 'totalKeluar', 'saldo'
        ));
    }

public function rekapPembayaran(Request $request)
{
    $wali    = WaliKelas::where('user_id', Auth::id())->firstOrFail();
    $siswa   = Siswa::with('user')->where('kelas_id', $wali->kelas_id)->get();
    $userIds = $siswa->pluck('user_id');

    // ambil search
    $search = $request->get('search', '');

    $tagihanQuery = Tagihan::whereIn('user_id', $userIds);

    // FILTER SEARCH
    if (!empty($search)) {
        $tagihanQuery->where('nama_tagihan', 'LIKE', '%' . $search . '%');
    }

    // ambil unik berdasarkan nama
    $tagihan = $tagihanQuery
        ->orderBy('periode', 'desc')
        ->get()
        ->unique('nama_tagihan')
        ->values();

    $rekapTagihanRaw = $tagihan->map(function ($t) use ($userIds, $siswa) {

        // cari semua id tagihan yg namanya sama
        $tagihanIds = Tagihan::where('nama_tagihan', $t->nama_tagihan)
            ->whereIn('user_id', $userIds)
            ->pluck('id');

        $sudahBayar = Pembayaran::whereIn('tagihan_id', $tagihanIds)
            ->whereIn('user_id', $userIds)
            ->where('status', 'lunas')
            ->count();

        $totalSiswa = $siswa->count();

        return [
            'tagihan' => $t,
            'sudah_bayar' => $sudahBayar,
            'belum_bayar' => max(0, $totalSiswa - $sudahBayar),
            'total_siswa' => $totalSiswa,
            'persen' => $totalSiswa > 0
                ? round(($sudahBayar / $totalSiswa) * 100)
                : 0,
        ];
    });

    // PAGINATION
    $perPage = 5;
    $currentPage = Paginator::resolveCurrentPage();

    $rekapTagihan = new LengthAwarePaginator(
        collect($rekapTagihanRaw)
            ->forPage($currentPage, $perPage)
            ->values(),
        count($rekapTagihanRaw),
        $perPage,
        $currentPage,
        [
            'path' => Paginator::resolveCurrentPath(),
            'query' => $request->query() // BIAR SEARCH KEBAWA PAS NEXT
        ]
    );

    return view(
        'admin.wali_kelas.rekap-pembayaran',
        compact('wali', 'rekapTagihan')
    );
}

    public function tunggakan(Request $request)
    {
        $wali    = WaliKelas::where('user_id', Auth::id())->firstOrFail();
        $siswa   = Siswa::with('user')->where('kelas_id', $wali->kelas_id)->get();
        $userIds = $siswa->pluck('user_id');

        $tagihanLewat = Tagihan::whereIn('user_id', $userIds)
            ->where('batas_bayar', '<', now()->toDateString())
            ->orderBy('batas_bayar', 'desc')
            ->get()
            ->values();

        // ---- FILTER LOGIC ----
        $search = $request->get('search', '');
        $dari   = $request->get('dari', '');
        $sampai = $request->get('sampai', '');

        if ($search) {
            $tagihanLewat = $tagihanLewat->filter(function ($t) use ($search) {
                return stripos($t->nama_tagihan, $search) !== false;
            })->values();
        }

        if ($dari) {
            $tagihanLewat = $tagihanLewat->filter(function ($t) use ($dari) {
                return $t->batas_bayar >= $dari;
            })->values();
        }

        if ($sampai) {
            $tagihanLewat = $tagihanLewat->filter(function ($t) use ($sampai) {
                return $t->batas_bayar <= $sampai;
            })->values();
        }

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

        // ---- PROSES PAGINASI MANUAL ----
        $perPage     = 5;
        $currentPage = Paginator::resolveCurrentPage();
        $collection  = collect($tunggakanRaw);

        $tunggakan = new LengthAwarePaginator(
            $collection->forPage($currentPage, $perPage)->values(),
            $collection->count(),
            $perPage,
            $currentPage,
            ['path' => Paginator::resolveCurrentPath(), 'query' => $request->query()]
        );

        return view('admin.wali_kelas.tunggakan', compact('wali', 'tunggakan'));
    }

    public function cetakTransaksiPdf()
    {
        $wali    = WaliKelas::where('user_id', Auth::id())->firstOrFail();
        $siswa   = Siswa::with('user')->where('kelas_id', $wali->kelas_id)->get();
        $userIds = $siswa->pluck('user_id');

        $masuk = Pembayaran::with(['user', 'tagihan'])
            ->whereIn('user_id', $userIds)
            ->where('status', 'lunas')
            ->get()
            ->map(fn($p) => [
                'tipe'       => 'masuk',
                'nominal'    => $p->jml_bayar,
                'tanggal'    => $p->tanggal_bayar,
                'keterangan' => $p->tagihan->nama_tagihan ?? 'Pembayaran kas',
                'nama'       => $p->user->name ?? '-',
                'metode'     => $p->metode,
            ]);

        $keluar = Pengeluaran::with('user')
            ->where('kelas_id', $wali->kelas_id)
            ->get()
            ->map(fn($p) => [
                'tipe'       => 'keluar',
                'nominal'    => $p->nominal,
                'tanggal'    => $p->tanggal,
                'keterangan' => $p->keterangan,
                'nama'       => 'Bendahara (' . ($p->user->name ?? 'Tidak Diketahui') . ')',
                'metode'     => '-',
            ]);

        $transaksi = $masuk->concat($keluar)->sortByDesc('tanggal')->values();

        $totalMasuk  = $masuk->sum('nominal');
        $totalKeluar = $keluar->sum('nominal');
        $saldo       = $totalMasuk - $totalKeluar;

        return view('admin.wali_kelas.cetak-transaksi', compact('wali', 'transaksi', 'totalMasuk', 'totalKeluar', 'saldo'));
    }
}
