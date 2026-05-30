<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = 'transaksi';

    protected $fillable = [
        'kelas_id',
        'user_id',
        'tipe_transaksi', // masuk, keluar
        'kategori',
        'nominal',
        'tanggal',
        'keterangan',
        'bukti_file',
        'status', // approved, rejected, pending
        'disetujui_oleh',
        'catatan_admin'
    ];

    protected $casts = [
        'tanggal' => 'date',
        'nominal' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    // Relationships
    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function approvedBy()
    {
        return $this->belongsTo(User::class, 'disetujui_oleh');
    }

    // Scopes
    public function scopeMasuk($query)
    {
        return $query->where('tipe_transaksi', 'masuk');
    }

    public function scopeKeluar($query)
    {
        return $query->where('tipe_transaksi', 'keluar');
    }

    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeRejected($query)
    {
        return $query->where('status', 'rejected');
    }

    public function scopeByKelas($query, $kelasId)
    {
        return $query->where('kelas_id', $kelasId);
    }

    public function scopeByUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    public function scopeByTanggal($query, $dari, $sampai)
    {
        return $query->whereBetween('tanggal', [$dari, $sampai]);
    }

    // Accessors
    public function getStatusBadgeAttribute()
    {
        $badges = [
            'approved' => '<span class="badge badge-success">Disetujui</span>',
            'pending' => '<span class="badge badge-warning">Menunggu</span>',
            'rejected' => '<span class="badge badge-danger">Ditolak</span>'
        ];

        return $badges[$this->status] ?? '';
    }

    public function getTipeTransaksiBadgeAttribute()
    {
        $badges = [
            'masuk' => '<span class="badge badge-info">Masuk</span>',
            'keluar' => '<span class="badge badge-warning">Keluar</span>'
        ];

        return $badges[$this->tipe_transaksi] ?? '';
    }
}
