<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    protected $table = 'kelas';

    protected $fillable = [
        'nama_kelas',
        'tahun_ajaran',
        'code',
    ];

    public function users()
    {
        return $this->hasMany(User::class, 'kelas_id');
    }

    public function pengeluaran()
    {
        return $this->hasMany(Pengeluaran::class, 'kelas_id');
    }

    public function pembayaran()
    {
        return $this->hasMany(Pembayaran::class, 'kelas_id');
    }
}
