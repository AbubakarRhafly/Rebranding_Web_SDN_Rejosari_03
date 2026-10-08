@extends('layouts.app')

@section('title', 'Tambah Kegiatan Lomba')

@section('content')

<h1>Tambah Kegiatan Lomba</h1>

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
        action="{{ route('admin.kegiatan-lomba.store') }}"
        method="POST"
    >

        @csrf

        <p>
            <label>Kategori</label><br>

            <select name="kategori" required>

                <option value="">-- Pilih Kategori --</option>

                <option value="MAPSI"
                    {{ old('kategori') == 'MAPSI' ? 'selected' : '' }}>
                    MAPSI
                </option>

                <option value="Literasi"
                    {{ old('kategori') == 'Literasi' ? 'selected' : '' }}>
                    Literasi
                </option>

                <option value="Bahasa Jawa"
                    {{ old('kategori') == 'Bahasa Jawa' ? 'selected' : '' }}>
                    Bahasa Jawa
                </option>

                <option value="Siswa Berprestasi"
                    {{ old('kategori') == 'Siswa Berprestasi' ? 'selected' : '' }}>
                    Siswa Berprestasi
                </option>

                <option value="Motivasi & Inspiratif"
                    {{ old('kategori') == 'Motivasi & Inspiratif' ? 'selected' : '' }}>
                    Motivasi & Inspiratif
                </option>

            </select>
        </p>

        <p>
            <label>Judul Kegiatan</label><br>

            <input
                type="text"
                name="judul"
                value="{{ old('judul') }}"
                required
            >
        </p>

        <p>
            <label>Nama Peserta</label><br>

            <input
                type="text"
                name="nama_peserta"
                value="{{ old('nama_peserta') }}"
            >
        </p>

        <p>
            <label>Kelas</label><br>

            <input
                type="text"
                name="kelas"
                value="{{ old('kelas') }}"
                placeholder="Contoh: 6A"
            >
        </p>

        <p>
            <label>Jenis Kegiatan</label><br>

            <input
                type="text"
                name="jenis_kegiatan"
                value="{{ old('jenis_kegiatan') }}"
                placeholder="Contoh: Lomba Pidato"
            >
        </p>

        <p>
            <label>Tingkat</label><br>

            <input
                type="text"
                name="tingkat"
                value="{{ old('tingkat') }}"
                placeholder="Contoh: Kecamatan"
            >
        </p>

        <p>
            <label>Hasil</label><br>

            <input
                type="text"
                name="hasil"
                value="{{ old('hasil') }}"
                placeholder="Contoh: Juara 1"
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
                rows="6"
            >{{ old('deskripsi') }}</textarea>
        </p>

        <button type="submit">
            Simpan
        </button>

        <a href="{{ route('admin.kegiatan-lomba.index') }}">
            Batal
        </a>

    </form>

</div>

@endsection
