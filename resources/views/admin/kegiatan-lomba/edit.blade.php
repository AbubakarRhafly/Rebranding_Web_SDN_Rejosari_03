
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
        enctype="multipart/form-data"
    >
        @csrf
        @method('PUT')

        <p>
            <label for="kategori">Kategori</label><br>
            <select name="kategori" id="kategori" required>
                @foreach ([
                    'MAPSI',
                    'Literasi',
                    'Bahasa Jawa',
                    'Siswa Berprestasi',
                    'Motivasi & Inspiratif'
                ] as $kategori)
                    <option value="{{ $kategori }}"
                        {{ old('kategori', $kegiatan->kategori) == $kategori ? 'selected' : '' }}>
                        {{ $kategori }}
                    </option>
                @endforeach
            </select>
        </p>

        <p>
            <label for="judul">Judul Kegiatan</label><br>
            <input type="text" id="judul" name="judul"
                   value="{{ old('judul', $kegiatan->judul) }}"
                   maxlength="255" required>
        </p>

        <p>
            <label for="nama_peserta">Nama Peserta</label><br>
            <input type="text" id="nama_peserta" name="nama_peserta"
                   value="{{ old('nama_peserta', $kegiatan->nama_peserta) }}"
                   maxlength="150">
        </p>

        <p>
            <label for="kelas">Kelas</label><br>
            <input type="text" id="kelas" name="kelas"
                   value="{{ old('kelas', $kegiatan->kelas) }}"
                   maxlength="20">
        </p>

        <p>
            <label for="jenis_kegiatan">Jenis Kegiatan</label><br>
            <input type="text" id="jenis_kegiatan" name="jenis_kegiatan"
                   value="{{ old('jenis_kegiatan', $kegiatan->jenis_kegiatan) }}"
                   maxlength="150">
        </p>

        <p>
            <label for="tingkat">Tingkat</label><br>
            <input type="text" id="tingkat" name="tingkat"
                   value="{{ old('tingkat', $kegiatan->tingkat) }}"
                   maxlength="100">
        </p>

        <p>
            <label for="hasil">Hasil</label><br>
            <input type="text" id="hasil" name="hasil"
                   value="{{ old('hasil', $kegiatan->hasil) }}"
                   maxlength="150">
        </p>

        <p>
            <label for="tanggal">Tanggal</label><br>
            <input type="date" id="tanggal" name="tanggal"
                   value="{{ old('tanggal', $kegiatan->tanggal ? $kegiatan->tanggal->format('Y-m-d') : '') }}">
        </p>

        <p>
            <label for="foto">Foto (Path Lama, Opsional)</label><br>
            <input type="text" id="foto" name="foto"
                   value="{{ old('foto', $kegiatan->foto) }}"
                   maxlength="255">
        </p>

        <p>
            <strong>Dokumentasi Siswa dan Piagam Saat Ini</strong><br>

            @if ($kegiatan->dokumentasi)
                <img
                    src="{{ asset('storage/' . $kegiatan->dokumentasi) }}"
                    alt="Dokumentasi {{ $kegiatan->judul }}"
                    style="max-width: 300px; max-height: 300px; object-fit: contain;"
                >
            @else
                <span>Belum ada dokumentasi.</span>
            @endif
        </p>

        <p>
            <label for="dokumentasi">Ganti Dokumentasi</label><br>
            <input
                type="file"
                id="dokumentasi"
                name="dokumentasi"
                accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp"
            ><br>
            <small>
                Format JPG, JPEG, PNG, atau WEBP. Maksimal 5 MB.
                Kosongkan jika tidak ingin mengganti dokumentasi.
            </small>
        </p>

        <p>
            <label for="deskripsi">Deskripsi</label><br>
            <textarea id="deskripsi" name="deskripsi" rows="6">{{ old('deskripsi', $kegiatan->deskripsi) }}</textarea>
        </p>

        <button type="submit">Simpan Perubahan</button>
        <a href="{{ route('admin.kegiatan-lomba.index') }}">Batal</a>
    </form>
</div>

@endsection
