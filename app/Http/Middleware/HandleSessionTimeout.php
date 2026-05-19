<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class HandleSessionTimeout
{
    /**
     * Handle an incoming request.
     *
     * Middleware ini mengecek apakah user sudah idle terlalu lama
     * Jika ya, logout dan redirect ke home dengan pesan
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Hanya jalankan untuk user yang authenticated
        if (Auth::check()) {
            $timeout = config('session.lifetime') * 60; // Convert menit ke detik
            $lastActivity = session('last_activity');

            // Jika ada last_activity dan sudah melewati timeout
            if ($lastActivity && (now()->timestamp - strtotime($lastActivity)) > $timeout) {
                // Logout user
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return redirect('/')->with('timeout', 'Sesi Anda telah kadaluarsa. Silakan login kembali.');
            }

            // Update last activity
            session(['last_activity' => now()]);
        }

        return $next($request);
    }
}
