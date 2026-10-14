<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GuruController extends Controller
{
    /**
     * Menampilkan semua guru.
     */
    public function index()
    {
        $guru = Guru::orderBy('urutan')
            ->orderBy('nama')
            ->get();

        return view('admin.guru.index', compact('guru'));
    }

    /**
     * Form tambah guru.
     */
    public function create()
    {
        return view('admin.guru.create');
    }

    /**
     * Menyimpan guru baru.
     */
public function store(Request $request)
{
    $validated = $request->validate([
        'nama' => 'required|string|max:150',
        'jabatan' => 'required|string|max:100',

        'foto_awal' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',

        'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',

        'kata_kata' => 'nullable|string',
        'urutan' => 'nullable|integer|min:0',
        'status' => 'required|in:aktif,nonaktif',
    ]);

    /*
     * Simpan foto asli
     */
    if ($request->hasFile('foto_awal')) {
        $validated['foto_awal'] =
            $request->file('foto_awal')->store('guru/asli', 'public');
    }

    /*
     * Simpan hasil crop
     */
    if ($request->hasFile('foto')) {
        $validated['foto'] =
            $request->file('foto')->store('guru/crop', 'public');
    }

    Guru::create($validated);

    return redirect()
        ->route('admin.guru.index')
        ->with('success', 'Data guru berhasil ditambahkan.');
}

    /**
     * Form edit guru.
     */
    public function edit($id)
    {
        $guru = Guru::findOrFail($id);

        return view('admin.guru.edit', compact('guru'));
    }

    /**
     * Memperbarui data guru.
     */
public function update(Request $request, $id)
{
    $guru = Guru::findOrFail($id);

    $validated = $request->validate([
        'nama' => 'required|string|max:150',
        'jabatan' => 'required|string|max:100',

        'foto_awal' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',

        'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',

        'kata_kata' => 'nullable|string',
        'urutan' => 'nullable|integer|min:0',
        'status' => 'required|in:aktif,nonaktif',
    ]);

    /*
     * Jika admin upload foto baru
     */
    if ($request->hasFile('foto_awal')) {

        /*
         * Hapus foto awal lama
         */
        if ($guru->foto_awal) {
            Storage::disk('public')->delete($guru->foto_awal);
        }

        /*
         * Simpan foto awal baru
         */
        $validated['foto_awal'] =
            $request->file('foto_awal')->store('guru/asli', 'public');
    }

    /*
     * Jika ada hasil crop baru
     */
    if ($request->hasFile('foto')) {

        /*
         * Hapus hasil crop lama
         */
        if ($guru->foto) {
            Storage::disk('public')->delete($guru->foto);
        }

        /*
         * Simpan hasil crop baru
         */
        $validated['foto'] =
            $request->file('foto')->store('guru/crop', 'public');
    }

    $guru->update($validated);

    return redirect()
        ->route('admin.guru.index')
        ->with('success', 'Data guru berhasil diperbarui.');
}

    /**
     * Menghapus guru.
     */
public function destroy($id)
{
    $guru = Guru::findOrFail($id);

    /*
     * Hapus foto awal
     */
    if ($guru->foto_awal) {
        Storage::disk('public')->delete($guru->foto_awal);
    }

    /*
     * Hapus foto hasil crop
     */
    if ($guru->foto) {
        Storage::disk('public')->delete($guru->foto);
    }

    $guru->delete();

    return redirect()
        ->route('admin.guru.index')
        ->with('success', 'Data guru berhasil dihapus.');
}
}
