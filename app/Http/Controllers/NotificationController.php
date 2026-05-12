<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Notification;
use App\Models\Tagihan;
use App\Models\Pembayaran;
use App\Models\Diskusi;
use App\Models\Pengumuman;

class SiswaController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();


        $tunggakan = Tagihan::where('user_id', $user->id)
            ->where('status', 'belum_bayar')
            ->exists();

        if ($tunggakan) {

            $sudahAda = Notification::where('user_id', $user->id)
                ->where('title', 'Menunggak Pembayaran')
                ->exists();

            if (!$sudahAda) {

                Notification::create([
                    'user_id' => $user->id,
                    'title' => 'Menunggak Pembayaran',
                    'message' => 'Kamu masih memiliki tagihan yang belum dibayar.',
                    'target_type' => 'personal',
                ]);
            }
        }


        $deadline = Tagihan::where('user_id', $user->id)
            ->whereDate('deadline', '<=', now()->addDays(3))
            ->where('status', 'belum_bayar')
            ->exists();

        if ($deadline) {

            $sudahAda = Notification::where('user_id', $user->id)
                ->where('title', 'Deadline Pembayaran Dekat')
                ->exists();

            if (!$sudahAda) {

                Notification::create([
                    'user_id' => $user->id,
                    'title' => 'Deadline Pembayaran Dekat',
                    'message' => 'Segera lakukan pembayaran sebelum deadline.',
                    'target_type' => 'personal',
                ]);
            }
        }


        $tagihanBaru = Tagihan::where('user_id', $user->id)
            ->latest()
            ->first();

        if ($tagihanBaru) {

            $sudahAda = Notification::where('user_id', $user->id)
                ->where('title', 'Ada Tagihan Baru')
                ->whereDate('created_at', today())
                ->exists();

            if (!$sudahAda) {

                Notification::create([
                    'user_id' => $user->id,
                    'title' => 'Ada Tagihan Baru',
                    'message' => 'Tagihan baru telah ditambahkan.',
                    'target_type' => 'personal',
                ]);
            }
        }


        $pembayaranBerhasil = Pembayaran::where('user_id', $user->id)
            ->where('status', 'diterima')
            ->latest()
            ->first();

        if ($pembayaranBerhasil) {

            $sudahAda = Notification::where('user_id', $user->id)
                ->where('title', 'Pembayaran Berhasil')
                ->whereDate('created_at', today())
                ->exists();

            if (!$sudahAda) {

                Notification::create([
                    'user_id' => $user->id,
                    'title' => 'Pembayaran Berhasil',
                    'message' => 'Pembayaran kamu berhasil dikonfirmasi.',
                    'target_type' => 'personal',
                ]);
            }
        }


        $pembayaranDitolak = Pembayaran::where('user_id', $user->id)
            ->where('status', 'ditolak')
            ->latest()
            ->first();

        if ($pembayaranDitolak) {

            $sudahAda = Notification::where('user_id', $user->id)
                ->where('title', 'Pembayaran Ditolak')
                ->whereDate('created_at', today())
                ->exists();

            if (!$sudahAda) {

                Notification::create([
                    'user_id' => $user->id,
                    'title' => 'Pembayaran Ditolak',
                    'message' => 'Pembayaran kamu ditolak, silakan upload ulang.',
                    'target_type' => 'personal',
                ]);
            }
        }


        $diskusiBaru = Diskusi::latest()->first();

        if ($diskusiBaru) {

            $sudahAda = Notification::where('title', 'Diskusi Baru')
                ->whereDate('created_at', today())
                ->exists();

            if (!$sudahAda) {

                Notification::create([
                    'title' => 'Diskusi Baru',
                    'message' => 'Ada diskusi baru untuk penggunaan uang kas.',
                    'target_type' => 'global',
                ]);
            }
        }


        $pengumumanBaru = Pengumuman::latest()->first();

        if ($pengumumanBaru) {

            $sudahAda = Notification::where('title', 'Pengumuman Baru')
                ->whereDate('created_at', today())
                ->exists();

            if (!$sudahAda) {

                Notification::create([
                    'title' => 'Pengumuman Baru',
                    'message' => 'Ada pengumuman baru dari bendahara.',
                    'target_type' => 'global',
                ]);
            }
        }

        $notifications = Notification::where(function ($query) use ($user) {

                $query->where('user_id', $user->id)
                    ->orWhere('target_type', 'global');
            })
            ->latest()
            ->get();


        $unreadCount = Notification::where(function ($query) use ($user) {

                $query->where('user_id', $user->id)
                    ->orWhere('target_type', 'global');
            })
            ->where('is_read', false)
            ->count();

        return view('siswa.dashboard', compact(
            'notifications',
            'unreadCount'
        ));
    }


    public function readNotification($id)
    {
        $notification = Notification::findOrFail($id);

        $notification->update([
            'is_read' => true
        ]);

        return back();
    }
}