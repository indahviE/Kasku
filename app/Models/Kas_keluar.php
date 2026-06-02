<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class KasKeluar extends Model
{
    protected $table = 'kas_keluar';
    protected $fillable = ['nama', 'kategori', 'jumlah', 'status', 'tanggal'];
    protected $casts = ['tanggal' => 'date'];
}