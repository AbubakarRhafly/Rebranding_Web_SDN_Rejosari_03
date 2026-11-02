@extends('layouts.app')

@section('title', 'Galeri')

@section('content')

<h1>Galeri Sekolah</h1>

@if (session('success'))
    <div class="card">{{ session('success') }}</div>
@endif

<p>
    <a href="{{ route('admin.gallery.create') }}">+ Tambah Galeri</a>
</p>

<div class="grid">

    @foreach ($gallery as $item)

        <div class="card">

            @if ($item->cover_url)
                <img
                    src="{{ $item->cover_url }}"
                    alt="{{ $item->judul }}"
                    style="width:100%; aspect-ratio:4/3; object-fit:cover; border-radius:8px;"
                    onerror="this.style.display='none'; if(this.nextElementSibling) this.nextElementSibling.style.display='flex';"
                >
                <div style="width:100%; aspect-ratio:4/3; background:#eee; border-radius:8px;
                            display:none; align-items:center; justify-content:center;">
                    Tanpa thumbnail
                </div>
            @else
                <div style="width:100%; aspect-ratio:4/3; background:#eee; border-radius:8px;
                            display:flex; align-items:center; justify-content:center;">
                    Tanpa thumbnail
                </div>
            @endif

            <h2>{{ $item->judul }}</h2>

            <p>{{ $item->deskripsi }}</p>

            <p>
                <strong>Tanggal:</strong>
                {{ optional($item->tanggal)->format('d-m-Y') }}
            </p>

            <p>
                <strong>Status:</strong> {{ ucfirst($item->status) }}
            </p>

            <p>
                <strong>Jumlah Foto:</strong> {{ $item->foto->count() }}
            </p>

            <hr style="margin: 16px 0; border: 0; border-top: 1px solid #e2e8f0;">

            <div class="admin-actions">
                <a href="{{ route('admin.gallery.edit', $item->id) }}" class="btn-action-edit" title="Edit Galeri">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                        <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                    </svg>
                    Edit
                </a>

                <form
                    action="{{ route('admin.gallery.destroy', $item->id) }}"
                    method="POST"
                    onsubmit="return confirm('Hapus galeri ini beserta semua fotonya?')"
                >
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-action-delete" title="Hapus Galeri">
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <polyline points="3 6 5 6 21 6"></polyline>
                            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                            <line x1="10" y1="11" x2="10" y2="17"></line>
                            <line x1="14" y1="11" x2="14" y2="17"></line>
                        </svg>
                        Hapus
                    </button>
                </form>
            </div>

        </div>

    @endforeach

</div>

@endsection
