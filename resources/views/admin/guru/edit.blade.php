@extends('layouts.app')

@section('title', 'Edit Guru — ' . $guru->nama)

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.2/cropper.min.css">
<style>
    .admin-form-container {
        max-width: 900px;
        margin: 0 auto;
        color: var(--site-text, #263244);
    }

    .form-header-box {
        margin-bottom: 24px;
    }

    .form-header-box h1 {
        margin: 0 0 6px;
        font-size: clamp(24px, 3vw, 28px);
        color: #1e293b;
    }

    .form-header-box p {
        margin: 0;
        color: #64748b;
        font-size: 14px;
    }

    .btn-back-link {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        color: var(--site-red-dark, #893642);
        font-weight: 600;
        font-size: 13.5px;
        text-decoration: none;
        margin-bottom: 16px;
        transition: transform 0.15s ease;
    }

    .btn-back-link:hover {
        transform: translateX(-3px);
        text-decoration: underline;
    }

    .form-section-title {
        margin: 28px 0 16px;
        padding-bottom: 10px;
        border-bottom: 1.5px solid #f1f5f9;
        font-size: 17px;
        font-weight: 700;
        color: #1e293b;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    /* Upload & Live Preview Section */
    .upload-zone-box {
        background: #fafbfc;
        border: 1.5px dashed #cbd5e1;
        border-radius: 12px;
        padding: 20px;
        margin-bottom: 20px;
        transition: border-color 0.2s ease;
    }

    .upload-zone-box:hover {
        border-color: var(--site-red, #a84450);
    }

    .upload-action-row {
        display: flex;
        align-items: center;
        gap: 14px;
        flex-wrap: wrap;
    }

    .btn-recrop-old {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 8px 14px;
        background: #ffffff;
        color: var(--site-red-dark, #893642);
        border: 1px solid #cbd5e1;
        border-radius: 7px;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.15s ease;
    }

    .btn-recrop-old:hover {
        background: var(--site-pink, #f5e7e9);
        border-color: var(--site-red, #a84450);
    }

    /* Live Preview Panel */
    .preview-panel {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 20px;
        margin-top: 18px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.04);
    }

    .preview-panel-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        flex-wrap: wrap;
        margin-bottom: 16px;
        padding-bottom: 12px;
        border-bottom: 1px solid #f1f5f9;
    }

    .preview-panel-header h4 {
        margin: 0;
        font-size: 15px;
        color: #1e293b;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .preview-status-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 4px 10px;
        border-radius: 16px;
        font-size: 12px;
        font-weight: 700;
    }

    .preview-status--ready {
        background: #dcfce7;
        color: #15803d;
        border: 1px solid #bbf7d0;
    }

    .preview-status--pending {
        background: #fef3c7;
        color: #92400e;
        border: 1px solid #fde68a;
    }

    .preview-comparison-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 20px;
        align-items: start;
        margin-bottom: 16px;
    }

    .preview-item-box {
        text-align: center;
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        padding: 16px 12px;
    }

    .preview-item-box .item-title {
        display: block;
        font-size: 12.5px;
        font-weight: 700;
        color: #475569;
        margin-bottom: 4px;
    }

    .preview-item-box .item-desc {
        display: block;
        font-size: 11.5px;
        color: #64748b;
        margin-bottom: 12px;
    }

    .preview-img-wrap {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: #ffffff;
        border: 1px solid #cbd5e1;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    }

    .preview-img-wrap img {
        display: block;
        max-width: 100%;
    }

    .preview-actions-bar {
        display: flex;
        align-items: center;
        gap: 10px;
        flex-wrap: wrap;
        padding-top: 14px;
        border-top: 1px solid #f1f5f9;
    }

    .btn-edit-crop {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 8px 14px;
        background: var(--site-red, #a84450);
        color: #ffffff !important;
        border: none;
        border-radius: 7px;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
        transition: background 0.15s ease;
    }

    .btn-edit-crop:hover {
        background: var(--site-red-dark, #893642);
    }

    .btn-cancel-new-photo {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 8px 14px;
        background: #ffffff;
        color: #64748b;
        border: 1px solid #cbd5e1;
        border-radius: 7px;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.15s ease;
    }

    .btn-cancel-new-photo:hover {
        background: #fee2e2;
        color: #b91c1c;
        border-color: #fca5a5;
    }

    /* Modal Styling */
    .crop-modal-overlay {
        position: fixed;
        inset: 0;
        background: rgba(15, 23, 42, 0.8);
        z-index: 9999;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
        backdrop-filter: blur(2px);
    }

    .crop-modal-card {
        background: #ffffff;
        width: 100%;
        max-width: 780px;
        max-height: 94vh;
        border-radius: 14px;
        padding: 24px;
        overflow-y: auto;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.25);
    }

    .crop-modal-header {
        margin-bottom: 16px;
        border-bottom: 1px solid #f1f5f9;
        padding-bottom: 12px;
    }

    .crop-modal-header h3 {
        margin: 0 0 6px;
        font-size: 19px;
        color: #1e293b;
    }

    .crop-modal-header p {
        margin: 0;
        font-size: 13px;
        color: #64748b;
        line-height: 1.5;
    }

    .crop-stage-container {
        width: 100%;
        max-height: 55vh;
        min-height: 320px;
        overflow: hidden;
        background: #1e293b;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .crop-stage-container img {
        display: block;
        max-width: 100%;
    }

    .crop-toolbar {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        margin-top: 14px;
    }

    .btn-tool {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 7px 12px;
        background: #f1f5f9;
        color: #334155;
        border: 1px solid #cbd5e1;
        border-radius: 6px;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
        transition: background 0.15s ease;
    }

    .btn-tool:hover {
        background: #e2e8f0;
    }

    .crop-modal-footer {
        display: flex;
        justify-content: flex-end;
        gap: 10px;
        margin-top: 20px;
        padding-top: 16px;
        border-top: 1px solid #f1f5f9;
    }

    .btn-modal-cancel {
        padding: 10px 18px;
        background: #f1f5f9;
        color: #475569;
        border: 1px solid #cbd5e1;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
    }

    .btn-modal-cancel:hover {
        background: #e2e8f0;
    }

    .btn-modal-apply {
        padding: 10px 22px;
        background: var(--site-red, #a84450);
        color: #ffffff;
        border: none;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 700;
        cursor: pointer;
        transition: background 0.15s ease;
    }

    .btn-modal-apply:hover {
        background: var(--site-red-dark, #893642);
    }
</style>
@endpush

@section('content')
<div class="admin-form-container">
    <a href="{{ route('admin.guru.index') }}" class="btn-back-link">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
        Kembali ke Data Guru
    </a>

    <div class="form-header-box">
        <h1>Edit Data Guru</h1>
        <p>Perbarui profil, jabatan, kata mutiara, dan sesuaikan foto resmi profil guru.</p>
    </div>

    @if ($errors->any())
        <div style="background:#fef2f2;border:1px solid #fecaca;border-radius:10px;padding:14px 18px;color:#991b1b;margin-bottom:20px;font-size:13.5px;">
            <strong>Terjadi kesalahan saat menyimpan:</strong>
            <ul style="margin:8px 0 0;padding-left:18px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card" style="padding:28px;">
        <form id="guruForm" action="{{ route('admin.guru.update', $guru->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- NAMA -->
            <p>
                <label><strong>Nama Lengkap Guru</strong> <span style="color:#e11d48;">*</span></label><br>
                <input type="text" name="nama" value="{{ old('nama', $guru->nama) }}" placeholder="Contoh: SUPARNO, S.Pd.M.Pd" required>
            </p>

            <!-- JABATAN -->
            <p>
                <label><strong>Jabatan / Tugas</strong> <span style="color:#e11d48;">*</span></label><br>
                <input type="text" name="jabatan" value="{{ old('jabatan', $guru->jabatan) }}" placeholder="Contoh: Guru Kelas 1A / Kepala Sekolah" required>
            </p>

            <!-- UPLOAD & PREVIEW FOTO -->
            <div class="form-section-title">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="17 8 12 3 7 8"></polyline><line x1="12" y1="3" x2="12" y2="15"></line></svg>
                Upload / Ganti Foto Guru
            </div>

            <div class="upload-zone-box">
                <label style="display:block;font-size:14px;font-weight:700;color:#334155;margin-bottom:8px;">
                    Pilih File Foto Baru
                </label>
                <div class="upload-action-row">
                    <input type="file" id="fotoInput" accept="image/jpeg,image/png,image/webp" style="margin-top:0;">

                    @if ($guru->foto_awal)
                        <button type="button" id="recropButton" class="btn-recrop-old">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M6 2v14a2 2 0 0 0 2 2h14"></path><path d="M18 22V8a2 2 0 0 0-2-2H2"></path></svg>
                            Crop Ulang dari Foto Awal yang Ada
                        </button>
                    @endif
                </div>
                <small style="display:block;color:#64748b;margin-top:8px;">
                    Mendukung format JPG, PNG, atau WebP (Maksimal 5MB). Jendela pemotong (crop 3:4) akan otomatis terbuka untuk mengatur framing pas foto.
                </small>

                <!-- LIVE PREVIEW CONTAINER -->
                <div id="livePreviewContainer" class="preview-panel" style="display:none;">
                    <div class="preview-panel-header">
                        <h4>
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="var(--site-red, #a84450)" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                            Preview Foto yang Baru Diatur
                        </h4>
                        <span id="cropStatusBadge" class="preview-status-badge preview-status--ready">
                            ✓ Foto Siap Digunakan
                        </span>
                    </div>

                    <div class="preview-comparison-grid">
                        <!-- Preview Foto Asli Dipilih -->
                        <div class="preview-item-box">
                            <span class="item-title">1. Foto Asli yang Dipilih</span>
                            <span class="item-desc">Akan disimpan sebagai arsip resolusi tinggi (foto awal).</span>
                            <div class="preview-img-wrap" style="width:160px;height:213px;">
                                <img id="previewFotoAwal" src="" alt="Preview Foto Asli" style="max-height:100%;object-fit:contain;">
                            </div>
                        </div>

                        <!-- Preview Foto Hasil Crop 3:4 -->
                        <div class="preview-item-box" style="background:#ffffff;border-color:#cbd5e1;box-shadow:0 2px 6px rgba(0,0,0,0.03);">
                            <span class="item-title" style="color:var(--site-red-dark, #893642);">2. Hasil Crop (Tampilan Publik 3:4)</span>
                            <span class="item-desc">Foto berbingkai pas foto ini yang akan tampil di halaman website.</span>
                            <div class="preview-img-wrap" style="width:160px;height:213px;border-color:var(--site-red, #a84450);box-shadow:0 0 0 2px rgba(168,68,80,0.15);">
                                <img id="previewFotoCrop" src="" alt="Preview Hasil Crop" style="width:100%;height:100%;object-fit:cover;">
                            </div>
                        </div>
                    </div>

                    <div class="preview-actions-bar">
                        <button type="button" id="btnReopenCropper" class="btn-edit-crop">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                            Sesuaikan / Crop Ulang Foto Ini
                        </button>
                        <button type="button" id="btnCancelNewPhoto" class="btn-cancel-new-photo">
                            Batal Gunakan Foto Baru Ini
                        </button>
                    </div>
                </div>
            </div>

            <!-- HIDDEN INPUTS UNTUK DIKIRIM KE CONTROLLER -->
            <input type="file" id="fotoAwalInput" name="foto_awal" style="display:none;">
            <input type="file" id="fotoCropInput" name="foto" style="display:none;">

            <!-- KATA-KATA -->
            <p>
                <label><strong>Kata Mutiara / Pesan Edukasi (Opsional)</strong></label><br>
                <textarea name="kata_kata" rows="3" placeholder="Contoh: Belajar adalah jendela menuju masa depan yang cerah.">{{ old('kata_kata', $guru->kata_kata) }}</textarea>
            </p>

            <!-- URUTAN & STATUS -->
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;">
                <p>
                    <label><strong>Urutan Tampilan</strong></label><br>
                    <input type="number" name="urutan" value="{{ old('urutan', $guru->urutan ?? 0) }}" min="0">
                    <small style="display:block;color:#64748b;margin-top:4px;">Urutan kecil tampil lebih dulu (0 = paling awal).</small>
                </p>

                <p>
                    <label><strong>Status</strong></label><br>
                    <select name="status">
                        <option value="aktif" {{ old('status', $guru->status) == 'aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="nonaktif" {{ old('status', $guru->status) == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                    </select>
                </p>
            </div>

            <div style="margin-top:24px;display:flex;align-items:center;gap:12px;">
                <button type="submit" style="padding:12px 24px;font-size:15px;font-weight:700;">
                    Simpan Perubahan
                </button>
                <a href="{{ route('admin.guru.index') }}" style="color:#64748b;text-decoration:none;font-size:14px;padding:10px 16px;">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>

<!-- ================================================= -->
<!-- MODAL CROPPER FOTO (3:4) -->
<!-- ================================================= -->
<div id="cropModal" class="crop-modal-overlay" style="display:none;">
    <div class="crop-modal-card">
        <div class="crop-modal-header">
            <h3>Atur & Potong Foto Guru (Rasio 3:4)</h3>
            <p>Sesuaikan foto agar pas pada area bingkai 3:4. Anda dapat menggeser posisi foto, memperbesar/memperkecil (zoom), atau memutar arah foto.</p>
        </div>

        <div class="crop-stage-container">
            <img id="cropImage" src="" alt="Crop Area">
        </div>

        <div class="crop-toolbar">
            <button type="button" id="zoomOut" class="btn-tool">− Zoom Out</button>
            <button type="button" id="zoomIn" class="btn-tool">+ Zoom In</button>
            <button type="button" id="rotateLeft" class="btn-tool">↶ Putar Kiri</button>
            <button type="button" id="rotateRight" class="btn-tool">↷ Putar Kanan</button>
            <button type="button" id="resetCrop" class="btn-tool">⟲ Reset Posisi</button>
        </div>

        <div class="crop-modal-footer">
            <button type="button" id="cancelCrop" class="btn-modal-cancel">Batal</button>
            <button type="button" id="applyCrop" class="btn-modal-apply">Gunakan Hasil Crop</button>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.2/cropper.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    let cropper = null;
    let currentRawImageSource = null;

    const fotoInput = document.getElementById('fotoInput');
    const fotoAwalInput = document.getElementById('fotoAwalInput');
    const fotoCropInput = document.getElementById('fotoCropInput');

    const cropModal = document.getElementById('cropModal');
    const cropImage = document.getElementById('cropImage');

    const livePreviewContainer = document.getElementById('livePreviewContainer');
    const previewFotoAwal = document.getElementById('previewFotoAwal');
    const previewFotoCrop = document.getElementById('previewFotoCrop');
    const cropStatusBadge = document.getElementById('cropStatusBadge');
    const btnReopenCropper = document.getElementById('btnReopenCropper');
    const btnCancelNewPhoto = document.getElementById('btnCancelNewPhoto');
    const recropButton = document.getElementById('recropButton');

    // =================================================
    // FUNGSI INISIALISASI CROPPER
    // =================================================
    function initCropperInstance() {
        if (cropper) {
            cropper.destroy();
            cropper = null;
        }

        cropper = new Cropper(cropImage, {
            aspectRatio: 3 / 4,
            viewMode: 1,
            dragMode: 'move',
            autoCropArea: 0.95,
            responsive: true,
            background: false,
            zoomable: true,
            movable: true,
            rotatable: true,
            cropBoxMovable: false,
            cropBoxResizable: false
        });
    }

    // =================================================
    // FUNGSI BUKA MODAL CROPPER
    // =================================================
    function openCropper(sourceUrl) {
        if (cropper) {
            cropper.destroy();
            cropper = null;
        }

        cropModal.style.display = 'flex';

        // Pasang listener onload sebelum menetapkan src
        cropImage.onload = function () {
            initCropperInstance();
        };

        cropImage.onerror = function () {
            alert('Gagal memuat gambar. Silakan pastikan file berformat gambar yang valid.');
            cropModal.style.display = 'none';
        };

        cropImage.src = sourceUrl;

        // Jika gambar sudah selesai di-cache di browser
        if (cropImage.complete && cropImage.naturalWidth > 0) {
            initCropperInstance();
        }
    }

    // =================================================
    // EVENT: PILIH FILE FOTO BARU
    // =================================================
    fotoInput.addEventListener('change', function () {
        const file = this.files[0];
        if (!file) return;

        // Baca dengan FileReader agar tidak terjadi bug pencabutan ObjectURL
        const reader = new FileReader();
        reader.onload = function (e) {
            const rawDataUrl = e.target.result;
            currentRawImageSource = rawDataUrl;

            // Simpan foto asli ke input form foto_awal
            const dt = new DataTransfer();
            dt.items.add(file);
            fotoAwalInput.files = dt.files;

            // Tampilkan preview foto asli di panel preview
            previewFotoAwal.src = rawDataUrl;
            livePreviewContainer.style.display = 'block';

            cropStatusBadge.className = 'preview-status-badge preview-status--pending';
            cropStatusBadge.innerHTML = '⚠️ Menunggu Penyesuaian Crop';

            // Langsung buka modal pemotong (cropper)
            openCropper(rawDataUrl);
        };

        reader.readAsDataURL(file);
    });

    // =================================================
    // EVENT: CROP ULANG DARI FOTO AWAL YANG ADA DI SERVER
    // =================================================
    if (recropButton) {
        recropButton.addEventListener('click', function () {
            @if ($guru->foto_awal)
                const existingFotoAwalUrl = "{{ asset('storage/' . $guru->foto_awal) }}";
                currentRawImageSource = existingFotoAwalUrl;
                previewFotoAwal.src = existingFotoAwalUrl;
                livePreviewContainer.style.display = 'block';
                openCropper(existingFotoAwalUrl);
            @endif
        });
    }

    // Tombol buka ulang cropper dari preview panel
    if (btnReopenCropper) {
        btnReopenCropper.addEventListener('click', function () {
            if (currentRawImageSource) {
                openCropper(currentRawImageSource);
            }
        });
    }

    // Tombol batalkan foto baru
    if (btnCancelNewPhoto) {
        btnCancelNewPhoto.addEventListener('click', function () {
            fotoInput.value = '';
            fotoAwalInput.value = '';
            fotoCropInput.value = '';
            currentRawImageSource = null;
            previewFotoAwal.src = '';
            previewFotoCrop.src = '';
            livePreviewContainer.style.display = 'none';
        });
    }

    // =================================================
    // KONTROL ALAT CROPPER
    // =================================================
    document.getElementById('zoomIn').addEventListener('click', function () {
        if (cropper) cropper.zoom(0.1);
    });

    document.getElementById('zoomOut').addEventListener('click', function () {
        if (cropper) cropper.zoom(-0.1);
    });

    document.getElementById('rotateLeft').addEventListener('click', function () {
        if (cropper) cropper.rotate(-90);
    });

    document.getElementById('rotateRight').addEventListener('click', function () {
        if (cropper) cropper.rotate(90);
    });

    document.getElementById('resetCrop').addEventListener('click', function () {
        if (cropper) cropper.reset();
    });

    // =================================================
    // BATAL CROP
    // =================================================
    document.getElementById('cancelCrop').addEventListener('click', function () {
        if (cropper) {
            cropper.destroy();
            cropper = null;
        }
        cropModal.style.display = 'none';
    });

    // =================================================
    // TERAPKAN HASIL CROP
    // =================================================
    document.getElementById('applyCrop').addEventListener('click', function () {
        if (!cropper) return;

        cropper.getCroppedCanvas({
            width: 600,
            height: 800,
            imageSmoothingEnabled: true,
            imageSmoothingQuality: 'high'
        }).toBlob(function (blob) {
            if (!blob) return;

            const croppedFile = new File([blob], 'guru_crop_' + Date.now() + '.jpg', { type: 'image/jpeg' });

            // Masukkan ke input tersembunyi fotoCropInput
            const dt = new DataTransfer();
            dt.items.add(croppedFile);
            fotoCropInput.files = dt.files;

            // Update live preview foto hasil crop
            const croppedUrl = URL.createObjectURL(blob);
            previewFotoCrop.src = croppedUrl;

            cropStatusBadge.className = 'preview-status-badge preview-status--ready';
            cropStatusBadge.innerHTML = '✓ Foto Siap Digunakan (3:4)';

            // Tutup modal
            cropper.destroy();
            cropper = null;
            cropModal.style.display = 'none';
        }, 'image/jpeg', 0.92);
    });

    // =================================================
    // VALIDASI SUBMIT
    // =================================================
    document.getElementById('guruForm').addEventListener('submit', function (event) {
        const adaFotoBaru = fotoAwalInput.files.length > 0;
        const adaCropBaru = fotoCropInput.files.length > 0;

        // Jika upload foto baru, wajib di-crop
        if (adaFotoBaru && !adaCropBaru) {
            event.preventDefault();
            alert('Silakan lakukan penyesuaian crop terlebih dahulu untuk foto baru yang diunggah.');
            if (currentRawImageSource) {
                openCropper(currentRawImageSource);
            }
        }
    });
});
</script>
@endsection
