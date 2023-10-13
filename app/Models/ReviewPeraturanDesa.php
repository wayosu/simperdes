<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReviewPeraturanDesa extends Model
{
    use HasFactory;

    protected $fillable = [
        'peraturan_desa_id',
        'user_id',
        'status',
        'catatan',
        'file',
        'link_tautan',
    ];

    protected $table = 'review_peraturan_desas';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function peraturan_desa()
    {
        return $this->belongsTo(PeraturanDesa::class);
    }
}
