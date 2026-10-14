<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\GuruController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GuruController as AdminGuruController;
use App\Http\Controllers\Admin\SiswaController as AdminSiswaController;
use App\Http\Controllers\Admin\BeritaController as AdminBeritaController;
use App\Http\Controllers\Admin\PengumumanController as AdminPengumumanController;
use App\Http\Controllers\Admin\GalleryController as AdminGalleryController;
use App\Http\Controllers\Admin\KegiatanLombaController as AdminKegiatanLombaController;


Route::get('/', function () {
    return view('layouts.app', [
        'title' => 'Beranda',
    ]);
});


// Profil
Route::get('/guru', [GuruController::class, 'index'])
    ->name('guru.index');

Route::get('/siswa', [SiswaController::class, 'index'])
    ->name('siswa.index');


// Informasi
Route::get('/gallery', [GalleryController::class, 'index'])
    ->name('gallery.index');

Route::get('/berita', [BeritaController::class, 'index'])
    ->name('berita.index');

Route::get('/pengumuman', [PengumumanController::class, 'index'])
    ->name('pengumuman.index');


// Pengaduan User
Route::get('/pengaduan', [PengaduanController::class, 'create'])
    ->name('pengaduan.create');

Route::post('/pengaduan', [PengaduanController::class, 'store'])
    ->middleware('throttle:3,10')
    ->name('pengaduan.store');




// Login
Route::get('/login', [LoginController::class, 'showLogin'])
    ->name('login');

Route::post('/login', [LoginController::class, 'login'])
    ->middleware('throttle:login')
    ->name('login.store');

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
        Route::resource('guru', AdminGuruController::class);

        Route::resource('siswa', AdminSiswaController::class);

        Route::resource('berita', AdminBeritaController::class);

        Route::resource('pengumuman', AdminPengumumanController::class);

        Route::resource('gallery', AdminGalleryController::class);

        Route::resource('kegiatan-lomba', AdminKegiatanLombaController::class);
    });
