<?php

namespace App\Http\Controllers;

use App\Models\Pengumuman;

class PengumumanController extends Controller
{
    public function index()
    {
        // Pertahankan URL lama, arahkan ke bagian pengumuman pada halaman gabungan.
        return redirect()->to(route('berita.index').'#pengumuman');
    }

    public function show(int $id)
    {
        $pengumuman = Pengumuman::where('status', 'published')
            ->findOrFail($id);

        $pengumumanTerkait = Pengumuman::where('status', 'published')
            ->where('id', '!=', $pengumuman->id)
            ->orderByDesc('tanggal_mulai')
            ->limit(4)
            ->get();

        return view('pengumuman.show', compact('pengumuman', 'pengumumanTerkait'));
    }
}
