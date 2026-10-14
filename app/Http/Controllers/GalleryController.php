<?php

namespace App\Http\Controllers;

use App\Models\Gallery;

class GalleryController extends Controller
{
    public function index()
    {
        $gallery = Gallery::where('status', 'aktif')
            ->with('foto')
            ->orderByDesc('tanggal')
            ->get();

        return view('gallery.index', compact('gallery'));
    }
}
