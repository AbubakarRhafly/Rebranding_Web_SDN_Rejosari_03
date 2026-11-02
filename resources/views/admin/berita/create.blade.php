@extends('layouts.app')

@section('title', 'Tambah Berita')

@section('content')

<h1>Tambah Berita</h1>

@if ($errors->any())
    <div class="card">
        <strong>Terjadi kesalahan:</strong>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="card">

    <form
        action="{{ route('admin.berita.store') }}"
        method="POST"
        enctype="multipart/form-data"
    >
        @csrf

        <p>
            <label>Judul</label><br>
            <input
                type="text"
                name="judul"
                value="{{ old('judul') }}"
                required
            >
        </p>

        <p>
            <label>Slug</label><br>
            <input
                type="text"
                name="slug"
                value="{{ old('slug') }}"
                placeholder="Kosongkan untuk dibuat otomatis"
            >
        </p>

        <p>
            <label>Thumbnail Berita</label><br>
            <input
                type="file"
                id="thumbnailInput"
                name="thumbnail"
                accept="image/jpeg,image/png,image/webp"
            >
            <br>
            <small style="color: #64748b;">Format JPG, JPEG, PNG, WEBP. Maksimal 5 MB.</small>

            <!-- LIVE PREVIEW THUMBNAIL BARU -->
            <div id="thumbnailPreviewBox" style="display: none; margin-top: 14px; padding: 16px; background: #f8fafc; border: 1.5px dashed #3b82f6; border-radius: 10px;">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px; gap: 8px; flex-wrap: wrap;">
                    <div style="display: flex; align-items: center; gap: 8px;">
                        <span style="display: inline-flex; align-items: center; justify-content: center; width: 24px; height: 24px; background: #dbeafe; color: #1d4ed8; border-radius: 50%; font-size: 13px;">👁</span>
                        <strong style="color: #1e293b; font-size: 13.5px;">Preview Thumbnail Berita (Sebelum Disimpan)</strong>
                    </div>
                    <span style="background: #dcfce7; color: #15803d; font-size: 12px; font-weight: 700; padding: 3px 10px; border-radius: 20px; border: 1px solid #bbf7d0;">
                        ✓ Siap Disimpan
                    </span>
                </div>
                <div style="display: flex; gap: 16px; align-items: flex-start; flex-wrap: wrap;">
                    <img id="thumbnailPreviewImg" src="" alt="Preview Thumbnail" style="max-width: 240px; max-height: 150px; object-fit: cover; border-radius: 6px; border: 1px solid #cbd5e1; box-shadow: 0 2px 6px rgba(0,0,0,0.06); display: block;">
                    <div style="flex: 1; min-width: 200px;">
                        <div style="font-size: 13px; color: #475569; margin-bottom: 8px;">
                            <p style="margin: 0 0 4px;"><strong>Nama File:</strong> <span id="thumbnailFileName">-</span></p>
                            <p style="margin: 0 0 4px;"><strong>Ukuran:</strong> <span id="thumbnailFileSize">-</span></p>
                        </div>
                        <p style="margin: 0 0 10px; font-size: 12.5px; color: #64748b; line-height: 1.4;">
                            Pastikan gambar sudah sesuai sebelum menekan tombol <strong>Simpan</strong> di bawah.
                        </p>
                        <button type="button" id="btnCancelThumbnail" style="background: #fff; border: 1px solid #cbd5e1; color: #dc2626; padding: 6px 12px; font-size: 12.5px; font-weight: 600; border-radius: 6px; cursor: pointer;">
                            ✕ Batalkan Pilihan Thumbnail
                        </button>
                    </div>
                </div>
            </div>
        </p>

        <p>
            <label>Kategori</label><br>
            <input
                type="text"
                name="kategori"
                value="{{ old('kategori') }}"
                placeholder="Contoh: Sekolah"
            >
        </p>

        <p>
            <label>Penulis</label><br>
            <input
                type="text"
                name="penulis"
                value="{{ old('penulis') }}"
            >
        </p>

        <p>
            <label>Tanggal Publish</label><br>
            <input
                type="datetime-local"
                name="tanggal_publish"
                value="{{ old('tanggal_publish') }}"
            >
        </p>

        <p>
            <label>Status</label><br>
            <select name="status" required>
                <option value="draft"
                    {{ old('status', 'draft') == 'draft' ? 'selected' : '' }}>
                    Draft
                </option>
                <option value="published"
                    {{ old('status') == 'published' ? 'selected' : '' }}>
                    Published
                </option>
            </select>
        </p>

        <p>
            <label>Isi Berita</label><br>
            <textarea
                name="isi"
                rows="10"
                required
            >{{ old('isi') }}</textarea>
        </p>

        <button type="submit">Simpan</button>

        <a href="{{ route('admin.berita.index') }}">Batal</a>
    </form>

</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const thumbInput = document.getElementById('thumbnailInput');
    const previewBox = document.getElementById('thumbnailPreviewBox');
    const previewImg = document.getElementById('thumbnailPreviewImg');
    const fileNameEl = document.getElementById('thumbnailFileName');
    const fileSizeEl = document.getElementById('thumbnailFileSize');
    const btnCancel = document.getElementById('btnCancelThumbnail');

    if (!thumbInput || !previewBox || !previewImg) return;

    function formatFileSize(bytes) {
        if (bytes < 1024) return bytes + ' B';
        if (bytes < 1048576) return (bytes / 1024).toFixed(1) + ' KB';
        return (bytes / 1048576).toFixed(2) + ' MB';
    }

    thumbInput.addEventListener('change', function () {
        const file = this.files && this.files[0];
        if (!file) {
            previewBox.style.display = 'none';
            previewImg.src = '';
            return;
        }

        if (!file.type.match(/^image\//)) {
            alert('File yang dipilih bukan gambar. Silakan pilih file gambar JPG, PNG, atau WEBP.');
            this.value = '';
            previewBox.style.display = 'none';
            return;
        }

        if (file.size > 5 * 1024 * 1024) {
            alert('Ukuran file terlalu besar (' + formatFileSize(file.size) + '). Maksimal ukuran file adalah 5 MB.');
            this.value = '';
            previewBox.style.display = 'none';
            return;
        }

        const reader = new FileReader();
        reader.onload = function (e) {
            previewImg.src = e.target.result;
            fileNameEl.textContent = file.name;
            fileSizeEl.textContent = formatFileSize(file.size);
            previewBox.style.display = 'block';
        };
        reader.readAsDataURL(file);
    });

    if (btnCancel) {
        btnCancel.addEventListener('click', function () {
            thumbInput.value = '';
            previewImg.src = '';
            previewBox.style.display = 'none';
        });
    }
});
</script>

@endsection
