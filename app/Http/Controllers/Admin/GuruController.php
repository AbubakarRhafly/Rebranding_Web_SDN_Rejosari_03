<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use Illuminate\Http\Request;

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
            'foto' => 'nullable|string|max:255',
            'kata_kata' => 'nullable|string',
            'urutan' => 'nullable|integer|min:0',
            'status' => 'required|in:aktif,nonaktif',
        ]);

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
            'foto' => 'nullable|string|max:255',
            'kata_kata' => 'nullable|string',
            'urutan' => 'nullable|integer|min:0',
            'status' => 'required|in:aktif,nonaktif',
        ]);

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

        $guru->delete();

        return redirect()
            ->route('admin.guru.index')
            ->with('success', 'Data guru berhasil dihapus.');
    }
}
