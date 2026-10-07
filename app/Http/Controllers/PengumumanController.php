<?php

namespace App\Http\Controllers;

use App\Models\Pengumuman;

class PengumumanController extends Controller
{
    public function index()
    {
        $pengumuman = Pengumuman::where('status', 'published')
            ->orderByDesc('tanggal_mulai')
            ->get();

        return view('pengumuman.index', compact('pengumuman'));
    }
}
