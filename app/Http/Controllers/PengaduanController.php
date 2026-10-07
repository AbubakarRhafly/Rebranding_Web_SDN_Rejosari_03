<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use Illuminate\Http\Request;

class PengaduanController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | FORM PENGADUAN UNTUK USER
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        return view('pengaduan.create');
    }

    /*
    |--------------------------------------------------------------------------
    | SIMPAN PENGADUAN USER
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:150',
            'email' => 'nullable|email|max:150',
            'no_hp' => 'nullable|string|max:30',
            'judul' => 'required|string|max:255',
            'isi' => 'required|string|max:5000',
        ]);

        Pengaduan::create([
            'nama' => $validated['nama'],
            'email' => $validated['email'] ?? null,
            'no_hp' => $validated['no_hp'] ?? null,
            'judul' => $validated['judul'],
            'isi' => $validated['isi'],
            'status' => 'baru',
        ]);

        return redirect()
            ->route('pengaduan.create')
            ->with('success', 'Pengaduan berhasil dikirim.');
    }

    /*
    |--------------------------------------------------------------------------
    | ADMIN - DAFTAR PENGADUAN
    |--------------------------------------------------------------------------
    */

    public function adminIndex()
    {
        $pengaduan = Pengaduan::latest()->get();

        return view('admin.pengaduan.index', compact('pengaduan'));
    }

    /*
    |--------------------------------------------------------------------------
    | ADMIN - FORM EDIT
    |--------------------------------------------------------------------------
    */

    public function edit($id)
    {
        $pengaduan = Pengaduan::findOrFail($id);

        return view('admin.pengaduan.edit', compact('pengaduan'));
    }

    /*
    |--------------------------------------------------------------------------
    | ADMIN - UPDATE
    |--------------------------------------------------------------------------
    */

    public function update(Request $request, $id)
    {
        $pengaduan = Pengaduan::findOrFail($id);

        $validated = $request->validate([
            'status' => 'required|in:baru,diproses,selesai',
            'tanggapan' => 'nullable|string|max:5000',
        ]);

        $pengaduan->update($validated);

        return redirect()
            ->route('admin.pengaduan.index')
            ->with('success', 'Pengaduan berhasil diperbarui.');
    }

    /*
    |--------------------------------------------------------------------------
    | ADMIN - HAPUS
    |--------------------------------------------------------------------------
    */

    public function destroy($id)
    {
        $pengaduan = Pengaduan::findOrFail($id);

        $pengaduan->delete();

        return redirect()
            ->route('admin.pengaduan.index')
            ->with('success', 'Pengaduan berhasil dihapus.');
    }
}
