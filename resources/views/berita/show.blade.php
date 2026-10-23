@extends('layouts.app')

@section('title', $berita->judul . ' — SDN Rejosari 03')

@push('styles')
<style>
    .article-page {
        max-width: 1100px;
        margin: 0 auto;
        color: var(--site-text, #263244);
    }

    .article-back-nav {
        margin-bottom: 20px;
    }

    .article-back-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: var(--site-red-dark, #893642);
        font-weight: 600;
        font-size: 14px;
        text-decoration: none;
        transition: transform 0.15s ease, color 0.15s ease;
    }

    .article-back-btn:hover {
        transform: translateX(-3px);
        color: var(--site-red, #a84450);
        text-decoration: underline;
    }

    .article-layout {
        display: grid;
        grid-template-columns: minmax(0, 2fr) minmax(300px, 1fr);
        gap: 32px;
        align-items: start;
    }

    .article-main {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        padding: 36px 34px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.04);
        box-sizing: border-box;
        overflow-wrap: break-word;
    }

    .article-header {
        margin-bottom: 24px;
        border-bottom: 1px solid #f1f5f9;
        padding-bottom: 22px;
    }

    .article-meta-top {
        display: flex;
        align-items: center;
        gap: 12px;
        flex-wrap: wrap;
        margin-bottom: 14px;
    }

    .article-badge {
        display: inline-block;
        background: var(--site-pink, #f5e7e9);
        color: var(--site-red-dark, #893642);
        padding: 5px 12px;
        border-radius: 6px;
        font-size: 12.5px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .article-date {
        color: #64748b;
        font-size: 13.5px;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .article-header h1 {
        margin: 0 0 16px;
        font-size: clamp(24px, 3.2vw, 32px);
        line-height: 1.3;
        color: #1e293b;
        letter-spacing: -0.5px;
    }

    .article-author-row {
        display: flex;
        align-items: center;
        gap: 14px;
        font-size: 13.5px;
        color: #64748b;
    }

    .article-author-avatar {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        background: var(--site-pink);
        color: var(--site-red-dark);
        display: grid;
        place-items: center;
        font-weight: 700;
        font-size: 14px;
    }

    .article-cover {
        margin-bottom: 28px;
        border-radius: 12px;
        overflow: hidden;
        background: #f1f5f9;
        max-height: 440px;
    }

    .article-cover img {
        display: block;
        width: 100%;
        height: 100%;
        max-height: 440px;
        object-fit: cover;
    }

    .article-body {
        font-size: 15.5px;
        line-height: 1.85;
        color: #334155;
        white-space: pre-line;
        margin-bottom: 32px;
    }

    .article-share-section {
        border-top: 1px solid #f1f5f9;
        padding-top: 22px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 14px;
    }

    .article-share-label {
        font-size: 13.5px;
        font-weight: 600;
        color: #475569;
    }

    .article-share-buttons {
        display: flex;
        align-items: center;
        gap: 10px;
        flex-wrap: wrap;
    }

    .btn-share {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 8px 14px;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 600;
        text-decoration: none;
        cursor: pointer;
        border: 1px solid transparent;
        transition: all 0.15s ease;
    }

    .btn-share-wa {
        background: #25d366;
        color: #ffffff;
    }

    .btn-share-wa:hover {
        background: #20bd5a;
    }

    .btn-share-copy {
        background: #f1f5f9;
        color: #334155;
        border-color: #cbd5e1;
    }

    .btn-share-copy:hover {
        background: #e2e8f0;
    }

    /* Sidebar */
    .article-sidebar {
        display: flex;
        flex-direction: column;
        gap: 24px;
    }

    .sidebar-widget {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 14px;
        padding: 24px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
        box-sizing: border-box;
    }

    .sidebar-widget h2 {
        margin: 0 0 16px;
        font-size: 18px;
        color: #1e293b;
        display: flex;
        align-items: center;
        gap: 8px;
        padding-bottom: 12px;
        border-bottom: 1px solid #f1f5f9;
    }

    .sidebar-widget h2::before {
        content: "";
        display: inline-block;
        width: 3px;
        height: 18px;
        background: var(--site-red);
        border-radius: 2px;
    }

    .sidebar-article-list {
        display: flex;
        flex-direction: column;
        gap: 16px;
    }

    .sidebar-article-item {
        display: flex;
        flex-direction: column;
        gap: 4px;
        text-decoration: none;
        color: inherit;
        padding-bottom: 12px;
        border-bottom: 1px solid #f8fafc;
        transition: color 0.15s ease;
    }

    .sidebar-article-item:last-child {
        border-bottom: none;
        padding-bottom: 0;
    }

    .sidebar-article-item:hover h3 {
        color: var(--site-red, #a84450);
    }

    .sidebar-article-item h3 {
        margin: 0;
        font-size: 14px;
        font-weight: 600;
        line-height: 1.45;
        color: #263244;
        transition: color 0.15s ease;
    }

    .sidebar-article-item time {
        font-size: 12px;
        color: #94a3b8;
    }

    @media (max-width: 860px) {
        .article-layout {
            grid-template-columns: 1fr;
        }

        .article-main {
            padding: 24px 20px;
        }

        .article-header h1 {
            font-size: 22px;
        }
    }

    @media (max-width: 480px) {
        .article-main {
            padding: 20px 16px;
            border-radius: 12px;
        }

        .article-body {
            font-size: 14.5px;
            line-height: 1.75;
        }
    }
</style>
@endpush

@section('content')
<div class="article-page">
    <div class="article-back-nav">
        <a href="{{ route('berita.index') }}" class="article-back-btn">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <line x1="19" y1="12" x2="5" y2="12"></line>
                <polyline points="12 19 5 12 12 5"></polyline>
            </svg>
            Kembali ke Berita & Pengumuman
        </a>
    </div>

    <div class="article-layout">
        {{-- Main Article --}}
        <article class="article-main">
            <header class="article-header">
                <div class="article-meta-top">
                    <span class="article-badge">{{ $berita->kategori ?: 'Berita Sekolah' }}</span>
                    @if ($berita->tanggal_publish)
                        <span class="article-date">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <rect width="18" height="18" x="3" y="4" rx="2" ry="2"></rect>
                                <line x1="16" y1="2" x2="16" y2="6"></line>
                                <line x1="8" y1="2" x2="8" y2="6"></line>
                                <line x1="3" y1="10" x2="21" y2="10"></line>
                            </svg>
                            <time datetime="{{ $berita->tanggal_publish->format('Y-m-d') }}">
                                {{ $berita->tanggal_publish->locale('id')->translatedFormat('l, d F Y') }}
                            </time>
                        </span>
                    @endif
                </div>

                <h1>{{ $berita->judul }}</h1>

                <div class="article-author-row">
                    <div class="article-author-avatar">
                        {{ strtoupper(substr($berita->penulis ?: 'A', 0, 1)) }}
                    </div>
                    <div>
                        <strong>{{ $berita->penulis ?: 'Admin SDN Rejosari 03' }}</strong>
                        <div style="font-size: 12px; color: #94a3b8;">Dipublikasikan secara resmi</div>
                    </div>
                </div>
            </header>

            @if ($berita->thumbnail)
                <div class="article-cover">
                    <img src="{{ asset('storage/' . $berita->thumbnail) }}" alt="{{ $berita->judul }}" loading="eager">
                </div>
            @endif

            <div class="article-body">
                {!! nl2br(e($berita->isi)) !!}
            </div>

            <div class="article-share-section">
                <span class="article-share-label">Bagikan kabar ini:</span>
                <div class="article-share-buttons">
                    <a href="https://api.whatsapp.com/send?text={{ rawurlencode($berita->judul . ' - ' . url()->current()) }}"
                       target="_blank"
                       rel="noopener noreferrer"
                       class="btn-share btn-share-wa">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                            <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981z"/>
                        </svg>
                        WhatsApp
                    </a>
                    <button type="button" class="btn-share btn-share-copy" onclick="navigator.clipboard.writeText(window.location.href); alert('Tautan berita berhasil disalin!');">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <rect width="14" height="14" x="8" y="8" rx="2" ry="2"></rect>
                            <path d="M4 16c-1.1 0-2-.9-2-2V4c0-1.1.9-2 2-2h10c1.1 0 2 .9 2 2"></path>
                        </svg>
                        Salin Tautan
                    </button>
                </div>
            </div>
        </article>

        {{-- Sidebar --}}
        <aside class="article-sidebar">
            <div class="sidebar-widget">
                <h2>Berita Lainnya</h2>
                @if ($beritaTerkait->count())
                    <div class="sidebar-article-list">
                        @foreach ($beritaTerkait as $terkait)
                            <a href="{{ route('berita.show', $terkait->slug) }}" class="sidebar-article-item">
                                <h3>{{ $terkait->judul }}</h3>
                                @if ($terkait->tanggal_publish)
                                    <time datetime="{{ $terkait->tanggal_publish->format('Y-m-d') }}">
                                        {{ $terkait->tanggal_publish->locale('id')->translatedFormat('d M Y') }}
                                    </time>
                                @endif
                            </a>
                        @endforeach
                    </div>
                @else
                    <p style="margin: 0; font-size: 13.5px; color: #94a3b8;">Belum ada berita lainnya.</p>
                @endif
            </div>

            <div class="sidebar-widget">
                <h2>Pengumuman</h2>
                <p style="margin: 0 0 14px; font-size: 13.5px; color: #64748b; line-height: 1.55;">
                    Informasi penting dan pengumuman resmi bagi siswa dan wali murid.
                </p>
                <a href="{{ route('berita.index') }}#pengumuman" style="display: inline-flex; align-items: center; gap: 6px; color: var(--site-red-dark); font-weight: 700; font-size: 13.5px; text-decoration: none;">
                    Lihat semua pengumuman →
                </a>
            </div>
        </aside>
    </div>
</div>
@endsection
