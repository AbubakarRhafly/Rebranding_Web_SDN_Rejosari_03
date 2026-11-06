<?php

use App\Http\Controllers\Admin\BeritaController as AdminBeritaController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GalleryController as AdminGalleryController;
use App\Http\Controllers\Admin\GuruController as AdminGuruController;
use App\Http\Controllers\Admin\PengumumanController as AdminPengumumanController;
use App\Http\Controllers\Admin\SiswaController as AdminSiswaController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\SiswaController;
use App\Models\Berita;
use App\Models\Gallery;
use App\Models\Guru;
use App\Models\Pengumuman;
use App\Models\Siswa;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Route;

Route::get('/', function (): View {
    return view('beranda', [
        'jumlahSiswa' => Siswa::where('status', 'aktif')->count(),
        'jumlahGuru' => Guru::where('status', 'aktif')->count(),
        'guruBeranda' => Guru::where('status', 'aktif')->orderBy('urutan')->limit(4)->get(),
        'beritaBeranda' => Berita::where('status', 'published')->orderByDesc('tanggal_publish')->limit(4)->get(),
        'pengumumanBeranda' => Pengumuman::where('status', 'published')->orderByDesc('tanggal_mulai')->limit(5)->get(),
        'galeriBeranda' => Gallery::where('status', 'aktif')->orderByDesc('tanggal')->limit(6)->get(),
    ]);
})->name('beranda');

// Profil, Visi Misi & Kontak
Route::view('/profil', 'profil.sekolah')
    ->name('profil.sekolah');

Route::view('/visi-misi', 'profil.visi-misi')
    ->name('profil.visi-misi');

Route::view('/kontak', 'profil.kontak')
    ->name('profil.kontak');

Route::get('/guru', [GuruController::class, 'index'])
    ->name('guru.index');

Route::get('/siswa', [SiswaController::class, 'index'])
    ->name('siswa.index');

// Informasi
Route::get('/gallery', [GalleryController::class, 'index'])
    ->name('gallery.index');

// Informasi (Berita & Pengumuman terpisah)
Route::get('/berita', [BeritaController::class, 'index'])
    ->name('berita.index');

Route::get('/berita/{slug}', [BeritaController::class, 'show'])
    ->name('berita.show');

Route::get('/pengumuman', [PengumumanController::class, 'index'])
    ->name('pengumuman.index');

Route::get('/pengumuman/{id}', [PengumumanController::class, 'show'])
    ->name('pengumuman.show');

Route::redirect('/beritadanpengumuman', '/berita', 301);
Route::get('/beritadanpengumuman/{slug}', fn (string $slug) => redirect()->route('berita.show', $slug, 301));

// Prestasi & Pendaftaran
Route::get('/prestasi', fn () => redirect()->away('https://sangjuara.semarangkota.go.id/kejuaraan_siswa?tingkat=&sekolah=371&q='))
    ->name('prestasi.index');

Route::redirect('/kegiatan-lomba', '/prestasi', 301);

Route::get('/pendaftaran', fn () => redirect()->away('https://spmb.semarangkota.go.id/'))
    ->name('pendaftaran');
// Pengaduan User
Route::get('/pengaduan', [PengaduanController::class, 'create'])
    ->name('pengaduan.create');

Route::post('/pengaduan', [PengaduanController::class, 'store'])
    ->middleware('throttle:3,10')
    ->name('pengaduan.store');

// Login Admin (Portal Masuk)
Route::get('/portalmasukadmin', [LoginController::class, 'showLogin'])
    ->name('login');

Route::post('/portalmasukadmin', [LoginController::class, 'login'])
    ->middleware('throttle:login')
    ->name('login.store');

Route::get('/portalmasukadmin/captcha-refresh', [LoginController::class, 'refreshCaptcha'])
    ->name('login.captcha-refresh');

Route::post('/logout', [LoginController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

Route::prefix('admin')
    ->name('admin.')
    ->middleware('auth')
    ->group(function () {

        // Dashboard
        Route::get('/', [DashboardController::class, 'index'])
            ->name('dashboard');

        // Pengaduan
        Route::get('/pengaduan', [PengaduanController::class, 'adminIndex'])
            ->name('pengaduan.index');

        Route::get('/pengaduan/{id}/edit', [PengaduanController::class, 'edit'])
            ->name('pengaduan.edit');

        Route::put('/pengaduan/{id}', [PengaduanController::class, 'update'])
            ->name('pengaduan.update');

        Route::delete('/pengaduan/{id}', [PengaduanController::class, 'destroy'])
            ->name('pengaduan.destroy');

        // CRUD
        Route::resource('guru', AdminGuruController::class)->except(['show']);

        Route::resource('siswa', AdminSiswaController::class)->except(['show']);

        Route::resource('berita', AdminBeritaController::class)->except(['show']);

        Route::resource('pengumuman', AdminPengumumanController::class)->except(['show']);

        Route::resource('gallery', AdminGalleryController::class)->except(['show']);

        Route::redirect('kegiatan-lomba', '/admin');
    });
