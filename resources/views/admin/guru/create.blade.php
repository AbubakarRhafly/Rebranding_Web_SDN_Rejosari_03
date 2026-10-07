@extends('layouts.app')

@section('title', 'Tambah Guru')

@section('content')

<h1>Tambah Guru</h1>

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

    <form
        action="{{ route('admin.guru.store') }}"
        method="POST"
    >

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
            <label>Jabatan</label><br>

            <input
                type="text"
                name="jabatan"
                value="{{ old('jabatan') }}"
                required
            >
        </p>

        <p>
            <label>Foto</label><br>

            <input
                type="text"
                name="foto"
                value="{{ old('foto') }}"
                placeholder="Nama/path foto"
            >
        </p>

        <p>
            <label>Kata-kata</label><br>

            <textarea
                name="kata_kata"
                rows="4"
            >{{ old('kata_kata') }}</textarea>
        </p>

        <p>
            <label>Urutan</label><br>

            <input
                type="number"
                name="urutan"
                value="{{ old('urutan', 0) }}"
                min="0"
            >
        </p>

        <p>
            <label>Status</label><br>

            <select name="status">

                <option value="aktif">
                    Aktif
                </option>

                <option value="nonaktif">
                    Nonaktif
                </option>

            </select>
        </p>

        <button type="submit">
            Simpan
        </button>

        <a href="{{ route('admin.guru.index') }}">
            Batal
        </a>

    </form>

</div>

@endsection
