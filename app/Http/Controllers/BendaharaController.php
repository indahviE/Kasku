<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BendaharaController extends Controller
{
    // Dashboard Bendahara
    public function dashboard()
    {
        return view('bendahara.dashboard');
    }

    // Kas Masuk
    public function kasMasuk()
    {
        return view('bendahara.kas-masuk');
    }

    // Kas Keluar
    public function kasKeluar()
    {
        return view('bendahara.kas-keluar');
    }

    // Laporan
    public function laporan()
    {
        return view('bendahara.laporan');
    }

    // Transaksi
    public function transaksi()
    {
        return view('bendahara.transaksi');
    }

    // Settings
    public function settings()
    {
        return view('bendahara.settings');
    }
}