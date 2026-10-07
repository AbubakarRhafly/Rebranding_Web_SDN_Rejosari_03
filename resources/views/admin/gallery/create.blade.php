@extends('layouts.app')

@section('title', 'Tambah Gallery')

@section('content')

<h1>Tambah Gallery</h1>

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

    <form action="{{ route('admin.gallery.store') }}" method="POST">

        @csrf

        <p>
            <label>Judul Gallery</label><br>

            <input
                type="text"
                name="judul"
                value="{{ old('judul') }}"
                required
            >
        </p>

        <p>
            <label>Tanggal</label><br>

            <input
                type="date"
                name="tanggal"
                value="{{ old('tanggal') }}"
            >
        </p>

        <p>
            <label>Thumbnail</label><br>

            <input
                type="text"
                name="thumbnail"
                value="{{ old('thumbnail') }}"
                placeholder="Path thumbnail (sementara)"
            >
        </p>

        <p>
            <label>Deskripsi</label><br>

            <textarea
                name="deskripsi"
                rows="6"
            >{{ old('deskripsi') }}</textarea>
        </p>

        <p>
            <label>Status</label><br>

            <select name="status" required>

                <option
                    value="aktif"
                    {{ old('status', 'aktif') == 'aktif' ? 'selected' : '' }}
                >
                    Aktif
                </option>

                <option
                    value="nonaktif"
                    {{ old('status') == 'nonaktif' ? 'selected' : '' }}
                >
                    Nonaktif
                </option>

            </select>
        </p>

        <button type="submit">
            Simpan
        </button>

        <a href="{{ route('admin.gallery.index') }}">
            Batal
        </a>

    </form>

</div>

@endsection
