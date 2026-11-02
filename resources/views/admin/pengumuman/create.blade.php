@extends('layouts.app')

@section('title', 'Tambah Pengumuman')

@section('content')

<h1>Tambah Pengumuman</h1>

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
        action="{{ route('admin.pengumuman.store') }}"
        method="POST"
        enctype="multipart/form-data"
    >

        @csrf


        <!-- JUDUL -->

        <p>

            <label>Judul</label><br>

            <input
                type="text"
                name="judul"
                value="{{ old('judul') }}"
                required
            >

        </p>


        <!-- FOTO -->

        <p>

            <label>
                <strong>Foto Pengumuman</strong>
            </label>
            <br>
            <input
                type="file"
                id="fotoInput"
                name="foto"
                accept="image/jpeg,image/png,image/webp"
            >
            <br>
            <small style="color: #64748b;">
                Format gambar: JPG, JPEG, PNG, atau WEBP. Maksimal ukuran file: 5 MB.
            </small>

            <!-- LIVE PREVIEW FOTO BARU -->
            <div id="fotoPreviewBox" style="display: none; margin-top: 14px; padding: 16px; background: #f8fafc; border: 1.5px dashed #3b82f6; border-radius: 10px;">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px; gap: 8px; flex-wrap: wrap;">
                    <div style="display: flex; align-items: center; gap: 8px;">
                        <span style="display: inline-flex; align-items: center; justify-content: center; width: 24px; height: 24px; background: #dbeafe; color: #1d4ed8; border-radius: 50%; font-size: 13px;">👁</span>
                        <strong style="color: #1e293b; font-size: 13.5px;">Preview Foto Pengumuman (Sebelum Disimpan)</strong>
                    </div>
                    <span style="background: #dcfce7; color: #15803d; font-size: 12px; font-weight: 700; padding: 3px 10px; border-radius: 20px; border: 1px solid #bbf7d0;">
                        ✓ Siap Disimpan
                    </span>
                </div>
                <div style="display: flex; gap: 16px; align-items: flex-start; flex-wrap: wrap;">
                    <img id="fotoPreviewImg" src="" alt="Preview Foto" style="max-width: 240px; max-height: 150px; object-fit: cover; border-radius: 6px; border: 1px solid #cbd5e1; box-shadow: 0 2px 6px rgba(0,0,0,0.06); display: block;">
                    <div style="flex: 1; min-width: 200px;">
                        <div style="font-size: 13px; color: #475569; margin-bottom: 8px;">
                            <p style="margin: 0 0 4px;"><strong>Nama File:</strong> <span id="fotoFileName">-</span></p>
                            <p style="margin: 0 0 4px;"><strong>Ukuran:</strong> <span id="fotoFileSize">-</span></p>
                        </div>
                        <p style="margin: 0 0 10px; font-size: 12.5px; color: #64748b; line-height: 1.4;">
                            Pastikan foto sudah sesuai sebelum menekan tombol <strong>Simpan</strong> di bawah.
                        </p>
                        <button type="button" id="btnCancelFoto" style="background: #fff; border: 1px solid #cbd5e1; color: #dc2626; padding: 6px 12px; font-size: 12.5px; font-weight: 600; border-radius: 6px; cursor: pointer;">
                            ✕ Batalkan Pilihan Foto
                        </button>
                    </div>
                </div>
            </div>
        </p>


        <!-- TANGGAL MULAI -->

        <p>

            <label>Tanggal Mulai</label><br>

            <input
                type="date"
                name="tanggal_mulai"
                value="{{ old('tanggal_mulai') }}"
            >

        </p>


        <!-- TANGGAL SELESAI -->

        <p>

            <label>Tanggal Selesai</label><br>

            <input
                type="date"
                name="tanggal_selesai"
                value="{{ old('tanggal_selesai') }}"
            >

        </p>


        <!-- STATUS -->

        <p>

            <label>Status</label><br>

            <select name="status" required>

                <option
                    value="draft"
                    {{ old('status', 'draft') == 'draft' ? 'selected' : '' }}
                >
                    Draft
                </option>

                <option
                    value="published"
                    {{ old('status') == 'published' ? 'selected' : '' }}
                >
                    Published
                </option>

            </select>

        </p>


        <!-- ISI -->

        <p>

            <label>Isi Pengumuman</label><br>

            <textarea
                name="isi"
                rows="10"
                required
            >{{ old('isi') }}</textarea>

        </p>


        <button type="submit">
            Simpan
        </button>


        <a href="{{ route('admin.pengumuman.index') }}">
            Batal
        </a>

    </form>

</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const fotoInput = document.getElementById('fotoInput');
    const previewBox = document.getElementById('fotoPreviewBox');
    const previewImg = document.getElementById('fotoPreviewImg');
    const fileNameEl = document.getElementById('fotoFileName');
    const fileSizeEl = document.getElementById('fotoFileSize');
    const btnCancel = document.getElementById('btnCancelFoto');

    if (!fotoInput || !previewBox || !previewImg) return;

    function formatFileSize(bytes) {
        if (bytes < 1024) return bytes + ' B';
        if (bytes < 1048576) return (bytes / 1024).toFixed(1) + ' KB';
        return (bytes / 1048576).toFixed(2) + ' MB';
    }

    fotoInput.addEventListener('change', function () {
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
            fotoInput.value = '';
            previewImg.src = '';
            previewBox.style.display = 'none';
        });
    }
});
</script>

@endsection
