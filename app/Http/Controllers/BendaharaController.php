<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pembayaran;
use App\Models\Pengeluaran;
use App\Models\Tagihan;
use App\Models\User; 
use Illuminate\Support\Facades\DB; 

class BendaharaController extends Controller
{
    // =========================
    // DASHBOARD
    // =========================
    public function dashboard()
    {
        $totalMasuk = Pembayaran::sum('jml_bayar') ?? 0;
        $totalKeluar = Pengeluaran::sum('nominal') ?? 0;

        $saldoAwal = 1000000;
        $saldoKas = $totalMasuk - $totalKeluar;
        $saldoAkhir = $saldoAwal + $saldoKas;

        $jumlahTransaksi =
            Pembayaran::count() +
            Pengeluaran::count();

        return view('bendahara.dashboard', compact(
            'totalMasuk',
            'totalKeluar',
            'saldoKas',
            'saldoAwal',
            'saldoAkhir',
            'jumlahTransaksi'
        ));
    }

    // =========================
    // KAS MASUK
    // =========================
    public function kasMasuk()
    {
        $totalMasuk = Pembayaran::sum('jml_bayar') ?? 0;
        $totalKeluar = Pengeluaran::sum('nominal') ?? 0;

        $saldoAwal = 1000000;
        $saldoKas = $totalMasuk - $totalKeluar;
        $saldoAkhir = $saldoAwal + $saldoKas;

        $jumlahTransaksi =
            Pembayaran::count() +
            Pengeluaran::count();

        $pembayaran = Pembayaran::latest()->get();

        return view('bendahara.kas_masuk', compact(
            'totalMasuk',
            'totalKeluar',
            'saldoKas',
            'saldoAwal',
            'saldoAkhir',
            'jumlahTransaksi',
            'pembayaran'
        ));
    }

    // =========================
    // KAS KELUAR
    // =========================
    public function kasKeluar()
    {
        $totalKeluar = Pengeluaran::sum('nominal') ?? 0;

        $pengeluaran = Pengeluaran::latest()->get();

        return view('bendahara.kas_keluar', compact(
            'pengeluaran',
            'totalKeluar'
        ));
    }

    // =========================
    // TRANSAKSI
    // =========================
    public function transaksi()
    {
        $pembayaran = Pembayaran::latest()->get();
        $pengeluaran = Pengeluaran::latest()->get();

        return view('bendahara.transaksi', compact(
            'pembayaran',
            'pengeluaran'
        ));
    }

    // =========================
    // TAGIHAN
    // =========================

    // halaman daftar tagihan
    // halaman daftar tagihan
    public function tagihan()
    {
        // Ubah dari latest()->get() menjadi orderBy('id', 'desc')->get()
        $tagihan = Tagihan::orderBy('id', 'desc')->get();

        return view('bendahara.tagihan', compact('tagihan'));
    }

    // halaman tambah tagihan
    public function createTagihan()
    {
        return view('bendahara.tambah_tagihan');
    }

    // === DI SINI BAGIAN YANG DIUBAH TOTAL ===
    // simpan tagihan sekaligus membagikannya ke seluruh siswa
    // simpan tagihan sekaligus membagikannya ke seluruh siswa
    public function storeTagihan(Request $request)
    {
        $request->validate([
            'nama_tagihan' => 'required',
            'periode'      => 'required|date',
            'nominal'      => 'required|numeric',
            'batas_bayar'  => 'required|date',
            'deskripsi'    => 'nullable'
        ]);

        // Menggunakan DB Transaction agar aman
        DB::transaction(function () use ($request) {
            
            // 1. Membuat data induk di tabel tagihan
            $tagihan = Tagihan::create([
                'user_id'      => auth()->id(),
                'created_by'   => auth()->id(),
                'nama_tagihan' => $request->nama_tagihan,
                'periode'      => $request->periode,
                'nominal'      => $request->nominal,
                'batas_bayar'  => $request->batas_bayar,
                'deskripsi'    => $request->deskripsi,
            ]);

            // 2. Mengambil semua data user dengan role siswa
            $paraSiswa = User::where('role', 'siswa')->get();

            // 3. Looping untuk memasukkan tagihan ke tiap siswa di tabel jembatan
            foreach ($paraSiswa as $siswa) {
                DB::table('tunggakan')->insert([
                    'tagihan_id' => $tagihan->id,
                    'user_id'    => $siswa->id,
                    'status'     => 'belum_bayar',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }); // <-- Di sini penutup DB::transaction yang bikin merah tadi

        return redirect()
            ->route('bendahara.tagihan')
            ->with('success', 'Tagihan berhasil dibuat dan langsung dikirim ke seluruh siswa!');
    }

    // hapus tagihan
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
        $totalMasuk = Pembayaran::sum('jml_bayar') ?? 0;
        $totalKeluar = Pengeluaran::sum('nominal') ?? 0;

        $saldoAkhir = $totalMasuk - $totalKeluar;

        $pembayaran = Pembayaran::latest()->get();
        $pengeluaran = Pengeluaran::latest()->get();

        return view('bendahara.laporan', compact(
            'totalMasuk',
            'totalKeluar',
            'saldoAkhir',
            'pembayaran',
            'pengeluaran'
        ));
    }

    // =========================
    // SETTINGS
    // =========================
    public function settings()
    {
        return view('bendahara.settings');
    }
}