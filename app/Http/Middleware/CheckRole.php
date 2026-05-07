<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Auth\Middleware\Middleware;

class CheckRole
{
    public function handle(Request $request, Closure $next, string ...$roles)
    {
        // Cek apakah user sudah login
        if (!$request->user()) {
            return redirect()->route('login');
        }

        // Cek apakah role user ada di dalam list roles yang diizinkan
        if (!in_array($request->user()->role, $roles)) {
            abort(403, 'Unauthorized');
        }

        return $next($request);
    }
}
