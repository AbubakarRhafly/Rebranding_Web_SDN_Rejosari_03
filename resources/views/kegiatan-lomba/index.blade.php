@extends('layouts.app')

@section('title', 'Kegiatan Lomba')

@push('styles')
<style>
    .competition-header { text-align: center; padding: 35px 12px 40px; }
    .competition-header > p { color: var(--site-red); font-size: 12px; font-weight: 700; letter-spacing: 2px; }
    .competition-header h1 { color: var(--site-text); font-size: clamp(28px, 4vw, 42px); margin: 12px 0 16px; }
    .competition-header > div { color: #637083; line-height: 1.7; }
    .competition-grid { display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: 24px; }
    .competition-card { background: #fff; border: 1px solid #e4e7eb; border-top: 4px solid var(--site-red); border-radius: 12px; padding: 24px; min-width: 0; overflow-wrap: anywhere; }
    .competition-card .badge { background: var(--site-pink); color: var(--site-red-dark); padding: 7px 12px; border-radius: 20px; font-size: 12px; }
    .competition-card h2 { color: var(--site-text); font-size: 22px; line-height: 1.4; margin: 18px 0 22px; }
    .competition-card p { display: grid; grid-template-columns: 75px minmax(0, 1fr); gap: 10px; line-height: 1.6; font-size: 14px; margin: 12px 0; }
    .competition-card p strong { color: #637083; }
    .competition-card p:last-child { border-top: 1px solid #e4e7eb; margin-top: 20px; padding-top: 16px; color: var(--site-red-dark); font-weight: 700; }
    .competition-empty { grid-column: 1 / -1; text-align: center; padding: 40px 20px; background: white; border-radius: 12px; color: #637083; }
    @media (max-width: 900px) { .competition-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); } }
    @media (max-width: 600px) { .competition-grid { grid-template-columns: minmax(0, 1fr); gap: 18px; } .competition-header { padding: 20px 0 28px; } .competition-card { padding: 22px; } }
</style>
@endpush

@section('content')

<header class="competition-header">
    <p>SDN REJOSARI 03</p>
    <h1>Kegiatan dan Lomba</h1>
    <div>Informasi partisipasi dan pencapaian siswa dalam berbagai kegiatan.</div>
</header>

<div class="competition-grid">

    @forelse ($kegiatan as $item)

        <article class="competition-card">

            <span class="badge">
                {{ $item->kategori }}
            </span>

            <h2>{{ $item->judul }}</h2>

            <p>
                <strong>Peserta:</strong>
                {{ $item->nama_peserta }}
            </p>

            <p>
                <strong>Kelas:</strong>
                {{ $item->kelas }}
            </p>

            <p>
                <strong>Jenis:</strong>
                {{ $item->jenis_kegiatan }}
            </p>

            <p>
                <strong>Tingkat:</strong>
                {{ $item->tingkat }}
            </p>

            <p>
                <strong>Hasil:</strong>
                {{ $item->hasil }}
            </p>

        </article>

    @empty
        <p class="competition-empty">Belum ada kegiatan yang ditampilkan.</p>
    @endforelse

</div>

@endsection
