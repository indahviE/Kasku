<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;

    protected $table = 'pembayaran';

    protected $fillable = [
        'tagihan_id',
        'user_id',
        'dicatat_oleh',
        'jml_bayar',
        'tanggal_bayar',
        'metode',
        'status',
        'bukti_bayar',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function tagihan()
    {
        return $this->belongsTo(Tagihan::class, 'tagihan_id');
    }

    public function siswa()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function pencatat()
    {
        return $this->belongsTo(User::class, 'dicatat_oleh');
    }
}
