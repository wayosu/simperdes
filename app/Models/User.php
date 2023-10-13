<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'nomor_hp',
        'alamat',
        'foto',
        'provinsi_id',
        'kabupaten_kota_id',
        'kecamatan_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    protected function role(): Attribute
    {
        return new Attribute(
            get: fn ($value) =>  ["mitra", "admin_desakel", "admin_kecamatan", "admin_kabkota", "superadmin"][$value],
        );
    }

    public function kabupaten_kota() {
        return $this->belongsTo(KabupatenKota::class, 'kabupaten_kota_id', 'id')->withDefault();
    }

    public function kecamatan() {
        return $this->belongsTo(Kecamatan::class, 'kecamatan_id', 'id')->withDefault();
    }

    public function desa_kelurahan() {
        return $this->belongsTo(DesaKelurahan::class, 'desa_kelurahan_id', 'id')->withDefault();
    }

    public function peraturan_desa() {
        return $this->hasMany(PeraturanDesa::class);
    }

    public function perde() {
        return $this->hasMany(Perde::class);
    }

    public function log_peraturan_desa() {
        return $this->hasMany(LogPeraturanDesa::class);
    }

    public function review_peraturan_desa() {
        return $this->hasMany(ReviewPeraturanDesa::class);
    }

    public function log_review_peraturan_desa() {
        return $this->hasMany(LogReviewPeraturanDesa::class);
    }
}
