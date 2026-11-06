<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    private const IMG = 'image|mimes:jpg,jpeg,png,webp|max:4096';

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
            'judul' => 'required|string|max:200',
            'deskripsi' => 'nullable|string',
            'tanggal' => 'nullable|date',
            'status' => 'required|in:aktif,nonaktif',
            'thumbnail' => 'nullable|'.self::IMG,

            'foto_baru' => 'nullable|array',
            'foto_baru.*' => self::IMG,
            'keterangan_baru' => 'nullable|array',
            'keterangan_baru.*' => 'nullable|string|max:255',
            'urutan_baru' => 'nullable|array',
            'urutan_baru.*' => 'nullable|integer|min:0',
        ]);

        $newFiles = [];

        try {
            DB::transaction(function () use ($request, $validated, &$newFiles) {
                $data = Arr::only($validated, [
                    'judul',
                    'deskripsi',
                    'tanggal',
                    'status',
                ]);

                if ($request->hasFile('thumbnail')) {
                    $data['thumbnail'] = $this->simpanFile(
                        $request->file('thumbnail'),
                        'gallery/thumbnail',
                        $newFiles
                    );
                }

                $gallery = Gallery::create($data);

                $this->simpanFotoBaru($request, $gallery, $newFiles);
            });
        } catch (\Throwable $e) {
            $this->hapusBanyak($newFiles);
            throw $e;
        }

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
            'judul' => 'required|string|max:200',
            'deskripsi' => 'nullable|string',
            'tanggal' => 'nullable|date',
            'status' => 'required|in:aktif,nonaktif',
            'thumbnail' => 'nullable|'.self::IMG,

            'foto_lama' => 'nullable|array',
            'foto_lama.*.keterangan' => 'nullable|string|max:255',
            'foto_lama.*.urutan' => 'nullable|integer|min:0',

            'foto_ganti' => 'nullable|array',
            'foto_ganti.*' => self::IMG,

            'hapus_foto' => 'nullable|array',
            'hapus_foto.*' => 'integer',

            'foto_baru' => 'nullable|array',
            'foto_baru.*' => self::IMG,
            'keterangan_baru' => 'nullable|array',
            'keterangan_baru.*' => 'nullable|string|max:255',
            'urutan_baru' => 'nullable|array',
            'urutan_baru.*' => 'nullable|integer|min:0',
        ]);

        $filesToDelete = [];
        $newFiles = [];

        try {
            DB::transaction(function () use (
                $request,
                $validated,
                $gallery,
                &$filesToDelete,
                &$newFiles
            ) {
                $data = Arr::only($validated, [
                    'judul',
                    'deskripsi',
                    'tanggal',
                    'status',
                ]);

                // Ganti thumbnail dengan hasil crop baru.
                if ($request->hasFile('thumbnail')) {
                    if ($gallery->thumbnail) {
                        $filesToDelete[] = $gallery->thumbnail;
                    }

                    $data['thumbnail'] = $this->simpanFile(
                        $request->file('thumbnail'),
                        'gallery/thumbnail',
                        $newFiles
                    );
                }

                $gallery->update($data);

                // Hapus foto yang dipilih.
                $hapus = $request->input('hapus_foto', []);

                foreach ($gallery->foto()->whereIn('id', $hapus)->get() as $foto) {
                    if ($foto->foto) {
                        $filesToDelete[] = $foto->foto;
                    }

                    $foto->delete();
                }

                // Perbarui keterangan, urutan, atau gambar foto lama.
                $ganti = $request->file('foto_ganti', []);

                foreach ($gallery->foto()->get() as $foto) {
                    $row = $request->input("foto_lama.{$foto->id}", []);

                    $update = [
                        'keterangan' => $row['keterangan'] ?? $foto->keterangan,
                        'urutan' => (int) ($row['urutan'] ?? $foto->urutan),
                    ];

                    if (isset($ganti[$foto->id])) {
                        if ($foto->foto) {
                            $filesToDelete[] = $foto->foto;
                        }

                        $update['foto'] = $this->simpanFile(
                            $ganti[$foto->id],
                            'gallery/foto',
                            $newFiles
                        );
                    }

                    $foto->update($update);
                }

                // Tambahkan foto baru.
                $this->simpanFotoBaru($request, $gallery, $newFiles);
            });
        } catch (\Throwable $e) {
            // Hapus file baru jika transaksi database gagal.
            $this->hapusBanyak($newFiles);
            throw $e;
        }

        // Hapus file lama setelah transaksi berhasil.
        $this->hapusBanyak($filesToDelete);

        return redirect()
            ->route('admin.gallery.index')
            ->with('success', 'Gallery berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $gallery = Gallery::with('foto')->findOrFail($id);

        $filesToDelete = [];

        foreach ($gallery->foto as $foto) {
            if ($foto->foto) {
                $filesToDelete[] = $foto->foto;
            }
        }

        if ($gallery->thumbnail) {
            $filesToDelete[] = $gallery->thumbnail;
        }

        DB::transaction(function () use ($gallery) {
            $gallery->foto()->delete();
            $gallery->delete();
        });

        $this->hapusBanyak($filesToDelete);

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

    private function hapusBanyak(array $paths): void
    {
        foreach (array_unique(array_filter($paths)) as $path) {
            $this->hapusFile($path);
        }
    }

    private function simpanFile(
        UploadedFile $file,
        string $dir,
        array &$newFiles
    ): string {
        $path = $file->store($dir, 'public');

        if ($path === false) {
            throw new \RuntimeException('Gagal menyimpan file gambar.');
        }

        $newFiles[] = $path;

        return $path;
    }

    private function simpanFotoBaru(
        Request $request,
        Gallery $gallery,
        array &$newFiles
    ): void {
        $files = $request->file('foto_baru', []);
        $ket = $request->input('keterangan_baru', []);
        $urutan = $request->input('urutan_baru', []);

        foreach ($files as $i => $file) {
            $gallery->foto()->create([
                'foto' => $this->simpanFile(
                    $file,
                    'gallery/foto',
                    $newFiles
                ),
                'keterangan' => $ket[$i] ?? null,
                'urutan' => (int) ($urutan[$i] ?? 0),
            ]);
        }
    }
}
