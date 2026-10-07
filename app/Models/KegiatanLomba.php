<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KegiatanLomba extends Model
{
    protected $table = 'kegiatan_lomba';

    protected $fillable = [
        'kategori',
        'judul',
        'nama_peserta',
        'kelas',
        'jenis_kegiatan',
        'tingkat',
        'hasil',
        'tanggal',
        'foto',
        'deskripsi',
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];
}
