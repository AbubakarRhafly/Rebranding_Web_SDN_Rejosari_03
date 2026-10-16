@extends('layouts.app')

@section('title', 'Galeri Sekolah')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/gallery-public.css') }}">
@endpush

@section('content')
<section class="school-gallery" aria-labelledby="gallery-heading">
    <header class="sg-header">
        <p class="sg-eyebrow">SDN REJOSARI 03</p>
        <h1 id="gallery-heading">Galeri Sekolah</h1>
        <p>Dokumentasi berbagai kegiatan dan momen sekolah.</p>
    </header>
    <section class="sg-filter" aria-labelledby="gallery-search-heading">
        <h2 id="gallery-search-heading">Temukan Album</h2>
        <p>Cari dokumentasi kegiatan sekolah yang kamu inginkan.</p>
        <label for="gallery-search">Judul album</label>
        <input id="gallery-search" type="search" placeholder="Cari berdasarkan judul album…" autocomplete="off">
        <p id="gallery-count" role="status">{{ $gallery->count() }} album</p>
    </section>
    <div class="sg-grid">
        @forelse ($gallery as $item)
            <article class="sg-album">
                <div class="sg-cover">
                    <span>Foto belum tersedia</span>
                    @if ($item->thumbnail)
                        <img src="{{ asset('storage/'.$item->thumbnail) }}" alt="Sampul {{ $item->judul }}" loading="lazy">
                    @elseif ($item->foto->first()?->foto)
                        <img src="{{ asset('storage/'.$item->foto->first()->foto) }}" alt="Sampul {{ $item->judul }}" loading="lazy">
                    @endif
                </div>
                <div class="sg-info">
                    <p class="sg-date">{{ $item->tanggal?->format('d/m/Y') ?? 'Tanggal belum tersedia' }}</p>
                    <h2>{{ $item->judul }}</h2>
                    <p class="sg-description">{{ $item->deskripsi }}</p>
                    <button class="sg-open" type="button" aria-haspopup="dialog" hidden>Lihat album <span aria-hidden="true">→</span></button>
                    <noscript><p>Aktifkan JavaScript untuk membuka foto album.</p></noscript>
                </div>
                <template class="sg-data">
                    @foreach ($item->foto->sortBy('urutan') as $foto)
                        @if ($foto->foto)
                            <span data-src="{{ asset('storage/'.$foto->foto) }}" data-caption="{{ $foto->keterangan }}"></span>
                        @endif
                    @endforeach
                </template>
            </article>
        @empty
            <p class="sg-empty">Belum ada album yang dipublikasikan.</p>
        @endforelse
    </div>
    <p class="sg-empty" id="gallery-no-results" hidden>Tidak ada album yang cocok. Coba kata kunci lain.</p>
    <dialog id="gallery-dialog" aria-labelledby="gallery-dialog-title">
        <div class="sg-dialog-body">
            <div class="sg-stage">
                <p id="gallery-photo-message" role="status">Foto belum tersedia</p>
                <img id="gallery-photo" alt="" hidden>
            </div>
            <section class="sg-detail">
                <button id="gallery-close" type="button" aria-label="Tutup album" autofocus>×</button>
                <p class="sg-eyebrow">SDN REJOSARI 03</p>
                <h2 id="gallery-dialog-title"></h2>
                <p id="gallery-dialog-date"></p>
                <p id="gallery-dialog-description"></p>
                <p id="gallery-caption"></p>
                <div class="sg-controls">
                    <button id="gallery-prev" type="button" aria-label="Foto sebelumnya">←</button>
                    <span id="gallery-position" aria-live="polite"></span>
                    <button id="gallery-next" type="button" aria-label="Foto berikutnya">→</button>
                </div>
            </section>
        </div>
    </dialog>
</section>
@endsection

@push('scripts')
    <script src="{{ asset('js/gallery-public.js') }}" defer></script>
@endpush
