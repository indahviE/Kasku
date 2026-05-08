<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Siswa;
use App\Models\Transaksi;

class SiswaController extends Controller
{

    public function index()
    {
        $user = Auth::user();

        // Ambil data siswa
        $siswa = Siswa::where('user_id', $user->id)->first();

        // Total kas masuk
        $kasMasuk = Transaksi::where('jenis', 'masuk')
            ->where('status', 'success')
            ->sum('jumlah');

        $kasKeluar = Transaksi::where('jenis', 'keluar')
            ->where('status', 'success')
            ->sum('jumlah');

        $saldoKas = $kasMasuk - $kasKeluar;

        $riwayat = Transaksi::where('user_id', $user->id)
            ->latest()
            ->take(5)
            ->get();

        $tunggakan = Transaksi::where('user_id', $user->id)
            ->where('status', 'belum_bayar')
            ->sum('jumlah');

        return view('siswa.index', compact(
            'siswa',
            'saldoKas',
            'kasMasuk',
            'kasKeluar',
            'riwayat',
            'tunggakan'
        ));
    }

    public function riwayat()
    {
        $riwayat = Transaksi::where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('siswa.riwayat', compact('riwayat'));
    }

    public function tunggakan()
    {
        $tunggakan = Transaksi::where('user_id', Auth::id())
            ->where('status', 'belum_bayar')
            ->get();

        return view('siswa.tunggakan', compact('tunggakan'));
    }

    public function laporanKas()
    {
        $laporan = Transaksi::where('status', 'success')
            ->latest()
            ->get();

        return view('siswa.laporan_kas', compact('laporan'));
    }

    public function pembayaran()
    {
        return view('siswa.pembayaran');
    }

    public function simpanPembayaran(Request $request)
    {
        $request->validate([
            'jumlah' => 'required|numeric',
            'metode_pembayaran' => 'required',
            'bukti_pembayaran' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $bukti = $request->file('bukti_pembayaran')
            ->store('bukti_pembayaran', 'public');

        Transaksi::create([
            'user_id' => Auth::id(),
            'jumlah' => $request->jumlah,
            'jenis' => 'masuk',
            'metode_pembayaran' => $request->metode_pembayaran,
            'bukti_pembayaran' => $bukti,
            'status' => 'menunggu_verifikasi',
        ]);

        return redirect()
            ->route('siswa.riwayat')
            ->with('success', 'Pembayaran berhasil dikirim!');
    }

    public function detailPembayaran($id)
    {
        $transaksi = Transaksi::where('user_id', Auth::id())
            ->findOrFail($id);

        return view('siswa.detail_pembayaran', compact('transaksi'));
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}