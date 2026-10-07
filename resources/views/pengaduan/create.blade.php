@extends('layouts.app')

@section('title', 'Pengaduan')

@section('content')

<h1>Form Pengaduan</h1>

@if (session('success'))
    <div class="card">
        {{ session('success') }}
    </div>
@endif

@if ($errors->any())
    <div class="card">
        <strong>Terjadi kesalahan:</strong>

        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="card">

    <form action="{{ route('pengaduan.store') }}" method="POST">

        @csrf

        <p>
            <label>Nama</label><br>
            <input
                type="text"
                name="nama"
                value="{{ old('nama') }}"
                required
            >
        </p>

        <p>
            <label>Email</label><br>
            <input
                type="email"
                name="email"
                value="{{ old('email') }}"
            >
        </p>

        <p>
            <label>No. HP</label><br>
            <input
                type="text"
                name="no_hp"
                value="{{ old('no_hp') }}"
            >
        </p>

        <p>
            <label>Judul Pengaduan</label><br>
            <input
                type="text"
                name="judul"
                value="{{ old('judul') }}"
                required
            >
        </p>

        <p>
            <label>Isi Pengaduan</label><br>
            <textarea
                name="isi"
                rows="7"
                required
            >{{ old('isi') }}</textarea>
        </p>

        <button type="submit">
            Kirim Pengaduan
        </button>

    </form>

</div>

@endsection
