@extends('layouts.app')

@section('title', 'Profil Guru dan Staf | SDN Rejosari 03')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/profil-guru.css') }}">

<style>
    .profil-guru {
        color: #202c46;
        font-family: Arial, sans-serif;
        line-height: 1.6;
    }

    .profil-guru__empty {
        padding: 32px 20px;
        border: 1px dashed #d5dae1;
        border-radius: 16px;
        background: #ffffff;
        text-align: center;
        color: #526076;
    }

    .profil-guru__placeholder {
        display: grid;
        place-items: center;
        padding: 20px;
        color: #647084;
        text-align: center;
    }
</style>
@endpush

@section('content')
@php
// Mengelompokkan tampilan berdasarkan jabatan yang sudah tersedia.
// Urutan dari controller tetap dipertahankan dalam setiap kelompok.
$kelompokGuru = $guru->groupBy(function ($item) {
$jabatan = strtolower(trim((string) $item->jabatan));
$jabatan = preg_replace('/\s+/', ' ', $jabatan);

if (str_contains($jabatan, 'kepala sekolah')) {
return 'kepala-sekolah';
}

if (preg_match('/^guru\b/', $jabatan)) {
return 'guru';
}

if (preg_match('/^(staf|staff|tenaga|petugas|operator|penjaga)\b/', $jabatan)) {
return 'staf';
}

// Data dengan jabatan lain tetap ditampilkan.
return 'lainnya';
});

$kategori = [
'kepala-sekolah' => [
'judul' => 'Kepala Sekolah',
'label' => 'PIMPINAN SEKOLAH',
'deskripsi' => 'Mengenal kepala sekolah SDN Rejosari 03.',
],
'guru' => [
'judul' => 'Guru',
'label' => 'TENAGA PENDIDIK',
'deskripsi' => 'Para pendidik yang mendampingi siswa dalam belajar dan berkembang.',
],
'staf' => [
'judul' => 'Staf',
'label' => 'TENAGA KEPENDIDIKAN',
'deskripsi' => 'Mendukung pelayanan dan kegiatan sehari-hari di sekolah.',
],
'lainnya' => [
'judul' => 'Personel Lainnya',
'label' => 'WARGA SEKOLAH',
'deskripsi' => 'Personel lainnya di SDN Rejosari 03.',
],
];
@endphp

<main class="profil-guru">
    <header class="profil-guru__intro">
        <p class="profil-guru__label">SDN REJOSARI 03</p>

        <h1>Mengenal Guru dan <span>Staf Kami</span></h1>

        <p class="profil-guru__description">
            Mengenal para pendidik dan tenaga kependidikan
            yang mendampingi kegiatan belajar di SDN Rejosari 03.
        </p>

        <a class="profil-guru__button" href="#daftar-guru">
            Lihat Guru dan Staf
            <span aria-hidden="true">↓</span>
        </a>
    </header>

    <div id="daftar-guru" class="profil-guru__directory">
        @if ($guru->isEmpty())
        <div class="profil-guru__empty profil-guru__section">
            <p>Data guru dan staf belum tersedia.</p>
        </div>
        @else
        <div class="profil-guru__search" role="search" hidden>
            <label for="cari-guru">Cari guru dan staf</label>

            <div class="profil-guru__search-row">
                <input
                    type="search"
                    id="cari-guru"
                    placeholder="Ketik nama atau jabatan..."
                    aria-controls="daftar-guru"
                    autocomplete="off">

                <button type="button" id="reset-cari-guru">
                    Hapus pencarian
                </button>
            </div>

            <p id="hasil-cari-guru" role="status" aria-live="polite"></p>
        </div>

        <div id="pencarian-kosong" class="profil-guru__empty" hidden>
            <p>Tidak ada nama atau jabatan yang cocok.</p>
            <p>Coba kata lain atau hapus pencarian.</p>
        </div>
        <div
            class="profil-guru__shortcuts"
            role="group"
            aria-label="Pilih kelompok guru dan staf">
            @foreach ($kategori as $kode => $info)
            @if ($kelompokGuru->has($kode))
            <a href="#kelompok-{{ $kode }}">
                {{ $info['judul'] }}
                <span>{{ $kelompokGuru->get($kode)->count() }}</span>
            </a>
            @endif
            @endforeach
        </div>

        @foreach ($kategori as $kode => $info)
        @if ($kelompokGuru->has($kode))
        <section
            class="profil-guru__section"
            id="kelompok-{{ $kode }}"
            aria-labelledby="judul-{{ $kode }}">

            <div class="profil-guru__section-heading">
                <p class="profil-guru__label">
                    {{ $info['label'] }}
                </p>

                <h2 id="judul-{{ $kode }}">
                    {{ $info['judul'] }}
                </h2>

                <p>{{ $info['deskripsi'] }}</p>
            </div>

            <div class="profil-guru__grid {{ $kode === 'kepala-sekolah' ? 'profil-guru__grid--kepala' : '' }}">
                @foreach ($kelompokGuru->get($kode) as $item)
                @php
                $fotoPath = ltrim((string) $item->foto, '/');
                $fotoUrl = null;

                if (
                str_starts_with($fotoPath, 'images/guru/')
                && !str_contains($fotoPath, '..')
                && is_file(public_path($fotoPath))
                ) {
                $fotoUrl = asset($fotoPath);
                }
                @endphp

                <article class="profil-guru__card">
                    @if ($fotoUrl)
                    <img
                        class="profil-guru__photo"
                        src="{{ $fotoUrl }}"
                        alt="Foto {{ $item->nama }}"
                        width="600"
                        height="750"
                        loading="lazy">
                    @else
                    <div class="profil-guru__photo profil-guru__placeholder">
                        <span>Foto belum tersedia</span>
                    </div>
                    @endif

                    <div class="profil-guru__card-content">
                        <p class="profil-guru__role">
                            {{ $item->jabatan }}
                        </p>

                        <h3>{{ $item->nama }}</h3>

                        <p class="profil-guru__school">
                            SDN Rejosari 03
                        </p>
                    </div>
                </article>
                @endforeach
            </div>
        </section>
        @endif
        @endforeach
        @endif
    </div>
</main>
<script src="{{ asset('js/profil-guru.js') }}" defer></script>
@endsection