@extends('layouts.app')
@section('title', 'Beranda — SDN Rejosari 03')
@push('styles')
<link rel="stylesheet" href="{{ asset('css/beranda.css') }}">
@endpush
@section('content')
<main class="home-school">
    <section class="home-hero" aria-labelledby="home-title">
        <img class="home-school-photo" src="{{ asset('images/sekolah-rejosari03.jpg') }}" alt="Tampak depan SDN Rejosari 03 Semarang" width="512" height="384" fetchpriority="high">
        <div class="home-intro">
            <p class="home-eyebrow">SELAMAT DATANG</p>
            <h1 id="home-title">SDN Rejosari 03</h1>
            <p>Kenali sekolah kami melalui informasi guru dan staf, kegiatan siswa, berita, serta dokumentasi sekolah. Website ini menjadi tempat untuk mengikuti informasi terbaru SDN Rejosari 03 Semarang.</p>
            <a class="home-button" href="#lokasi-sekolah">Lokasi sekolah <span aria-hidden="true">↗</span></a>
        </div>
        <div class="home-stats" aria-label="Data sekolah">
            <div><strong>{{ number_format($jumlahSiswa, 0, ',', '.') }}</strong><span>Siswa aktif</span></div>
            <div><strong>{{ number_format($jumlahGuru, 0, ',', '.') }}</strong><span>Guru dan staf aktif</span></div>
            <p>Berdasarkan data yang tercatat di website.</p>
        </div>
    </section>
    <section class="home-section" aria-labelledby="home-guru-title">
        <header class="home-heading"><p class="home-eyebrow">TENAGA PENDIDIK DAN KEPENDIDIKAN</p><h2 id="home-guru-title">Guru dan Staf Kami</h2></header>
        <div class="home-teachers">
            @forelse ($guruBeranda as $guru)
                <article class="home-person">
                    <div class="home-media home-portrait">
                        <span>Foto belum tersedia</span>
                        @if ($guru->foto && str_starts_with($guru->foto, 'images/guru/') && !str_contains($guru->foto, '..'))
                            <img src="{{ asset($guru->foto) }}" alt="{{ $guru->nama }}" loading="lazy">
                        @endif
                    </div>
                    <h3>{{ $guru->nama }}</h3><p>{{ $guru->jabatan }}</p>
                </article>
            @empty
                <p>Data guru dan staf belum tersedia.</p>
            @endforelse
        </div>
        <p class="home-center"><a class="home-link" href="{{ route('guru.index') }}">Lihat semua guru dan staf →</a></p>
    </section>
    <section class="home-section home-information" aria-label="Informasi sekolah">
        <div>
            <header class="home-section-row"><h2>Berita Terbaru</h2><a class="home-link" href="{{ route('berita.index') }}">Semua berita →</a></header>
            <div class="home-news">
                @forelse ($beritaBeranda as $berita)
                    <article class="home-news-card">
                        <div class="home-media">
                            <span>Gambar belum tersedia</span>
                            @if ($berita->thumbnail)
                                <img src="{{ asset('storage/'.$berita->thumbnail) }}" alt="{{ $berita->judul }}" loading="lazy">
                            @endif
                        </div>
                        <div class="home-card-content">
                            <p class="home-date">{{ $berita->tanggal_publish?->format('d/m/Y') }}</p>
                            <h3>{{ $berita->judul }}</h3>
                            <p>{{ \Illuminate\Support\Str::limit(strip_tags($berita->isi ?? ''), 120) }}</p>
                            <a class="home-link" href="{{ route('berita.index', ['q' => $berita->judul]) }}">Baca berita →</a>
                        </div>
                    </article>
                @empty
                    <p class="home-empty">Belum ada berita yang dipublikasikan.</p>
                @endforelse
            </div>
        </div>
        <aside class="home-announcements" aria-labelledby="home-announcement-title">
            <h2 id="home-announcement-title">Pengumuman</h2>
            <div class="home-announcement-list">
                @forelse ($pengumumanBeranda as $pengumuman)
                    <article>
                        <p class="home-date">{{ $pengumuman->tanggal_mulai?->format('d/m/Y') }}</p>
                        <h3>{{ $pengumuman->judul }}</h3>
                        <p>{{ \Illuminate\Support\Str::limit(strip_tags($pengumuman->isi ?? ''), 100) }}</p>
                    </article>
                @empty
                    <p>Belum ada pengumuman yang dipublikasikan.</p>
                @endforelse
                <a class="home-link" href="{{ route('pengumuman.index') }}">Semua pengumuman →</a>
            </div>
        </aside>
    </section>
    <section class="home-section" aria-labelledby="home-gallery-title">
        <header class="home-heading"><p class="home-eyebrow">MOMEN SEKOLAH</p><h2 id="home-gallery-title">Galeri</h2></header>
        <div class="home-albums">
            @forelse ($galeriBeranda as $album)
                <a class="home-album" href="{{ route('gallery.index') }}">
                    <div class="home-media"><span>Foto belum tersedia</span>
                        @if ($album->thumbnail)
                            <img src="{{ asset('storage/'.$album->thumbnail) }}" alt="{{ $album->judul }}" loading="lazy">
                        @endif
                    </div>
                    <h3>{{ $album->judul }}</h3>
                </a>
            @empty
                <p class="home-empty">Belum ada album yang dipublikasikan.</p>
            @endforelse
        </div>
        <p class="home-center"><a class="home-link" href="{{ route('gallery.index') }}">Lihat semua album →</a></p>
    </section>
    <section class="home-section home-location" id="lokasi-sekolah" aria-labelledby="home-location-title">
        <div><p class="home-eyebrow">KUNJUNGI KAMI</p><h2 id="home-location-title">Lokasi Sekolah</h2><p>SDN Rejosari 03<br>Kecamatan Semarang Timur, Kota Semarang.</p><a class="home-button" href="https://www.google.com/maps/search/?api=1&amp;query=SDN+Rejosari+03+Semarang" target="_blank" rel="noopener noreferrer">Buka Google Maps ↗</a></div>
        <iframe title="Peta pencarian SDN Rejosari 03 Semarang" src="https://maps.google.com/maps?q=SDN%20Rejosari%2003%20Semarang&amp;output=embed" width="600" height="320" loading="lazy" referrerpolicy="no-referrer-when-downgrade" allowfullscreen></iframe>
    </section>
</main>
@endsection
@push('scripts')
<script src="{{ asset('js/beranda.js') }}" defer></script>
@endpush
