@extends('layouts.app')
@section('title', 'Data Siswa | SDN Rejosari 03')

@push('styles')
<style>
.siswa-page { color: var(--site-text, #263244); }
.siswa-page [hidden] { display: none !important; }
.siswa-breadcrumb { margin-bottom: 20px; font-size: 13px; color: #637083; }
.siswa-breadcrumb a { color: var(--site-red-dark, #893642); text-decoration: none; }
.siswa-breadcrumb span { margin: 0 10px; }
.siswa-hero { padding: 32px; border: 1px solid #ead5d9; border-radius: 20px; background: var(--site-pink, #f5e7e9); }
.siswa-eyebrow { margin: 0 0 12px; color: var(--site-red-dark, #893642); font-size: 12px; font-weight: 700; letter-spacing: 1.3px; text-transform: uppercase; }
.siswa-hero h1 { margin: 0 0 12px; font-size: clamp(28px, 4vw, 40px); line-height: 1.2; }
.siswa-intro { max-width: 650px; margin: 0; color: #566174; line-height: 1.8; font-size: 15px; }
.siswa-summary { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 16px; margin: 22px 0 30px; }
.siswa-stat { padding: 22px 24px; background: #fff; border: 1px solid #e3e7ec; border-radius: 14px; }
.siswa-stat dt { color: #637083; font-size: 14px; }
.siswa-stat dd { margin: 8px 0 0; color: var(--site-red-dark, #893642); font-size: 30px; font-weight: 700; }
.siswa-section-heading h2 { margin: 0 0 8px; font-size: 23px; }
.siswa-section-heading p { margin: 0 0 20px; color: #637083; line-height: 1.6; font-size: 14px; }
.siswa-filters { display: grid; grid-template-columns: minmax(0, 1fr) 220px; gap: 16px; padding: 20px; background: #fff; border: 1px solid #e3e7ec; border-radius: 14px; }
.siswa-field { min-width: 0; }
.siswa-field label { display: block; margin-bottom: 8px; font-size: 13px; font-weight: 700; }
.siswa-field input, .siswa-field select { width: 100%; min-height: 46px; padding: 11px 12px; border: 1px solid #cbd2dc; border-radius: 8px; background: #fff; color: #263244; font: inherit; font-size: 16px; }
.siswa-page :is(a, input, select, button):focus-visible { outline: 3px solid var(--site-red-dark, #893642); outline-offset: 3px; }
.siswa-result { margin: 18px 0; color: #637083; font-size: 13px; line-height: 1.6; }
.siswa-grid { display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: 18px; }
.siswa-card { min-width: 0; padding: 24px; background: #fff; border: 1px solid #e3e7ec; border-radius: 14px; }
.siswa-card-top { display: flex; align-items: center; justify-content: space-between; gap: 12px; margin-bottom: 18px; }
.siswa-avatar { display: grid; place-items: center; flex: 0 0 48px; width: 48px; height: 48px; background: var(--site-pink, #f5e7e9); color: var(--site-red-dark, #893642); border-radius: 14px; }
.siswa-avatar svg { width: 26px; height: 26px; }
.siswa-class { padding: 6px 10px; border-radius: 6px; background: #f1f4f8; color: #536174; font-size: 12px; line-height: 1.5; overflow-wrap: anywhere; }
.siswa-card h3 { margin: 0 0 10px; font-size: 18px; line-height: 1.45; overflow-wrap: anywhere; }
.siswa-description { margin: 0; color: #637083; font-size: 14px; line-height: 1.7; overflow-wrap: anywhere; white-space: pre-line; }
.siswa-empty { padding: 40px 24px; text-align: center; background: #fff; border: 1px dashed #cbd2dc; border-radius: 14px; }
.siswa-empty h3 { margin: 0 0 10px; font-size: 19px; }
.siswa-empty p { margin: 0; color: #637083; line-height: 1.7; }
.siswa-reset { min-height: 44px; margin-top: 18px; padding: 10px 18px; border: 0; border-radius: 8px; background: var(--site-red-dark, #893642); color: #fff; font: inherit; cursor: pointer; }
@media (max-width: 900px) { .siswa-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); } }
@media (max-width: 600px) {
    .siswa-hero { padding: 24px 20px; border-radius: 16px; }
    .siswa-summary { gap: 10px; margin-bottom: 24px; }
    .siswa-stat { padding: 18px 14px; }
    .siswa-stat dt { font-size: 12px; }
    .siswa-stat dd { font-size: 26px; }
    .siswa-filters { grid-template-columns: 1fr; padding: 16px; }
    .siswa-grid { grid-template-columns: 1fr; gap: 14px; }
    .siswa-card { padding: 20px; }
}
</style>
@endpush

@section('content')
@php
    // Ringkasan berasal dari koleksi siswa aktif pada controller.
    $daftarKelas = $siswa->pluck('kelas')
        ->filter(function ($kelas) { return trim((string) $kelas) !== ''; })
        ->unique()->sort()->values();
@endphp
<main class="siswa-page" id="siswa-page">
    <nav class="siswa-breadcrumb" aria-label="Breadcrumb">
        <a href="{{ url('/') }}">Beranda</a><span aria-hidden="true">/</span><strong aria-current="page">Siswa</strong>
    </nav>
    <header class="siswa-hero">
        <p class="siswa-eyebrow">SDN Rejosari 03 Semarang</p>
        <h1>Data Siswa</h1>
        <p class="siswa-intro">Mengenal peserta didik SDN Rejosari 03. Temukan informasi siswa aktif berdasarkan nama dan kelas.</p>
    </header>
    <dl class="siswa-summary">
        <div class="siswa-stat"><dt>Siswa aktif terdata</dt><dd>{{ $siswa->count() }}</dd></div>
        <div class="siswa-stat"><dt>Kelas terdata</dt><dd>{{ $daftarKelas->count() }}</dd></div>
    </dl>
    <section aria-labelledby="siswa-heading">
        <div class="siswa-section-heading">
            <h2 id="siswa-heading">Daftar Siswa</h2>
            <p>Informasi peserta didik yang terdaftar aktif di sekolah.</p>
        </div>
        @if ($siswa->isNotEmpty())
            <div class="siswa-filters" id="siswa-filters" role="search" aria-label="Cari siswa" hidden>
                <div class="siswa-field">
                    <label for="siswa-search">Cari nama siswa</label>
                    <input type="search" id="siswa-search" placeholder="Ketik nama siswa..." aria-controls="siswa-grid" autocomplete="off">
                </div>
                <div class="siswa-field">
                    <label for="siswa-kelas">Filter kelas</label>
                    <select id="siswa-kelas" aria-controls="siswa-grid">
                        <option value="">Semua kelas</option>
                        @foreach ($daftarKelas as $kelas)
                            <option value="{{ $kelas }}">Kelas {{ $kelas }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <p class="siswa-result" id="siswa-result" role="status" aria-live="polite" aria-atomic="true">Menampilkan {{ $siswa->count() }} dari {{ $siswa->count() }} siswa aktif terdata.</p>
            <div class="siswa-grid" id="siswa-grid">
                @foreach ($siswa as $item)
                    <article class="siswa-card" data-siswa-name="{{ $item->nama }}" data-siswa-class="{{ $item->kelas }}">
                        <div class="siswa-card-top">
                            <span class="siswa-avatar" aria-hidden="true">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="8" r="4"/><path d="M4 21v-2a8 8 0 0 1 16 0v2"/></svg>
                            </span>
                            <span class="siswa-class">{{ trim((string) $item->kelas) !== '' ? 'Kelas ' . $item->kelas : 'Kelas belum tersedia' }}</span>
                        </div>
                        <h3>{{ $item->nama }}</h3>
                        @if (trim((string) $item->deskripsi) !== '')
                            <p class="siswa-description">{{ $item->deskripsi }}</p>
                        @endif
                    </article>
                @endforeach
            </div>
            <div class="siswa-empty" id="siswa-no-results" hidden>
                <h3>Siswa tidak ditemukan</h3>
                <p>Coba nama lain atau pilih kelas yang berbeda.</p>
                <button type="button" class="siswa-reset" id="siswa-reset">Reset pencarian</button>
            </div>
        @else
            <div class="siswa-empty">
                <h3>Belum ada data siswa aktif</h3>
                <p>Informasi siswa akan ditampilkan setelah data tersedia.</p>
            </div>
        @endif
    </section>
</main>
@endsection

@push('scripts')
<script>
(() => {
    const page = document.getElementById('siswa-page');
    const search = page?.querySelector('#siswa-search');
    if (!search) return;
    const kelas = page.querySelector('#siswa-kelas');
    const cards = Array.from(page.querySelectorAll('.siswa-card'));
    const result = page.querySelector('#siswa-result');
    const empty = page.querySelector('#siswa-no-results');
    function filterSiswa() {
        const query = search.value.trim().toLocaleLowerCase('id');
        let count = 0;
        cards.forEach(card => {
            const match = card.dataset.siswaName.toLocaleLowerCase('id').includes(query)
                && (!kelas.value || card.dataset.siswaClass === kelas.value);
            card.hidden = !match;
            if (match) count++;
        });
        result.textContent = `Menampilkan ${count} dari ${cards.length} siswa aktif terdata.`;
        empty.hidden = count !== 0;
        page.querySelector('#siswa-grid').hidden = count === 0;
    }
    search.addEventListener('input', filterSiswa);
    kelas.addEventListener('change', filterSiswa);
    page.querySelector('#siswa-reset').addEventListener('click', () => {
        search.value = '';
        kelas.value = '';
        filterSiswa();
        search.focus();
    });
    page.querySelector('#siswa-filters').hidden = false;
    filterSiswa();
})();
</script>
@endpush
