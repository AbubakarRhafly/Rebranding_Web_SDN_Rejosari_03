<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengaduan extends Model
{
    protected $table = 'pengaduan';

    protected $fillable = [
        'nama',
        'email',
        'no_hp',
        'judul',
        'isi',
        'status',
        'tanggapan',
    ];
}
