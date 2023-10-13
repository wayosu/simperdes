<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogPeraturanDesa extends Model
{
    use HasFactory;

    protected $fillable = [
        'peraturan_desa_id',
        'judul_peraturan',
        'jenis_peraturan_id',
        'isi_peraturan',
        'file',
        'nama_penyusun',
        'user_id',
        'status_admin_kabkota',
        'status_admin_kecamatan',
        'status_admin_mitra',
        'admin_kabkota_id',
        'admin_kecamatan_id',
        'admin_mitra_id',
    ];

    protected $table = 'log_peraturan_desas';

    public function jenis_peraturan()
    {
        return $this->belongsTo(JenisPeraturan::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function log_review_peraturan_desa() {
        return $this->hasMany(LogReviewPeraturanDesa::class, 'peraturan_desa_id', 'id');
    }
}
