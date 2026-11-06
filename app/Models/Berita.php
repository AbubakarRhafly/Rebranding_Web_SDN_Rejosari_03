<?php

namespace App\Models;

use App\Support\StorageFile;
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

    /**
     * Get thumbnail URL if the file exists on disk.
     */
    public function getThumbnailUrlAttribute(): ?string
    {
        return StorageFile::url($this->thumbnail);
    }
}
