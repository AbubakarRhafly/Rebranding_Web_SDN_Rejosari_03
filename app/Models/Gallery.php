<?php

namespace App\Models;

use App\Support\StorageFile;
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

    /**
     * Get thumbnail URL if the file exists on disk.
     */
    public function getThumbnailUrlAttribute(): ?string
    {
        return StorageFile::url($this->thumbnail);
    }

    /**
     * Get cover image URL (thumbnail or first valid photo).
     */
    public function getCoverUrlAttribute(): ?string
    {
        return $this->thumbnail_url
            ?? $this->foto->sortBy('urutan')->map->foto_url->filter()->first();
    }
}
