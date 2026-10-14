@extends('layouts.app')

@section('title', 'Berita')

@section('content')

<h1>Berita Sekolah</h1>

@foreach ($berita as $item)

    <div class="card">

        <h2>{{ $item->judul }}</h2>

        <p>
            <span class="badge">
                {{ $item->kategori }}
            </span>
        </p>

        <p>
            {{ Str::limit(strip_tags($item->isi), 250) }}
        </p>

        <small>
            Penulis: {{ $item->penulis }}
        </small>

    </div>

@endforeach

@endsection
