@extends('layouts.app')

@section('title', 'Galeri')

@section('content')

<h1>Galeri Sekolah</h1>

<div class="grid">

    @foreach ($gallery as $item)

        <div class="card">

            <h2>{{ $item->judul }}</h2>

            <p>
                {{ $item->deskripsi }}
            </p>

            <p>
                <strong>Tanggal:</strong>
                {{ $item->tanggal }}
            </p>

            <hr>

            <strong>Jumlah Foto:</strong>
            {{ $item->foto->count() }}

        </div>

    @endforeach

</div>

@endsection
