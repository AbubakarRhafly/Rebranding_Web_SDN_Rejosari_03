@extends('layouts.app')

@section('title', 'Edit Galeri')

@section('content')

<h1>Edit Galeri</h1>

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

<form
    id="galleryForm"
    action="{{ route('admin.gallery.update', $gallery->id) }}"
    method="POST"
    enctype="multipart/form-data"
>
    @csrf
    @method('PUT')

    {{-- ================= BAGIAN 1: GALLERY ================= --}}

    <div class="card">

        <h2>Data Galeri</h2>

        <p>
            <label>Judul</label><br>
            <input type="text" name="judul" value="{{ old('judul', $gallery->judul) }}" required>
        </p>

        <p>
            <label>Deskripsi</label><br>
            <textarea name="deskripsi" rows="4">{{ old('deskripsi', $gallery->deskripsi) }}</textarea>
        </p>

        <p>
            <label>Tanggal</label><br>
            <input
                type="date"
                name="tanggal"
                value="{{ old('tanggal', optional($gallery->tanggal)->format('Y-m-d')) }}"
            >
        </p>

        <p>
            <label>Thumbnail (4:3)</label><br>
            <input type="file" id="thumbPick" accept="image/*">
        </p>

        <p>
            <img
                id="thumbPreview"
                src="{{ $gallery->thumbnail ? asset('storage/' . $gallery->thumbnail) : '' }}"
                alt="Thumbnail"
                style="display:{{ $gallery->thumbnail ? 'block' : 'none' }}; width:240px;
                       aspect-ratio:4/3; object-fit:cover; border:1px solid #ddd; border-radius:8px;"
            >
        </p>

        <p>
            <button
                type="button"
                id="thumbRecrop"
                data-src="{{ $gallery->thumbnail_asli
                    ? asset('storage/' . $gallery->thumbnail_asli)
                    : ($gallery->thumbnail ? asset('storage/' . $gallery->thumbnail) : '') }}"                style="display:{{ $gallery->thumbnail ? 'inline-block' : 'none' }};"
            >
                Crop Ulang Thumbnail
            </button>
        </p>

        <input type="file" id="thumbCrop" name="thumbnail" style="display:none;">

        <p>
            <label>Status</label><br>
            <select name="status">
                <option value="aktif" {{ old('status', $gallery->status) == 'aktif' ? 'selected' : '' }}>Aktif</option>
                <option value="nonaktif" {{ old('status', $gallery->status) == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
            </select>
        </p>

    </div>

    {{-- ================= BAGIAN 2: GALLERY FOTO ================= --}}

    <div class="card">

        <h2>Foto Galeri</h2>

        <p>
            <label>Tambah Foto</label><br>
            <input type="file" id="fotoAdd" accept="image/*" multiple>
        </p>

        <div id="fotoList">

            @foreach ($gallery->foto->sortBy('urutan') as $foto)

                <div
                    class="foto-lama"
                    data-id="{{ $foto->id }}"
                    data-src="{{ asset('storage/' . ($foto->foto_asli ?: $foto->foto)) }}"                    style="display:flex; gap:15px; flex-wrap:wrap; align-items:flex-start;
                           padding:10px; margin-bottom:10px; border:1px solid #ddd; border-radius:8px;"
                >

                    <div style="position:relative; width:160px;">
                        <img
                            class="foto-img"
                            src="{{ asset('storage/' . $foto->foto) }}"
                            alt="Foto {{ $foto->id }}"
                            style="width:160px; height:120px; object-fit:contain; background:#eee;
                                   border:1px solid #ddd; border-radius:6px;"
                        >

                        <button
                            type="button"
                            class="btn-hapus"
                            style="position:absolute; top:4px; right:4px; width:24px; height:24px;
                                   line-height:20px; padding:0; border:0; border-radius:50%;
                                   background:#dc2626; color:#fff; font-size:16px; cursor:pointer;"
                        >×</button>
                    </div>

                    <div>
                        <p>
                            <input
                                type="text"
                                name="foto_lama[{{ $foto->id }}][keterangan]"
                                value="{{ $foto->keterangan }}"
                                placeholder="Keterangan"
                            >
                        </p>

                        <p>
                            <input
                                type="number"
                                name="foto_lama[{{ $foto->id }}][urutan]"
                                value="{{ $foto->urutan }}"
                                min="0"
                                style="width:80px;"
                                title="Urutan"
                            >
                        </p>

                        <p>
                            <button type="button" class="btn-recrop">Crop Ulang</button>
                        </p>
                    </div>

                    <input
                        type="file"
                        class="foto-ganti"
                        name="foto_ganti[{{ $foto->id }}]"
                        style="display:none;"
                    >

                </div>

            @endforeach

        </div>

    </div>

    <button type="submit">Simpan Perubahan</button>
    <a href="{{ route('admin.gallery.index') }}">Batal</a>

</form>


{{-- ================= MODAL CROP ================= --}}

<div
    id="cropModal"
    style="display:none; position:fixed; inset:0; background:rgba(0,0,0,.75);
           z-index:9999; align-items:center; justify-content:center; padding:20px;"
>
    <div style="background:#fff; width:100%; max-width:800px; max-height:95vh;
                border-radius:10px; padding:20px; overflow:auto;">

        <h2>Atur Foto</h2>

        <p>
            <label>Rasio:
                <select id="cropRasio">
                    <option value="4:3">4:3</option>
                    <option value="16:9">16:9</option>
                    <option value="3:4">3:4</option>
                    <option value="9:16">9:16</option>
                </select>
            </label>
        </p>

        <div style="width:100%; max-height:60vh; overflow:hidden; background:#eee;">
            <img id="cropImage" alt="Crop" style="display:block; max-width:100%;">
        </div>

        <div style="margin-top:15px;">
            <button type="button" id="cropZoomOut">− Zoom</button>
            <button type="button" id="cropZoomIn">+ Zoom</button>
            <button type="button" id="cropRotL">↶ Putar</button>
            <button type="button" id="cropRotR">↷ Putar</button>
        </div>

        <div style="margin-top:20px;">
            <button type="button" id="cropCancel">Batal</button>
            <button type="button" id="cropApply">Gunakan Crop</button>
        </div>

    </div>
</div>


<link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.2/cropper.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.2/cropper.min.js"></script>

<script>
(function () {
    const $ = (id) => document.getElementById(id);

    const RATIOS = {
        '4:3':  [1200, 900],
        '16:9': [1280, 720],
        '3:4':  [900, 1200],
        '9:16': [720, 1280],
    };

    // =========================================================
    // CROP CORE
    // =========================================================

    const modal     = $('cropModal');
    const cropImage = $('cropImage');
    const cropRasio = $('cropRasio');

    let cropper = null;
    let current = null;

    function ratioValue() {
        const [a, b] = cropRasio.value.split(':').map(Number);
        return a / b;
    }

    function closeModal() {
        if (cropper) { cropper.destroy(); cropper = null; }
        modal.style.display = 'none';
    }

    // opts: { src, ratio, lock, onApply(file, blob, ratio), onCancel() }
    function openCrop(opts) {
        current = opts;

        cropRasio.value = opts.ratio || '4:3';
        cropRasio.disabled = !!opts.lock;

        if (cropper) { cropper.destroy(); cropper = null; }

        cropImage.onload = function () {
            if (cropper) cropper.destroy();

            cropper = new Cropper(cropImage, {
                aspectRatio: ratioValue(),
                viewMode: 1,
                dragMode: 'move',
                autoCropArea: 0.9,
                background: false,
            });
        };

        cropImage.src = opts.src;
        modal.style.display = 'flex';
    }

    cropRasio.addEventListener('change', () => cropper && cropper.setAspectRatio(ratioValue()));
    $('cropZoomIn').onclick  = () => cropper && cropper.zoom(0.1);
    $('cropZoomOut').onclick = () => cropper && cropper.zoom(-0.1);
    $('cropRotL').onclick    = () => cropper && cropper.rotate(-90);
    $('cropRotR').onclick    = () => cropper && cropper.rotate(90);

    $('cropCancel').onclick = function () {
        const opts = current;
        closeModal();
        current = null;
        if (opts && opts.onCancel) opts.onCancel();
    };

    $('cropApply').onclick = function () {
        if (!cropper) return;

        const ratio = cropRasio.value;
        const [w, h] = RATIOS[ratio];

        cropper.getCroppedCanvas({
            width: w,
            height: h,
            imageSmoothingEnabled: true,
            imageSmoothingQuality: 'high',
        }).toBlob(function (blob) {
            const opts = current;
            const file = new File([blob], 'crop.jpg', { type: 'image/jpeg' });

            closeModal();
            current = null;

            if (opts && opts.onApply) opts.onApply(file, blob, ratio);
        }, 'image/jpeg', 0.9);
    };

    function setFile(input, file) {
        const dt = new DataTransfer();
        dt.items.add(file);
        input.files = dt.files;
    }

    // =========================================================
    // BAGIAN 1 — THUMBNAIL (tabel gallery, 4:3)
    // =========================================================

    const thumbPick    = $('thumbPick');
    const thumbCrop    = $('thumbCrop');
    const thumbPreview = $('thumbPreview');
    const thumbRecrop  = $('thumbRecrop');

    let thumbSource = thumbRecrop.dataset.src || null;

    function cropThumb(src, onCancel) {
        openCrop({
            src: src,
            ratio: '4:3',
            lock: true,
            onApply: function (file, blob) {
                setFile(thumbCrop, file);
                thumbPreview.src = URL.createObjectURL(blob);
                thumbPreview.style.display = 'block';
                thumbRecrop.style.display = 'inline-block';
            },
            onCancel: onCancel,
        });
    }

    thumbPick.addEventListener('change', function () {
        const f = this.files[0];
        if (!f) return;

        thumbSource = URL.createObjectURL(f);

        cropThumb(thumbSource, function () {
            thumbPick.value = '';
        });
    });

    thumbRecrop.addEventListener('click', function () {
        if (thumbSource) cropThumb(thumbSource);
    });

    // =========================================================
    // BAGIAN 2 — FOTO (tabel gallery_foto)
    // =========================================================

    const list = $('fotoList');
    const add  = $('fotoAdd');

    const BTN_X =
        'position:absolute;top:4px;right:4px;width:24px;height:24px;line-height:20px;' +
        'padding:0;border:0;border-radius:50%;background:#dc2626;color:#fff;' +
        'font-size:16px;cursor:pointer;';

    // ---- foto lama (dirender server) ----

    list.querySelectorAll('.foto-lama').forEach(function (row) {
        const id    = row.dataset.id;
        const src   = row.dataset.src;
        const img   = row.querySelector('.foto-img');
        const input = row.querySelector('.foto-ganti');

        row.querySelector('.btn-recrop').addEventListener('click', function () {
            openCrop({
                src: src,
                ratio: '4:3',
                onApply: function (file, blob) {
                    setFile(input, file);
                    img.src = URL.createObjectURL(blob);
                },
            });
        });

        row.querySelector('.btn-hapus').addEventListener('click', function () {
            const h = document.createElement('input');
            h.type = 'hidden';
            h.name = 'hapus_foto[]';
            h.value = id;

            row.appendChild(h);
            row.style.display = 'none';
        });
    });

    // ---- foto baru ----

    function addNewRow(originalURL, file, blob, ratio) {
        const row = document.createElement('div');
        row.style.cssText =
            'display:flex;gap:15px;flex-wrap:wrap;align-items:flex-start;' +
            'padding:10px;margin-bottom:10px;border:1px solid #ddd;border-radius:8px;';

        row.innerHTML = `
            <div style="position:relative;width:160px;">
                <img class="foto-img" alt="Foto"
                     style="width:160px;height:120px;object-fit:contain;background:#eee;
                            border:1px solid #ddd;border-radius:6px;">
                <button type="button" class="btn-hapus" style="${BTN_X}">×</button>
            </div>
            <div>
                <p><input type="text" name="keterangan_baru[]" placeholder="Keterangan"></p>
                <p>
                    <input type="number" name="urutan_baru[]" min="0" style="width:80px;"
                           value="${list.children.length}" title="Urutan">
                </p>
                <p><button type="button" class="btn-recrop">Crop Ulang</button></p>
            </div>`;

        const img = row.querySelector('.foto-img');
        img.src = URL.createObjectURL(blob);

        const input = document.createElement('input');
        input.type = 'file';
        input.name = 'foto_baru[]';
        input.style.display = 'none';
        setFile(input, file);
        row.appendChild(input);

        let currentRatio = ratio;

        row.querySelector('.btn-recrop').addEventListener('click', function () {
            openCrop({
                src: originalURL,
                ratio: currentRatio,
                onApply: function (newFile, newBlob, newRatio) {
                    setFile(input, newFile);
                    img.src = URL.createObjectURL(newBlob);
                    currentRatio = newRatio;
                },
            });
        });

        row.querySelector('.btn-hapus').addEventListener('click', function () {
            row.remove();
        });

        list.appendChild(row);
    }

    function processQueue(files) {
        const f = files.shift();
        if (!f) return;

        const url = URL.createObjectURL(f);

        openCrop({
            src: url,
            ratio: '4:3',
            onApply: function (file, blob, ratio) {
                addNewRow(url, file, blob, ratio);
                processQueue(files);
            },
            onCancel: function () {
                URL.revokeObjectURL(url);
                processQueue(files);
            },
        });
    }

    add.addEventListener('change', function () {
        const files = Array.from(this.files);
        this.value = '';
        processQueue(files);
    });
})();
</script>

@endsection
