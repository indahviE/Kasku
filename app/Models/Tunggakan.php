<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tunggakan extends Model
{
    use HasFactory;

    protected $table = 'tunggakan';

    protected $fillable = [
        'tagihan_id',
        'user_id',
        'status',
    ];

    // Relasi balik ke induk tagihan
    public function tagihan()
    {
        return $this->belongsTo(Tagihan::class, 'tagihan_id');
    }

    // Relasi ke data siswa/user
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}