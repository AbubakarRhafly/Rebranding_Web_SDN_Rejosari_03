<?php

namespace App\Http\Controllers;

use App\Models\Siswa;

class SiswaController extends Controller
{
    public function index()
    {
        $siswa = Siswa::where('status', 'aktif')
            ->orderBy('kelas')
            ->orderBy('nama')
            ->get();

        return view('siswa.index', compact('siswa'));
    }
}
