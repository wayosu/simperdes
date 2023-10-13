<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogReviewPeraturanDesa extends Model
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

    protected $table = 'log_review_peraturan_desas';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function log_peraturan_desa()
    {
        return $this->belongsTo(LogPeraturanDesa::class, 'peraturan_desa_id', 'id')->withDefault();
    }
}
