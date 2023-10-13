<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provinsi extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_provinsi',
    ];

    protected $table = 'provinsis';

    public function kabupaten_kota() {
        return $this->hasMany(KabupatenKota::class, 'provinsi_id', 'id');
    }
}
