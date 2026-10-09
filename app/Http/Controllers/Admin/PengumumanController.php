<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengumuman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PengumumanController extends Controller
{
    public function index()
    {
        $pengumuman = Pengumuman::latest()->get();

        return view('admin.pengumuman.index', compact('pengumuman'));
    }


    public function create()
    {
        return view('admin.pengumuman.create');
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',

            'isi' => 'required|string',

            'foto' =>
                'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',

            'tanggal_mulai' => 'nullable|date',

            'tanggal_selesai' =>
                'nullable|date|after_or_equal:tanggal_mulai',

            'lampiran' =>
                'nullable|file|max:5120',

            'status' =>
                'required|in:draft,published',
        ]);


        // Simpan foto
        if ($request->hasFile('foto')) {

            $validated['foto'] =
                $request
                    ->file('foto')
                    ->store('pengumuman/foto', 'public');

        }


        // Simpan lampiran
        if ($request->hasFile('lampiran')) {

            $validated['lampiran'] =
                $request
                    ->file('lampiran')
                    ->store('pengumuman/lampiran', 'public');

        }


        Pengumuman::create($validated);


        return redirect()
            ->route('admin.pengumuman.index')
            ->with(
                'success',
                'Pengumuman berhasil ditambahkan.'
            );
    }


    public function edit($id)
    {
        $pengumuman =
            Pengumuman::findOrFail($id);


        return view(
            'admin.pengumuman.edit',
            compact('pengumuman')
        );
    }


    public function update(Request $request, $id)
    {
        $pengumuman =
            Pengumuman::findOrFail($id);


        $validated = $request->validate([
            'judul' => 'required|string|max:255',

            'isi' => 'required|string',

            'foto' =>
                'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',

            'tanggal_mulai' => 'nullable|date',

            'tanggal_selesai' =>
                'nullable|date|after_or_equal:tanggal_mulai',

            'lampiran' =>
                'nullable|file|max:5120',

            'status' =>
                'required|in:draft,published',
        ]);


        // Jika upload foto baru
        if ($request->hasFile('foto')) {

            // Hapus foto lama
            if ($pengumuman->foto) {

                Storage::disk('public')
                    ->delete($pengumuman->foto);

            }


            // Simpan foto baru
            $validated['foto'] =
                $request
                    ->file('foto')
                    ->store('pengumuman/foto', 'public');

        }


        // Jika upload lampiran baru
        if ($request->hasFile('lampiran')) {

            // Hapus lampiran lama
            if ($pengumuman->lampiran) {

                Storage::disk('public')
                    ->delete($pengumuman->lampiran);

            }


            // Simpan lampiran baru
            $validated['lampiran'] =
                $request
                    ->file('lampiran')
                    ->store('pengumuman/lampiran', 'public');

        }


        $pengumuman->update($validated);


        return redirect()
            ->route('admin.pengumuman.index')
            ->with(
                'success',
                'Pengumuman berhasil diperbarui.'
            );
    }


    public function destroy($id)
    {
        $pengumuman =
            Pengumuman::findOrFail($id);


        // Hapus foto
        if ($pengumuman->foto) {

            Storage::disk('public')
                ->delete($pengumuman->foto);

        }


        // Hapus lampiran
        if ($pengumuman->lampiran) {

            Storage::disk('public')
                ->delete($pengumuman->lampiran);

        }


        $pengumuman->delete();


        return redirect()
            ->route('admin.pengumuman.index')
            ->with(
                'success',
                'Pengumuman berhasil dihapus.'
            );
    }
}
