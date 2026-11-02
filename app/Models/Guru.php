<?php

namespace App\Models;

use App\Support\StorageFile;
use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    protected $table = 'guru';

    protected $fillable = [
        'nama',
        'jabatan',
        'foto_awal',
        'foto',
        'kata_kata',
        'urutan',
        'status',
    ];

    /**
     * Get the active photo URL if the file exists on disk.
     */
    public function getFotoUrlAttribute(): ?string
    {
        return StorageFile::url($this->foto)
            ?? StorageFile::url($this->foto_awal);
    }

    /**
     * Get the original photo URL if the file exists on disk.
     */
    public function getFotoAwalUrlAttribute(): ?string
    {
        return StorageFile::url($this->foto_awal);
    }
}
