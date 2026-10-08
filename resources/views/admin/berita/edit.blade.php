@extends('layouts.app')

@section('title', 'Edit Berita')

@section('content')

<h1>Edit Berita</h1>

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
        action="{{ route('admin.berita.update', $berita->id) }}"
        method="POST"
    >
        @csrf
        @method('PUT')

        <p>
            <label>Judul</label><br>

            <input
                type="text"
                name="judul"
                value="{{ old('judul', $berita->judul) }}"
                required
            >
        </p>

        <p>
            <label>Slug</label><br>

            <input
                type="text"
                name="slug"
                value="{{ old('slug', $berita->slug) }}"
            >
        </p>

        <p>
            <label>Thumbnail</label><br>

            <input
                type="text"
                name="thumbnail"
                value="{{ old('thumbnail', $berita->thumbnail) }}"
                placeholder="Path thumbnail (sementara)"
            >
        </p>

        <p>
            <label>Kategori</label><br>

            <input
                type="text"
                name="kategori"
                value="{{ old('kategori', $berita->kategori) }}"
            >
        </p>

        <p>
            <label>Penulis</label><br>

            <input
                type="text"
                name="penulis"
                value="{{ old('penulis', $berita->penulis) }}"
            >
        </p>

        <p>
            <label>Tanggal Publish</label><br>

            <input
                type="datetime-local"
                name="tanggal_publish"
                value="{{ old(
                    'tanggal_publish',
                    $berita->tanggal_publish
                        ? $berita->tanggal_publish->format('Y-m-d\TH:i')
                        : ''
                ) }}"
            >
        </p>

        <p>
            <label>Status</label><br>

            <select name="status" required>

                <option
                    value="draft"
                    {{ old('status', $berita->status) == 'draft' ? 'selected' : '' }}
                >
                    Draft
                </option>

                <option
                    value="published"
                    {{ old('status', $berita->status) == 'published' ? 'selected' : '' }}
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
            >{{ old('isi', $berita->isi) }}</textarea>
        </p>

        <button type="submit">
            Simpan Perubahan
        </button>

        <a href="{{ route('admin.berita.index') }}">
            Batal
        </a>

    </form>

</div>

@endsection
