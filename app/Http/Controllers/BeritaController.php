<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BeritaController extends Controller
{
    public function index(Request $request): View
    {
        $filters = $request->validate([
            'q' => ['nullable', 'string', 'max:150'],
            'kategori' => ['nullable', 'string', 'max:100'],
            'page' => ['nullable', 'integer', 'min:1'],
        ]);

        $q = trim($filters['q'] ?? '');
        $kategori = $filters['kategori'] ?? '';
        $kategoriList = Berita::where('status', 'published')
            ->whereNotNull('kategori')->where('kategori', '!=', '')
            ->distinct()->orderBy('kategori')->pluck('kategori');

        $query = Berita::where('status', 'published');

        if ($q !== '') {
            $query->where(function ($search) use ($q) {
                $search->where('judul', 'like', '%'.$q.'%')
                    ->orWhere('isi', 'like', '%'.$q.'%');
            });
        }

        if ($kategori !== '') {
            $query->where('kategori', $kategori);
        }

        $queryParams = array_filter(['q' => $q, 'kategori' => $kategori], fn ($value) => $value !== '');
        $berita = $query->orderByDesc('tanggal_publish')->orderByDesc('id')
            ->paginate(6)
            ->appends($queryParams);

        return view('berita.index', compact('berita', 'q', 'kategori', 'kategoriList'));
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
