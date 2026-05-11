<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pembayaran;
use App\Models\Pengeluaran;

class BendaharaController extends Controller
{
    public function dashboard()
    {
        return view('bendahara.dashboard');
    }

    public function kasMasuk()
    {
        $totalMasuk = Pembayaran::sum('jml_bayar') ?? 0;
        $totalKeluar = Pengeluaran::sum('nominal') ?? 0;
        $saldoAwal = 1000000;
        $saldoKas = $totalMasuk - $totalKeluar;
        $saldoAkhir = $saldoAwal + $saldoKas;
        $jumlahTransaksi = Pembayaran::count() + Pengeluaran::count();

        return view('bendahara.kas_masuk', compact(
            'totalMasuk', 'totalKeluar', 'saldoKas',
            'saldoAwal', 'saldoAkhir', 'jumlahTransaksi'
        ));
    }

    public function kasKeluar()
    {
        $totalKeluar = Pengeluaran::sum('nominal') ?? 0;
        $pengeluaran = Pengeluaran::latest()->get();

        return view('bendahara.kas_keluar', compact('pengeluaran', 'totalKeluar'));
    }

    public function laporan()
    {
        return view('bendahara.laporan');
    }

    public function transaksi()
    {
        return view('bendahara.transaksi');
    }

    public function settings()
    {
        return view('bendahara.settings');
    }
}