<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Pengeluaran;
use App\Models\Tagihan;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BendaharaController extends Controller
{
    // Helper untuk dapatkan user_ids siswa di kelas bendahara
    private function getSiswaUserIds()
    {
        $kelasId = auth()->user()->kelas_id;
        return Siswa::where('kelas_id', $kelasId)->pluck('user_id');
    }

    // =========================
    // DASHBOARD
    // =========================
    public function dashboard()
    {
        $userIds = $this->getSiswaUserIds();

        $totalMasuk = Pembayaran::whereIn('user_id', $userIds)
            ->where('status', 'lunas')
            ->sum('jml_bayar') ?? 0;

        $totalKeluar = Pengeluaran::where('kelas_id', auth()->user()->kelas_id)
            ->sum('nominal') ?? 0;

        $saldoKas = $totalMasuk - $totalKeluar;

        $jumlahTransaksi = Pembayaran::whereIn('user_id', $userIds)->count() +
                           Pengeluaran::where('kelas_id', auth()->user()->kelas_id)->count();

        $kasSosial = Pembayaran::whereIn('user_id', $userIds)
            ->where('status', 'lunas')
            ->whereHas('tagihan', function($q) {
                $q->where('nama_tagihan', 'like', '%sosial%')
                  ->orWhere('nama_tagihan', 'like', '%tabungan%');
            })
            ->sum('jml_bayar') ?? 0;

        $targetKasSosial = 10000000;
        $persenKasSosial = $targetKasSosial > 0 ? min(100, ($kasSosial / $targetKasSosial) * 100) : 0;

        $pembayaran = Pembayaran::with(['user', 'tagihan'])
            ->whereIn('user_id', $userIds)
            ->latest()
            ->limit(5)
            ->get();

        return view('bendahara.dashboard', compact(
            'totalMasuk',
            'totalKeluar',
            'saldoKas',
            'jumlahTransaksi',
            'kasSosial',
            'persenKasSosial',
            'pembayaran'
        ));
    }

    // =========================
    // KAS MASUK
    // =========================
    public function kasMasuk(Request $request)
    {
        $userIds = $this->getSiswaUserIds();

        $search = $request->input('search');
        $kategori = $request->input('kategori');

        $pembayaranQuery = Pembayaran::with(['user', 'tagihan'])
            ->whereIn('user_id', $userIds);

        if ($search) {
            $pembayaranQuery->whereHas('user', function($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                  ->orWhere('email', 'LIKE', "%{$search}%");
            });
        }

        if ($kategori) {
            if ($kategori == 'umum') {
                $pembayaranQuery->whereNull('tagihan_id');
            } else {
                $pembayaranQuery->where('tagihan_id', $kategori);
            }
        }

        $pembayaran = $pembayaranQuery->latest()->paginate(5);

        $totalMasuk = Pembayaran::whereIn('user_id', $userIds)
            ->where('status', 'lunas')
            ->sum('jml_bayar') ?? 0;

        $totalKeluar = Pengeluaran::where('kelas_id', auth()->user()->kelas_id)
            ->sum('nominal') ?? 0;

        $saldoKas = $totalMasuk - $totalKeluar;

        $jumlahTransaksi = Pembayaran::whereIn('user_id', $userIds)->count() +
                           Pengeluaran::where('kelas_id', auth()->user()->kelas_id)->count();

        $siswaList = \App\Models\User::whereIn('id', $userIds)->get();
        $tagihanList = Tagihan::whereIn('user_id', $userIds)->latest()->get();

        $totalMasukBulanIni = Pembayaran::whereIn('user_id', $userIds)
            ->where('status', 'lunas')
            ->whereMonth('tanggal_bayar', now()->month)
            ->whereYear('tanggal_bayar', now()->year)
            ->sum('jml_bayar') ?? 0;

        $totalMasukBulanLalu = Pembayaran::whereIn('user_id', $userIds)
            ->where('status', 'lunas')
            ->whereMonth('tanggal_bayar', now()->subMonth()->month)
            ->whereYear('tanggal_bayar', now()->subMonth()->year)
            ->sum('jml_bayar') ?? 0;

        $persenMasuk = $totalMasukBulanLalu > 0 ? (($totalMasukBulanIni - $totalMasukBulanLalu) / $totalMasukBulanLalu) * 100 : 100;

        $iuranWajib = Pembayaran::whereIn('user_id', $userIds)
            ->where('status', 'lunas')
            ->whereNotNull('tagihan_id')
            ->sum('jml_bayar') ?? 0;

        $dendaLainnya = Pembayaran::whereIn('user_id', $userIds)
            ->where('status', 'lunas')
            ->whereNull('tagihan_id')
            ->sum('jml_bayar') ?? 0;

        return view('bendahara.kas_masuk', compact(
            'totalMasuk',
            'totalKeluar',
            'saldoKas',
            'jumlahTransaksi',
            'pembayaran',
            'siswaList',
            'tagihanList',
            'totalMasukBulanIni',
            'persenMasuk',
            'iuranWajib',
            'dendaLainnya'
        ));
    }

    public function cetakKasMasuk(Request $request)
    {
        $userIds = $this->getSiswaUserIds();
        $search = $request->input('search');
        $kategori = $request->input('kategori');

        $pembayaranQuery = Pembayaran::with(['user', 'tagihan'])
            ->whereIn('user_id', $userIds)
            ->where('status', 'lunas');

        if ($search) {
            $pembayaranQuery->whereHas('user', function($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                  ->orWhere('email', 'LIKE', "%{$search}%");
            });
        }

        if ($kategori) {
            if ($kategori == 'umum') {
                $pembayaranQuery->whereNull('tagihan_id');
            } else {
                $pembayaranQuery->where('tagihan_id', $kategori);
            }
        }

        $pembayaran = $pembayaranQuery->orderBy('tanggal_bayar', 'desc')->get();

        return view('bendahara.cetak_kas_masuk', compact('pembayaran'));
    }

    // =========================
    // KAS KELUAR
    // =========================
    public function kasKeluar()
    {
        $totalKeluar = Pengeluaran::where('kelas_id', auth()->user()->kelas_id)
            ->sum('nominal') ?? 0;

        $pengeluaran = Pengeluaran::where('kelas_id', auth()->user()->kelas_id)
            ->latest()
            ->get();

        $totalKeluarBulanIni = Pengeluaran::where('kelas_id', auth()->user()->kelas_id)
            ->whereMonth('tanggal', now()->month)
            ->whereYear('tanggal', now()->year)
            ->sum('nominal') ?? 0;

        $totalKeluarBulanLalu = Pengeluaran::where('kelas_id', auth()->user()->kelas_id)
            ->whereMonth('tanggal', now()->subMonth()->month)
            ->whereYear('tanggal', now()->subMonth()->year)
            ->sum('nominal') ?? 0;

        $persenKeluar = $totalKeluarBulanLalu > 0 ? (($totalKeluarBulanIni - $totalKeluarBulanLalu) / $totalKeluarBulanLalu) * 100 : 100;

        $sektorTerbesar = Pengeluaran::where('kelas_id', auth()->user()->kelas_id)
            ->selectRaw('keterangan, sum(nominal) as total')
            ->groupBy('keterangan')
            ->orderByDesc('total')
            ->first();

        $userIds = $this->getSiswaUserIds();
        $totalMasuk = Pembayaran::whereIn('user_id', $userIds)
            ->where('status', 'lunas')
            ->sum('jml_bayar') ?? 0;

        $kasSisa = $totalMasuk - $totalKeluar;
        $jumlahSektor = Pengeluaran::where('kelas_id', auth()->user()->kelas_id)
            ->distinct('keterangan')
            ->count('keterangan');

        return view('bendahara.kas_keluar', compact(
            'pengeluaran',
            'totalKeluar',
            'totalKeluarBulanIni',
            'persenKeluar',
            'sektorTerbesar',
            'kasSisa',
            'jumlahSektor'
        ));
    }

    // =========================
    // TRANSAKSI
    // =========================
    public function transaksi()
    {
        $userIds = $this->getSiswaUserIds();

        $pembayaran = Pembayaran::with(['user', 'tagihan'])
            ->whereIn('user_id', $userIds)
            ->latest()
            ->paginate(5);

        $pengeluaran = Pengeluaran::where('kelas_id', auth()->user()->kelas_id)
            ->latest()
            ->paginate(5);

        $totalMasukBulanIni = Pembayaran::whereIn('user_id', $userIds)
            ->where('status', 'lunas')
            ->whereMonth('tanggal_bayar', now()->month)
            ->whereYear('tanggal_bayar', now()->year)
            ->sum('jml_bayar') ?? 0;

        $totalMasukBulanLalu = Pembayaran::whereIn('user_id', $userIds)
            ->where('status', 'lunas')
            ->whereMonth('tanggal_bayar', now()->subMonth()->month)
            ->whereYear('tanggal_bayar', now()->subMonth()->year)
            ->sum('jml_bayar') ?? 0;

        $persenMasuk = $totalMasukBulanLalu > 0 ? (($totalMasukBulanIni - $totalMasukBulanLalu) / $totalMasukBulanLalu) * 100 : 100;

        $totalKeluarBulanIni = Pengeluaran::where('kelas_id', auth()->user()->kelas_id)
            ->whereMonth('tanggal', now()->month)
            ->whereYear('tanggal', now()->year)
            ->sum('nominal') ?? 0;

        $totalKeluarBulanLalu = Pengeluaran::where('kelas_id', auth()->user()->kelas_id)
            ->whereMonth('tanggal', now()->subMonth()->month)
            ->whereYear('tanggal', now()->subMonth()->year)
            ->sum('nominal') ?? 0;

        $persenKeluar = $totalKeluarBulanLalu > 0 ? (($totalKeluarBulanIni - $totalKeluarBulanLalu) / $totalKeluarBulanLalu) * 100 : 100;

        $jumlahTransaksi = $pembayaran->count() + $pengeluaran->count();
        $verifikasiTertunda = $pembayaran->where('status', 'pending')->count();

        return view('bendahara.transaksi', compact(
            'pembayaran',
            'pengeluaran',
            'totalMasukBulanIni',
            'persenMasuk',
            'totalKeluarBulanIni',
            'persenKeluar',
            'jumlahTransaksi',
            'verifikasiTertunda'
        ));
    }

    // =========================
    // TAGIHAN
    // =========================
    public function tagihan()
    {
        $userIds = $this->getSiswaUserIds();

        $tagihan = Tagihan::whereIn('user_id', $userIds)
            ->latest()
            ->paginate(5);

        return view('bendahara.tagihan', compact('tagihan'));
    }

    public function createTagihan()
    {
        return view('bendahara.tambah_tagihan');
    }

    public function storeTagihan(Request $request)
    {
        $request->validate([
            'nama_tagihan' => 'required',
            'periode'      => 'required|date',
            'nominal'      => 'required|numeric',
            'batas_bayar'  => 'required|date',
            'deskripsi'    => 'nullable'
        ]);

        $userIds = $this->getSiswaUserIds();

        $tagihan = Tagihan::create([
            'user_id'      => auth()->id(),
            'created_by'   => auth()->id(),
            'nama_tagihan' => $request->nama_tagihan,
            'periode'      => $request->periode,
            'nominal'      => $request->nominal,
            'batas_bayar'  => $request->batas_bayar,
            'deskripsi'    => $request->deskripsi,
        ]);

        $daftarSiswa = \App\Models\User::whereIn('id', $userIds)->get();

        foreach ($daftarSiswa as $siswa) {
            DB::table('tunggakan')->insert([
                'tagihan_id' => $tagihan->id,
                'user_id'    => $siswa->id,
                'status'     => 'belum_bayar',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        return redirect()
            ->route('bendahara.tagihan')
            ->with('success', 'Tagihan berhasil dibuat dan disebarkan ke seluruh siswa kelas.');
    }

    public function editTagihan($id)
    {
        $tagihan = Tagihan::findOrFail($id);
        return view('bendahara.edit_tagihan', compact('tagihan'));
    }

    public function updateTagihan(Request $request, $id)
    {
        $request->validate([
            'nama_tagihan' => 'required',
            'periode'      => 'required|date',
            'nominal'      => 'required|numeric',
            'batas_bayar'  => 'required|date',
            'deskripsi'    => 'nullable'
        ]);

        $tagihan = Tagihan::findOrFail($id);
        $tagihan->update([
            'nama_tagihan' => $request->nama_tagihan,
            'periode'      => $request->periode,
            'nominal'      => $request->nominal,
            'batas_bayar'  => $request->batas_bayar,
            'deskripsi'    => $request->deskripsi,
        ]);

        return redirect()
            ->route('bendahara.tagihan')
            ->with('success', 'Tagihan berhasil diupdate');
    }

    public function destroyTagihan($id)
    {
        $tagihan = Tagihan::findOrFail($id);
        $tagihan->delete();

        return redirect()
            ->route('bendahara.tagihan')
            ->with('success', 'Tagihan berhasil dihapus');
    }

    // =========================
    // LAPORAN
    // =========================
    public function laporan()
    {
        $userIds = $this->getSiswaUserIds();

        $totalMasuk = Pembayaran::whereIn('user_id', $userIds)
            ->where('status', 'lunas')
            ->sum('jml_bayar') ?? 0;

        $totalKeluar = Pengeluaran::where('kelas_id', auth()->user()->kelas_id)
            ->sum('nominal') ?? 0;

        $saldoAkhir = $totalMasuk - $totalKeluar;

        $totalMasukBulanIni = Pembayaran::whereIn('user_id', $userIds)
            ->where('status', 'lunas')
            ->whereMonth('tanggal_bayar', now()->month)
            ->whereYear('tanggal_bayar', now()->year)
            ->sum('jml_bayar') ?? 0;

        $totalMasukBulanLalu = Pembayaran::whereIn('user_id', $userIds)
            ->where('status', 'lunas')
            ->whereMonth('tanggal_bayar', now()->subMonth()->month)
            ->whereYear('tanggal_bayar', now()->subMonth()->year)
            ->sum('jml_bayar') ?? 0;

        $persenMasuk = $totalMasukBulanLalu > 0 ? (($totalMasukBulanIni - $totalMasukBulanLalu) / $totalMasukBulanLalu) * 100 : 100;

        $totalKeluarBulanIni = Pengeluaran::where('kelas_id', auth()->user()->kelas_id)
            ->whereMonth('tanggal', now()->month)
            ->whereYear('tanggal', now()->year)
            ->sum('nominal') ?? 0;

        $totalKeluarBulanLalu = Pengeluaran::where('kelas_id', auth()->user()->kelas_id)
            ->whereMonth('tanggal', now()->subMonth()->month)
            ->whereYear('tanggal', now()->subMonth()->year)
            ->sum('nominal') ?? 0;

        $persenKeluar = $totalKeluarBulanLalu > 0 ? (($totalKeluarBulanIni - $totalKeluarBulanLalu) / $totalKeluarBulanLalu) * 100 : 100;

        $totalTagihan = Tagihan::whereIn('user_id', $userIds)
            ->sum('nominal') ?? 0;

        $pembayaran = Pembayaran::with(['user', 'tagihan'])
            ->whereIn('user_id', $userIds)
            ->where('status', 'lunas')
            ->get()
            ->map(function($item) {
                $item->jenis = 'masuk';
                $item->tanggal_sort = $item->tanggal_bayar;
                return $item;
            });

        $pengeluaran = Pengeluaran::where('kelas_id', auth()->user()->kelas_id)
            ->get()
            ->map(function($item) {
                $item->jenis = 'keluar';
                $item->tanggal_sort = $item->tanggal;
                return $item;
            });

        $transaksiList = $pembayaran->concat($pengeluaran)->sortByDesc('tanggal_sort')->values();

        return view('bendahara.laporan', compact(
            'totalMasuk',
            'totalKeluar',
            'saldoAkhir',
            'persenMasuk',
            'persenKeluar',
            'totalTagihan',
            'transaksiList'
        ));
    }

    public function exportPdf()
    {
        $userIds = $this->getSiswaUserIds();

        $totalMasuk = Pembayaran::whereIn('user_id', $userIds)
            ->where('status', 'lunas')
            ->sum('jml_bayar') ?? 0;

        $totalKeluar = Pengeluaran::where('kelas_id', auth()->user()->kelas_id)
            ->sum('nominal') ?? 0;

        $saldoAkhir = $totalMasuk - $totalKeluar;

        $pembayaran = Pembayaran::with(['user', 'tagihan'])
            ->whereIn('user_id', $userIds)
            ->where('status', 'lunas')
            ->latest()
            ->get();

        $pengeluaran = Pengeluaran::where('kelas_id', auth()->user()->kelas_id)
            ->latest()
            ->get();

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('bendahara.laporan_pdf', compact('totalMasuk', 'totalKeluar', 'saldoAkhir', 'pembayaran', 'pengeluaran'));
        return $pdf->download('Laporan_Kas_Kasku_'.date('Y-m-d').'.pdf');
    }

    public function exportExcel()
    {
        $userIds = $this->getSiswaUserIds();

        $pembayaran = Pembayaran::with(['user', 'tagihan'])
            ->whereIn('user_id', $userIds)
            ->where('status', 'lunas')
            ->get();

        $pengeluaran = Pengeluaran::where('kelas_id', auth()->user()->kelas_id)
            ->get();

        $filename = "transaksi_kasku_" . date('Y-m-d') . ".csv";

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$filename",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = ['ID / Deskripsi', 'Kategori', 'Tanggal', 'Nominal', 'Tipe'];

        $callback = function() use($pembayaran, $pengeluaran, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($pembayaran as $item) {
                $deskripsi = ($item->user->name ?? 'User') . ' membayar kas';
                $kategori = $item->tagihan->nama_tagihan ?? 'Kas Masuk';
                $tanggal = \Carbon\Carbon::parse($item->tanggal_bayar)->format('Y-m-d H:i');
                fputcsv($file, [$deskripsi, $kategori, $tanggal, $item->jml_bayar, 'Masuk']);
            }

            foreach ($pengeluaran as $item) {
                $kategori = 'Umum';
                $tanggal = \Carbon\Carbon::parse($item->tanggal)->format('Y-m-d H:i');
                fputcsv($file, [$item->keterangan, $kategori, $tanggal, $item->nominal, 'Keluar']);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    // =========================
    // SETTINGS
    // =========================
    public function settings()
    {
        return view('bendahara.pengaturan');
    }
}
