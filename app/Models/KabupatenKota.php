<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KabupatenKota extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_kabupaten_kota',
        'provinsi_id',
    ];

    protected $table = 'kabupaten_kotas';

    public function kecamatan() {
        return $this->hasMany(Kecamatan::class, 'kabupaten_kota_id', 'id');
    }

    public function provinsi() {
        return $this->belongsTo(Provinsi::class, 'provinsi_id', 'id')->withDefault();
    }

    public function user() {
        return $this->hasOne(User::class, 'kabupaten_kota_id', 'id');
    }
}
