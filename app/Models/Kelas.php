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
        'kode_kelas',
        'status',
    ];

    public function siswa()
    {
        return $this->hasMany(Siswa::class, 'kelas_id');
    }

    public function waliKelas()
    {
        return $this->hasOne(WaliKelas::class, 'kelas_id');
    }

    public function pengeluaran()
    {
        return $this->hasMany(Pengeluaran::class, 'kelas_id');
    }
}