<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\Gallery;
use App\Models\Guru;
use App\Models\Pengaduan;
use App\Models\Pengumuman;
use App\Models\Siswa;

class DashboardController extends Controller
{
    public function index()
    {
        $jumlahGuru = Guru::count();
        $jumlahSiswa = Siswa::count();
        $jumlahGallery = Gallery::count();
        $jumlahBerita = Berita::count();
        $jumlahPengumuman = Pengumuman::count();
        $jumlahPengaduan = Pengaduan::count();

        return view('admin.dashboard', compact(
            'jumlahGuru',
            'jumlahSiswa',
            'jumlahGallery',
            'jumlahBerita',
            'jumlahPengumuman',
            'jumlahPengaduan'
        ));
    }
}
