<?php

namespace App\Http\Controllers;

use App\Models\KegiatanLomba;

class KegiatanLombaController extends Controller
{
    public function index()
    {
        $kegiatan = KegiatanLomba::orderByDesc('tanggal')->get();

        return view('kegiatan-lomba.index', compact('kegiatan'));
    }
}
