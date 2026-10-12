<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    private const IMG      = 'image|mimes:jpg,jpeg,png,webp|max:4096';
    private const IMG_ASLI = 'image|mimes:jpg,jpeg,png,webp|max:10240';

    public function index()
    {
        $gallery = Gallery::with('foto')->latest()->get();

        return view('admin.gallery.index', compact('gallery'));
    }

    public function create()
    {
        return view('admin.gallery.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul'          => 'required|string|max:200',
            'deskripsi'      => 'nullable|string',
            'tanggal'        => 'nullable|date',
            'status'         => 'required|in:aktif,nonaktif',
            'thumbnail'      => 'nullable|' . self::IMG,
            'thumbnail_asli' => 'nullable|' . self::IMG_ASLI,

            'foto_baru'         => 'nullable|array',
            'foto_baru.*'       => self::IMG,
            'foto_asli_baru'    => 'nullable|array',
            'foto_asli_baru.*'  => self::IMG_ASLI,
            'keterangan_baru'   => 'nullable|array',
            'keterangan_baru.*' => 'nullable|string|max:255',
            'urutan_baru'       => 'nullable|array',
            'urutan_baru.*'     => 'nullable|integer|min:0',
        ]);

        DB::transaction(function () use ($request, $validated) {
            $data = Arr::only($validated, ['judul', 'deskripsi', 'tanggal', 'status']);

            if ($request->hasFile('thumbnail')) {
                $data['thumbnail'] = $request->file('thumbnail')->store('gallery/thumbnail', 'public');
            }

            if ($request->hasFile('thumbnail_asli')) {
                $data['thumbnail_asli'] = $request->file('thumbnail_asli')->store('gallery/thumbnail/asli', 'public');
            }

            $gallery = Gallery::create($data);

            $this->simpanFotoBaru($request, $gallery);
        });

        return redirect()
            ->route('admin.gallery.index')
            ->with('success', 'Gallery berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $gallery = Gallery::with('foto')->findOrFail($id);

        return view('admin.gallery.edit', compact('gallery'));
    }

    public function update(Request $request, $id)
    {
        $gallery = Gallery::findOrFail($id);

        $validated = $request->validate([
            'judul'          => 'required|string|max:200',
            'deskripsi'      => 'nullable|string',
            'tanggal'        => 'nullable|date',
            'status'         => 'required|in:aktif,nonaktif',
            'thumbnail'      => 'nullable|' . self::IMG,
            'thumbnail_asli' => 'nullable|' . self::IMG_ASLI,

            'foto_lama'              => 'nullable|array',
            'foto_lama.*.keterangan' => 'nullable|string|max:255',
            'foto_lama.*.urutan'     => 'nullable|integer|min:0',
            'foto_ganti'             => 'nullable|array',
            'foto_ganti.*'           => self::IMG,
            'hapus_foto'             => 'nullable|array',
            'hapus_foto.*'           => 'integer',

            'foto_baru'         => 'nullable|array',
            'foto_baru.*'       => self::IMG,
            'foto_asli_baru'    => 'nullable|array',
            'foto_asli_baru.*'  => self::IMG_ASLI,
            'keterangan_baru'   => 'nullable|array',
            'keterangan_baru.*' => 'nullable|string|max:255',
            'urutan_baru'       => 'nullable|array',
            'urutan_baru.*'     => 'nullable|integer|min:0',
        ]);

        DB::transaction(function () use ($request, $validated, $gallery) {
            $data = Arr::only($validated, ['judul', 'deskripsi', 'tanggal', 'status']);

            // Hasil crop thumbnail
            if ($request->hasFile('thumbnail')) {
                $this->hapusFile($gallery->thumbnail);
                $data['thumbnail'] = $request->file('thumbnail')->store('gallery/thumbnail', 'public');
            }

            // Thumbnail asli: hanya diganti jika user memilih file baru
            if ($request->hasFile('thumbnail_asli')) {
                $this->hapusFile($gallery->thumbnail_asli);
                $data['thumbnail_asli'] = $request->file('thumbnail_asli')->store('gallery/thumbnail/asli', 'public');
            }

            $gallery->update($data);

            // Hapus foto
            $hapus = $request->input('hapus_foto', []);

            foreach ($gallery->foto()->whereIn('id', $hapus)->get() as $foto) {
                $this->hapusFile($foto->foto);
                $this->hapusFile($foto->foto_asli);
                $foto->delete();
            }

            // Update foto lama (foto_asli tidak disentuh)
            $ganti = $request->file('foto_ganti', []);

            foreach ($gallery->foto()->get() as $foto) {
                $row = $request->input("foto_lama.{$foto->id}", []);

                $update = [
                    'keterangan' => $row['keterangan'] ?? $foto->keterangan,
                    'urutan'     => (int) ($row['urutan'] ?? $foto->urutan),
                ];

                if (isset($ganti[$foto->id])) {
                    $this->hapusFile($foto->foto);
                    $update['foto'] = $ganti[$foto->id]->store('gallery/foto', 'public');
                }

                $foto->update($update);
            }

            // Tambah foto baru
            $this->simpanFotoBaru($request, $gallery);
        });

        return redirect()
            ->route('admin.gallery.index')
            ->with('success', 'Gallery berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $gallery = Gallery::with('foto')->findOrFail($id);

        foreach ($gallery->foto as $foto) {
            $this->hapusFile($foto->foto);
            $this->hapusFile($foto->foto_asli);
        }

        $this->hapusFile($gallery->thumbnail);
        $this->hapusFile($gallery->thumbnail_asli);

        $gallery->delete();

        return redirect()
            ->route('admin.gallery.index')
            ->with('success', 'Gallery berhasil dihapus.');
    }

    private function hapusFile(?string $path): void
    {
        if ($path) {
            Storage::disk('public')->delete($path);
        }
    }

    private function simpanFotoBaru(Request $request, Gallery $gallery): void
    {
        $files  = $request->file('foto_baru', []);
        $asli   = $request->file('foto_asli_baru', []);
        $ket    = $request->input('keterangan_baru', []);
        $urutan = $request->input('urutan_baru', []);

        foreach ($files as $i => $file) {
            $gallery->foto()->create([
                'foto'       => $file->store('gallery/foto', 'public'),
                'foto_asli'  => isset($asli[$i]) ? $asli[$i]->store('gallery/foto/asli', 'public') : null,
                'keterangan' => $ket[$i] ?? null,
                'urutan'     => (int) ($urutan[$i] ?? 0),
            ]);
        }
    }
}
