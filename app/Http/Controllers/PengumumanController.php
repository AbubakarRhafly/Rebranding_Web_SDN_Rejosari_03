<?php

namespace App\Http\Controllers;

class PengumumanController extends Controller
{
    public function index()
    {
        // Pertahankan URL lama, arahkan ke bagian pengumuman pada halaman gabungan.
        return redirect()->to(route('berita.index').'#pengumuman');
    }
}
