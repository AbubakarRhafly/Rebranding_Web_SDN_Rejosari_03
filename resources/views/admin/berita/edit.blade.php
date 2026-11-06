@extends('layouts.app')

@section('title', 'Edit Berita')

@section('content')

<h1>Edit Berita</h1>

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
        action="{{ route('admin.berita.update', $berita->id) }}"
        method="POST"
        enctype="multipart/form-data"
    >
        @csrf
        @method('PUT')

        <p>
            <label>Judul</label><br>
            <input
                type="text"
                name="judul"
                value="{{ old('judul', $berita->judul) }}"
                required
            >
        </p>

        <p>
            <label>Slug</label><br>
            <input
                type="text"
                name="slug"
                value="{{ old('slug', $berita->slug) }}"
            >
        </p>

        <p>
            <label><strong>Thumbnail Saat Ini</strong></label><br>

            @if ($berita->thumbnail_url)
                <img
                    src="{{ $berita->thumbnail_url }}"
                    alt="{{ $berita->judul }}"
                    style="width:200px;height:130px;object-fit:cover;border-radius:5px;display:block;margin-bottom:8px;"
                    onerror="this.style.display='none'; if(this.nextElementSibling) this.nextElementSibling.style.display='none'; if(this.nextElementSibling && this.nextElementSibling.nextElementSibling) this.nextElementSibling.nextElementSibling.style.display='inline';"
                >
                <label style="font-weight:normal;color:#dc2626;cursor:pointer;display:inline-flex;align-items:center;gap:6px;font-size:13.5px;margin-bottom:6px;">
                    <input type="checkbox" name="hapus_thumbnail" value="1">
                    <span>Hapus thumbnail saat ini</span>
                </label>
                <span style="display:none;color:#64748b;font-size:13.5px;">Belum ada thumbnail.</span>
            @else
                <span style="color:#64748b;font-size:13.5px;">Belum ada thumbnail.</span>
            @endif
        </p>

        <p>
            <label><strong>Ganti Thumbnail</strong></label><br>
            <input
                type="file"
                id="thumbnailInput"
                name="thumbnail"
                accept="image/jpeg,image/png,image/webp"
            >
            <br>
            <small style="color: #64748b;">
                Kosongkan jika tidak ingin mengganti thumbnail.
                Format JPG, JPEG, PNG, WEBP. Maksimal 5 MB.
            </small>

            <!-- LIVE PREVIEW THUMBNAIL BARU -->
            <div id="thumbnailPreviewBox" style="display: none; margin-top: 14px; padding: 16px; background: #f8fafc; border: 1.5px dashed #3b82f6; border-radius: 10px;">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px; gap: 8px; flex-wrap: wrap;">
                    <div style="display: flex; align-items: center; gap: 8px;">
                        <span style="display: inline-flex; align-items: center; justify-content: center; width: 24px; height: 24px; background: #dbeafe; color: #1d4ed8; border-radius: 50%; font-size: 13px;">👁</span>
                        <strong style="color: #1e293b; font-size: 13.5px;">Preview Thumbnail Baru (Akan Disimpan)</strong>
                    </div>
                    <span style="background: #dcfce7; color: #15803d; font-size: 12px; font-weight: 700; padding: 3px 10px; border-radius: 20px; border: 1px solid #bbf7d0;">
                        ✓ Siap Disimpan
                    </span>
                </div>
                <div style="display: flex; gap: 16px; align-items: flex-start; flex-wrap: wrap;">
                    <img id="thumbnailPreviewImg" src="" alt="Preview Thumbnail Baru" style="max-width: 240px; max-height: 150px; object-fit: cover; border-radius: 6px; border: 1px solid #cbd5e1; box-shadow: 0 2px 6px rgba(0,0,0,0.06); display: block;">
                    <div style="flex: 1; min-width: 200px;">
                        <div style="font-size: 13px; color: #475569; margin-bottom: 8px;">
                            <p style="margin: 0 0 4px;"><strong>Nama File:</strong> <span id="thumbnailFileName">-</span></p>
                            <p style="margin: 0 0 4px;"><strong>Ukuran:</strong> <span id="thumbnailFileSize">-</span></p>
                        </div>
                        <p style="margin: 0 0 10px; font-size: 12.5px; color: #64748b; line-height: 1.4;">
                            Thumbnail di atas akan aktif dan disimpan saat Anda menekan tombol <strong>Simpan Perubahan</strong> di bawah.
                        </p>
                        <button type="button" id="btnCancelThumbnail" style="background: #fff; border: 1px solid #cbd5e1; color: #dc2626; padding: 6px 12px; font-size: 12.5px; font-weight: 600; border-radius: 6px; cursor: pointer;">
                            ✕ Batalkan Pilihan Thumbnail Baru
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
                value="{{ old('kategori', $berita->kategori) }}"
            >
        </p>

        <p>
            <label>Penulis</label><br>
            <input
                type="text"
                name="penulis"
                value="{{ old('penulis', $berita->penulis) }}"
            >
        </p>

        <p>
            <label>Tanggal Publish</label><br>
            <input
                type="datetime-local"
                name="tanggal_publish"
                value="{{ old(
                    'tanggal_publish',
                    $berita->tanggal_publish
                        ? $berita->tanggal_publish->format('Y-m-d\TH:i')
                        : ''
                ) }}"
            >
        </p>

        <p>
            <label>Status</label><br>
            <select name="status" required>
                <option value="draft"
                    {{ old('status', $berita->status) == 'draft' ? 'selected' : '' }}>
                    Draft
                </option>
                <option value="published"
                    {{ old('status', $berita->status) == 'published' ? 'selected' : '' }}>
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
            >{{ old('isi', $berita->isi) }}</textarea>
        </p>

        <button type="submit">Simpan Perubahan</button>

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
