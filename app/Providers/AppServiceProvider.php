<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Notifications; // Pastikan model Notification di-import

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Menggunakan View Composer agar query hanya berjalan saat user sudah login
        View::composer('*', function ($view) {
            if (Auth::check()) {
                $user = Auth::user();

                $notifications = Notifications::where(function ($query) use ($user) {
                        $query->where('user_id', $user->id)
                              ->orWhere('target_type', 'global');
                    })
                    ->latest()
                    ->take(10)
                    ->get();

                $unreadCount = Notifications::where(function ($query) use ($user) {
                        $query->where('user_id', $user->id)
                              ->orWhere('target_type', 'global');
                    })
                    ->where('is_read', false)
                    ->count();

                // Bagikan ke seluruh view blade
                $view->with(compact('notifications', 'unreadCount'));
            }
        });
    }
}