@extends('layouts.app')

@section('title', 'Tambah Galeri')

@section('content')

<h1>Tambah Galeri</h1>

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

<form
    id="galleryForm"
    action="{{ route('admin.gallery.store') }}"
    method="POST"
    enctype="multipart/form-data"
>
    @csrf

    {{-- ================= BAGIAN 1: GALLERY ================= --}}

    <div class="card">

        <h2>Data Galeri</h2>

        <p>
            <label>Judul</label><br>
            <input type="text" name="judul" value="{{ old('judul') }}" required>
        </p>

        <p>
            <label>Deskripsi</label><br>
            <textarea name="deskripsi" rows="4">{{ old('deskripsi') }}</textarea>
        </p>

        <p>
            <label>Tanggal</label><br>
            <input type="date" name="tanggal" value="{{ old('tanggal') }}">
        </p>

        <p>
            <label>Thumbnail (4:3)</label><br>
            <input type="file" id="thumbPick" accept="image/*">
        </p>

        <p>
            <img
                id="thumbPreview"
                src=""
                alt="Preview thumbnail"
                style="display:none; width:240px; aspect-ratio:4/3; object-fit:cover;
                       border:1px solid #ddd; border-radius:8px;"
            >
        </p>

        <p>
            <button type="button" id="thumbRecrop" style="display:none;">Crop Ulang Thumbnail</button>
        </p>

        <input type="file" id="thumbCrop" name="thumbnail" style="display:none;">

        <p>
            <label>Status</label><br>
            <select name="status">
                <option value="aktif" {{ old('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                <option value="nonaktif" {{ old('status') == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
            </select>
        </p>

    </div>

    {{-- ================= BAGIAN 2: GALLERY FOTO ================= --}}

    <div class="card">

        <h2>Foto Galeri</h2>

        <p>
            <label>Tambah Foto</label><br>
            <input type="file" id="fotoAdd" accept="image/*" multiple>
        </p>

        <div id="fotoList"></div>

    </div>

    <button type="submit">Simpan</button>
    <a href="{{ route('admin.gallery.index') }}">Batal</a>

</form>

<link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.2/cropper.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.2/cropper.min.js"></script>
<script src="{{ asset('js/gallery-form.js') }}"></script>

@endsection
