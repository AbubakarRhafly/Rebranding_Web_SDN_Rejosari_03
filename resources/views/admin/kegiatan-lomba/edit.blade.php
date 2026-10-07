@extends('layouts.app')

@section('title', 'Edit Kegiatan Lomba')

@section('content')

<h1>Edit Kegiatan Lomba</h1>

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
        action="{{ route('admin.kegiatan-lomba.update', $kegiatan->id) }}"
        method="POST"
    >

        @csrf
        @method('PUT')

        <p>
            <label>Kategori</label><br>

            <select name="kategori" required>

                <option value="MAPSI"
                    {{ old('kategori', $kegiatan->kategori) == 'MAPSI' ? 'selected' : '' }}>
                    MAPSI
                </option>

                <option value="Literasi"
                    {{ old('kategori', $kegiatan->kategori) == 'Literasi' ? 'selected' : '' }}>
                    Literasi
                </option>

                <option value="Bahasa Jawa"
                    {{ old('kategori', $kegiatan->kategori) == 'Bahasa Jawa' ? 'selected' : '' }}>
                    Bahasa Jawa
                </option>

                <option value="Siswa Berprestasi"
                    {{ old('kategori', $kegiatan->kategori) == 'Siswa Berprestasi' ? 'selected' : '' }}>
                    Siswa Berprestasi
                </option>

                <option value="Motivasi & Inspiratif"
                    {{ old('kategori', $kegiatan->kategori) == 'Motivasi & Inspiratif' ? 'selected' : '' }}>
                    Motivasi & Inspiratif
                </option>

            </select>
        </p>

        <p>
            <label>Judul Kegiatan</label><br>

            <input
                type="text"
                name="judul"
                value="{{ old('judul', $kegiatan->judul) }}"
                required
            >
        </p>

        <p>
            <label>Nama Peserta</label><br>

            <input
                type="text"
                name="nama_peserta"
                value="{{ old('nama_peserta', $kegiatan->nama_peserta) }}"
            >
        </p>

        <p>
            <label>Kelas</label><br>

            <input
                type="text"
                name="kelas"
                value="{{ old('kelas', $kegiatan->kelas) }}"
            >
        </p>

        <p>
            <label>Jenis Kegiatan</label><br>

            <input
                type="text"
                name="jenis_kegiatan"
                value="{{ old('jenis_kegiatan', $kegiatan->jenis_kegiatan) }}"
            >
        </p>

        <p>
            <label>Tingkat</label><br>

            <input
                type="text"
                name="tingkat"
                value="{{ old('tingkat', $kegiatan->tingkat) }}"
            >
        </p>

        <p>
            <label>Hasil</label><br>

            <input
                type="text"
                name="hasil"
                value="{{ old('hasil', $kegiatan->hasil) }}"
            >
        </p>

        <p>
            <label>Tanggal</label><br>

            <input
                type="date"
                name="tanggal"
                value="{{ old(
                    'tanggal',
                    $kegiatan->tanggal
                        ? $kegiatan->tanggal->format('Y-m-d')
                        : ''
                ) }}"
            >
        </p>

        <p>
            <label>Foto</label><br>

            <input
                type="text"
                name="foto"
                value="{{ old('foto', $kegiatan->foto) }}"
                placeholder="Path foto (sementara)"
            >
        </p>

        <p>
            <label>Deskripsi</label><br>

            <textarea
                name="deskripsi"
                rows="6"
            >{{ old('deskripsi', $kegiatan->deskripsi) }}</textarea>
        </p>

        <button type="submit">
            Simpan Perubahan
        </button>

        <a href="{{ route('admin.kegiatan-lomba.index') }}">
            Batal
        </a>

    </form>

</div>

@endsection
