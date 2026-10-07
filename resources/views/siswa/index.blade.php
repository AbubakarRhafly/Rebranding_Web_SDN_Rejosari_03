@extends('layouts.app')

@section('title', 'Data Siswa')

@section('content')

<h1>Data Siswa</h1>

<div class="grid">

    @foreach ($siswa as $item)

        <div class="card">

            <h2>{{ $item->nama }}</h2>

            <p>
                <strong>Kelas:</strong>
                {{ $item->kelas }}
            </p>

            <p>
                {{ $item->deskripsi }}
            </p>

        </div>

    @endforeach

</div>

@endsection
