@extends('layouts.app')

@section('title', 'Kegiatan Lomba')

@section('content')

<h1>Kegiatan Lomba</h1>

<div class="grid">

    @foreach ($kegiatan as $item)

        <div class="card">

            <span class="badge">
                {{ $item->kategori }}
            </span>

            <h2>{{ $item->judul }}</h2>

            <p>
                <strong>Peserta:</strong>
                {{ $item->nama_peserta }}
            </p>

            <p>
                <strong>Kelas:</strong>
                {{ $item->kelas }}
            </p>

            <p>
                <strong>Jenis:</strong>
                {{ $item->jenis_kegiatan }}
            </p>

            <p>
                <strong>Tingkat:</strong>
                {{ $item->tingkat }}
            </p>

            <p>
                <strong>Hasil:</strong>
                {{ $item->hasil }}
            </p>

        </div>

    @endforeach

</div>

@endsection
