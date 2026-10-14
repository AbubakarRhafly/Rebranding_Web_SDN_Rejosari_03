<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use App\Models\Siswa;
use App\Models\Gallery;
use App\Models\Berita;
use App\Models\Pengumuman;
use App\Models\Pengaduan;
use App\Models\KegiatanLomba;

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
        $jumlahKegiatan = KegiatanLomba::count();

        return view('admin.dashboard', compact(
            'jumlahGuru',
            'jumlahSiswa',
            'jumlahGallery',
            'jumlahBerita',
            'jumlahPengumuman',
            'jumlahPengaduan',
            'jumlahKegiatan'
        ));
    }
}
