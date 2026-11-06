@extends('layouts.app')

@section('title', 'Layanan Pengaduan & Aspirasi — SDN Rejosari 03')

@push('styles')
<style>
    .complaint-page {
        max-width: 1100px;
        margin: 0 auto;
        color: var(--site-text, #263244);
    }

    .complaint-hero {
        background: linear-gradient(135deg, var(--site-red, #a84450) 0%, var(--site-red-dark, #893642) 100%);
        color: #ffffff;
        padding: 38px 32px;
        border-radius: 16px;
        margin-bottom: 28px;
        box-shadow: 0 4px 16px rgba(168, 68, 80, 0.16);
    }

    .complaint-hero__badge {
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

    .complaint-hero h1 {
        margin: 0 0 10px;
        font-size: clamp(24px, 3.5vw, 34px);
        line-height: 1.25;
    }

    .complaint-hero p {
        margin: 0;
        font-size: 15px;
        opacity: 0.95;
        max-width: 650px;
        line-height: 1.6;
    }

    .complaint-layout {
        display: grid;
        grid-template-columns: 1.45fr 1fr;
        gap: 28px;
        align-items: start;
    }

    .complaint-card {
        background: #ffffff;
        border-radius: 14px;
        padding: 30px;
        border: 1px solid #e2e8f0;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.04);
    }

    .complaint-card h2 {
        margin: 0 0 8px;
        font-size: 20px;
        color: #1e293b;
    }

    .complaint-card p.subtitle {
        margin: 0 0 24px;
        color: #64748b;
        font-size: 13.5px;
        line-height: 1.5;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-label {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 7px;
        font-size: 14px;
        font-weight: 600;
        color: #334155;
    }

    .form-label .required {
        color: var(--site-red, #a84450);
        margin-left: 3px;
    }

    .form-label .optional {
        color: #94a3b8;
        font-size: 12px;
        font-weight: 400;
    }

    .form-control {
        width: 100%;
        min-height: 46px;
        padding: 10px 14px;
        border: 1.5px solid #cbd5e1;
        border-radius: 8px;
        font-size: 14.5px;
        font-family: inherit;
        color: #1e293b;
        background: #ffffff;
        box-sizing: border-box;
        transition: border-color 0.15s ease, box-shadow 0.15s ease;
    }

    select.form-control {
        cursor: pointer;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%2364748b' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 14px center;
        padding-right: 40px;
        appearance: none;
        -webkit-appearance: none;
    }

    textarea.form-control {
        min-height: 130px;
        resize: vertical;
        line-height: 1.5;
    }

    .form-control:focus {
        border-color: var(--site-red, #a84450);
        outline: none;
        box-shadow: 0 0 0 3px rgba(168, 68, 80, 0.15);
    }

    .form-hint {
        margin-top: 6px;
        font-size: 12px;
        color: #64748b;
        line-height: 1.4;
    }

    .btn-submit {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        width: 100%;
        min-height: 48px;
        padding: 12px 24px;
        background: var(--site-red, #a84450);
        color: #ffffff;
        border: none;
        border-radius: 8px;
        font-size: 15px;
        font-weight: 700;
        cursor: pointer;
        font-family: inherit;
        transition: background-color 0.15s ease, transform 0.1s ease;
    }

    .btn-submit:hover {
        background: var(--site-red-dark, #893642);
        transform: translateY(-1px);
    }

    .btn-submit:active {
        transform: translateY(1px);
    }

    /* Aside Cards */
    .aside-box {
        background: #ffffff;
        border-radius: 14px;
        padding: 24px;
        border: 1px solid #e2e8f0;
        margin-bottom: 20px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.03);
    }

    .aside-box h3 {
        margin: 0 0 12px;
        font-size: 16px;
        color: #1e293b;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .security-note {
        background: #f8fafc;
        border-left: 4px solid var(--site-red, #a84450);
        padding: 14px 16px;
        border-radius: 0 8px 8px 0;
        font-size: 13px;
        color: #475569;
        line-height: 1.55;
    }

    .quick-contact-list {
        display: grid;
        gap: 10px;
        font-size: 13.5px;
        color: #475569;
    }

    .quick-contact-item {
        display: flex;
        align-items: center;
        gap: 10px;
        overflow-wrap: anywhere;
    }

    .alert-success {
        background: #ecfdf5;
        border: 1px solid #a7f3d0;
        border-radius: 12px;
        padding: 18px 22px;
        margin-bottom: 24px;
        color: #065f46;
        display: flex;
        align-items: flex-start;
        gap: 14px;
    }

    .alert-success h4 {
        margin: 0 0 4px;
        font-size: 16px;
        font-weight: 700;
    }

    .alert-success p {
        margin: 0;
        font-size: 13.5px;
        line-height: 1.5;
    }

    .alert-error {
        background: #fef2f2;
        border: 1px solid #fecaca;
        border-radius: 12px;
        padding: 16px 20px;
        margin-bottom: 24px;
        color: #991b1b;
        font-size: 13.5px;
    }

    .alert-error ul {
        margin: 8px 0 0;
        padding-left: 20px;
    }

    @media (max-width: 820px) {
        .complaint-layout {
            grid-template-columns: 1fr;
        }

        .complaint-hero {
            padding: 26px 20px;
        }

        .complaint-card {
            padding: 22px 18px;
        }
    }
</style>
@endpush

@section('content')
<div class="complaint-page">
    <div class="complaint-hero">
        <span class="complaint-hero__badge">KOTAK ASPIRASI & PENGADUAN</span>
        <h1>Layanan Pengaduan Sekolah</h1>
        <p>Sampaikan pertanyaan, kritik, saran, maupun aspirasi secara langsung ke pihak SDN Rejosari 03 Semarang demi peningkatan mutu pendidikan yang lebih baik.</p>
    </div>

    @if (session('success'))
        <div class="alert-success" role="alert">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#059669" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" style="flex-shrink: 0; margin-top: 2px;">
                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                <polyline points="22 4 12 14.01 9 11.01"></polyline>
            </svg>
            <div>
                <h4>Pengaduan Berhasil Dikirim!</h4>
                <p>{{ session('success') }} Data Anda telah masuk ke sistem dan akan ditinjau langsung oleh tim pengelola sekolah. Balasan akan disampaikan melalui email yang Anda daftarkan.</p>
            </div>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert-error" role="alert">
            <strong>Mohon periksa kembali formulir Anda:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="complaint-layout">
        {{-- Formulir Utama --}}
        <div class="complaint-card">
            <h2>Formulir Pengaduan</h2>
            <p class="subtitle">Silakan isi formulir di bawah ini dengan informasi yang jelas dan dapat dipertanggungjawabkan.</p>

            <form action="{{ route('pengaduan.store') }}" method="POST">
                @csrf

                {{-- Nama Lengkap --}}
                <div class="form-group">
                    <label for="nama" class="form-label">
                        <span>Nama Lengkap <span class="required" aria-hidden="true">*</span></span>
                    </label>
                    <input
                        id="nama"
                        type="text"
                        name="nama"
                        class="form-control"
                        value="{{ old('nama') }}"
                        placeholder="Contoh: Budi Santoso"
                        maxlength="150"
                        required
                    >
                </div>

                {{-- Email --}}
                <div class="form-group">
                    <label for="email" class="form-label">
                        <span>Alamat Email Aktif <span class="required" aria-hidden="true">*</span></span>
                    </label>
                    <input
                        id="email"
                        type="email"
                        name="email"
                        class="form-control"
                        value="{{ old('email') }}"
                        placeholder="nama@email.com"
                        maxlength="150"
                        required
                    >
                    <p class="form-hint">Email akan digunakan oleh pihak sekolah untuk mengirimkan tanggapan secara resmi.</p>
                </div>

                {{-- Nomor WhatsApp / HP --}}
                <div class="form-group">
                    <label for="no_hp" class="form-label">
                        <span>Nomor WhatsApp / HP</span>
                        <span class="optional">(Opsional)</span>
                    </label>
                    <input
                        id="no_hp"
                        type="text"
                        name="no_hp"
                        class="form-control"
                        value="{{ old('no_hp') }}"
                        placeholder="08xxxxxxxxxx"
                        maxlength="30"
                    >
                </div>

                {{-- Kategori Keperluan (Dropdown di Atas Judul Pengaduan) --}}
                <div class="form-group">
                    <label for="kategori_keperluan" class="form-label">
                        <span>Kategori Keperluan <span class="required" aria-hidden="true">*</span></span>
                    </label>
                    <select
                        id="kategori_keperluan"
                        name="kategori_keperluan"
                        class="form-control"
                        required
                    >
                        <option value="">-- Pilih Kategori Keperluan --</option>
                        <option value="Informasi & Pertanyaan Umum" {{ old('kategori_keperluan') == 'Informasi & Pertanyaan Umum' ? 'selected' : '' }}>Informasi & Pertanyaan Umum</option>
                        <option value="Akademik & Pembelajaran" {{ old('kategori_keperluan') == 'Akademik & Pembelajaran' ? 'selected' : '' }}>Akademik & Pembelajaran</option>
                        <option value="Sarana & Prasarana Sekolah" {{ old('kategori_keperluan') == 'Sarana & Prasarana Sekolah' ? 'selected' : '' }}>Sarana & Prasarana Sekolah</option>
                        <option value="Kritik, Saran & Masukan" {{ old('kategori_keperluan') == 'Kritik, Saran & Masukan' ? 'selected' : '' }}>Kritik, Saran & Masukan</option>
                        <option value="Layanan Administrasi & Dokumen" {{ old('kategori_keperluan') == 'Layanan Administrasi & Dokumen' ? 'selected' : '' }}>Layanan Administrasi & Dokumen</option>
                        <option value="Lainnya" {{ old('kategori_keperluan') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                    </select>
                    <p class="form-hint">Pilih topik yang paling sesuai dengan pesan yang ingin disampaikan.</p>
                </div>

                {{-- Judul Pengaduan --}}
                <div class="form-group">
                    <label for="judul" class="form-label">
                        <span>Judul Pengaduan <span class="required" aria-hidden="true">*</span></span>
                    </label>
                    <input
                        id="judul"
                        type="text"
                        name="judul"
                        class="form-control"
                        value="{{ old('judul') }}"
                        placeholder="Ringkasan inti keperluan/pengaduan"
                        maxlength="255"
                        required
                    >
                </div>

                {{-- Isi Pengaduan --}}
                <div class="form-group">
                    <label for="isi" class="form-label">
                        <span>Isi Pengaduan / Pesan <span class="required" aria-hidden="true">*</span></span>
                    </label>
                    <textarea
                        id="isi"
                        name="isi"
                        class="form-control"
                        placeholder="Tuliskan secara lengkap detail pengaduan, waktu kejadian, atau aspirasi yang ingin Anda sampaikan..."
                        maxlength="5000"
                        required
                    >{{ old('isi') }}</textarea>
                </div>

                <button type="submit" class="btn-submit">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <line x1="22" y1="2" x2="11" y2="13"></line>
                        <polygon points="22 2 15 22 11 13 2 9 22 2"></polygon>
                    </svg>
                    Kirim Pengaduan Sekarang
                </button>
            </form>
        </div>

        {{-- Sisi Panduan & Info Kontak --}}
        <div>
            <div class="aside-box">
                <h3>
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="var(--site-red, #a84450)" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                    </svg>
                    Jaminan Kerahasiaan
                </h3>
                <div class="security-note">
                    Identitas pelapor dan seluruh isi aduan dijaga kerahasiaannya serta tidak dipublikasikan ke publik. Hanya tim pengelola sekolah yang berwenang yang dapat meninjau data Anda.
                </div>
            </div>

            <div class="aside-box">
                <h3>
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="var(--site-red, #a84450)" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <rect width="20" height="16" x="2" y="4" rx="2"></rect>
                        <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"></path>
                    </svg>
                    Saluran Alternatif
                </h3>
                <div class="quick-contact-list">
                    <div class="quick-contact-item">
                        <span style="font-weight: 600; min-width: 75px;">Telepon/Fax:</span>
                        <span>024 - 340710</span>
                    </div>
                    <div class="quick-contact-item">
                        <span style="font-weight: 600; min-width: 75px;">Email:</span>
                        <span>sdnegerirejosari03@gmail.com</span>
                    </div>
                    <div class="quick-contact-item">
                        <span style="font-weight: 600; min-width: 75px;">Alamat:</span>
                        <span>Jl. Tirtoyoso VI No. 10, Semarang</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
