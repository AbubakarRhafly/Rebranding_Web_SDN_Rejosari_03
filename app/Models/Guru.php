<?php

namespace App\Models;

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
}
