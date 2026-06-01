<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Notification;
use App\Models\Tagihan;
use App\Models\Pembayaran;
use App\Models\Diskusi;
use App\Models\Pengumuman;

class NotificationController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        $today = today();

        // 1. Cek Tunggakan
        $tunggakan = Tagihan::where('user_id', $user->id)
            ->where('status', 'belum_bayar')
            ->exists();

        if ($tunggakan) {
            $sudahAda = Notification::where('user_id', $user->id)
                ->where('title', 'Menunggak Pembayaran')
                ->whereDate('created_at', $today)
                ->exists();

            if (!$sudahAda) {
                Notification::create([
                    'user_id'     => $user->id,
                    'title'       => 'Menunggak Pembayaran',
                    'message'     => 'Kamu masih memiliki tagihan uang kas yang belum dibayar.',
                    'target_type' => 'personal',
                    'is_read'     => false
                ]);
            }
        }

        // 2. Cek Batas Waktu / Deadline
        $deadline = Tagihan::where('user_id', $user->id)
            ->where('status', 'belum_bayar')
            ->whereDate('deadline', '<=', now()->addDays(3))
            ->whereDate('deadline', '>=', now())
            ->exists();

        if ($deadline) {
            $sudahAda = Notification::where('user_id', $user->id)
                ->where('title', 'Deadline Pembayaran Dekat')
                ->whereDate('created_at', $today)
                ->exists();

            if (!$sudahAda) {
                Notification::create([
                    'user_id'     => $user->id,
                    'title'       => 'Deadline Pembayaran Dekat',
                    'message'     => 'Segera lakukan pembayaran sebelum batas deadline berakhir.',
                    'target_type' => 'personal',
                    'is_read'     => false
                ]);
            }
        }

        // 3. Cek Tagihan Baru
        $tagihanBaru = Tagihan::where('user_id', $user->id)
            ->whereDate('created_at', $today)
            ->exists();

        if ($tagihanBaru) {
            $sudahAda = Notification::where('user_id', $user->id)
                ->where('title', 'Ada Tagihan Baru')
                ->whereDate('created_at', $today)
                ->exists();

            if (!$sudahAda) {
                Notification::create([
                    'user_id'     => $user->id,
                    'title'       => 'Ada Tagihan Baru',
                    'message'     => 'Tagihan kas baru telah ditambahkan, silahkan periksa menu tagihan.',
                    'target_type' => 'personal',
                    'is_read'     => false
                ]);
            }
        }

        // 4. Cek Konfirmasi Pembayaran Berhasil
        $pembayaranBerhasil = Pembayaran::where('user_id', $user->id)
            ->where('status', 'diterima')
            ->whereDate('updated_at', $today)
            ->exists();

        if ($pembayaranBerhasil) {
            $sudahAda = Notification::where('user_id', $user->id)
                ->where('title', 'Pembayaran Berhasil')
                ->whereDate('created_at', $today)
                ->exists();

            if (!$sudahAda) {
                Notification::create([
                    'user_id'     => $user->id,
                    'title'       => 'Pembayaran Berhasil',
                    'message'     => 'Pembayaran kas kamu berhasil dikonfirmasi oleh bendahara.',
                    'target_type' => 'personal',
                    'is_read'     => false
                ]);
            }
        }

        // 5. Cek Pembayaran Ditolak
        $pembayaranDitolak = Pembayaran::where('user_id', $user->id)
            ->where('status', 'ditolak')
            ->whereDate('updated_at', $today)
            ->exists();

        if ($pembayaranDitolak) {
            $sudahAda = Notification::where('user_id', $user->id)
                ->where('title', 'Pembayaran Ditolak')
                ->whereDate('created_at', $today)
                ->exists();

            if (!$sudahAda) {
                Notification::create([
                    'user_id'     => $user->id,
                    'title'       => 'Pembayaran Ditolak',
                    'message'     => 'Pembayaran kamu ditolak. Silakan upload ulang bukti pembayaran yang valid.',
                    'target_type' => 'personal',
                    'is_read'     => false
                ]);
            }
        }

        // 6. Cek Diskusi Global Baru
        $diskusiBaru = Diskusi::whereDate('created_at', $today)->exists();
        if ($diskusiBaru) {
            $sudahAda = Notification::where('title', 'Diskusi Baru')
                ->whereDate('created_at', $today)
                ->exists();

            if (!$sudahAda) {
                Notification::create([
                    'title'       => 'Diskusi Baru',
                    'message'     => 'Ada ruang diskusi baru mengenai rencana alokasi uang kas.',
                    'target_type' => 'global',
                    'is_read'     => false
                ]);
            }
        }

        // 7. Cek Pengumuman Global Baru
        $pengumumanBaru = Pengumuman::whereDate('created_at', $today)->exists();
        if ($pengumumanBaru) {
            $sudahAda = Notification::where('title', 'Pengumuman Baru')
                ->whereDate('created_at', $today)
                ->exists();

            if (!$sudahAda) {
                Notification::create([
                    'title'       => 'Pengumuman Baru',
                    'message'     => 'Ada informasi pengumuman terbaru dari bendahara kelas.',
                    'target_type' => 'global',
                    'is_read'     => false
                ]);
            }
        }

        // Ambil list notifikasi gabungan (Personal & Global)
        $notifications = Notification::where(function ($query) use ($user) {
                $query->where('user_id', $user->id)
                      ->orWhere('target_type', 'global');
            })
            ->latest()
            ->take(10)
            ->get();

        // Hitung jumlah notifikasi yang belum dibaca
        $unreadCount = Notification::where(function ($query) use ($user) {
                $query->where('user_id', $user->id)
                      ->orWhere('target_type', 'global');
            })
            ->where('is_read', false)
            ->count();

        // Diarahkan ke view 'siswa.dashboard' sesuai struktur folder dan variabel Anda
        return view('siswa.dashboard', compact(
            'notifications',
            'unreadCount'
        ));
    }

    public function readNotification($id)
    {
        $notification = Notification::where('id', $id)
            ->where(function($query) {
                $query->where('user_id', Auth::id())
                      ->orWhere('target_type', 'global');
            })
            ->firstOrFail();

        $notification->update([
            'is_read' => true
        ]);

        return back();
    }
}