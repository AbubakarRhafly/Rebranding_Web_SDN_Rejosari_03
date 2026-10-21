@extends('layouts.app')

@section('title', 'Kontak & Lokasi Sekolah — SDN Rejosari 03')

@push('styles')
<style>
    .contact-page {
        max-width: 1100px;
        margin: 0 auto;
        color: var(--site-text, #263244);
        box-sizing: border-box;
        width: 100%;
        overflow-wrap: break-word;
    }

    .contact-hero {
        background: linear-gradient(135deg, var(--site-red, #a84450) 0%, var(--site-red-dark, #893642) 100%);
        color: #ffffff;
        padding: 38px 32px;
        border-radius: 16px;
        margin-bottom: 28px;
        box-shadow: 0 4px 16px rgba(168, 68, 80, 0.16);
        box-sizing: border-box;
        max-width: 100%;
    }

    .contact-hero__badge {
        display: inline-block;
        background: rgba(255, 255, 255, 0.2);
        color: #ffffff;
        padding: 5px 14px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 700;
        letter-spacing: 0.5px;
        text-transform: uppercase;
        margin-bottom: 12px;
    }

    .contact-hero h1 {
        margin: 0 0 10px;
        font-size: clamp(24px, 3.5vw, 34px);
        line-height: 1.25;
        overflow-wrap: break-word;
    }

    .contact-hero p {
        margin: 0;
        font-size: 15px;
        opacity: 0.95;
        max-width: 650px;
        line-height: 1.6;
        overflow-wrap: break-word;
    }

    .contact-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 24px;
        margin-bottom: 28px;
    }

    .contact-card {
        background: #ffffff;
        border-radius: 14px;
        padding: 28px;
        border: 1px solid #e2e8f0;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.04);
        display: flex;
        flex-direction: column;
        box-sizing: border-box;
        max-width: 100%;
        overflow-wrap: break-word;
    }

    .contact-card h2 {
        margin: 0 0 16px;
        font-size: 19px;
        color: #1e293b;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .contact-card h2 svg {
        color: var(--site-red, #a84450);
        flex-shrink: 0;
    }

    .contact-item {
        display: flex;
        align-items: flex-start;
        gap: 14px;
        padding: 12px 0;
        border-bottom: 1px solid #f1f5f9;
        font-size: 14px;
        line-height: 1.6;
        box-sizing: border-box;
    }

    .contact-item:last-child {
        border-bottom: none;
    }

    .contact-item strong {
        color: #334155;
        min-width: 110px;
        font-size: 13.5px;
        flex-shrink: 0;
    }

    .contact-item div,
    .contact-item a {
        overflow-wrap: anywhere;
        word-break: break-word;
    }

    .contact-item a {
        color: var(--site-red, #a84450);
        text-decoration: none;
        font-weight: 600;
        transition: color 0.15s ease;
    }

    .contact-item a:hover {
        color: var(--site-red-dark, #893642);
        text-decoration: underline;
    }

    /* Hours Table */
    .hours-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 14px;
        max-width: 100%;
    }

    .hours-table tr {
        border-bottom: 1px solid #f1f5f9;
    }

    .hours-table tr:last-child {
        border-bottom: none;
    }

    .hours-table th {
        text-align: left;
        padding: 12px 0;
        color: #475569;
        font-weight: 500;
        overflow-wrap: anywhere;
    }

    .hours-table td {
        text-align: right;
        padding: 12px 0;
        color: #1e293b;
        font-weight: 600;
        overflow-wrap: anywhere;
        word-break: break-word;
    }

    .hours-table tr.closed td {
        color: #dc2626;
    }

    /* Map Box */
    .map-box {
        background: #ffffff;
        border-radius: 14px;
        padding: 24px;
        border: 1px solid #e2e8f0;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.04);
        margin-bottom: 28px;
        box-sizing: border-box;
        max-width: 100%;
        overflow-wrap: break-word;
    }

    .map-box h2 {
        margin: 0 0 16px;
        font-size: 20px;
        color: #1e293b;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .map-box h2 svg {
        color: var(--site-red, #a84450);
        flex-shrink: 0;
    }

    .map-iframe-wrapper {
        position: relative;
        width: 100%;
        height: 380px;
        border-radius: 12px;
        overflow: hidden;
        border: 1px solid #cbd5e1;
        box-sizing: border-box;
    }

    .map-iframe-wrapper iframe {
        width: 100%;
        height: 100%;
        border: 0;
    }

    .map-actions {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-top: 14px;
        font-size: 13.5px;
        color: #64748b;
        gap: 12px;
        flex-wrap: wrap;
    }

    .map-actions span {
        overflow-wrap: anywhere;
    }

    .btn-maps {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 9px 16px;
        border-radius: 8px;
        background: var(--site-red, #a84450);
        color: #ffffff;
        text-decoration: none;
        font-weight: 600;
        font-size: 13.5px;
        box-sizing: border-box;
        transition: background-color 0.15s ease;
    }

    .btn-maps:hover {
        background: var(--site-red-dark, #893642);
    }

    /* FAQ Section */
    .faq-section {
        background: #ffffff;
        border-radius: 14px;
        padding: 28px;
        border: 1px solid #e2e8f0;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.04);
        box-sizing: border-box;
        max-width: 100%;
        overflow-wrap: break-word;
    }

    .faq-section h2 {
        margin: 0 0 6px;
        font-size: 20px;
        color: #1e293b;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .faq-section h2 svg {
        color: var(--site-red, #a84450);
        flex-shrink: 0;
    }

    .faq-section p.faq-intro {
        margin: 0 0 20px;
        color: #64748b;
        font-size: 14px;
        line-height: 1.5;
    }

    .faq-list {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .faq-item {
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        overflow: hidden;
        background: #fafbfc;
        transition: border-color 0.15s ease;
        box-sizing: border-box;
    }

    .faq-item[open] {
        border-color: #cbd5e1;
        background: #ffffff;
    }

    .faq-summary {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 14px 18px;
        font-size: 14.5px;
        font-weight: 600;
        color: #1e293b;
        cursor: pointer;
        list-style: none;
        user-select: none;
        gap: 12px;
        box-sizing: border-box;
    }

    .faq-summary span {
        flex: 1;
        overflow-wrap: anywhere;
    }

    .faq-summary::-webkit-details-marker {
        display: none;
    }

    .faq-chevron {
        transition: transform 0.2s ease;
        color: #64748b;
        flex-shrink: 0;
    }

    .faq-item[open] .faq-chevron {
        transform: rotate(180deg);
        color: var(--site-red, #a84450);
    }

    .faq-content {
        padding: 0 18px 16px;
        font-size: 14px;
        line-height: 1.65;
        color: #475569;
        border-top: 1px solid #f1f5f9;
        margin-top: 6px;
        padding-top: 12px;
        overflow-wrap: anywhere;
        word-break: break-word;
    }

    @media (max-width: 800px) {
        .contact-grid {
            grid-template-columns: 1fr;
        }

        .contact-hero {
            padding: 26px 20px;
        }

        .map-iframe-wrapper {
            height: 280px;
        }
    }

    @media (max-width: 640px) {
        .contact-hero {
            padding: 22px 16px;
            border-radius: 14px;
            margin-bottom: 20px;
        }

        .contact-hero h1 {
            font-size: 22px;
        }

        .contact-hero p {
            font-size: 13.5px;
            line-height: 1.55;
        }

        .contact-card,
        .map-box,
        .faq-section {
            padding: 18px 16px;
            border-radius: 12px;
            margin-bottom: 20px;
        }

        .contact-card h2,
        .map-box h2,
        .faq-section h2 {
            font-size: 18px;
            margin-bottom: 14px;
        }

        /* Stack contact items vertically on mobile to prevent squishing and horizontal scroll */
        .contact-item {
            flex-direction: column;
            gap: 4px;
            padding: 10px 0;
        }

        .contact-item strong {
            min-width: 0;
            font-size: 12px;
            font-weight: 600;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 0.3px;
        }

        .contact-item div {
            font-size: 13.5px;
            line-height: 1.5;
        }

        .hours-table tr {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 0;
            gap: 8px;
        }

        .hours-table th,
        .hours-table td {
            padding: 0;
            font-size: 13px;
        }

        .map-iframe-wrapper {
            height: 230px;
            border-radius: 10px;
        }

        .map-actions {
            flex-direction: column;
            align-items: stretch;
            gap: 12px;
        }

        .map-actions span {
            font-size: 12px;
        }

        .btn-maps {
            width: 100%;
            justify-content: center;
            text-align: center;
            padding: 11px 16px;
        }

        .faq-summary {
            padding: 12px 14px;
            font-size: 13.5px;
            gap: 8px;
        }

        .faq-content {
            padding: 0 14px 12px;
            font-size: 13px;
        }
    }
</style>
@endpush

@section('content')
<div class="contact-page">
    <div class="contact-hero">
        <span class="contact-hero__badge">INFORMASI RESMI</span>
        <h1>Kontak & Lokasi SDN Rejosari 03</h1>
        <p>Hubungi satuan pendidikan kami atau kunjungi langsung gedung sekolah di Semarang Timur untuk informasi pembelajaran, pendaftaran, dan administrasi.</p>
    </div>

    <div class="contact-grid">
        {{-- Card 1: Informasi Kontak Resmi --}}
        <div class="contact-card">
            <h2>
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <rect width="20" height="16" x="2" y="4" rx="2"></rect>
                    <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"></path>
                </svg>
                Kontak & Lokasi
            </h2>

            <div class="contact-item">
                <strong>Alamat Sekolah</strong>
                <div>
                    SDN Rejosari 03 Semarang<br>
                    Jl. Tirtoyoso VI No. 10, Kel. Rejosari,<br>
                    Kec. Semarang Timur, Kota Semarang, Jawa Tengah 50125
                </div>
            </div>

            <div class="contact-item">
                <strong>Nomor Telepon / Fax</strong>
                <div>
                    <a href="tel:024340710">024 - 340710</a>
                </div>
            </div>

            <div class="contact-item">
                <strong>Email Resmi</strong>
                <div>
                    <a href="mailto:sdnegerirejosari03@gmail.com">sdnegerirejosari03@gmail.com</a>
                </div>
            </div>

            <div class="contact-item">
                <strong>Layanan Publik</strong>
                <div>
                    Tersedia formulir pengaduan & aspirasi daring melalui menu <a href="{{ route('pengaduan.create') }}">Pengaduan</a>.
                </div>
            </div>
        </div>

        {{-- Card 2: Jam Layanan Sekolah --}}
        <div class="contact-card">
            <h2>
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <circle cx="12" cy="12" r="10"></circle>
                    <polyline points="12 6 12 12 16 14"></polyline>
                </svg>
                Jam Layanan Operasional
            </h2>

            <table class="hours-table" aria-label="Tabel Jam Operasional Layanan Sekolah">
                <tbody>
                    <tr>
                        <th scope="row">Senin – Kamis</th>
                        <td>07.00 – 14.00 WIB</td>
                    </tr>
                    <tr>
                        <th scope="row">Jumat</th>
                        <td>07.00 – 11.30 WIB</td>
                    </tr>
                    <tr>
                        <th scope="row">Sabtu</th>
                        <td>07.00 – 12.00 WIB</td>
                    </tr>
                    <tr class="closed">
                        <th scope="row">Minggu & Libur Nasional</th>
                        <td>Tutup</td>
                    </tr>
                </tbody>
            </table>

            <p style="margin: 16px 0 0; font-size: 12.5px; color: #64748b; line-height: 1.5;">
                * Tamu dipersilakan melapor ke petugas keamanan dan mengisi buku tamu di kantor tata usaha sekolah.
            </p>
        </div>
    </div>

    {{-- Peta Interaktif (Map) --}}
    <div class="map-box">
        <h2>
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"></path>
                <circle cx="12" cy="10" r="3"></circle>
            </svg>
            Peta Lokasi Sekolah
        </h2>

        <div class="map-iframe-wrapper">
            <iframe
                title="Peta Lokasi SDN Rejosari 03 Semarang"
                src="https://maps.google.com/maps?q=SDN%20Rejosari%2003%20Semarang&amp;output=embed"
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"
                allowfullscreen>
            </iframe>
        </div>

        <div class="map-actions">
            <span>Koordinat: -6.9749, 110.4398 • Rejosari, Semarang Timur</span>
            <a href="https://www.google.com/maps/search/?api=1&query=SDN+Rejosari+03+Semarang" target="_blank" rel="noopener noreferrer" class="btn-maps">
                Buka di Google Maps ↗
            </a>
        </div>
    </div>

    {{-- FAQ Section --}}
    <div class="faq-section">
        <h2>
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <circle cx="12" cy="12" r="10"></circle>
                <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"></path>
                <path d="M12 17h.01"></path>
            </svg>
            Frequently Asked Questions (FAQ)
        </h2>
        <p class="faq-intro">Pertanyaan umum seputar layanan, administrasi, dan informasi SDN Rejosari 03.</p>

        <div class="faq-list">
            <details class="faq-item">
                <summary class="faq-summary">
                    <span>Bagaimana cara mendaftarkan siswa baru di SDN Rejosari 03?</span>
                    <svg class="faq-chevron" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </summary>
                <div class="faq-content">
                    Pendaftaran Peserta Didik Baru (PPDB) mengikuti jadwal resmi dari Dinas Pendidikan Kota Semarang secara daring (online). Informasi lengkap kuota, zonasi, dan persyaratan berkas akan kami publikasikan di menu Berita & Pengumuman menjelang periode PPDB.
                </div>
            </details>

            <details class="faq-item">
                <summary class="faq-summary">
                    <span>Apakah bisa berkunjung atau berkonsultasi langsung ke sekolah?</span>
                    <svg class="faq-chevron" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </summary>
                <div class="faq-content">
                    Bisa. Orang tua atau wali murid dapat berkunjung pada jam layanan operasional (Senin – Kamis pukul 07.00 – 14.00 WIB, Jumat pukul 07.00 – 11.30 WIB, Sabtu pukul 07.00 – 12.00 WIB). Harap melapor terlebih dahulu ke pos keamanan dan resepsionis sekolah.
                </div>
            </details>

            <details class="faq-item">
                <summary class="faq-summary">
                    <span>Bagaimana alur penyampaian saran atau pengaduan sekolah?</span>
                    <svg class="faq-chevron" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </summary>
                <div class="faq-content">
                    Anda dapat menggunakan fasilitas form online pada menu Pengaduan di website ini. Seluruh data pelapor dijaga kerahasiaannya dan akan langsung ditindaklanjuti oleh pihak manajemen sekolah. Alternatif lain, Anda dapat menghubungi via email resmi di sdnegerirejosari03@gmail.com.
                </div>
            </details>

            <details class="faq-item">
                <summary class="faq-summary">
                    <span>Apakah SDN Rejosari 03 memungut biaya pendaftaran atau SPP?</span>
                    <svg class="faq-chevron" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </summary>
                <div class="faq-content">
                    Sebagai Sekolah Dasar Negeri di bawah naungan Dinas Pendidikan Kota Semarang, proses pembelajaran reguler didukung oleh dana Bantuan Operasional Sekolah (BOS) sehingga bebas biaya SPP bulanan.
                </div>
            </details>
        </div>
    </div>
</div>
@endsection
