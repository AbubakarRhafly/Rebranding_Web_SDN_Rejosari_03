@extends('layouts.app')

@section('title', 'Pengumuman & Berita | SDN Rejosari 03')

@push('styles')
<style>
    .info-page { max-width: 1060px; margin: 0 auto; color: #263244; }
    .info-page * { min-width: 0; }
    .info-breadcrumb { display: flex; gap: 10px; flex-wrap: wrap; margin: 0 0 30px; font-size: 12px; color: #68717c; }
    .info-breadcrumb a { color: inherit; text-decoration: none; }
    .info-header { text-align: center; margin-bottom: 30px; }
    .info-eyebrow { display: flex; align-items: center; justify-content: center; gap: 12px; font-size: 11px; font-weight: 700; letter-spacing: 1.5px; text-transform: uppercase; color: var(--site-red, #a84450); }
    .info-eyebrow::before, .info-eyebrow::after { content: ''; width: 38px; height: 1px; background: #dcbcc1; }
    .info-header h1 { margin: 12px 0; font-size: clamp(28px, 4vw, 40px); letter-spacing: -1.2px; color: #20252b; line-height: 1.15; }
    .info-header p { margin: 0; color: #68717c; font-size: 14px; line-height: 1.7; }
    .info-search { display: flex; gap: 10px; padding: 6px; background: #fff; border: 1px solid #dce0e5; border-radius: 10px; }
    .info-search__field { display: flex; flex: 1; align-items: center; padding-left: 12px; gap: 10px; }
    .info-search__field svg { flex-shrink: 0; color: #68717c; }
    .info-search input[type="search"] { width: 100%; min-height: 44px; border: 0; font: inherit; font-size: 14px; background: transparent; color: #263244; }
    .info-search button { min-height: 44px; border: 0; border-radius: 7px; background: var(--site-red, #a84450); color: white; padding: 0 24px; font: inherit; font-size: 14px; font-weight: 700; cursor: pointer; }
    .info-page a:focus-visible, .info-page button:focus-visible, .info-page summary:focus-visible, .info-page input:focus-visible { outline: 3px solid #893642; outline-offset: 3px; }
    .info-search button:hover { background: var(--site-red-dark, #893642); }
    .info-filters { display: flex; gap: 8px; flex-wrap: wrap; align-items: center; margin: 14px 0 12px; }
    .info-filters__label { color: #68717c; font-size: 12px; margin-right: 4px; }
    .info-chip { padding: 9px 14px; display: inline-flex; align-items: center; min-height: 40px; border: 1px solid #dce0e5; border-radius: 7px; background: white; text-decoration: none; color: #4c5664; font-size: 12px; overflow-wrap: anywhere; }
    .info-chip[aria-current="true"] { background: var(--site-red, #a84450); border-color: var(--site-red, #a84450); color: #fff; }
    .info-result { color: #68717c; font-size: 13px; line-height: 1.7; margin: 14px 0 0; overflow-wrap: anywhere; }
    .info-result a { color: var(--site-red-dark, #893642); margin-left: 10px; }
    .info-section { margin-top: 38px; scroll-margin-top: 24px; }
    .info-section + .info-section { border-top: 1px solid #dce0e5; padding-top: 36px; margin-top: 40px; }
    .info-section__heading { display: flex; justify-content: space-between; align-items: end; gap: 16px; margin-bottom: 20px; }
    .info-section h2 { margin: 0 0 6px; font-size: clamp(24px, 3vw, 30px); color: #20252b; letter-spacing: -.7px; }
    .info-section__heading p { margin: 0; color: #68717c; font-size: 13px; line-height: 1.6; }
    .info-count { white-space: nowrap; padding: 7px 10px; border-radius: 6px; color: var(--site-red-dark, #893642); background: var(--site-pink, #f5e7e9); font-size: 12px; }
    .info-grid { display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: 22px; align-items: start; }
    .info-card { overflow: hidden; padding: 10px; border-radius: 22px; background: #fff; border: 1px solid #e3e5e9; box-shadow: 0 3px 12px rgb(38 50 68 / 2%); }
    .info-card__image { border-radius: 15px; aspect-ratio: 3 / 2; overflow: hidden; background: #ece8e9; }
    .info-card__image img { display: block; width: 100%; height: 100%; object-fit: cover; }
    .info-placeholder { width: 100%; height: 100%; display: flex; flex-direction: column; align-items: center; justify-content: center; gap: 10px; color: #a68b91; background: linear-gradient(135deg, #eee7e8, #f5f1ed); }
    .info-placeholder span { font-size: 10px; letter-spacing: 1.5px; text-transform: uppercase; }
    .info-card__body { padding: 16px 8px 8px; }
    .info-card__meta { display: flex; justify-content: space-between; align-items: center; gap: 8px; font-size: 10px; color: #68717c; }
    .info-card__meta time { white-space: nowrap; }
    .info-tag { color: var(--site-red-dark, #893642); background: var(--site-pink, #f5e7e9); border-radius: 4px; padding: 5px 7px; overflow-wrap: anywhere; }
    .info-card h3 { margin: 14px 0 8px; font-size: 17px; line-height: 1.45; color: #263244; overflow-wrap: anywhere; }
    .info-excerpt { color: #68717c; font-size: 13px; line-height: 1.7; margin: 0 0 16px; overflow-wrap: anywhere; }
    .info-detail { border-top: 1px solid #eceef0; }
    .info-detail summary { display: flex; justify-content: space-between; align-items: center; min-height: 44px; color: var(--site-red-dark, #893642); font-size: 12px; font-weight: 700; cursor: pointer; list-style: none; }
    .info-detail summary::-webkit-details-marker { display: none; }
    .info-detail[open] summary span { transform: rotate(90deg); }
    .info-detail__text { white-space: pre-line; font-size: 14px; line-height: 1.8; overflow-wrap: anywhere; padding: 8px 0 12px; }
    .info-detail__note { font-size: 12px; color: #68717c; line-height: 1.6; }
    .info-attachment { display: inline-block; padding: 10px 0; color: var(--site-red-dark, #893642); font-size: 13px; }
    .info-empty { text-align: center; background: #fff; border: 1px dashed #d6c8cb; border-radius: 18px; padding: 42px 20px; }
    .info-empty h3 { margin: 0 0 10px; font-size: 17px; }
    .info-empty p { color: #68717c; font-size: 14px; margin: 0; line-height: 1.7; }
    .info-empty a { display: inline-block; margin-top: 14px; color: var(--site-red-dark, #893642); }
    .info-pagination { display: flex; justify-content: space-between; align-items: center; gap: 14px; margin-top: 24px; font-size: 11px; color: #68717c; }
    .info-pages { display: flex; flex-wrap: wrap; gap: 5px; }
    .info-pages a, .info-pages span { display: inline-flex; justify-content: center; align-items: center; min-width: 36px; min-height: 40px; padding: 8px; border: 1px solid #e0e3e7; border-radius: 6px; background: white; text-decoration: none; color: #4c5664; }
    .info-pages [aria-current="page"] { color: #fff; background: var(--site-red, #a84450); border-color: var(--site-red, #a84450); }
    .info-pages [aria-disabled="true"] { color: #777; background: #edf0f2; }
    .info-pages .info-ellipsis { border: 0; background: none; min-width: 16px; }
    .info-sr-only { position: absolute; width: 1px; height: 1px; overflow: hidden; clip: rect(0, 0, 0, 0); white-space: nowrap; }
    @media (max-width: 900px) { .info-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); } .info-pagination { flex-direction: column; align-items: flex-start; } }
    @media (max-width: 560px) {
        .info-breadcrumb { margin-bottom: 24px; }
        .info-header { margin-bottom: 24px; }
        .info-header p { font-size: 13px; }
        .info-search { flex-wrap: wrap; }
        .info-search__field { flex-basis: 100%; }
        .info-search button { width: 100%; }
        .info-filters__label { flex-basis: 100%; }
        .info-grid { grid-template-columns: minmax(0, 1fr); gap: 18px; }
        .info-section { margin-top: 30px; }
        .info-section__heading { align-items: flex-start; }
        .info-card h3 { font-size: 18px; }
        .info-card__meta { font-size: 11px; }
        .info-pages { gap: 4px; }
        .info-pages a, .info-pages span { min-width: 30px; padding: 7px; }
    }
</style>
@endpush

@section('content')
<main class="info-page">
    <nav class="info-breadcrumb" aria-label="Breadcrumb">
        <a href="{{ url('/') }}">Beranda</a><span aria-hidden="true">›</span><span aria-current="page">Pengumuman & Berita</span>
    </nav>

    <header class="info-header">
        <div class="info-eyebrow">Informasi sekolah</div>
        <h1>Pengumuman & Berita</h1>
        <p>Temukan pengumuman penting dan kabar terbaru dari SDN Rejosari 03.</p>
    </header>

    <form class="info-search" method="GET" action="{{ route('berita.index') }}" role="search">
        <div class="info-search__field">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" aria-hidden="true"><circle cx="10.5" cy="10.5" r="6.5"/><path d="m16 16 4 4"/></svg>
            <label class="info-sr-only" for="info-query">Cari pengumuman dan berita</label>
            <input id="info-query" type="search" name="q" maxlength="150" value="{{ $q }}" placeholder="Cari judul atau isi informasi…">
        </div>
        @if ($kategori !== '') <input type="hidden" name="kategori" value="{{ $kategori }}"> @endif
        <button type="submit">Cari informasi</button>
    </form>

    <nav class="info-filters" aria-label="Filter kategori berita">
        <span class="info-filters__label">Kategori berita:</span>
        <a class="info-chip" href="{{ route('berita.index', array_filter(['q' => $q], fn ($v) => $v !== '')) }}" @if ($kategori === '') aria-current="true" @endif>Semua</a>
        @foreach ($kategoriList as $namaKategori)
            <a class="info-chip" href="{{ route('berita.index', ['q' => $q, 'kategori' => $namaKategori]) }}" @if ($kategori === $namaKategori) aria-current="true" @endif>{{ $namaKategori }}</a>
        @endforeach
    </nav>

    @if ($q !== '' || $kategori !== '')
        <p class="info-result">
            @if ($q !== '') Hasil pencarian “{{ $q }}”. @endif
            @if ($kategori !== '') Kategori berita: {{ $kategori }}. @endif
            {{ $pengumuman->total() }} pengumuman dan {{ $berita->total() }} berita ditemukan.
            <a href="{{ route('berita.index') }}">Reset pencarian</a>
        </p>
    @endif

    @foreach ([['id' => 'pengumuman', 'judul' => 'Pengumuman', 'deskripsi' => 'Informasi penting untuk siswa dan orang tua.', 'data' => $pengumuman, 'jenis' => 'pengumuman'], ['id' => 'berita-sekolah', 'judul' => 'Berita Sekolah', 'deskripsi' => 'Kegiatan, prestasi, dan cerita dari sekolah kita.', 'data' => $berita, 'jenis' => 'berita']] as $bagian)
        <section id="{{ $bagian['id'] }}" class="info-section" aria-labelledby="judul-{{ $bagian['id'] }}">
            <div class="info-section__heading">
                <div><h2 id="judul-{{ $bagian['id'] }}">{{ $bagian['judul'] }}</h2><p>{{ $bagian['deskripsi'] }}</p></div>
                <span class="info-count">{{ $bagian['data']->total() }} {{ $bagian['jenis'] }}</span>
            </div>
            @if ($bagian['data']->count())
                <div class="info-grid">
                    @foreach ($bagian['data'] as $item)
                        @include('berita.partials.card', ['item' => $item, 'jenis' => $bagian['jenis']])
                    @endforeach
                </div>
            @else
                <div class="info-empty">
                    @if ($bagian['data']->total() > 0)
                        <h3>Halaman ini tidak berisi data</h3><p>Silakan kembali ke halaman pertama.</p>
                        <a href="{{ $bagian['data']->url(1) }}">Ke halaman pertama</a>
                    @elseif ($q !== '' || ($bagian['jenis'] === 'berita' && $kategori !== ''))
                        <h3>{{ $bagian['judul'] }} tidak ditemukan</h3><p>Coba kata kunci lain atau reset pencarian.</p>
                    @else
                        <h3>Belum ada {{ strtolower($bagian['judul']) }}</h3><p>Informasi yang sudah diterbitkan akan tampil di sini.</p>
                    @endif
                </div>
            @endif
            @include('berita.partials.pagination', ['paginator' => $bagian['data'], 'label' => $bagian['jenis']])
        </section>
    @endforeach
</main>
@endsection
