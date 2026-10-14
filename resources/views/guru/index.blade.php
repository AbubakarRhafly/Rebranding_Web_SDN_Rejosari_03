@extends('layouts.app')

@section('title', 'Data Guru')

@section('content')

<h1>Data Guru</h1>

<div class="grid">

    @foreach ($guru as $item)

        <div class="card">

            <h2>{{ $item->nama }}</h2>

            <p>
                <strong>Jabatan:</strong>
                {{ $item->jabatan }}
            </p>

            <p>
                {{ $item->kata_kata }}
            </p>

            <span class="badge">
                {{ $item->status }}
            </span>

        </div>

    @endforeach

</div>

@endsection
