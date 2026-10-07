<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $table = 'gallery';

    protected $fillable = [
        'judul',
        'deskripsi',
        'tanggal',
        'thumbnail',
        'status',
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];

    public function foto()
    {
        return $this->hasMany(GalleryFoto::class, 'gallery_id');
    }
}
