<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index()
    {
        $gallery = Gallery::with('foto')
            ->latest()
            ->get();

        return view('admin.gallery.index', compact('gallery'));
    }

    public function create()
    {
        return view('admin.gallery.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:200',
            'deskripsi' => 'nullable|string',
            'tanggal' => 'nullable|date',
            'thumbnail' => 'nullable|string|max:255',
            'status' => 'required|in:aktif,nonaktif',
        ]);

        Gallery::create($validated);

        return redirect()
            ->route('admin.gallery.index')
            ->with('success', 'Gallery berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $gallery = Gallery::findOrFail($id);

        return view('admin.gallery.edit', compact('gallery'));
    }

    public function update(Request $request, $id)
    {
        $gallery = Gallery::findOrFail($id);

        $validated = $request->validate([
            'judul' => 'required|string|max:200',
            'deskripsi' => 'nullable|string',
            'tanggal' => 'nullable|date',
            'thumbnail' => 'nullable|string|max:255',
            'status' => 'required|in:aktif,nonaktif',
        ]);

        $gallery->update($validated);

        return redirect()
            ->route('admin.gallery.index')
            ->with('success', 'Gallery berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $gallery = Gallery::findOrFail($id);

        $gallery->delete();

        return redirect()
            ->route('admin.gallery.index')
            ->with('success', 'Gallery berhasil dihapus.');
    }
}
