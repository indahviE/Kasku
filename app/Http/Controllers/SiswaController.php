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
            return redirect('/')->with('error', 'Profil siswa tidak ditemukan. Silakan hubungi admin.');
        }

        $kasMasuk = Pembayaran::where('status', 'lunas')->sum('jml_bayar');
        $kasKeluar = Pengeluaran::sum('nominal');
        $saldoKas = $kasMasuk - $kasKeluar;

        $riwayat = Pembayaran::where('user_id', $user->id)
            ->latest()
            ->take(5)
            ->get();

        $totalTagihanSiswa = Tagihan::where('user_id', $user->id)->sum('nominal');

        $totalSudahBayar = Pembayaran::where('user_id', $user->id)
            ->where('status', 'lunas')
            ->sum('jml_bayar');

        $tunggakan = $totalTagihanSiswa - $totalSudahBayar;

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
        $riwayat = Pembayaran::where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('siswa.riwayat', compact('riwayat'));
    }

    public function tunggakan()
    {
        $user = Auth::user();

        $tunggakan = Tagihan::where('user_id', $user->id)

            // Hilangkan tagihan yang SUDAH pernah dibayar
            ->whereDoesntHave('pembayaran', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })

            ->with(['pembayaran' => function ($query) use ($user) {
                $query->where('user_id', $user->id);
            }])

            ->orderBy('periode', 'desc')
            ->get();

        return view('siswa.tunggakan', compact('tunggakan'));
    }

    public function detailTagihan($id)
    {

        $tagihan = Tagihan::findOrFail($id);

        $pembayaran = Pembayaran::where('tagihan_id', $tagihan->id)
            ->where('user_id', auth()->id())
            ->first();

        $lunas = $pembayaran ? true : false;

        return view('siswa.detail-tunggakan', compact(
            'tagihan',
            'pembayaran',
            'lunas'
        ));
    }

    public function laporanKas()
    {
        $laporan = Pembayaran::where('status', 'lunas')
            ->latest()
            ->get();

        return view('siswa.laporan_kas', compact('laporan'));
    }

    public function pembayaran()
    {
        $user = Auth::user();

        // Tagihan yang belum pernah dibayar
        $sudahDibayar = Pembayaran::where('user_id', $user->id)
            ->whereNotNull('tagihan_id')
            ->pluck('tagihan_id')
            ->toArray();

        $tagihanBelumBayar = Tagihan::where('user_id', $user->id)
            ->whereNotIn('id', $sudahDibayar)
            ->orderBy('periode', 'asc')
            ->get();

        $data_pembayaran = Pembayaran::where('user_id', $user->id)
            ->latest()
            ->get();

        return view('siswa.transaksi', compact(
            'tagihanBelumBayar',
            'data_pembayaran'
        ));
    }

    public function simpanPembayaran(Request $request)
    {
        $request->validate([
            'tagihan_id'  => 'nullable|exists:tagihan,id',
            'jml_bayar'   => 'required|numeric|min:1',
            'metode'      => 'required|in:tunai,transfer',
            'bukti_bayar' => 'required_if:metode,transfer|image|mimes:jpg,jpeg,png|max:2048',
        ], [
            'bukti_bayar.required_if' => 'Bukti pembayaran wajib diunggah jika memilih metode Transfer.',
            'jml_bayar.required'      => 'Jumlah pembayaran tidak boleh kosong.'
        ]);

        $namaFile = null;

        if ($request->hasFile('bukti_bayar')) {
            $pathBukti = $request->file('bukti_bayar')
                ->store('bukti_pembayaran', 'public');

            $namaFile = basename($pathBukti);
        }

        Pembayaran::create([
            // Bisa NULL kalau bayar langsung/manual
            'tagihan_id'    => $request->tagihan_id,

            'user_id'       => Auth::id(),
            'dicatat_oleh'  => Auth::id(),

            'jml_bayar'     => $request->jml_bayar,

            'tanggal_bayar' => now()->format('Y-m-d'),

            'metode'        => $request->metode,

            // pending / nunggak / lunas bebas nanti bendahara ubah
            'status'        => 'nunggak',

            'bukti_bayar'   => $namaFile,
        ]);

        return redirect()
            ->route('siswa.riwayat')
            ->with('success', 'Pembayaran berhasil dikirim!');
    }

    public function detailPembayaran($id)
    {
        $pembayaran = Pembayaran::where('user_id', Auth::id())
            ->findOrFail($id);

        return view('siswa.detail_transaksi', compact('pembayaran'));
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}