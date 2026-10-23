@extends('layouts.app')

@section('title', 'Admin - Data Pengaduan & Aspirasi')

@push('styles')
<style>
    .admin-pengaduan-page {
        max-width: 1100px;
        margin: 0 auto;
        color: var(--site-text, #263244);
    }

    .pengaduan-header-box {
        margin-bottom: 24px;
    }

    .pengaduan-header-box h1 {
        margin: 0 0 8px;
        font-size: clamp(24px, 3.2vw, 30px);
        color: #1e293b;
        letter-spacing: -0.5px;
    }

    .pengaduan-header-box p {
        margin: 0;
        color: #64748b;
        font-size: 14.5px;
        line-height: 1.6;
    }

    /* Filter Tabs */
    .pengaduan-filter-tabs {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        margin-bottom: 24px;
        padding-bottom: 16px;
        border-bottom: 1px solid #e2e8f0;
    }

    .admin-pengaduan-page .filter-tab,
    .admin-page .container .filter-tab {
        display: inline-flex !important;
        align-items: center !important;
        gap: 8px !important;
        padding: 8px 16px !important;
        border-radius: 8px !important;
        font-size: 13.5px !important;
        font-weight: 600 !important;
        text-decoration: none !important;
        color: #475569 !important;
        background: #ffffff !important;
        border: 1px solid #cbd5e1 !important;
        transition: all 0.15s ease !important;
    }

    .admin-pengaduan-page .filter-tab:hover,
    .admin-page .container .filter-tab:hover {
        background: #f8fafc !important;
        color: #1e293b !important;
        border-color: #94a3b8 !important;
    }

    .admin-pengaduan-page .filter-tab.is-active,
    .admin-page .container .filter-tab.is-active {
        background: var(--site-red, #a84450) !important;
        color: #ffffff !important;
        border-color: var(--site-red, #a84450) !important;
        box-shadow: 0 2px 6px rgba(168, 68, 80, 0.25) !important;
    }

    .admin-pengaduan-page .filter-tab .tab-count,
    .admin-page .container .filter-tab .tab-count {
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        min-width: 20px !important;
        height: 20px !important;
        padding: 0 6px !important;
        border-radius: 10px !important;
        font-size: 11.5px !important;
        background: #f1f5f9 !important;
        color: #475569 !important;
    }

    .admin-pengaduan-page .filter-tab.is-active .tab-count,
    .admin-page .container .filter-tab.is-active .tab-count {
        background: rgba(255, 255, 255, 0.25) !important;
        color: #ffffff !important;
    }

    /* Complaint Cards */
    .aduan-list {
        display: grid;
        gap: 20px;
    }

    .aduan-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 14px;
        padding: 24px 26px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.03);
        transition: transform 0.15s ease, box-shadow 0.15s ease, border-color 0.15s ease;
    }

    .aduan-card:hover {
        border-color: #cbd5e1;
        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.06);
    }

    /* Top Row */
    .aduan-top-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        flex-wrap: wrap;
        margin-bottom: 16px;
        padding-bottom: 14px;
        border-bottom: 1px solid #f1f5f9;
    }

    .aduan-meta-left {
        display: flex;
        align-items: center;
        gap: 10px;
        flex-wrap: wrap;
    }

    .badge-kategori {
        display: inline-block;
        background: var(--site-pink, #f5e7e9);
        color: var(--site-red-dark, #893642);
        padding: 5px 12px;
        border-radius: 6px;
        font-size: 12px;
        font-weight: 700;
        letter-spacing: 0.3px;
    }

    .aduan-date {
        color: #64748b;
        font-size: 13px;
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }

    /* Status Badges */
    .badge-status {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 12.5px;
        font-weight: 700;
    }

    .badge-status--baru {
        background: #e0f2fe;
        color: #0369a1;
        border: 1px solid #bae6fd;
    }

    .badge-status--diproses {
        background: #fef3c7;
        color: #92400e;
        border: 1px solid #fde68a;
    }

    .badge-status--selesai {
        background: #dcfce7;
        color: #15803d;
        border: 1px solid #bbf7d0;
    }

    .status-dot {
        width: 7px;
        height: 7px;
        border-radius: 50%;
        background: currentColor;
    }

    /* Judul Pengaduan Section */
    .aduan-judul-section {
        background: #fafbfc;
        border: 1px solid #e2e8f0;
        border-left: 4px solid var(--site-red, #a84450);
        border-radius: 8px;
        padding: 14px 18px;
        margin-bottom: 18px;
    }

    .aduan-field-label {
        display: block;
        font-size: 11.5px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: #64748b;
        margin-bottom: 4px;
    }

    .aduan-judul-text {
        margin: 0;
        font-size: 18px;
        font-weight: 700;
        color: #1e293b;
        line-height: 1.4;
    }

    /* Pelapor Grid */
    .aduan-pelapor-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 14px;
        margin-bottom: 18px;
        padding: 12px 14px;
        background: #ffffff;
        border: 1px dashed #e2e8f0;
        border-radius: 8px;
    }

    .pelapor-col {
        min-width: 0;
    }

    .pelapor-label {
        font-size: 11.5px;
        color: #64748b;
        font-weight: 600;
        margin-bottom: 2px;
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .pelapor-val {
        font-size: 13.5px;
        font-weight: 600;
        color: #334155;
        overflow-wrap: anywhere;
    }

    .pelapor-val a {
        color: var(--site-red-dark, #893642);
        text-decoration: none;
    }

    .pelapor-val a:hover {
        text-decoration: underline;
    }

    /* Isi Pengaduan */
    .aduan-isi-box {
        margin-bottom: 18px;
    }

    .aduan-isi-content {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        padding: 14px 16px;
        font-size: 14px;
        line-height: 1.65;
        color: #334155;
        white-space: pre-line;
    }

    /* Catatan Internal */
    .aduan-catatan-box {
        margin-bottom: 18px;
        background: #fffbeb;
        border: 1px solid #fef3c7;
        border-radius: 8px;
        padding: 12px 16px;
    }

    .aduan-catatan-label {
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: 12px;
        font-weight: 700;
        color: #92400e;
        margin-bottom: 4px;
    }

    .aduan-catatan-text {
        margin: 0;
        font-size: 13px;
        color: #78350f;
        line-height: 1.5;
        white-space: pre-line;
    }

    /* Actions Footer */
    .aduan-footer-actions {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        padding-top: 14px;
        border-top: 1px solid #f1f5f9;
        flex-wrap: wrap;
    }

    .admin-pengaduan-page .btn-action-primary,
    .admin-page .container .btn-action-primary {
        display: inline-flex !important;
        align-items: center !important;
        gap: 8px !important;
        padding: 9px 18px !important;
        background: var(--site-red, #a84450) !important;
        color: #ffffff !important;
        font-size: 13.5px !important;
        font-weight: 600 !important;
        border-radius: 7px !important;
        text-decoration: none !important;
        transition: background 0.15s ease !important;
    }

    .admin-pengaduan-page .btn-action-primary:hover,
    .admin-page .container .btn-action-primary:hover {
        background: var(--site-red-dark, #893642) !important;
        color: #ffffff !important;
    }

    .admin-pengaduan-page .btn-action-delete,
    .admin-page .container .btn-action-delete {
        display: inline-flex !important;
        align-items: center !important;
        gap: 6px !important;
        padding: 9px 16px !important;
        background: #dc2626 !important;
        color: #ffffff !important;
        border: 1px solid #b91c1c !important;
        border-radius: 7px !important;
        font-size: 13px !important;
        font-weight: 700 !important;
        min-height: unset !important;
        height: auto !important;
        cursor: pointer !important;
        font-family: inherit !important;
        text-decoration: none !important;
        transition: background 0.15s ease, transform 0.1s ease !important;
    }

    .admin-pengaduan-page .btn-action-delete:hover,
    .admin-page .container .btn-action-delete:hover {
        background: #b91c1c !important;
        color: #ffffff !important;
        border-color: #991b1b !important;
    }

    .admin-pengaduan-page .btn-action-delete svg,
    .admin-page .container .btn-action-delete svg {
        stroke: #ffffff !important;
    }

    .aduan-empty-state {
        text-align: center;
        padding: 48px 24px;
        background: #ffffff;
        border: 1px dashed #cbd5e1;
        border-radius: 14px;
        color: #64748b;
    }

    .aduan-empty-state h3 {
        margin: 12px 0 6px;
        color: #334155;
        font-size: 18px;
    }

    @media (max-width: 768px) {
        .aduan-pelapor-grid {
            grid-template-columns: 1fr;
            gap: 10px;
        }

        .aduan-card {
            padding: 18px 16px;
        }

        .aduan-footer-actions {
            flex-direction: column;
            align-items: stretch;
        }

        .aduan-footer-actions .btn-action-primary,
        .aduan-footer-actions form,
        .aduan-footer-actions .btn-action-delete {
            width: 100%;
            justify-content: center;
        }
    }
</style>
@endpush

@section('content')
<div class="admin-pengaduan-page">
    <div class="pengaduan-header-box">
        <h1>Data Pengaduan & Aspirasi</h1>
        <p>Seluruh masukan, pengaduan, dan aspirasi yang dikirimkan melalui formulir publik website SDN Rejosari 03.</p>
    </div>

    @if (session('success'))
        <div style="background:#ecfdf5;border:1px solid #a7f3d0;border-radius:10px;padding:14px 18px;color:#065f46;margin-bottom:20px;font-size:14px;font-weight:600;">
            ✓ {{ session('success') }}
        </div>
    @endif

    {{-- Filter Tabs --}}
    <div class="pengaduan-filter-tabs">
        <a href="{{ route('admin.pengaduan.index') }}"
           class="filter-tab {{ empty($status) ? 'is-active' : '' }}">
            Semua Pengaduan
            <span class="tab-count">{{ $totalAduan }}</span>
        </a>
        <a href="{{ route('admin.pengaduan.index', ['status' => 'baru']) }}"
           class="filter-tab {{ $status === 'baru' ? 'is-active' : '' }}">
            Baru
            <span class="tab-count">{{ $totalBaru }}</span>
        </a>
        <a href="{{ route('admin.pengaduan.index', ['status' => 'diproses']) }}"
           class="filter-tab {{ $status === 'diproses' ? 'is-active' : '' }}">
            Diproses
            <span class="tab-count">{{ $totalDiproses }}</span>
        </a>
        <a href="{{ route('admin.pengaduan.index', ['status' => 'selesai']) }}"
           class="filter-tab {{ $status === 'selesai' ? 'is-active' : '' }}">
            Selesai
            <span class="tab-count">{{ $totalSelesai }}</span>
        </a>
    </div>

    @if ($pengaduan->isEmpty())
        <div class="aduan-empty-state">
            <svg width="44" height="44" viewBox="0 0 24 24" fill="none" stroke="#94a3b8" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" style="margin:0 auto;">
                <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
            </svg>
            <h3>Belum Ada Data Pengaduan</h3>
            <p>
                @if (!empty($status))
                    Tidak ada pengaduan dengan status <strong>{{ ucfirst($status) }}</strong>.
                    <br><a href="{{ route('admin.pengaduan.index') }}" style="display:inline-block;margin-top:8px;color:var(--site-red-dark);">Lihat semua pengaduan</a>
                @else
                    Pengaduan yang dikirimkan oleh pengunjung melalui formulir akan tampil di halaman ini.
                @endif
            </p>
        </div>
    @else
        <div class="aduan-list">
            @foreach ($pengaduan as $item)
                <article class="aduan-card">
                    {{-- Baris Atas: Kategori, Tanggal, dan Status --}}
                    <div class="aduan-top-row">
                        <div class="aduan-meta-left">
                            <span class="badge-kategori">
                                {{ $item->kategori_keperluan ?? 'Informasi & Pertanyaan Umum' }}
                            </span>
                            <time class="aduan-date" datetime="{{ $item->created_at->format('Y-m-d H:i') }}">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                    <rect width="18" height="18" x="3" y="4" rx="2" ry="2"></rect>
                                    <line x1="16" y1="2" x2="16" y2="6"></line>
                                    <line x1="8" y1="2" x2="8" y2="6"></line>
                                    <line x1="3" y1="10" x2="21" y2="10"></line>
                                </svg>
                                {{ $item->created_at->format('d-m-Y H:i') }} WIB
                            </time>
                        </div>

                        <div>
                            @if ($item->status === 'baru')
                                <span class="badge-status badge-status--baru">
                                    <span class="status-dot"></span> Baru
                                </span>
                            @elseif ($item->status === 'diproses')
                                <span class="badge-status badge-status--diproses">
                                    <span class="status-dot"></span> Diproses
                                </span>
                            @else
                                <span class="badge-status badge-status--selesai">
                                    <span class="status-dot"></span> Selesai
                                </span>
                            @endif
                        </div>
                    </div>

                    {{-- JUDUL PENGADUAN DENGAN LABEL EKSPLISIT --}}
                    <div class="aduan-judul-section">
                        <span class="aduan-field-label">Judul Pengaduan:</span>
                        <h2 class="aduan-judul-text">{{ $item->judul }}</h2>
                    </div>

                    {{-- Data Pelapor (Nama, Email, No. HP) --}}
                    <div class="aduan-pelapor-grid">
                        <div class="pelapor-col">
                            <span class="pelapor-label">
                                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                                Nama Lengkap Pelapor:
                            </span>
                            <div class="pelapor-val">{{ $item->nama }}</div>
                        </div>

                        <div class="pelapor-col">
                            <span class="pelapor-label">
                                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect width="20" height="16" x="2" y="4" rx="2"></rect><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"></path></svg>
                                Alamat Email:
                            </span>
                            <div class="pelapor-val">
                                <a href="mailto:{{ $item->email }}">{{ $item->email }}</a>
                            </div>
                        </div>

                        <div class="pelapor-col">
                            <span class="pelapor-label">
                                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
                                No. WhatsApp / HP:
                            </span>
                            <div class="pelapor-val">
                                @if ($item->no_hp)
                                    <a href="https://wa.me/{{ preg_replace('/^0/', '62', preg_replace('/[^0-9]/', '', $item->no_hp)) }}" target="_blank" rel="noopener noreferrer">
                                        {{ $item->no_hp }}
                                    </a>
                                @else
                                    <span style="color:#94a3b8;font-weight:400;">-</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    {{-- Isi Pengaduan / Pesan --}}
                    <div class="aduan-isi-box">
                        <span class="aduan-field-label">Isi Pengaduan / Pesan:</span>
                        <div class="aduan-isi-content">
                            {{ $item->isi }}
                        </div>
                    </div>

                    {{-- Catatan Internal Admin (jika ada) --}}
                    @if ($item->tanggapan)
                        <div class="aduan-catatan-box">
                            <span class="aduan-catatan-label">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                                Catatan Internal Admin:
                            </span>
                            <p class="aduan-catatan-text">{{ $item->tanggapan }}</p>
                        </div>
                    @endif

                    {{-- Tombol Aksi --}}
                    <div class="aduan-footer-actions">
                        <a href="{{ route('admin.pengaduan.edit', $item->id) }}" class="btn-action-primary">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                            </svg>
                            Periksa / Ubah Status
                        </a>

                        <form action="{{ route('admin.pengaduan.destroy', $item->id) }}"
                              method="POST"
                              style="margin:0;"
                              onsubmit="return confirm('Apakah Anda yakin ingin menghapus data pengaduan ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-action-delete">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                    <polyline points="3 6 5 6 21 6"></polyline>
                                    <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                    <line x1="10" y1="11" x2="10" y2="17"></line>
                                    <line x1="14" y1="11" x2="14" y2="17"></line>
                                </svg>
                                Hapus
                            </button>
                        </form>
                    </div>
                </article>
            @endforeach
        </div>
    @endif
</div>
@endsection
