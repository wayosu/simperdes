<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TentangKami extends Model
{
    use HasFactory;

    protected $table = 'tentang_kamis';

    protected $fillable = [
        'alamat',
        'link_gmaps',
        'email',
        'telepon',
        'link_facebook',
        'link_instagram',
        'link_twitter',
    ];

}
