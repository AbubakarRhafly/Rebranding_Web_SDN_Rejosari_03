<?php

namespace App\Http\Controllers;

use App\Models\Berita;

class BeritaController extends Controller
{
    public function index()
    {
        $berita = Berita::where('status', 'published')
            ->orderByDesc('tanggal_publish')
            ->get();

        return view('berita.index', compact('berita'));
    }
}
