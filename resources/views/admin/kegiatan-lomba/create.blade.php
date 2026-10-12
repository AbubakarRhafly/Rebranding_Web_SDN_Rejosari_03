
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
        enctype="multipart/form-data"
    >
        @csrf

        <p>
            <label for="kategori">Kategori</label><br>
            <select name="kategori" id="kategori" required>
                <option value="">-- Pilih Kategori --</option>
                @foreach ([
                    'MAPSI',
                    'Literasi',
                    'Bahasa Jawa',
                    'Siswa Berprestasi',
                    'Motivasi & Inspiratif'
                ] as $kategori)
                    <option value="{{ $kategori }}"
                        {{ old('kategori') == $kategori ? 'selected' : '' }}>
                        {{ $kategori }}
                    </option>
                @endforeach
            </select>
        </p>

        <p>
            <label for="judul">Judul Kegiatan</label><br>
            <input type="text" id="judul" name="judul"
                   value="{{ old('judul') }}" maxlength="255" required>
        </p>

        <p>
            <label for="nama_peserta">Nama Peserta</label><br>
            <input type="text" id="nama_peserta" name="nama_peserta"
                   value="{{ old('nama_peserta') }}" maxlength="150">
        </p>

        <p>
            <label for="kelas">Kelas</label><br>
            <input type="text" id="kelas" name="kelas"
                   value="{{ old('kelas') }}" maxlength="20"
                   placeholder="Contoh: 6A">
        </p>

        <p>
            <label for="jenis_kegiatan">Jenis Kegiatan</label><br>
            <input type="text" id="jenis_kegiatan" name="jenis_kegiatan"
                   value="{{ old('jenis_kegiatan') }}" maxlength="150"
                   placeholder="Contoh: Lomba Pidato">
        </p>

        <p>
            <label for="tingkat">Tingkat</label><br>
            <input type="text" id="tingkat" name="tingkat"
                   value="{{ old('tingkat') }}" maxlength="100"
                   placeholder="Contoh: Kecamatan">
        </p>

        <p>
            <label for="hasil">Hasil</label><br>
            <input type="text" id="hasil" name="hasil"
                   value="{{ old('hasil') }}" maxlength="150"
                   placeholder="Contoh: Juara 1 atau Peserta">
        </p>

        <p>
            <label for="tanggal">Tanggal</label><br>
            <input type="date" id="tanggal" name="tanggal"
                   value="{{ old('tanggal') }}">
        </p>

        <p>
            <label for="foto">Foto (Path Lama, Opsional)</label><br>
            <input type="text" id="foto" name="foto"
                   value="{{ old('foto') }}" maxlength="255"
                   placeholder="Path foto lama jika masih digunakan">
        </p>

        <p>
            <label for="dokumentasi">
                Dokumentasi Siswa dan Piagam
            </label><br>
            <input
                type="file"
                id="dokumentasi"
                name="dokumentasi"
                accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp"
            ><br>
            <small>Format JPG, JPEG, PNG, atau WEBP. Maksimal 5 MB.</small>
        </p>

        <p>
            <label for="deskripsi">Deskripsi</label><br>
            <textarea id="deskripsi" name="deskripsi" rows="6">{{ old('deskripsi') }}</textarea>
        </p>

        <button type="submit">Simpan</button>
        <a href="{{ route('admin.kegiatan-lomba.index') }}">Batal</a>
    </form>
</div>

@endsection
