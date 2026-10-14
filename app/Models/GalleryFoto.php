<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
}
