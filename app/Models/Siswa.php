<?php

namespace App\Models;

use App\Support\StorageFile;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $table = 'siswa';

    protected $fillable = [
        'nama',
        'kelas',
        'foto',
        'deskripsi',
        'status',
    ];

    /**
     * Get photo URL if the file exists on disk.
     */
    public function getFotoUrlAttribute(): ?string
    {
        return StorageFile::url($this->foto);
    }
}
