<?php

namespace App\Http\Controllers;

use App\Models\Pengumuman;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PengumumanController extends Controller
{
    public function index(Request $request): View
    {
        $filters = $request->validate([
            'q' => ['nullable', 'string', 'max:150'],
            'page' => ['nullable', 'integer', 'min:1'],
        ]);

        $q = trim($filters['q'] ?? '');

        $query = Pengumuman::where('status', 'published');

        if ($q !== '') {
            $query->where(function ($search) use ($q) {
                $search->where('judul', 'like', '%'.$q.'%')
                    ->orWhere('isi', 'like', '%'.$q.'%');
            });
        }

        $queryParams = array_filter(['q' => $q], fn ($value) => $value !== '');
        $pengumuman = $query->orderByDesc('tanggal_mulai')->orderByDesc('id')
            ->paginate(6)
            ->appends($queryParams);

        return view('pengumuman.index', compact('pengumuman', 'q'));
    }

    public function show(int $id): View
    {
        $pengumuman = Pengumuman::where('status', 'published')
            ->findOrFail($id);

        $pengumumanTerkait = Pengumuman::where('status', 'published')
            ->where('id', '!=', $pengumuman->id)
            ->orderByDesc('tanggal_mulai')
            ->limit(4)
            ->get();

        return view('pengumuman.show', compact('pengumuman', 'pengumumanTerkait'));
    }
}
