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
        // Ambil data profil siswa agar kita tahu dia kelas mana
        $siswa = Siswa::where('user_id', $user->id)->first();

        // Cek jika data siswa tidak ada agar tidak error
        if (!$siswa) {
            return "Data profil siswa tidak ditemukan. Pastikan seeder sudah dijalankan.";
        }

        // KAS MASUK: Dari tabel pembayaran (pastikan kolomnya jml_bayar sesuai kodemu)
        $kasMasuk = Pembayaran::where('status', 'success')->sum('jml_bayar');

        // KAS KELUAR: SESUAI SCREENSHOT, kolomnya adalah 'nominal'
        $kasKeluar = Pengeluaran::sum('nominal');

        $saldoKas = $kasMasuk - $kasKeluar;

        // RIWAYAT: Gunakan user_id (atau siswa_id, sesuaikan dengan tabel pembayaran)
        $riwayat = Pembayaran::where('user_id', $user->id)
            ->latest()
            ->take(5)
            ->get();

        // TUNGGAKAN: SESUAI SCREENSHOT, tagihan tidak punya user_id tapi punya kelas_id
        // Logika: Total Tagihan di kelas tersebut - Total yang sudah dibayar siswa ini
        $totalTagihanKelas = Tagihan::where('kelas_id', $siswa->kelas_id)->sum('nominal');
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

        // Ambil daftar tagihan berdasarkan kelas si siswa
        $tunggakan = Tagihan::where('kelas_id', $siswa->kelas_id)->get();

        return view('siswa.tunggakan', compact('tunggakan'));
    }

    public function laporanKas()
    {
        // Gabungkan data pembayaran (masuk) dan pengeluaran (keluar) jika perlu, 
        // tapi ini simpelnya ambil riwayat kas masuk saja
        $laporan = Pembayaran::where('status', 'success')
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
            'jml_bayar' => 'required|numeric',
            'metode_pembayaran' => 'required',
            'bukti_pembayaran' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $bukti = $request->file('bukti_pembayaran')
            ->store('bukti_pembayaran', 'public');

        Pembayaran::create([
            'user_id' => Auth::id(),
            'jml_bayar' => $request->jml_bayar,
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