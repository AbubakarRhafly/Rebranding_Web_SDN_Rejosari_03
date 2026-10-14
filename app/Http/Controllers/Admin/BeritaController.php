<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BeritaController extends Controller
{
    public function index()
    {
        $berita = Berita::latest()->get();

        return view('admin.berita.index', compact('berita'));
    }

    public function create()
    {
        return view('admin.berita.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:berita,slug',
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'isi' => 'required|string',
            'kategori' => 'nullable|string|max:100',
            'penulis' => 'nullable|string|max:100',
            'tanggal_publish' => 'nullable|date',
            'status' => 'required|in:draft,published',
        ]);

        $validated['slug'] = $validated['slug']
            ?: Str::slug($validated['judul']);

        if ($request->hasFile('thumbnail')) {
            $validated['thumbnail'] = $request
                ->file('thumbnail')
                ->store('berita', 'public');
        }

        Berita::create($validated);

        return redirect()
            ->route('admin.berita.index')
            ->with('success', 'Berita berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $berita = Berita::findOrFail($id);

        return view('admin.berita.edit', compact('berita'));
    }

    public function update(Request $request, $id)
    {
        $berita = Berita::findOrFail($id);

        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:berita,slug,' . $id,
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'isi' => 'required|string',
            'kategori' => 'nullable|string|max:100',
            'penulis' => 'nullable|string|max:100',
            'tanggal_publish' => 'nullable|date',
            'status' => 'required|in:draft,published',
        ]);

        $validated['slug'] = $validated['slug']
            ?: Str::slug($validated['judul']);

        if ($request->hasFile('thumbnail')) {
            if ($berita->thumbnail) {
                Storage::disk('public')->delete($berita->thumbnail);
            }

            $validated['thumbnail'] = $request
                ->file('thumbnail')
                ->store('berita', 'public');
        }

        $berita->update($validated);

        return redirect()
            ->route('admin.berita.index')
            ->with('success', 'Berita berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $berita = Berita::findOrFail($id);

        if ($berita->thumbnail) {
            Storage::disk('public')->delete($berita->thumbnail);
        }

        $berita->delete();

        return redirect()
            ->route('admin.berita.index')
            ->with('success', 'Berita berhasil dihapus.');
    }
}
