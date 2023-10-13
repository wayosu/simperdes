<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perde extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul_peraturan',
        'jenis_peraturan_id',
        'isi_peraturan',
        'file',
        'nama_penyusun',
        'user_id',
    ];

    protected $table = 'perdes';

    public function jenis_peraturan()
    {
        return $this->belongsTo(JenisPeraturan::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
