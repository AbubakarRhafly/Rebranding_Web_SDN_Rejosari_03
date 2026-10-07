@extends('layouts.app')

@section('title', 'Admin - Pengaduan')

@section('content')

<h1>Data Pengaduan</h1>

@if (session('success'))
    <div class="card">
        {{ session('success') }}
    </div>
@endif

@forelse ($pengaduan as $item)

    <div class="card">

        <h2>{{ $item->judul }}</h2>

        <p>
            <strong>Nama:</strong>
            {{ $item->nama }}
        </p>

        <p>
            <strong>Email:</strong>
            {{ $item->email ?? '-' }}
        </p>

        <p>
            <strong>No. HP:</strong>
            {{ $item->no_hp ?? '-' }}
        </p>

        <p>
            <strong>Isi:</strong><br>
            {{ $item->isi }}
        </p>

        <p>
            <strong>Status:</strong>
            {{ $item->status }}
        </p>

        @if ($item->tanggapan)

            <p>
                <strong>Tanggapan:</strong><br>
                {{ $item->tanggapan }}
            </p>

        @endif

        <a href="{{ route('admin.pengaduan.edit', $item->id) }}">
            Edit
        </a>

        <form
            action="{{ route('admin.pengaduan.destroy', $item->id) }}"
            method="POST"
            style="display:inline"
        >

            @csrf
            @method('DELETE')

            <button type="submit">
                Hapus
            </button>

        </form>

    </div>

@empty

    <div class="card">
        Belum ada pengaduan.
    </div>

@endforelse

@endsection
