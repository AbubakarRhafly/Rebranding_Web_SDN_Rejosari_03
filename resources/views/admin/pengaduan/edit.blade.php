@extends('layouts.app')

@section('title', 'Periksa & Tindak Lanjuti Pengaduan — SDN Rejosari 03')

@push('styles')
<style>
    .admin-edit-page {
        max-width: 1000px;
        margin: 0 auto;
        color: var(--site-text, #263244);
    }

    .edit-back-nav {
        margin-bottom: 20px;
    }

    .btn-back {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: var(--site-red-dark, #893642);
        font-weight: 600;
        font-size: 14px;
        text-decoration: none;
        transition: transform 0.15s ease;
    }

    .btn-back:hover {
        transform: translateX(-3px);
        text-decoration: underline;
    }

    .edit-header {
        margin-bottom: 24px;
    }

    .edit-header h1 {
        margin: 0 0 6px;
        font-size: clamp(24px, 3vw, 28px);
        color: #1e293b;
    }

    .edit-header p {
        margin: 0;
        color: #64748b;
        font-size: 14px;
    }

    .edit-grid {
        display: grid;
        grid-template-columns: 1.35fr 1fr;
        gap: 24px;
        align-items: start;
    }

    .edit-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 14px;
        padding: 24px 26px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.03);
    }

    .edit-card h2 {
        margin: 0 0 16px;
        font-size: 17px;
        color: #1e293b;
        border-bottom: 1px solid #f1f5f9;
        padding-bottom: 12px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    /* Meta bar */
    .edit-meta-bar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 10px;
        margin-bottom: 18px;
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

    .badge-status {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 700;
    }

    .badge-status--baru { background: #e0f2fe; color: #0369a1; border: 1px solid #bae6fd; }
    .badge-status--diproses { background: #fef3c7; color: #92400e; border: 1px solid #fde68a; }
    .badge-status--selesai { background: #dcfce7; color: #15803d; border: 1px solid #bbf7d0; }
    .status-dot { width: 7px; height: 7px; border-radius: 50%; background: currentColor; }

    /* Judul Pengaduan Section */
    .aduan-judul-box {
        background: #fafbfc;
        border: 1px solid #e2e8f0;
        border-left: 4px solid var(--site-red, #a84450);
        border-radius: 8px;
        padding: 14px 16px;
        margin-bottom: 18px;
    }

    .aduan-field-label {
        display: block;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: #64748b;
        margin-bottom: 4px;
    }

    .aduan-judul-val {
        margin: 0;
        font-size: 17px;
        font-weight: 700;
        color: #1e293b;
        line-height: 1.4;
    }

    /* Pelapor Info */
    .pelapor-info-list {
        display: grid;
        gap: 12px;
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        padding: 14px 16px;
        margin-bottom: 18px;
        font-size: 13.5px;
    }

    .pelapor-row {
        display: flex;
        justify-content: space-between;
        gap: 12px;
    }

    .pelapor-row span.label {
        color: #64748b;
        font-weight: 600;
    }

    .pelapor-row span.val {
        color: #1e293b;
        font-weight: 600;
        text-align: right;
    }

    /* Isi Aduan */
    .isi-aduan-box {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        padding: 14px 16px;
        font-size: 14px;
        line-height: 1.7;
        color: #334155;
        white-space: pre-line;
        margin-bottom: 20px;
    }

    /* Quick response buttons */
    .quick-reply-box {
        background: #fdf8f6;
        border: 1px solid #f9ded7;
        border-radius: 8px;
        padding: 14px 16px;
    }

    .quick-reply-box h3 {
        margin: 0 0 6px;
        font-size: 13.5px;
        color: var(--site-red-dark, #893642);
        font-weight: 700;
    }

    .quick-reply-box p {
        margin: 0 0 12px;
        font-size: 12.5px;
        color: #64748b;
        line-height: 1.5;
    }

    .quick-reply-buttons {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .btn-reply-email {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 9px 14px;
        background: #ea4335;
        color: #ffffff !important;
        border-radius: 7px;
        font-size: 13px;
        font-weight: 600;
        text-decoration: none;
    }

    .btn-reply-wa {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 9px 14px;
        background: #25d366;
        color: #ffffff !important;
        border-radius: 7px;
        font-size: 13px;
        font-weight: 600;
        text-decoration: none;
    }

    /* Form Styles */
    .form-group {
        margin-bottom: 18px;
    }

    .form-label {
        display: block;
        font-size: 13.5px;
        font-weight: 600;
        color: #334155;
        margin-bottom: 6px;
    }

    .form-control {
        width: 100%;
        padding: 10px 12px;
        border: 1.5px solid #cbd5e1;
        border-radius: 8px;
        font-size: 14px;
        font-family: inherit;
        background: #ffffff;
        box-sizing: border-box;
    }

    .form-control:focus {
        border-color: var(--site-red, #a84450);
        outline: none;
        box-shadow: 0 0 0 3px rgba(168, 68, 80, 0.12);
    }

    textarea.form-control {
        min-height: 130px;
        resize: vertical;
        line-height: 1.6;
    }

    .form-hint {
        margin-top: 6px;
        font-size: 12px;
        color: #64748b;
        line-height: 1.4;
    }

    .btn-save {
        width: 100%;
        padding: 11px 18px;
        background: var(--site-red, #a84450);
        color: #ffffff;
        border: none;
        border-radius: 8px;
        font-size: 14.5px;
        font-weight: 700;
        cursor: pointer;
        font-family: inherit;
        transition: background 0.15s ease;
    }

    .btn-save:hover {
        background: var(--site-red-dark, #893642);
    }

    @media (max-width: 820px) {
        .edit-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endpush

@section('content')
<div class="admin-edit-page">
    <div class="edit-back-nav">
        <a href="{{ route('admin.pengaduan.index') }}" class="btn-back">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
            Kembali ke Daftar Pengaduan
        </a>
    </div>

    <div class="edit-header">
        <h1>Periksa & Tindak Lanjuti Pengaduan</h1>
        <p>Tinjau detail pesan pelapor, kirim tanggapan resmi, dan perbarui status penanganan.</p>
    </div>

    @if ($errors->any())
        <div style="background:#fef2f2;border:1px solid #fecaca;border-radius:10px;padding:14px 18px;color:#991b1b;margin-bottom:20px;font-size:13.5px;">
            <ul style="margin:0;padding-left:18px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="edit-grid">
        {{-- Kolom Kiri: Detail Pengaduan --}}
        <div class="edit-card">
            <h2>
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--site-red, #a84450)" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline></svg>
                Detail Pengaduan dari Klien
            </h2>

            {{-- Baris Meta --}}
            <div class="edit-meta-bar">
                <span class="badge-kategori">{{ $pengaduan->kategori_keperluan ?? 'Informasi & Pertanyaan Umum' }}</span>

                <div>
                    @if ($pengaduan->status === 'baru')
                        <span class="badge-status badge-status--baru"><span class="status-dot"></span> Baru</span>
                    @elseif ($pengaduan->status === 'diproses')
                        <span class="badge-status badge-status--diproses"><span class="status-dot"></span> Diproses</span>
                    @else
                        <span class="badge-status badge-status--selesai"><span class="status-dot"></span> Selesai</span>
                    @endif
                </div>
            </div>

            {{-- Judul Pengaduan dengan Label Eksplisit --}}
            <div class="aduan-judul-box">
                <span class="aduan-field-label">Judul Pengaduan:</span>
                <h3 class="aduan-judul-val">{{ $pengaduan->judul }}</h3>
            </div>

            {{-- Data Pelapor --}}
            <div class="pelapor-info-list">
                <div class="pelapor-row">
                    <span class="label">Nama Pelapor:</span>
                    <span class="val">{{ $pengaduan->nama }}</span>
                </div>
                <div class="pelapor-row">
                    <span class="label">Alamat Email:</span>
                    <span class="val"><a href="mailto:{{ $pengaduan->email }}" style="color:var(--site-red-dark);">{{ $pengaduan->email }}</a></span>
                </div>
                <div class="pelapor-row">
                    <span class="label">No. WhatsApp / HP:</span>
                    <span class="val">{{ $pengaduan->no_hp ?? '-' }}</span>
                </div>
                <div class="pelapor-row">
                    <span class="label">Waktu Pengiriman:</span>
                    <span class="val">{{ $pengaduan->created_at->format('d-m-Y H:i') }} WIB</span>
                </div>
            </div>

            {{-- Isi Pengaduan --}}
            <div>
                <span class="aduan-field-label">Isi Pengaduan / Pesan Lengkap:</span>
                <div class="isi-aduan-box">
                    {{ $pengaduan->isi }}
                </div>
            </div>

            {{-- Tombol Balas Cepat --}}
            <div class="quick-reply-box">
                <h3>Kirim Tanggapan ke Pelapor</h3>
                <p>Gunakan saluran di bawah ini untuk mengirimkan tanggapan resmi secara langsung kepada pelapor:</p>
                <div class="quick-reply-buttons">
                    <a href="https://mail.google.com/mail/?view=cm&fs=1&to={{ urlencode($pengaduan->email) }}&su={{ urlencode('Tanggapan Pengaduan: ' . $pengaduan->judul) }}"
                       target="_blank"
                       rel="noopener noreferrer"
                       class="btn-reply-email">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/></svg>
                        Buka Gmail untuk Membalas Email
                    </a>

                    @if ($pengaduan->no_hp)
                        <a href="https://wa.me/{{ preg_replace('/^0/', '62', preg_replace('/[^0-9]/', '', $pengaduan->no_hp)) }}?text={{ urlencode('Halo ' . $pengaduan->nama . ', kami dari pihak SDN Rejosari 03 Semarang ingin menindaklanjuti pengaduan Anda mengenai "' . $pengaduan->judul . '".') }}"
                           target="_blank"
                           rel="noopener noreferrer"
                           class="btn-reply-wa">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981z"/></svg>
                            Hubungi via WhatsApp ({{ $pengaduan->no_hp }})
                        </a>
                    @endif
                </div>
            </div>
        </div>

        {{-- Kolom Kanan: Form Update Status & Catatan --}}
        <div class="edit-card">
            <h2>
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--site-red, #a84450)" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 20h9"></path><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path></svg>
                Pembaruan Status & Catatan
            </h2>

            <form action="{{ route('admin.pengaduan.update', $pengaduan->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="status" class="form-label">Status Pengaduan</label>
                    <select name="status" id="status" class="form-control" required>
                        <option value="baru" {{ old('status', $pengaduan->status) == 'baru' ? 'selected' : '' }}>
                            🔵 Baru (Belum ditindaklanjuti)
                        </option>
                        <option value="diproses" {{ old('status', $pengaduan->status) == 'diproses' ? 'selected' : '' }}>
                            🟡 Diproses (Sedang ditindaklanjuti)
                        </option>
                        <option value="selesai" {{ old('status', $pengaduan->status) == 'selesai' ? 'selected' : '' }}>
                            🟢 Selesai (Sudah tuntas / ditanggapi)
                        </option>
                    </select>
                    <p class="form-hint">Ubah status ini sesuai tahapan penanganan pengaduan.</p>
                </div>

                <div class="form-group">
                    <label for="tanggapan" class="form-label">Catatan Internal Admin (Opsional)</label>
                    <textarea
                        name="tanggapan"
                        id="tanggapan"
                        class="form-control"
                        rows="6"
                        placeholder="Tuliskan dokumentasi penanganan, misalnya: 'Sudah dihubungi via email tanggal 22/10 dan diteruskan ke bagian sarpras'..."
                        maxlength="5000"
                    >{{ old('tanggapan', $pengaduan->tanggapan) }}</textarea>
                    <p class="form-hint">Catatan ini hanya tersimpan di panel admin untuk dokumentasi internal pengelola sekolah.</p>
                </div>

                <button type="submit" class="btn-save">
                    Simpan Perubahan
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
