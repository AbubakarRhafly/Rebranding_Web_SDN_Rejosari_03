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

            @if ($item->thumbnail)
                <img
                    src="{{ asset('storage/' . $item->thumbnail) }}"
                    alt="{{ $item->judul }}"
                    style="width:100%; aspect-ratio:4/3; object-fit:cover; border-radius:8px;"
                >
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

            <hr>

            <a href="{{ route('admin.gallery.edit', $item->id) }}">Edit</a>

            <form
                action="{{ route('admin.gallery.destroy', $item->id) }}"
                method="POST"
                style="display:inline;"
                onsubmit="return confirm('Hapus galeri ini beserta semua fotonya?')"
            >
                @csrf
                @method('DELETE')
                <button type="submit">Hapus</button>
            </form>

        </div>

    @endforeach

</div>

@endsection
