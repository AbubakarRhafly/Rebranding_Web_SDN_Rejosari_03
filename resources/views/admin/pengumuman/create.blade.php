@extends('layouts.app')

@section('title', 'Tambah Pengumuman')

@section('content')

<h1>Tambah Pengumuman</h1>

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

    <form action="{{ route('admin.pengumuman.store') }}" method="POST">

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
            <label>Tanggal Mulai</label><br>

            <input
                type="date"
                name="tanggal_mulai"
                value="{{ old('tanggal_mulai') }}"
            >
        </p>

        <p>
            <label>Tanggal Selesai</label><br>

            <input
                type="date"
                name="tanggal_selesai"
                value="{{ old('tanggal_selesai') }}"
            >
        </p>

        <p>
            <label>Lampiran</label><br>

            <input
                type="text"
                name="lampiran"
                value="{{ old('lampiran') }}"
                placeholder="Path lampiran (sementara)"
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
            <label>Isi Pengumuman</label><br>

            <textarea
                name="isi"
                rows="10"
                required
            >{{ old('isi') }}</textarea>
        </p>

        <button type="submit">
            Simpan
        </button>

        <a href="{{ route('admin.pengumuman.index') }}">
            Batal
        </a>

    </form>

</div>

@endsection
