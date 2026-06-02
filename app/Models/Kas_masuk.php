<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class KasMasuk extends Model
{
    protected $table = 'kas_masuk';
    protected $fillable = ['user_id', 'kategori', 'jumlah', 'status', 'tanggal'];
    protected $casts = ['tanggal' => 'date'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}