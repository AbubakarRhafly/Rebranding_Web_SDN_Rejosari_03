<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KegiatanLomba;
use Illuminate\Http\Request;

class KegiatanLombaController extends Controller
{
    public function index()
    {
        $kegiatan = KegiatanLomba::latest()->get();

        return view('admin.kegiatan-lomba.index', compact('kegiatan'));
    }

    public function create()
    {
        return view('admin.kegiatan-lomba.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kategori' => 'required|in:MAPSI,Literasi,Bahasa Jawa,Siswa Berprestasi,Motivasi & Inspiratif',
            'judul' => 'required|string|max:255',
            'nama_peserta' => 'nullable|string|max:150',
            'kelas' => 'nullable|string|max:20',
            'jenis_kegiatan' => 'nullable|string|max:150',
            'tingkat' => 'nullable|string|max:100',
            'hasil' => 'nullable|string|max:150',
            'tanggal' => 'nullable|date',
            'foto' => 'nullable|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        KegiatanLomba::create($validated);

        return redirect()
            ->route('admin.kegiatan-lomba.index')
            ->with('success', 'Kegiatan lomba berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $kegiatan = KegiatanLomba::findOrFail($id);

        return view('admin.kegiatan-lomba.edit', compact('kegiatan'));
    }

    public function update(Request $request, $id)
    {
        $kegiatan = KegiatanLomba::findOrFail($id);

        $validated = $request->validate([
            'kategori' => 'required|in:MAPSI,Literasi,Bahasa Jawa,Siswa Berprestasi,Motivasi & Inspiratif',
            'judul' => 'required|string|max:255',
            'nama_peserta' => 'nullable|string|max:150',
            'kelas' => 'nullable|string|max:20',
            'jenis_kegiatan' => 'nullable|string|max:150',
            'tingkat' => 'nullable|string|max:100',
            'hasil' => 'nullable|string|max:150',
            'tanggal' => 'nullable|date',
            'foto' => 'nullable|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        $kegiatan->update($validated);

        return redirect()
            ->route('admin.kegiatan-lomba.index')
            ->with('success', 'Kegiatan lomba berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $kegiatan = KegiatanLomba::findOrFail($id);

        $kegiatan->delete();

        return redirect()
            ->route('admin.kegiatan-lomba.index')
            ->with('success', 'Kegiatan lomba berhasil dihapus.');
    }
}
