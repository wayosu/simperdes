<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisPeraturan extends Model
{
    use HasFactory;

    protected $fillable = [
        'jenis_aturan',
    ];

    protected $table = 'jenis_peraturans';

    public function peraturan_desa()
    {
        return $this->hasMany(PeraturanDesa::class);
    }

    public function perde()
    {
        return $this->hasMany(Perde::class);
    }

    public function log_peraturan_desa()
    {
        return $this->hasMany(LogPeraturanDesa::class);
    }
}
