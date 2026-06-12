<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Siswa;
use App\Models\Pembayaran;
use App\Models\Pengeluaran;
use App\Models\Tagihan;
use App\Models\Notifications;
use App\Models\Diskusi;
use App\Models\Pengumuman;

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

        $today = today();

        if ($tunggakan > 0) {
            $cekNotifTunggakan = Notifications::where('user_id', $user->id)
                ->where('title', 'Menunggak Pembayaran')
                ->whereDate('created_at', $today)
                ->exists();

            if (!$cekNotifTunggakan) {
                Notifications::create([
                    'user_id'     => $user->id,
                    'title'       => 'Menunggak Pembayaran',
                    'message'     => 'Kamu masih memiliki tagihan uang kas yang belum dilunasi.',
                    'target_type' => 'personal',
                    'is_read'     => false,
                    'created_at'  => $today
                ]);
            }
        }

        $deadlineDekat = Tagihan::where('user_id', $user->id)
            ->whereDate('batas_bayar', '<=', now()->addDays(3))
            ->whereDate('batas_bayar', '>=', now())
            ->exists();

        if ($deadlineDekat) {
            $cekNotifDeadline = Notifications::where('user_id', $user->id)
                ->where('title', 'Deadline Pembayaran Dekat')
                ->whereDate('created_at', $today)
                ->exists();

            if (!$cekNotifDeadline) {
                Notifications::create([
                    'user_id'     => $user->id,
                    'title'       => 'Deadline Pembayaran Dekat',
                    'message'     => 'Segera lakukan pembayaran sebelum batas deadline berakhir.',
                    'target_type' => 'personal',
                    'is_read'     => false,
                    'created_at'  => $today
                ]);
            }
        }

        if (Tagihan::where('user_id', $user->id)->whereDate('created_at', $today)->exists()) {
            $cekNotifTagihanBaru = Notifications::where('user_id', $user->id)
                ->where('title', 'Ada Tagihan Baru')
                ->whereDate('created_at', $today)
                ->exists();

            if (!$cekNotifTagihanBaru) {
                Notifications::create([
                    'user_id'     => $user->id,
                    'title'       => 'Ada Tagihan Baru',
                    'message'     => 'Tagihan kas baru telah ditambahkan, silahkan periksa menu tagihan.',
                    'target_type' => 'personal',
                    'is_read'     => false,
                    'created_at'  => $today
                ]);
            }
        }

        if (\App\Models\Tunggakan::where('user_id', $user->id)->where('status', 'belum_bayar')->whereDate('created_at', $today)->exists()) {
            $cekNotifTunggakanBaru = Notifications::where('user_id', $user->id)
                ->where('title', 'Ada Tunggakan Baru')
                ->whereDate('created_at', $today)
                ->exists();

            if (!$cekNotifTunggakanBaru) {
                Notifications::create([
                    'user_id'     => $user->id,
                    'title'       => 'Ada Tunggakan Baru',
                    'message'     => 'Kamu memiliki daftar tunggakan kas baru yang harus segera dilunasi. Silakan cek menu Tunggakan.',
                    'target_type' => 'personal',
                    'is_read'     => false,
                    'created_at'  => $today
                ]);
            }
        }

        if (Pembayaran::where('user_id', $user->id)->where('status', 'nunggak')->whereDate('created_at', $today)->exists()) {
            $cekNotifTungguVerif = Notifications::where('user_id', $user->id)
                ->where('title', 'Menunggu Verifikasi')
                ->whereDate('created_at', $today)
                ->exists();

            if (!$cekNotifTungguVerif) {
                Notifications::create([
                    'user_id'     => $user->id,
                    'title'       => 'Menunggu Verifikasi',
                    'message'     => 'Transaksi berhasil dikirim! Silakan tunggu konfirmasi dan verifikasi dari Bendahara.',
                    'target_type' => 'personal',
                    'is_read'     => false,
                    'created_at'  => $today
                ]);
            }
        }

        if (Pembayaran::where('user_id', $user->id)->where('status', 'lunas')->whereDate('updated_at', $today)->exists()) {
            $cekNotifLunas = Notifications::where('user_id', $user->id)
                ->where('title', 'Pembayaran Berhasil')
                ->whereDate('created_at', $today)
                ->exists();

            if (!$cekNotifLunas) {
                Notifications::create([
                    'user_id'     => $user->id,
                    'title'       => 'Pembayaran Berhasil',
                    'message'     => 'Pembayaran kas kamu berhasil dikonfirmasi dan dinyatakan Lunas oleh bendahara.',
                    'target_type' => 'personal',
                    'is_read'     => false,
                    'created_at'  => $today
                ]);
            }
        }

        if (Pembayaran::where('user_id', $user->id)->where('status', 'ditolak')->whereDate('updated_at', $today)->exists()) {
            $cekNotifDitolak = Notifications::where('user_id', $user->id)
                ->where('title', 'Pembayaran Ditolak')
                ->whereDate('created_at', $today)
                ->exists();

            if (!$cekNotifDitolak) {
                Notifications::create([
                    'user_id'     => $user->id,
                    'title'       => 'Pembayaran Ditolak',
                    'message'     => 'Pembayaran kamu ditolak. Silakan upload ulang bukti pembayaran yang valid.',
                    'target_type' => 'personal',
                    'is_read'     => false,
                    'created_at'  => $today
                ]);
            }
        }

        $notifications = Notifications::where(function ($query) use ($user) {
                $query->where('user_id', $user->id)->orWhere('target_type', 'global');
            })
            ->latest()->take(10)->get();

        $unreadCount = Notifications::where(function ($query) use ($user) {
                $query->where('user_id', $user->id)->orWhere('target_type', 'global');
            })
            ->where('is_read', false)->count();

        return view('siswa.index', compact(
            'siswa',
            'saldoKas',
            'kasMasuk',
            'kasKeluar',
            'riwayat',
            'tunggakan',
            'notifications', 
            'unreadCount'    
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
    // Mengambil ID user/siswa yang sedang login (ID: 36)
    $siswaId = auth()->user()->id; 

    $tunggakan = \App\Models\Tunggakan::with(['tagihan'])
        ->where('user_id', $siswaId) 
        ->get()
        ->filter(function ($item) use ($siswaId) {
            
            // Cek apakah siswa sudah upload bukti/bayar dan statusnya 'pending'
            $pembayaranPending = \App\Models\Pembayaran::where('tagihan_id', $item->tagihan_id)
                ->where('user_id', $siswaId) 
                ->where('status', 'pending')
                ->exists();

            // KUNCINYA DI SINI: 
            // Jika ada pembayaran yang pending, kembalikan false (artinya tagihan ini dibuang/diemajukan dari daftar)
            return !$pembayaranPending;
        });

    return view('siswa.tunggakan', compact('tunggakan')); 
}
    public function detailTagihan($id)
    {
        $tunggakanItem = \App\Models\Tunggakan::with('tagihan')
            ->where('user_id', Auth::user()->id)
            ->findOrFail($id);

        $tagihan = $tunggakanItem->tagihan;

        $pembayaran = Pembayaran::where('tagihan_id', $tagihan->id)
            ->where('user_id', Auth::user()->id)
            ->first();

        $lunas = $tunggakanItem->status === 'lunas';

        return view('siswa.detail-tunggakan', compact(
            'tagihan',
            'pembayaran',
            'lunas'
        ));
    }

    public function laporanKas()
    {
        $kasMasuk = Pembayaran::where('status', 'lunas')->sum('jml_bayar');

        $kasKeluar = Pengeluaran::sum('nominal');

        $saldoAkhir = $kasMasuk - $kasKeluar;

        $saldoAwal = 0; 

        $riwayatPemasukan = Pembayaran::with('siswa')
            ->where('status', 'lunas')
            ->latest()
            ->get();

        $riwayatPengeluaran = Pengeluaran::latest()->get();

        return view('siswa.laporan_kas', compact(
            'saldoAwal',
            'kasMasuk',       
            'kasKeluar',      
            'saldoAkhir',
            'riwayatPemasukan',
            'riwayatPengeluaran'
        ));
    }

    public function pembayaran()
    {
        $user = Auth::user();

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
            'tagihan_id'    => $request->tagihan_id,
            'user_id'       => Auth::id(),
            'dicatat_oleh'  => Auth::id(),
            'jml_bayar'     => $request->jml_bayar,
            'tanggal_bayar' => now()->format('Y-m-d'),
            'metode'        => $request->metode,
            'status'        => 'pending',
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

    public function readNotification($id)
    {
        Notifications::where('id', $id)
            ->where(function($query) {
                $query->where('user_id', Auth::id())->orWhere('target_type', 'global');
            })
            ->firstOrFail()
            ->update(['is_read' => true]);

        return back();
    }

    public function search(Request $request)
{
    $keyword = $request->q;

    $tagihan = Tagihan::where('user_id', auth()->id())
    ->where(function ($query) use ($keyword) {

        $query->where('nama_tagihan', 'like', "%{$keyword}%")
              ->orWhere('periode', 'like', "%{$keyword}%");

    })
    ->get();

    $pembayaran = Pembayaran::with('tagihan')
        ->where('user_id', auth()->id())
        ->where(function ($query) use ($keyword) {

            $query->where('metode', 'like', "%{$keyword}%")
                  ->orWhere('status', 'like', "%{$keyword}%")
                  ->orWhereHas('tagihan', function ($q) use ($keyword) {

                        $q->where(
                            'nama_tagihan',
                            'like',
                            "%{$keyword}%"
                        );

                  });

        })
        ->latest()
        ->get();

    return response()->json([
        'tagihan' => $tagihan,
        'pembayaran' => $pembayaran,
    ]);
}

    public function allNotifications()
    {
        $user = Auth::user();

        $allNotifications = Notifications::where(function ($query) use ($user) {
                $query->where('user_id', $user->id)->orWhere('target_type', 'global');
            })
            ->latest()
            ->get();

        $unreadCount = Notifications::where(function ($query) use ($user) {
                $query->where('user_id', $user->id)->orWhere('target_type', 'global');
            })
            ->where('is_read', false)
            ->count();

        return view('siswa.notifikasi', compact('allNotifications', 'unreadCount'));
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}