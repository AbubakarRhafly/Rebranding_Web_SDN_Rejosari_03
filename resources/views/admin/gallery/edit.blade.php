@extends('layouts.app')

@section('title', 'Edit Galeri')

@section('content')

<h1>Edit Galeri</h1>

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
    action="{{ route('admin.gallery.update', $gallery->id) }}"
    method="POST"
    enctype="multipart/form-data"
>
    @csrf
    @method('PUT')

    {{-- ================= BAGIAN 1: GALLERY ================= --}}

    <div class="card">

        <h2>Data Galeri</h2>

        <p>
            <label>Judul</label><br>
            <input type="text" name="judul" value="{{ old('judul', $gallery->judul) }}" required>
        </p>

        <p>
            <label>Deskripsi</label><br>
            <textarea name="deskripsi" rows="4">{{ old('deskripsi', $gallery->deskripsi) }}</textarea>
        </p>

        <p>
            <label>Tanggal</label><br>
            <input
                type="date"
                name="tanggal"
                value="{{ old('tanggal', optional($gallery->tanggal)->format('Y-m-d')) }}"
            >
        </p>

        <p>
            <label>Thumbnail (4:3)</label><br>
            <input type="file" id="thumbPick" accept="image/*">
        </p>

        <p>
            <img
                id="thumbPreview"
                src="{{ $gallery->thumbnail ? asset('storage/' . $gallery->thumbnail) : '' }}"
                alt="Thumbnail"
                style="display:{{ $gallery->thumbnail ? 'block' : 'none' }}; width:240px;
                       aspect-ratio:4/3; object-fit:cover; border:1px solid #ddd; border-radius:8px;"
            >
        </p>

        <p>
            <button
                type="button"
                id="thumbRecrop"
                data-src="{{ $gallery->thumbnail ? asset('storage/' . $gallery->thumbnail) : '' }}"
                style="display:{{ $gallery->thumbnail ? 'inline-block' : 'none' }};"
            >
                Crop Ulang Thumbnail
            </button>
        </p>

        <input type="file" id="thumbCrop" name="thumbnail" style="display:none;">

        <p>
            <label>Status</label><br>
            <select name="status">
                <option value="aktif" {{ old('status', $gallery->status) == 'aktif' ? 'selected' : '' }}>Aktif</option>
                <option value="nonaktif" {{ old('status', $gallery->status) == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
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

        <div id="fotoList">

            @foreach ($gallery->foto->sortBy('urutan') as $foto)

                <div
                    class="foto-lama"
                    data-id="{{ $foto->id }}"
                    data-src="{{ asset('storage/' . $foto->foto) }}"
                    style="display:flex; gap:15px; flex-wrap:wrap; align-items:flex-start;
                           padding:10px; margin-bottom:10px; border:1px solid #ddd; border-radius:8px;"
                >

                    <div style="position:relative; width:160px;">
                        <img
                            class="foto-img"
                            src="{{ asset('storage/' . $foto->foto) }}"
                            alt="Foto {{ $foto->id }}"
                            style="width:160px; height:120px; object-fit:contain; background:#eee;
                                   border:1px solid #ddd; border-radius:6px;"
                        >

                        <button
                            type="button"
                            class="btn-hapus"
                            style="position:absolute; top:4px; right:4px; width:24px; height:24px;
                                   line-height:20px; padding:0; border:0; border-radius:50%;
                                   background:#dc2626; color:#fff; font-size:16px; cursor:pointer;"
                        >×</button>
                    </div>

                    <div>
                        <p>
                            <input
                                type="text"
                                name="foto_lama[{{ $foto->id }}][keterangan]"
                                value="{{ $foto->keterangan }}"
                                placeholder="Keterangan"
                            >
                        </p>

                        <p>
                            <input
                                type="number"
                                name="foto_lama[{{ $foto->id }}][urutan]"
                                value="{{ $foto->urutan }}"
                                min="0"
                                style="width:80px;"
                                title="Urutan"
                            >
                        </p>

                        <p>
                            <button type="button" class="btn-recrop">Crop Ulang</button>
                        </p>
                    </div>

                    <input
                        type="file"
                        class="foto-ganti"
                        name="foto_ganti[{{ $foto->id }}]"
                        style="display:none;"
                    >

                </div>

            @endforeach

        </div>

    </div>

    <button type="submit">Simpan Perubahan</button>
    <a href="{{ route('admin.gallery.index') }}">Batal</a>

</form>

<link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.2/cropper.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.2/cropper.min.js"></script>
<script src="{{ asset('js/gallery-form.js') }}"></script>

@endsection
