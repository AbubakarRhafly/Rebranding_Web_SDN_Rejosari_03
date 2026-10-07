<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function index()
    {
        $siswa = Siswa::orderBy('kelas')
            ->orderBy('nama')
            ->get();

        return view('admin.siswa.index', compact('siswa'));
    }

    public function create()
    {
        return view('admin.siswa.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:150',
            'kelas' => 'required|string|max:20',
            'foto' => 'nullable|string|max:255',
            'deskripsi' => 'nullable|string',
            'status' => 'required|in:aktif,nonaktif',
        ]);

        Siswa::create($validated);

        return redirect()
            ->route('admin.siswa.index')
            ->with('success', 'Data siswa berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $siswa = Siswa::findOrFail($id);

        return view('admin.siswa.edit', compact('siswa'));
    }

    public function update(Request $request, $id)
    {
        $siswa = Siswa::findOrFail($id);

        $validated = $request->validate([
            'nama' => 'required|string|max:150',
            'kelas' => 'required|string|max:20',
            'foto' => 'nullable|string|max:255',
            'deskripsi' => 'nullable|string',
            'status' => 'required|in:aktif,nonaktif',
        ]);

        $siswa->update($validated);

        return redirect()
            ->route('admin.siswa.index')
            ->with('success', 'Data siswa berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $siswa = Siswa::findOrFail($id);

        $siswa->delete();

        return redirect()
            ->route('admin.siswa.index')
            ->with('success', 'Data siswa berhasil dihapus.');
    }
}
