@extends('layouts.app')

@section('title', 'Pengaduan')

@section('content')

<h1>Data Pengaduan</h1>

@foreach ($pengaduan as $item)

    <div class="card">

        <h2>{{ $item->judul }}</h2>

        <p>
            <strong>Nama:</strong>
            {{ $item->nama }}
        </p>

        <p>
            <strong>Email:</strong>
            {{ $item->email }}
        </p>

        <p>
            {{ $item->isi }}
        </p>

        <span class="badge">
            {{ $item->status }}
        </span>

        @if ($item->tanggapan)

            <p>
                <strong>Tanggapan:</strong>
                {{ $item->tanggapan }}
            </p>

        @endif

    </div>

@endforeach

@endsection
