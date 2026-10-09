@extends('layouts.app')

@section('title', 'Edit Pengumuman')

@section('content')

<h1>Edit Pengumuman</h1>

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
        action="{{ route('admin.pengumuman.update', $pengumuman->id) }}"
        method="POST"
        enctype="multipart/form-data"
    >

        @csrf
        @method('PUT')


        <!-- JUDUL -->

        <p>

            <label>Judul</label><br>

            <input
                type="text"
                name="judul"
                value="{{ old('judul', $pengumuman->judul) }}"
                required
            >

        </p>


        <!-- FOTO SAAT INI -->

        <p>

            <label>
                <strong>Foto Saat Ini</strong>
            </label>

            <br>

            @if ($pengumuman->foto)

                <img
                    src="{{ asset('storage/' . $pengumuman->foto) }}"
                    alt="{{ $pengumuman->judul }}"
                    style="
                        width: 200px;
                        height: 140px;
                        object-fit: cover;
                        border-radius: 5px;
                        margin-top: 10px;
                    "
                >

            @else

                <span>
                    Tidak ada foto.
                </span>

            @endif

        </p>


        <!-- GANTI FOTO -->

        <p>

            <label>
                <strong>Ganti Foto</strong>
            </label>

            <br>

            <input
                type="file"
                name="foto"
                accept="image/*"
            >

        </p>

        <small>
            Kosongkan jika tidak ingin mengganti foto.
            Format: JPG, JPEG, PNG, WEBP.
            Maksimal 5 MB.
        </small>


        <!-- TANGGAL MULAI -->

        <p>

            <label>Tanggal Mulai</label><br>

            <input
                type="date"
                name="tanggal_mulai"
                value="{{ old(
                    'tanggal_mulai',
                    $pengumuman->tanggal_mulai
                        ? $pengumuman->tanggal_mulai->format('Y-m-d')
                        : ''
                ) }}"
            >

        </p>


        <!-- TANGGAL SELESAI -->

        <p>

            <label>Tanggal Selesai</label><br>

            <input
                type="date"
                name="tanggal_selesai"
                value="{{ old(
                    'tanggal_selesai',
                    $pengumuman->tanggal_selesai
                        ? $pengumuman->tanggal_selesai->format('Y-m-d')
                        : ''
                ) }}"
            >

        </p>


        <!-- LAMPIRAN SAAT INI -->

        <p>

            <label>
                <strong>Lampiran Saat Ini</strong>
            </label>

            <br>

            @if ($pengumuman->lampiran)

                <a
                    href="{{ asset('storage/' . $pengumuman->lampiran) }}"
                    target="_blank"
                >
                    Lihat / Buka Lampiran
                </a>

            @else

                <span>
                    Tidak ada lampiran.
                </span>

            @endif

        </p>


        <!-- GANTI LAMPIRAN -->

        <p>

            <label>
                <strong>Ganti Lampiran</strong>
            </label>

            <br>

            <input
                type="file"
                name="lampiran"
            >

        </p>

        <small>
            Kosongkan jika tidak ingin mengganti lampiran.
            Maksimal 5 MB.
        </small>


        <!-- STATUS -->

        <p>

            <label>Status</label><br>

            <select name="status" required>

                <option
                    value="draft"
                    {{ old(
                        'status',
                        $pengumuman->status
                    ) == 'draft' ? 'selected' : '' }}
                >
                    Draft
                </option>

                <option
                    value="published"
                    {{ old(
                        'status',
                        $pengumuman->status
                    ) == 'published' ? 'selected' : '' }}
                >
                    Published
                </option>

            </select>

        </p>


        <!-- ISI -->

        <p>

            <label>Isi Pengumuman</label><br>

            <textarea
                name="isi"
                rows="10"
                required
            >{{ old('isi', $pengumuman->isi) }}</textarea>

        </p>


        <button type="submit">
            Simpan Perubahan
        </button>


        <a href="{{ route('admin.pengumuman.index') }}">
            Batal
        </a>

    </form>

</div>

@endsection
