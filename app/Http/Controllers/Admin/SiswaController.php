<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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

            'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',

            'deskripsi' => 'nullable|string',

            'status' => 'required|in:aktif,nonaktif',
        ]);


        // Simpan foto
        if ($request->hasFile('foto')) {

            $validated['foto'] =
                $request
                    ->file('foto')
                    ->store('siswa', 'public');

        }


        Siswa::create($validated);


        return redirect()
            ->route('admin.siswa.index')
            ->with(
                'success',
                'Data siswa berhasil ditambahkan.'
            );
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

            'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',

            'deskripsi' => 'nullable|string',

            'status' => 'required|in:aktif,nonaktif',
        ]);


        // Jika upload foto baru
        if ($request->hasFile('foto')) {

            // Hapus foto lama
            if ($siswa->foto) {

                Storage::disk('public')
                    ->delete($siswa->foto);

            }


            // Simpan foto baru
            $validated['foto'] =
                $request
                    ->file('foto')
                    ->store('siswa', 'public');
        }


        $siswa->update($validated);


        return redirect()
            ->route('admin.siswa.index')
            ->with(
                'success',
                'Data siswa berhasil diperbarui.'
            );
    }


    public function destroy($id)
    {
        $siswa = Siswa::findOrFail($id);


        // Hapus foto
        if ($siswa->foto) {

            Storage::disk('public')
                ->delete($siswa->foto);

        }


        $siswa->delete();


        return redirect()
            ->route('admin.siswa.index')
            ->with(
                'success',
                'Data siswa berhasil dihapus.'
            );
    }
}
