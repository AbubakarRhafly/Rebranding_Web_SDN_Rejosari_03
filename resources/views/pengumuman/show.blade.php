@extends('layouts.app')

@section('title', $pengumuman->judul . ' — SDN Rejosari 03')

@push('styles')
<style>
    .announcement-page {
        max-width: 1100px;
        margin: 0 auto;
        color: var(--site-text, #263244);
    }

    .announcement-back-nav {
        margin-bottom: 20px;
    }

    .announcement-back-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: var(--site-red-dark, #893642);
        font-weight: 600;
        font-size: 14px;
        text-decoration: none;
        transition: transform 0.15s ease, color 0.15s ease;
    }

    .announcement-back-btn:hover {
        transform: translateX(-3px);
        color: var(--site-red, #a84450);
        text-decoration: underline;
    }

    .announcement-layout {
        display: grid;
        grid-template-columns: minmax(0, 2fr) minmax(300px, 1fr);
        gap: 32px;
        align-items: start;
    }

    .announcement-main {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        padding: 36px 34px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.04);
        box-sizing: border-box;
        overflow-wrap: break-word;
    }

    .announcement-header {
        margin-bottom: 24px;
        border-bottom: 1px solid #f1f5f9;
        padding-bottom: 22px;
    }

    .announcement-meta-top {
        display: flex;
        align-items: center;
        gap: 12px;
        flex-wrap: wrap;
        margin-bottom: 14px;
    }

    .announcement-badge {
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

    .announcement-date {
        color: #64748b;
        font-size: 13.5px;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .announcement-header h1 {
        margin: 0 0 16px;
        font-size: clamp(24px, 3.2vw, 32px);
        line-height: 1.3;
        color: #1e293b;
        letter-spacing: -0.5px;
    }

    .announcement-period-box {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: #fafbfc;
        border: 1px solid #e2e8f0;
        padding: 8px 14px;
        border-radius: 8px;
        font-size: 13px;
        color: #475569;
    }

    .announcement-cover {
        margin-bottom: 28px;
        border-radius: 12px;
        overflow: hidden;
        background: #f1f5f9;
        max-height: 440px;
    }

    .announcement-cover img {
        display: block;
        width: 100%;
        height: 100%;
        max-height: 440px;
        object-fit: cover;
    }

    .announcement-body {
        font-size: 15.5px;
        line-height: 1.85;
        color: #334155;
        white-space: pre-line;
        margin-bottom: 30px;
    }

    /* Attachment Box */
    .announcement-attachment-card {
        background: #fafbfc;
        border: 1px solid #e2e8f0;
        border-left: 4px solid var(--site-red, #a84450);
        border-radius: 10px;
        padding: 18px 20px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
        flex-wrap: wrap;
        margin-bottom: 30px;
    }

    .announcement-attachment-info {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .announcement-attachment-icon {
        width: 40px;
        height: 40px;
        border-radius: 8px;
        background: var(--site-pink);
        color: var(--site-red-dark);
        display: grid;
        place-items: center;
        flex-shrink: 0;
    }

    .btn-download-attachment {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 9px 16px;
        border-radius: 8px;
        background: var(--site-red, #a84450);
        color: #ffffff;
        font-weight: 600;
        font-size: 13.5px;
        text-decoration: none;
        transition: background 0.15s ease;
    }

    .btn-download-attachment:hover {
        background: var(--site-red-dark, #893642);
    }

    .announcement-share-section {
        border-top: 1px solid #f1f5f9;
        padding-top: 22px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 14px;
    }

    .announcement-share-label {
        font-size: 13.5px;
        font-weight: 600;
        color: #475569;
    }

    .announcement-share-buttons {
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
    .announcement-sidebar {
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

    .sidebar-announcement-list {
        display: flex;
        flex-direction: column;
        gap: 16px;
    }

    .sidebar-announcement-item {
        display: flex;
        flex-direction: column;
        gap: 4px;
        text-decoration: none;
        color: inherit;
        padding-bottom: 12px;
        border-bottom: 1px solid #f8fafc;
        transition: color 0.15s ease;
    }

    .sidebar-announcement-item:last-child {
        border-bottom: none;
        padding-bottom: 0;
    }

    .sidebar-announcement-item:hover h3 {
        color: var(--site-red, #a84450);
    }

    .sidebar-announcement-item h3 {
        margin: 0;
        font-size: 14px;
        font-weight: 600;
        line-height: 1.45;
        color: #263244;
        transition: color 0.15s ease;
    }

    .sidebar-announcement-item time {
        font-size: 12px;
        color: #94a3b8;
    }

    @media (max-width: 860px) {
        .announcement-layout {
            grid-template-columns: 1fr;
        }

        .announcement-main {
            padding: 24px 20px;
        }

        .announcement-header h1 {
            font-size: 22px;
        }
    }

    @media (max-width: 480px) {
        .announcement-main {
            padding: 20px 16px;
            border-radius: 12px;
        }

        .announcement-body {
            font-size: 14.5px;
            line-height: 1.75;
        }

        .announcement-attachment-card {
            flex-direction: column;
            align-items: stretch;
        }

        .btn-download-attachment {
            width: 100%;
            justify-content: center;
            text-align: center;
        }
    }
</style>
@endpush

@section('content')
<div class="announcement-page">
    <div class="announcement-back-nav">
        <a href="{{ route('berita.index') }}#pengumuman" class="announcement-back-btn">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <line x1="19" y1="12" x2="5" y2="12"></line>
                <polyline points="12 19 5 12 12 5"></polyline>
            </svg>
            Kembali ke Berita & Pengumuman
        </a>
    </div>

    <div class="announcement-layout">
        {{-- Main Announcement --}}
        <article class="announcement-main">
            <header class="announcement-header">
                <div class="announcement-meta-top">
                    <span class="announcement-badge">Pengumuman Resmi</span>
                    @if ($pengumuman->tanggal_mulai)
                        <span class="announcement-date">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <rect width="18" height="18" x="3" y="4" rx="2" ry="2"></rect>
                                <line x1="16" y1="2" x2="16" y2="6"></line>
                                <line x1="8" y1="2" x2="8" y2="6"></line>
                                <line x1="3" y1="10" x2="21" y2="10"></line>
                            </svg>
                            <time datetime="{{ $pengumuman->tanggal_mulai->format('Y-m-d') }}">
                                {{ $pengumuman->tanggal_mulai->locale('id')->translatedFormat('l, d F Y') }}
                            </time>
                        </span>
                    @endif
                </div>

                <h1>{{ $pengumuman->judul }}</h1>

                @if ($pengumuman->tanggal_selesai)
                    <div class="announcement-period-box">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <circle cx="12" cy="12" r="10"></circle>
                            <polyline points="12 6 12 12 16 14"></polyline>
                        </svg>
                        <span>Berlaku hingga: <strong>{{ $pengumuman->tanggal_selesai->locale('id')->translatedFormat('d F Y') }}</strong></span>
                    </div>
                @endif
            </header>

            @if ($pengumuman->foto)
                <div class="announcement-cover">
                    <img src="{{ asset('storage/' . $pengumuman->foto) }}" alt="{{ $pengumuman->judul }}" loading="eager">
                </div>
            @endif

            <div class="announcement-body">
                {!! nl2br(e($pengumuman->isi)) !!}
            </div>

            @if ($pengumuman->lampiran)
                <div class="announcement-attachment-card">
                    <div class="announcement-attachment-info">
                        <div class="announcement-attachment-icon">
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"></path>
                                <polyline points="14 2 14 8 20 8"></polyline>
                            </svg>
                        </div>
                        <div>
                            <strong style="display: block; font-size: 14px; color: #1e293b;">Dokumen Lampiran Resmi</strong>
                            <span style="font-size: 12.5px; color: #64748b;">Unduh berkas pengumuman untuk informasi lebih lengkap.</span>
                        </div>
                    </div>
                    <a href="{{ asset('storage/' . $pengumuman->lampiran) }}" target="_blank" rel="noopener noreferrer" class="btn-download-attachment">
                        Unduh Lampiran ↗
                    </a>
                </div>
            @endif

            <div class="announcement-share-section">
                <span class="announcement-share-label">Bagikan pengumuman ini:</span>
                <div class="announcement-share-buttons">
                    <a href="https://api.whatsapp.com/send?text={{ rawurlencode($pengumuman->judul . ' - ' . url()->current()) }}"
                       target="_blank"
                       rel="noopener noreferrer"
                       class="btn-share btn-share-wa">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                            <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981z"/>
                        </svg>
                        WhatsApp
                    </a>
                    <button type="button" class="btn-share btn-share-copy" onclick="navigator.clipboard.writeText(window.location.href); alert('Tautan pengumuman berhasil disalin!');">
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
        <aside class="announcement-sidebar">
            <div class="sidebar-widget">
                <h2>Pengumuman Lainnya</h2>
                @if ($pengumumanTerkait->count())
                    <div class="sidebar-announcement-list">
                        @foreach ($pengumumanTerkait as $terkait)
                            <a href="{{ route('pengumuman.show', $terkait->id) }}" class="sidebar-announcement-item">
                                <h3>{{ $terkait->judul }}</h3>
                                @if ($terkait->tanggal_mulai)
                                    <time datetime="{{ $terkait->tanggal_mulai->format('Y-m-d') }}">
                                        {{ $terkait->tanggal_mulai->locale('id')->translatedFormat('d M Y') }}
                                    </time>
                                @endif
                            </a>
                        @endforeach
                    </div>
                @else
                    <p style="margin: 0; font-size: 13.5px; color: #94a3b8;">Belum ada pengumuman lainnya.</p>
                @endif
            </div>

            <div class="sidebar-widget">
                <h2>Berita Sekolah</h2>
                <p style="margin: 0 0 14px; font-size: 13.5px; color: #64748b; line-height: 1.55;">
                    Ikuti kabar kegiatan, prestasi siswa, dan artikel edukatif SDN Rejosari 03.
                </p>
                <a href="{{ route('berita.index') }}#berita-sekolah" style="display: inline-flex; align-items: center; gap: 6px; color: var(--site-red-dark); font-weight: 700; font-size: 13.5px; text-decoration: none;">
                    Lihat semua berita →
                </a>
            </div>
        </aside>
    </div>
</div>
@endsection
