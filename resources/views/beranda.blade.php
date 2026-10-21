@extends('layouts.app')
@section('title', 'Beranda — SDN Rejosari 03')
@push('styles')
<link rel="stylesheet" href="{{ asset('css/beranda.css') }}">
<style>
    /* --- Enhanced Symmetry for Berita Terbaru & Pengumuman --- */
    .home-information {
        display: grid;
        grid-template-columns: minmax(0, 1.9fr) minmax(310px, 1fr);
        gap: 28px;
        align-items: stretch;
    }

    .home-info-col {
        display: flex;
        flex-direction: column;
        height: 100%;
        min-width: 0;
    }

    .home-info-col .home-section-row {
        display: flex;
        justify-content: space-between;
        align-items: baseline;
        gap: 16px;
        margin-bottom: 18px;
        min-height: 40px;
    }

    .home-info-col .home-section-row h2 {
        font-size: clamp(24px, 3vw, 28px);
        font-weight: 700;
        margin: 0;
        color: var(--site-text, #263244);
        line-height: 1.25;
    }

    .home-news {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 20px;
        flex: 1;
        align-items: stretch;
    }

    .home-news-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 14px;
        overflow: hidden;
        display: flex;
        flex-direction: column;
        height: 100%;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
        transition: transform 0.2s ease, box-shadow 0.2s ease, border-color 0.2s ease;
    }

    .home-news-card:hover {
        transform: translateY(-2px);
        border-color: #cbd5e1;
        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.07);
    }

    .home-news-card .home-media {
        aspect-ratio: 16/10;
        border-radius: 0;
        background: linear-gradient(135deg, #f7f1f2 0%, #ece5e7 100%);
        color: #8c7178;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .home-media-placeholder {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 8px;
        color: #a38c92;
        font-size: 11px;
        letter-spacing: 0.8px;
        text-transform: uppercase;
        font-weight: 600;
    }

    .home-card-content {
        padding: 20px;
        display: flex;
        flex-direction: column;
        flex: 1;
    }

    .home-card-content .home-date {
        font-size: 12px;
        font-weight: 600;
        color: var(--site-red, #a84450);
        margin: 0 0 8px;
    }

    .home-card-content h3 {
        font-size: 17px;
        font-weight: 700;
        color: var(--site-text, #263244);
        margin: 0 0 10px;
        line-height: 1.45;
        overflow-wrap: anywhere;
    }

    .home-card-content .home-excerpt {
        font-size: 13.5px;
        color: #64748b;
        line-height: 1.6;
        margin: 0 0 16px;
        flex: 1;
        overflow-wrap: anywhere;
    }

    .home-card-content .home-card-action {
        margin-top: auto;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        color: var(--site-red-dark, #893642);
        font-weight: 700;
        font-size: 13.5px;
        text-decoration: none;
    }

    .home-card-content .home-card-action:hover {
        text-decoration: underline;
    }

    .home-announcements-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 14px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
        display: flex;
        flex-direction: column;
        flex: 1;
        height: 100%;
        overflow: hidden;
    }

    .home-announcement-list {
        padding: 6px 20px;
        display: flex;
        flex-direction: column;
        flex: 1;
    }

    .home-announcement-item {
        padding: 16px 0;
        border-bottom: 1px solid #f1f5f9;
        overflow-wrap: anywhere;
    }

    .home-announcement-item:last-child {
        border-bottom: none;
    }

    .home-announcement-item .home-date {
        font-size: 12px;
        font-weight: 600;
        color: var(--site-red, #a84450);
        margin: 0 0 6px;
    }

    .home-announcement-item h3 {
        font-size: 15.5px;
        font-weight: 700;
        margin: 0 0 6px;
        color: var(--site-text, #263244);
        line-height: 1.45;
    }

    .home-announcement-item p {
        font-size: 13px;
        color: #64748b;
        line-height: 1.55;
        margin: 0;
    }

    .home-announcements-footer {
        padding: 14px 20px;
        border-top: 1px solid #f1f5f9;
        background: #fafbfc;
        margin-top: auto;
    }

    .home-announcements-footer a {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        color: var(--site-red-dark, #893642);
        font-weight: 700;
        font-size: 13.5px;
        text-decoration: none;
    }

    .home-announcements-footer a:hover {
        text-decoration: underline;
    }

    @media (max-width: 900px) {
        .home-information {
            grid-template-columns: 1fr;
        }

        .home-info-col .home-section-row {
            min-height: auto;
        }
    }

    @media (max-width: 640px) {
        .home-news {
            grid-template-columns: 1fr;
        }
    }
</style>
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
        <div class="home-info-col">
            <header class="home-section-row">
                <h2>Berita Terbaru</h2>
                <a class="home-link" href="{{ route('berita.index') }}">Semua berita →</a>
            </header>
            <div class="home-news">
                @forelse ($beritaBeranda as $berita)
                    <article class="home-news-card">
                        <div class="home-media">
                            @if ($berita->thumbnail)
                                <img src="{{ asset('storage/'.$berita->thumbnail) }}" alt="{{ $berita->judul }}" loading="lazy">
                            @else
                                <div class="home-media-placeholder">
                                    <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                        <rect width="18" height="18" x="3" y="3" rx="2" ry="2"></rect>
                                        <circle cx="9" cy="9" r="2"></circle>
                                        <path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21"></path>
                                    </svg>
                                    <span>SDN Rejosari 03</span>
                                </div>
                            @endif
                        </div>
                        <div class="home-card-content">
                            <p class="home-date">{{ $berita->tanggal_publish?->format('d/m/Y') }}</p>
                            <h3>{{ $berita->judul }}</h3>
                            <p class="home-excerpt">{{ \Illuminate\Support\Str::limit(strip_tags($berita->isi ?? ''), 110) }}</p>
                            <a class="home-link home-card-action" href="{{ route('berita.index', ['q' => $berita->judul]) }}">Baca berita →</a>
                        </div>
                    </article>
                @empty
                    <p class="home-empty">Belum ada berita yang dipublikasikan.</p>
                @endforelse
            </div>
        </div>

        <aside class="home-info-col" aria-labelledby="home-announcement-title">
            <header class="home-section-row">
                <h2 id="home-announcement-title">Pengumuman</h2>
                <a class="home-link" href="{{ route('berita.index') }}#pengumuman">Semua pengumuman →</a>
            </header>
            <div class="home-announcements-card">
                <div class="home-announcement-list">
                    @forelse ($pengumumanBeranda as $pengumuman)
                        <article class="home-announcement-item">
                            <p class="home-date">{{ $pengumuman->tanggal_mulai?->format('d/m/Y') }}</p>
                            <h3>{{ $pengumuman->judul }}</h3>
                            <p>{{ \Illuminate\Support\Str::limit(strip_tags($pengumuman->isi ?? ''), 95) }}</p>
                        </article>
                    @empty
                        <p class="home-empty" style="margin: 0;">Belum ada pengumuman yang dipublikasikan.</p>
                    @endforelse
                </div>
                <div class="home-announcements-footer">
                    <a class="home-link" href="{{ route('berita.index') }}#pengumuman">Lihat semua pengumuman sekolah →</a>
                </div>
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
