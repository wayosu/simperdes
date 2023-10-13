<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_kecamatan',
        'nama_camat',
        'kabupaten_kota_id',
    ];

    protected $table = 'kecamatans';

    public function desa_kelurahan() {
        return $this->hasMany(DesaKelurahan::class, 'kecamatan_id', 'id');
    }

    public function kabupaten_kota() {
        return $this->belongsTo(KabupatenKota::class, 'kabupaten_kota_id', 'id')->withDefault();
    }

    public function user() {
        return $this->hasMany(User::class, 'kecamatan_id', 'id');
    }
}
