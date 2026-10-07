<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    public function foto()
    {
        return $this->hasMany(GalleryFoto::class, 'gallery_id');
    }
}
