@extends('layouts.app')

@section('title', 'Edit Guru')

@section('content')

<h1>Edit Guru</h1>

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
        action="{{ route('admin.guru.update', $guru->id) }}"
        method="POST"
    >

        @csrf
        @method('PUT')

        <p>
            <label>Nama</label><br>

            <input
                type="text"
                name="nama"
                value="{{ old('nama', $guru->nama) }}"
                required
            >
        </p>

        <p>
            <label>Jabatan</label><br>

            <input
                type="text"
                name="jabatan"
                value="{{ old('jabatan', $guru->jabatan) }}"
                required
            >
        </p>

        <p>
            <label>Foto</label><br>

            <input
                type="text"
                name="foto"
                value="{{ old('foto', $guru->foto) }}"
            >
        </p>

        <p>
            <label>Kata-kata</label><br>

            <textarea
                name="kata_kata"
                rows="4"
            >{{ old('kata_kata', $guru->kata_kata) }}</textarea>
        </p>

        <p>
            <label>Urutan</label><br>

            <input
                type="number"
                name="urutan"
                value="{{ old('urutan', $guru->urutan) }}"
                min="0"
            >
        </p>

        <p>
            <label>Status</label><br>

            <select name="status">

                <option
                    value="aktif"
                    {{ $guru->status == 'aktif' ? 'selected' : '' }}
                >
                    Aktif
                </option>

                <option
                    value="nonaktif"
                    {{ $guru->status == 'nonaktif' ? 'selected' : '' }}
                >
                    Nonaktif
                </option>

            </select>
        </p>

        <button type="submit">
            Simpan Perubahan
        </button>

        <a href="{{ route('admin.guru.index') }}">
            Batal
        </a>

    </form>

</div>

@endsection
