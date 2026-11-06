<?php

namespace App\Models;

use App\Support\StorageFile;
use Illuminate\Database\Eloquent\Model;

class GalleryFoto extends Model
{
    protected $table = 'gallery_foto';

    protected $fillable = [
        'gallery_id',
        'foto',
        'keterangan',
        'urutan',
    ];

    public function gallery()
    {
        return $this->belongsTo(Gallery::class, 'gallery_id');
    }

    /**
     * Get photo URL if the file exists on disk.
     */
    public function getFotoUrlAttribute(): ?string
    {
        return StorageFile::url($this->foto);
    }
}
