<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Pengumuman;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    public function index(Request $request)
    {
        $filters = $request->validate([
            'q' => ['nullable', 'string', 'max:150'],
            'kategori' => ['nullable', 'string', 'max:100'],
            'berita_page' => ['nullable', 'integer', 'min:1'],
            'pengumuman_page' => ['nullable', 'integer', 'min:1'],
        ]);

        $q = trim($filters['q'] ?? '');
        $kategori = $filters['kategori'] ?? '';
        $kategoriList = Berita::where('status', 'published')
            ->whereNotNull('kategori')->where('kategori', '!=', '')
            ->distinct()->orderBy('kategori')->pluck('kategori');

        $beritaQuery = Berita::where('status', 'published');
        $pengumumanQuery = Pengumuman::where('status', 'published');

        if ($q !== '') {
            foreach ([$beritaQuery, $pengumumanQuery] as $query) {
                $query->where(function ($search) use ($q) {
                    $search->where('judul', 'like', '%'.$q.'%')
                        ->orWhere('isi', 'like', '%'.$q.'%');
                });
            }
        }

        if ($kategori !== '') {
            $beritaQuery->where('kategori', $kategori);
        }

        $queryParams = array_filter(['q' => $q, 'kategori' => $kategori], fn ($value) => $value !== '');
        $berita = $beritaQuery->orderByDesc('tanggal_publish')->orderByDesc('id')
            ->paginate(6, ['*'], 'berita_page')
            ->appends($queryParams + ['pengumuman_page' => $filters['pengumuman_page'] ?? 1])
            ->fragment('berita-sekolah');
        $pengumuman = $pengumumanQuery->orderByDesc('tanggal_mulai')->orderByDesc('id')
            ->paginate(6, ['*'], 'pengumuman_page')
            ->appends($queryParams + ['berita_page' => $filters['berita_page'] ?? 1])
            ->fragment('pengumuman');

        return view('berita.index', compact('berita', 'pengumuman', 'q', 'kategori', 'kategoriList'));
    }

    public function show(string $slug)
    {
        $berita = Berita::where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail();

        $beritaTerkait = Berita::where('status', 'published')
            ->where('id', '!=', $berita->id)
            ->orderByDesc('tanggal_publish')
            ->limit(4)
            ->get();

        return view('berita.show', compact('berita', 'beritaTerkait'));
    }
}
