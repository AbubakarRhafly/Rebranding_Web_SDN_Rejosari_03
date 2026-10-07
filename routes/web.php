<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\GuruController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\KegiatanLombaController;
use App\Http\Controllers\Admin\GuruController as AdminGuruController;
use App\Http\Controllers\Admin\SiswaController as AdminSiswaController;


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


// Admin - Pengaduan
Route::prefix('admin')->name('admin.')->group(function () {

    Route::get('/pengaduan', [PengaduanController::class, 'adminIndex'])
        ->name('pengaduan.index');

    Route::get('/pengaduan/{id}/edit', [PengaduanController::class, 'edit'])
        ->name('pengaduan.edit');

    Route::put('/pengaduan/{id}', [PengaduanController::class, 'update'])
        ->name('pengaduan.update');

    Route::delete('/pengaduan/{id}', [PengaduanController::class, 'destroy'])
        ->name('pengaduan.destroy');

});


// Kegiatan
Route::get('/kegiatan-lomba', [KegiatanLombaController::class, 'index'])
    ->name('kegiatan-lomba.index');


Route::prefix('admin')->name('admin.')->group(function () {

    Route::resource('guru', AdminGuruController::class);

    Route::resource('siswa', AdminSiswaController::class);

});
