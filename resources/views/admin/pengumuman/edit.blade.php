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
    >

        @csrf
        @method('PUT')

        <p>
            <label>Judul</label><br>

            <input
                type="text"
                name="judul"
                value="{{ old('judul', $pengumuman->judul) }}"
                required
            >
        </p>

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

        <p>
            <label>Lampiran</label><br>

            <input
                type="text"
                name="lampiran"
                value="{{ old('lampiran', $pengumuman->lampiran) }}"
                placeholder="Path lampiran (sementara)"
            >
        </p>

        <p>
            <label>Status</label><br>

            <select name="status" required>

                <option
                    value="draft"
                    {{ old('status', $pengumuman->status) == 'draft' ? 'selected' : '' }}
                >
                    Draft
                </option>

                <option
                    value="published"
                    {{ old('status', $pengumuman->status) == 'published' ? 'selected' : '' }}
                >
                    Published
                </option>

            </select>
        </p>

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
