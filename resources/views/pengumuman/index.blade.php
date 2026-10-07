@extends('layouts.app')

@section('title', 'Pengumuman')

@section('content')

<h1>Pengumuman</h1>

@foreach ($pengumuman as $item)

    <div class="card">

        <h2>{{ $item->judul }}</h2>

        <p>
            {{ $item->isi }}
        </p>

        <p>
            <strong>Mulai:</strong>
            {{ $item->tanggal_mulai }}
        </p>

        <p>
            <strong>Selesai:</strong>
            {{ $item->tanggal_selesai }}
        </p>

        <span class="badge">
            {{ $item->status }}
        </span>

    </div>

@endforeach

@endsection
