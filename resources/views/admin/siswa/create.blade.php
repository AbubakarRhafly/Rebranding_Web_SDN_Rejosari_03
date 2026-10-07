@extends('layouts.app')

@section('title', 'Tambah Siswa')

@section('content')

<h1>Tambah Siswa</h1>

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

    <form action="{{ route('admin.siswa.store') }}" method="POST">
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
            <label>Kelas</label><br>
            <input
                type="text"
                name="kelas"
                value="{{ old('kelas') }}"
                placeholder="Contoh: 1A"
                required
            >
        </p>

        <p>
            <label>Foto</label><br>
            <input
                type="text"
                name="foto"
                value="{{ old('foto') }}"
                placeholder="Path foto (sementara)"
            >
        </p>

        <p>
            <label>Deskripsi</label><br>
            <textarea
                name="deskripsi"
                rows="5"
            >{{ old('deskripsi') }}</textarea>
        </p>

        <p>
            <label>Status</label><br>

            <select name="status" required>
                <option value="aktif" {{ old('status', 'aktif') == 'aktif' ? 'selected' : '' }}>
                    Aktif
                </option>

                <option value="nonaktif" {{ old('status') == 'nonaktif' ? 'selected' : '' }}>
                    Nonaktif
                </option>
            </select>
        </p>

        <button type="submit">
            Simpan
        </button>

        <a href="{{ route('admin.siswa.index') }}">
            Batal
        </a>

    </form>

</div>

@endsection
