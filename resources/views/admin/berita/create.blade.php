@extends('layouts.app')

@section('title', 'Tambah Berita')

@section('content')

<h1>Tambah Berita</h1>

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

    <form action="{{ route('admin.berita.store') }}" method="POST">
        @csrf

        <p>
            <label>Judul</label><br>

            <input
                type="text"
                name="judul"
                value="{{ old('judul') }}"
                required
            >
        </p>

        <p>
            <label>Slug</label><br>

            <input
                type="text"
                name="slug"
                value="{{ old('slug') }}"
                placeholder="Kosongkan untuk dibuat otomatis"
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
            <label>Kategori</label><br>

            <input
                type="text"
                name="kategori"
                value="{{ old('kategori') }}"
                placeholder="Contoh: Sekolah"
            >
        </p>

        <p>
            <label>Penulis</label><br>

            <input
                type="text"
                name="penulis"
                value="{{ old('penulis') }}"
            >
        </p>

        <p>
            <label>Tanggal Publish</label><br>

            <input
                type="datetime-local"
                name="tanggal_publish"
                value="{{ old('tanggal_publish') }}"
            >
        </p>

        <p>
            <label>Status</label><br>

            <select name="status" required>

                <option
                    value="draft"
                    {{ old('status', 'draft') == 'draft' ? 'selected' : '' }}
                >
                    Draft
                </option>

                <option
                    value="published"
                    {{ old('status') == 'published' ? 'selected' : '' }}
                >
                    Published
                </option>

            </select>
        </p>

        <p>
            <label>Isi Berita</label><br>

            <textarea
                name="isi"
                rows="10"
                required
            >{{ old('isi') }}</textarea>
        </p>

        <button type="submit">
            Simpan
        </button>

        <a href="{{ route('admin.berita.index') }}">
            Batal
        </a>

    </form>

</div>

@endsection
