<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'kelas_id'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    /**
     * Helper method untuk get dashboard route berdasarkan role
     */
    public function getDashboardRoute(): string
    {
        return match ($this->role) {
            'admin' => route('dashboard.admin'),
            'bendahara' => route('bendahara.dashboard'),
            'siswa' => route('siswa.index'),
            'wali_kelas' => route('wali.dashboard'),
            default => route('home'),
        };
    }

    /**
     * Helper method untuk check role
     */
    public function hasRole(string $role): bool
    {
        return $this->role === $role;
    }

    /**
     * Helper method untuk check multiple roles
     */
    public function hasAnyRole(array $roles): bool
    {
        return in_array($this->role, $roles);
    }
}
