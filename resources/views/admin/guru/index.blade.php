@extends('layouts.app')

@section('title', 'Admin - Data Guru & Tenaga Kependidikan')

@push('styles')
<style>
    .admin-guru-page {
        max-width: 1100px;
        margin: 0 auto;
        color: var(--site-text, #263244);
    }

    .page-header-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
        flex-wrap: wrap;
        margin-bottom: 24px;
    }

    .page-header-row h1 {
        margin: 0 0 6px;
        font-size: clamp(24px, 3.2vw, 30px);
        color: #1e293b;
    }

    .page-header-row p {
        margin: 0;
        color: #64748b;
        font-size: 14.5px;
    }

    .header-actions {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .btn-create-guru {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 18px;
        background: var(--site-red, #a84450);
        color: #ffffff !important;
        font-size: 14px;
        font-weight: 700;
        border-radius: 8px;
        text-decoration: none;
        transition: background 0.15s ease, transform 0.1s ease;
    }

    .btn-create-guru:hover {
        background: var(--site-red-dark, #893642);
        transform: translateY(-1px);
    }

    .stats-pill {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: #ffffff;
        border: 1px solid #e2e8f0;
        padding: 8px 14px;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 600;
        color: #475569;
    }

    /* Table Card */
    .table-container-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 14px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.03);
        overflow: hidden;
    }

    .table-responsive {
        width: 100%;
        overflow-x: auto;
    }

    .guru-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 14px;
        text-align: left;
    }

    .guru-table th {
        background: #f8fafc;
        color: #475569;
        font-weight: 700;
        font-size: 12.5px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 14px 18px;
        border-bottom: 1.5px solid #e2e8f0;
        white-space: nowrap;
    }

    .guru-table td {
        padding: 16px 18px;
        border-bottom: 1px solid #f1f5f9;
        vertical-align: middle;
        color: #334155;
    }

    .guru-table tbody tr {
        transition: background-color 0.15s ease;
    }

    .guru-table tbody tr:hover {
        background-color: #fdf8f9;
    }

    /* Guru Photo */
    .guru-photo-wrap {
        width: 54px;
        height: 72px;
        border-radius: 8px;
        overflow: hidden;
        background: #f1f5f9;
        border: 1px solid #cbd5e1;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.04);
    }

    .guru-photo-wrap img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    .guru-photo-placeholder {
        font-size: 11px;
        color: #94a3b8;
        font-weight: 600;
        text-align: center;
        padding: 4px;
    }

    /* Info Column */
    .guru-name {
        font-weight: 700;
        font-size: 14.5px;
        color: #1e293b;
        margin-bottom: 3px;
    }

    .guru-role {
        font-size: 13px;
        color: #64748b;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .badge-order {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 26px;
        height: 26px;
        padding: 0 6px;
        background: #f1f5f9;
        color: #475569;
        font-weight: 700;
        font-size: 12px;
        border-radius: 6px;
        border: 1px solid #e2e8f0;
    }

    /* Status Badges */
    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 4px 10px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 700;
        letter-spacing: 0.3px;
    }

    .status-badge--aktif {
        background: #dcfce7;
        color: #15803d;
        border: 1px solid #bbf7d0;
    }

    .status-badge--nonaktif {
        background: #f1f5f9;
        color: #64748b;
        border: 1px solid #e2e8f0;
    }

    .status-dot {
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: currentColor;
    }

    .guru-quote {
        font-size: 13px;
        color: #64748b;
        font-style: italic;
        max-width: 280px;
        line-height: 1.45;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    /* Actions */
    .actions-cell {
        white-space: nowrap;
    }

    .btn-table-edit {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 6px 12px;
        background: var(--site-pink, #f5e7e9);
        color: var(--site-red-dark, #893642) !important;
        border-radius: 6px;
        font-size: 13px;
        font-weight: 600;
        text-decoration: none;
        transition: background 0.15s ease;
    }

    .btn-table-edit:hover {
        background: #edd5d9;
    }

    .btn-table-delete {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 6px 12px;
        background: #fff1f2;
        color: #be123c !important;
        border: 1px solid #fecdd3;
        border-radius: 6px;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
        font-family: inherit;
        margin-left: 4px;
        transition: background 0.15s ease;
    }

    .btn-table-delete:hover {
        background: #ffe4e6;
        border-color: #fda4af;
    }

    .empty-state-box {
        text-align: center;
        padding: 48px 20px;
        color: #64748b;
    }

    .empty-state-box h3 {
        margin: 12px 0 6px;
        color: #1e293b;
        font-size: 17px;
    }
</style>
@endpush

@section('content')
<div class="admin-guru-page">
    <div class="page-header-row">
        <div>
            <h1>Data Guru & Tenaga Kependidikan</h1>
            <p>Kelola daftar pengajar, staf, nomor urut tampilan, dan foto resmi profil sekolah.</p>
        </div>

        <div class="header-actions">
            <div class="stats-pill">
                <span>Total: <strong>{{ $guru->count() }}</strong></span>
                <span style="color:#cbd5e1;">|</span>
                <span style="color:#15803d;">Aktif: <strong>{{ $guru->where('status', 'aktif')->count() }}</strong></span>
            </div>

            <a href="{{ route('admin.guru.create') }}" class="btn-create-guru">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <line x1="12" y1="5" x2="12" y2="19"></line>
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                </svg>
                Tambah Guru
            </a>
        </div>
    </div>

    @if (session('success'))
        <div style="background:#ecfdf5;border:1px solid #a7f3d0;border-radius:10px;padding:14px 18px;color:#065f46;margin-bottom:20px;font-size:14px;font-weight:600;display:flex;align-items:center;gap:10px;">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#059669" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                <polyline points="22 4 12 14.01 9 11.01"></polyline>
            </svg>
            {{ session('success') }}
        </div>
    @endif

    <div class="table-container-card">
        @if ($guru->isEmpty())
            <div class="empty-state-box">
                <svg width="44" height="44" viewBox="0 0 24 24" fill="none" stroke="#94a3b8" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" style="margin:0 auto;">
                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                    <circle cx="9" cy="7" r="4"></circle>
                    <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                    <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                </svg>
                <h3>Belum Ada Data Guru</h3>
                <p>Silakan klik tombol "Tambah Guru" untuk menambahkan profil tenaga pendidik baru.</p>
                <a href="{{ route('admin.guru.create') }}" class="btn-create-guru" style="margin-top:10px;">
                    + Tambah Guru Sekarang
                </a>
            </div>
        @else
            <div class="table-responsive">
                <table class="guru-table">
                    <thead>
                        <tr>
                            <th style="width: 50px; text-align: center;">No</th>
                            <th style="width: 75px; text-align: center;">Foto (3:4)</th>
                            <th>Nama Lengkap & Jabatan</th>
                            <th style="width: 80px; text-align: center;">Urutan</th>
                            <th>Kata Mutiara</th>
                            <th style="width: 100px; text-align: center;">Status</th>
                            <th style="width: 150px; text-align: center;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($guru as $item)
                            <tr>
                                <td style="text-align: center; color: #64748b; font-weight: 600;">
                                    {{ $loop->iteration }}
                                </td>

                                <td style="text-align: center;">
                                    <div class="guru-photo-wrap" style="margin: 0 auto;">
                                        @if ($item->foto)
                                            <img src="{{ asset('storage/' . $item->foto) }}"
                                                 alt="Foto {{ $item->nama }}">
                                        @elseif ($item->foto_awal)
                                            <img src="{{ asset('storage/' . $item->foto_awal) }}"
                                                 alt="Foto awal {{ $item->nama }}">
                                        @else
                                            <span class="guru-photo-placeholder">Tanpa Foto</span>
                                        @endif
                                    </div>
                                </td>

                                <td>
                                    <div class="guru-name">{{ $item->nama }}</div>
                                    <div class="guru-role">
                                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                            <rect width="20" height="14" x="2" y="7" rx="2" ry="2"></rect>
                                            <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path>
                                        </svg>
                                        {{ $item->jabatan }}
                                    </div>
                                </td>

                                <td style="text-align: center;">
                                    <span class="badge-order">{{ $item->urutan ?? 0 }}</span>
                                </td>

                                <td>
                                    @if ($item->kata_kata)
                                        <div class="guru-quote" title="{{ $item->kata_kata }}">
                                            “{{ $item->kata_kata }}”
                                        </div>
                                    @else
                                        <span style="color: #cbd5e1;">-</span>
                                    @endif
                                </td>

                                <td style="text-align: center;">
                                    @if ($item->status === 'aktif')
                                        <span class="status-badge status-badge--aktif">
                                            <span class="status-dot"></span> Aktif
                                        </span>
                                    @else
                                        <span class="status-badge status-badge--nonaktif">
                                            <span class="status-dot"></span> Nonaktif
                                        </span>
                                    @endif
                                </td>

                                <td class="actions-cell" style="text-align: center;">
                                    <a href="{{ route('admin.guru.edit', $item->id) }}" class="btn-table-edit" title="Edit Data Guru">
                                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                        </svg>
                                        Edit
                                    </a>

                                    <form action="{{ route('admin.guru.destroy', $item->id) }}"
                                          method="POST"
                                          style="display: inline; margin: 0;"
                                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus data guru \'{{ addslashes($item->nama) }}\'?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-table-delete" title="Hapus Data Guru">
                                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                                <polyline points="3 6 5 6 21 6"></polyline>
                                                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                                <line x1="10" y1="11" x2="10" y2="17"></line>
                                                <line x1="14" y1="11" x2="14" y2="17"></line>
                                            </svg>
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>
@endsection
