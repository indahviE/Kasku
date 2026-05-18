<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Siswa;
use App\Models\Pembayaran;
use App\Models\Pengeluaran;
use App\Models\Tagihan;

class SiswaController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $siswa = Siswa::where('user_id', $user->id)->first();

        if (!$siswa) {
            return "Data profil siswa tidak ditemukan. Pastikan seeder sudah dijalankan.";
        }

        $kasMasuk = Pembayaran::where('status', 'success')->sum('jml_bayar');

        $kasKeluar = Pengeluaran::sum('nominal');

        $saldoKas = $kasMasuk - $kasKeluar;

        $riwayat = Pembayaran::where('user_id', $user->id)
            ->latest()
            ->take(5)
            ->get();

        $totalTagihanKelas = Tagihan::where('user_id', $siswa->kelas_id)->sum('nominal');
        $totalSudahBayar = Pembayaran::where('user_id', $user->id)
            ->where('status', 'success')
            ->sum('jml_bayar');

        $tunggakan = $totalTagihanKelas - $totalSudahBayar;

        return view('siswa.index', compact(
            'siswa', 'saldoKas', 'kasMasuk', 'kasKeluar', 'riwayat', 'tunggakan'
        ));
    }

    public function riwayat()
    {
        $riwayat = Pembayaran::where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('siswa.riwayat', compact('riwayat'));
    }

    public function tunggakan()
    {
        $user = Auth::user();
        $siswa = Siswa::where('user_id', $user->id)->first();

        $tunggakan = Tagihan::where('kelas_id', $siswa->kelas_id)->get();

        return view('siswa.tunggakan', compact('tunggakan'));
    }

    public function laporanKas()
    {
        $laporan = Pembayaran::where('status', 'success')
            ->latest()
            ->get();

        return view('siswa.laporan_kas', compact('laporan'));
    }

     public function pembayaran()
{
    $user = Auth::user();

    $semuaTagihan = Tagihan::where('user_id', $user->id)
        ->orderBy('periode', 'asc')
        ->get();

    $sudahDibayar = Pembayaran::where('user_id', $user->id)
        ->pluck('tagihan_id')
        ->toArray();

    $tagihanBelumBayar = $semuaTagihan->whereNotIn('id', $sudahDibayar);

    $data_pembayaran = Pembayaran::where('user_id', $user->id)
        ->latest()
        ->get();

    return view('siswa.pembayaran', compact(
        'tagihanBelumBayar',
        'data_pembayaran'
    ));
}

    public function simpanPembayaran(Request $request)
    {
        $request->validate([
            'tagihan_id' => 'required|exists:tagihan,id',
            'jml_bayar' => 'required|numeric|min:1',
            'metode' => 'required|in:tunai,transfer',
            'bukti_bayar' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $pathBukti = $request->file('bukti_bayar')
            ->store('bukti_pembayaran', 'public');

        Pembayaran::create([
            'tagihan_id'    => $request->tagihan_id,
            'user_id'       => Auth::id(),
            'jml_bayar'     => $request->jml_bayar,
            'tanggal_bayar' => now(),
            'metode'        => $request->metode,
            'status'        => 'belum',
            'bukti_bayar'   => $pathBukti,
        ]);

        return redirect()
            ->route('siswa.riwayat')
            ->with('success', 'Pembayaran berhasil dikirim!');
    }

    public function detailPembayaran($id)
    {
        $pembayaran = Pembayaran::where('user_id', Auth::id())
            ->findOrFail($id);

        return view('siswa.detail_pembayaran', compact('pembayaran'));
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
