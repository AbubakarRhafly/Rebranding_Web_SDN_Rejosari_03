<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    protected $table = 'berita';

    protected $fillable = [
        'judul',
        'slug',
        'thumbnail',
        'isi',
        'kategori',
        'penulis',
        'tanggal_publish',
        'status',
    ];

    protected $casts = [
        'tanggal_publish' => 'datetime',
    ];
}
