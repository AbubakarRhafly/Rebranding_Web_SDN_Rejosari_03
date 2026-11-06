@extends('layouts.app')

@section('title', 'Profil Sekolah — SDN Rejosari 03')

@push('styles')
<style>
    .page-header {
        background: linear-gradient(135deg, var(--site-red) 0%, var(--site-red-dark) 100%);
        color: #ffffff;
        padding: 40px 30px;
        border-radius: 16px;
        margin-bottom: 30px;
        box-shadow: 0 4px 14px rgba(168, 68, 80, 0.15);
        box-sizing: border-box;
        max-width: 100%;
    }

    .page-header__badge {
        display: inline-block;
        background: rgba(255, 255, 255, 0.2);
        color: #ffffff;
        padding: 6px 14px;
        border-radius: 20px;
        font-size: 13px;
        font-weight: 600;
        letter-spacing: 0.5px;
        margin-bottom: 12px;
    }

    .page-header h1 {
        margin: 0 0 10px;
        font-size: clamp(24px, 3.5vw, 36px);
        line-height: 1.25;
        overflow-wrap: break-word;
    }

    .page-header p {
        margin: 0;
        font-size: 16px;
        opacity: 0.95;
        max-width: 720px;
        line-height: 1.6;
        overflow-wrap: break-word;
    }

    .profile-grid {
        display: grid;
        grid-template-columns: 1.25fr 1fr;
        gap: 25px;
        margin-bottom: 30px;
    }

    .profile-card {
        background: #ffffff;
        border-radius: 14px;
        padding: 28px;
        border: 1px solid #e5e7eb;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
        margin-bottom: 25px;
        box-sizing: border-box;
        max-width: 100%;
        overflow-wrap: break-word;
    }

    .profile-card h2 {
        margin: 0 0 18px;
        font-size: 22px;
        color: var(--site-text);
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .profile-card h2::before {
        content: "";
        display: inline-block;
        width: 4px;
        height: 22px;
        background: var(--site-red);
        border-radius: 4px;
        flex-shrink: 0;
    }

    .info-table {
        width: 100%;
        border-collapse: collapse;
        max-width: 100%;
    }

    .info-table tr {
        border-bottom: 1px solid #f1f5f9;
    }

    .info-table tr:last-child {
        border-bottom: none;
    }

    .info-table th {
        text-align: left;
        padding: 12px 0;
        color: #64748b;
        font-weight: 500;
        width: 36%;
        font-size: 14px;
        vertical-align: top;
        overflow-wrap: break-word;
    }

    .info-table td {
        padding: 12px 0;
        color: var(--site-text);
        font-weight: 600;
        font-size: 14px;
        overflow-wrap: anywhere;
        word-break: break-word;
    }

    .badge-status {
        display: inline-block;
        background: #eef8f1;
        color: #15803d;
        padding: 3px 10px;
        border-radius: 6px;
        font-size: 12px;
        font-weight: 700;
    }

    .badge-umbi {
        display: inline-block;
        background: var(--site-pink);
        color: var(--site-red-dark);
        padding: 4px 10px;
        border-radius: 6px;
        font-size: 12px;
        font-weight: 700;
        line-height: 1.45;
        max-width: 100%;
        white-space: normal;
        overflow-wrap: anywhere;
        word-break: break-word;
        box-sizing: border-box;
    }

    .feature-list {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
        gap: 16px;
        margin-top: 20px;
    }

    .feature-item {
        background: var(--site-pink);
        padding: 20px;
        border-radius: 12px;
        border-left: 4px solid var(--site-red);
        box-sizing: border-box;
    }

    .feature-item h3 {
        margin: 0 0 6px;
        font-size: 16px;
        color: var(--site-red-dark);
    }

    .feature-item p {
        margin: 0;
        font-size: 13px;
        color: #475569;
        line-height: 1.55;
    }

    .related-links-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 16px;
        margin-top: 18px;
    }

    .related-link-card {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        padding: 18px 20px;
        background: #fafbfc;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        text-decoration: none;
        color: inherit;
        box-sizing: border-box;
        transition: transform 0.2s ease, border-color 0.2s ease, box-shadow 0.2s ease;
    }

    .related-link-card:hover {
        transform: translateY(-2px);
        border-color: var(--site-red);
        box-shadow: 0 4px 12px rgba(168, 68, 80, 0.08);
    }

    .related-link-card h4 {
        margin: 0 0 6px;
        font-size: 15px;
        color: var(--site-red-dark);
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .related-link-card p {
        margin: 0;
        font-size: 13px;
        color: #64748b;
        line-height: 1.5;
    }

    .contact-actions {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
        margin-top: 20px;
    }

    .btn-action-primary {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        background: var(--site-red);
        color: #ffffff;
        font-weight: 600;
        font-size: 13.5px;
        padding: 9px 16px;
        border-radius: 8px;
        text-decoration: none;
        box-sizing: border-box;
        transition: background 0.2s ease;
    }

    .btn-action-primary:hover {
        background: var(--site-red-dark);
    }

    .btn-action-secondary {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        background: var(--site-pink);
        color: var(--site-red-dark);
        font-weight: 600;
        font-size: 13.5px;
        padding: 9px 16px;
        border-radius: 8px;
        text-decoration: none;
        box-sizing: border-box;
        transition: background 0.2s ease;
    }

    .btn-action-secondary:hover {
        background: #edd8db;
    }

    @media (max-width: 900px) {
        .profile-grid {
            grid-template-columns: 1fr;
        }

        .page-header {
            padding: 28px 20px;
        }
    }

    @media (max-width: 640px) {
        .page-header {
            padding: 22px 16px;
            border-radius: 14px;
            margin-bottom: 20px;
        }

        .page-header h1 {
            font-size: 22px;
        }

        .page-header p {
            font-size: 13.5px;
            line-height: 1.55;
        }

        .profile-card {
            padding: 18px 16px;
            border-radius: 12px;
            margin-bottom: 18px;
        }

        .profile-card h2 {
            font-size: 18px;
            margin-bottom: 14px;
        }

        /* Stack table rows vertically on mobile to prevent squishing and horizontal scroll */
        .info-table,
        .info-table tbody,
        .info-table tr,
        .info-table th,
        .info-table td {
            display: block;
            width: 100%;
            box-sizing: border-box;
        }

        .info-table tr {
            padding: 10px 0;
            border-bottom: 1px solid #f1f5f9;
        }

        .info-table th {
            width: 100%;
            padding: 0 0 3px 0;
            font-size: 12px;
            font-weight: 600;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 0.3px;
        }

        .info-table td {
            width: 100%;
            padding: 0;
            font-size: 13.5px;
            line-height: 1.5;
        }

        .contact-actions {
            flex-direction: column;
            gap: 10px;
        }

        .btn-action-primary,
        .btn-action-secondary {
            width: 100%;
            padding: 11px 16px;
        }

        .feature-list {
            grid-template-columns: 1fr;
            gap: 12px;
        }

        .related-links-grid {
            grid-template-columns: 1fr;
            gap: 12px;
        }
    }
</style>
@endpush

@section('content')
<div class="page-header">
    <span class="page-header__badge">TENTANG SEKOLAH</span>
    <h1>Profil SDN Rejosari 03</h1>
    <p>Mewujudkan peserta didik yang Unggul Budi Pekerti, Maju dalam Bidang IPTEK, Berkarakter, dan Inovatif (UMBI) di lingkungan pendidikan ramah anak Kota Semarang.</p>
</div>

<div class="profile-grid">
    <div class="profile-card">
        <h2>Identitas Satuan Pendidikan</h2>
        <table class="info-table" aria-label="Tabel Identitas Sekolah">
            <tbody>
                <tr>
                    <th scope="row">Nama Sekolah</th>
                    <td>SDN Rejosari 03 Semarang</td>
                </tr>
                <tr>
                    <th scope="row">NPSN</th>
                    <td>20329037</td>
                </tr>
                <tr>
                    <th scope="row">Bentuk Pendidikan</th>
                    <td>Sekolah Dasar (SD)</td>
                </tr>
                <tr>
                    <th scope="row">Status Sekolah</th>
                    <td><span class="badge-status">Negeri</span></td>
                </tr>
                <tr>
                    <th scope="row">Motto & Visi</th>
                    <td><span class="badge-umbi">UMBI (Unggul, Maju IPTEK, Berkarakter, Inovatif)</span></td>
                </tr>
                <tr>
                    <th scope="row">Kurikulum</th>
                    <td>Kurikulum Merdeka</td>
                </tr>
                <tr>
                    <th scope="row">Kecamatan</th>
                    <td>Semarang Timur</td>
                </tr>
                <tr>
                    <th scope="row">Kota / Provinsi</th>
                    <td>Kota Semarang, Jawa Tengah</td>
                </tr>
                <tr>
                    <th scope="row">Kode Pos</th>
                    <td>50125</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="profile-card">
        <h2>Informasi Lokasi & Kontak</h2>
        <table class="info-table" aria-label="Tabel Kontak Sekolah">
            <tbody>
                <tr>
                    <th scope="row">Alamat</th>
                    <td>Jl. Tirtoyoso VI No. 10, Rejosari</td>
                </tr>
                <tr>
                    <th scope="row">Kelurahan</th>
                    <td>Rejosari, Semarang Timur</td>
                </tr>
                <tr>
                    <th scope="row">No. Telepon / Fax</th>
                    <td><strong>024 - 340710</strong></td>
                </tr>
                <tr>
                    <th scope="row">Email Resmi</th>
                    <td><strong>sdnegerirejosari03@gmail.com</strong></td>
                </tr>
                <tr>
                    <th scope="row">Jam Operasional</th>
                    <td>
                        Senin – Kamis: 07.00 – 14.00 WIB<br>
                        Jumat: 07.00 – 11.30 WIB<br>
                        Sabtu: 07.00 – 12.00 WIB<br>
                        <span style="color: #94a3b8; font-size: 13px;">Minggu & Libur: Tutup</span>
                    </td>
                </tr>
                <tr>
                    <th scope="row">Layanan Aduan</th>
                    <td>Tersedia formulir pengaduan online</td>
                </tr>
            </tbody>
        </table>

        <div class="contact-actions">
            <a href="https://www.google.com/maps/search/?api=1&query=SDN+Rejosari+03+Semarang" target="_blank" rel="noopener noreferrer" class="btn-action-primary">
                Buka Google Maps ↗
            </a>
            <a href="{{ route('profil.kontak') }}" class="btn-action-secondary">
                Lihat Halaman Kontak & FAQ →
            </a>
        </div>
    </div>
</div>

<div class="profile-card">
    <h2>Fasilitas & Lingkungan Belajar</h2>
    <p style="color: #475569; font-size: 14px; line-height: 1.6; margin-top: 0;">
        SDN Rejosari 03 terus berkomitmen menghadirkan sarana dan prasarana yang memadai guna menunjang proses pembelajaran yang interaktif, aman, ramah anak, dan nyaman bagi seluruh peserta didik.
    </p>

    <div class="feature-list">
        <div class="feature-item">
            <h3>Ruang Kelas Nyaman & Digital</h3>
            <p>Pencahayaan memadai, ventilasi asri, dan pemanfaatan media pembelajaran berbasis digital.</p>
        </div>
        <div class="feature-item">
            <h3>Perpustakaan Sekolah</h3>
            <p>Koleksi buku literasi, buku referensi sains, dan pojok baca untuk menumbuhkan minat membaca.</p>
        </div>
        <div class="feature-item">
            <h3>Lapangan Olahraga & Upacara</h3>
            <p>Area kegiatan jasmani, senam bersama, upacara bendera, dan ragam latihan ekstrakurikuler.</p>
        </div>
        <div class="feature-item">
            <h3>Laboratorium Komputer & IT</h3>
            <p>Perangkat komputer terintegrasi untuk pelaksanaan asesmen digital dan pelatihan literasi teknologi.</p>
        </div>
    </div>
</div>

<div class="profile-card">
    <h2>Eksplorasi Profil Sekolah</h2>
    <p style="color: #475569; font-size: 14px; line-height: 1.6; margin-top: 0;">
        Ketahui lebih banyak informasi tentang arah strategis dan keluarga besar SDN Rejosari 03.
    </p>

    <div class="related-links-grid">
        <a href="{{ route('profil.visi-misi') }}" class="related-link-card">
            <h4>Visi & Misi <span>→</span></h4>
            <p>Pedoman komitmen sekolah dan 4 pilar nilai utama UMBI.</p>
        </a>
        <a href="{{ route('guru.index') }}" class="related-link-card">
            <h4>Guru & Tendik <span>→</span></h4>
            <p>Daftar pendidik profesional dan staf kependidikan berdedikasi.</p>
        </a>
        <a href="{{ route('siswa.index') }}" class="related-link-card">
            <h4>Data Siswa <span>→</span></h4>
            <p>Statistik dan direktori peserta didik aktif di setiap tingkatan kelas.</p>
        </a>
        <a href="{{ route('profil.kontak') }}" class="related-link-card">
            <h4>Kontak & FAQ <span>→</span></h4>
            <p>Informasi saluran komunikasi langsung, peta, jam buka, serta tanya jawab.</p>
        </a>
    </div>
</div>
@endsection
