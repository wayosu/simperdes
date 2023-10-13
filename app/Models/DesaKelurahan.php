<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DesaKelurahan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_desa',
        'nama_kepala_desa',
        'kecamatan_id',
    ];

    protected $table = 'desa_kelurahans';

    public function kecamatan() {
        return $this->belongsTo(Kecamatan::class, 'kecamatan_id', 'id')->withDefault();
    }

    public function user() {
        return $this->hasMany(User::class, 'desa_kelurahan_id', 'id');
    }
}
