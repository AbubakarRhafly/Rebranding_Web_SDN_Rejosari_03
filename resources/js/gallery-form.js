(function () {
    const $ = (id) => document.getElementById(id);

    const RATIOS = {
        '4:3':  [1200, 900],
        '16:9': [1280, 720],
        '3:4':  [900, 1200],
        '9:16': [720, 1280],
    };

    // =========================================================
    // MODAL CROP (dibuat oleh JS)
    // =========================================================

    const modal = document.createElement('div');
    modal.style.cssText =
        'display:none;position:fixed;inset:0;background:rgba(0,0,0,.75);' +
        'z-index:9999;align-items:center;justify-content:center;padding:20px;';

    modal.innerHTML = `
        <div style="background:#fff;width:100%;max-width:800px;max-height:95vh;
                    border-radius:10px;padding:20px;overflow:auto;">
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

            <div style="width:100%;max-height:60vh;overflow:hidden;background:#eee;">
                <img id="cropImage" alt="Crop" style="display:block;max-width:100%;">
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
        </div>`;

    document.body.appendChild(modal);

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

    function clearFile(input) {
        input.value = '';
    }

    // =========================================================
    // BAGIAN 1 — THUMBNAIL (tabel gallery, rasio 4:3)
    // =========================================================

    const thumbPick    = $('thumbPick');
    const thumbCrop    = $('thumbCrop');
    const thumbPreview = $('thumbPreview');
    const thumbRecrop  = $('thumbRecrop');

    // Input file tersembunyi untuk foto asli (name="thumbnail_asli").
    // Dibuat otomatis jika belum ada di Blade.
    let thumbAsli = $('thumbAsli');

    if (!thumbAsli) {
        thumbAsli = document.createElement('input');
        thumbAsli.type = 'file';
        thumbAsli.id = 'thumbAsli';
        thumbAsli.name = 'thumbnail_asli';
        thumbAsli.style.display = 'none';
        thumbCrop.insertAdjacentElement('afterend', thumbAsli);
    }

    let thumbSource = thumbRecrop.dataset.src || null;

    function cropThumb(src, originalFile, onCancel) {
        openCrop({
            src: src,
            ratio: '4:3',
            lock: true,
            onApply: function (file, blob) {
                setFile(thumbCrop, file);

                // Foto asli hanya dikirim jika user memilih file baru.
                // Crop ulang dari thumbnail server tidak menyentuh thumbnail_asli.
                if (originalFile) setFile(thumbAsli, originalFile);

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

        const url = URL.createObjectURL(f);
        thumbSource = url;

        cropThumb(url, f, function () {
            thumbPick.value = '';
        });
    });

    thumbRecrop.addEventListener('click', function () {
        if (!thumbSource) return;

        // Jika sumbernya file yang baru dipilih, pakai ulang file asli itu.
        const original = thumbPick.files[0] || null;
        cropThumb(thumbSource, original);
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
    // foto_asli foto lama tidak disentuh (sesuai controller).

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
    // Setiap baris selalu mengirim 4 field berpasangan:
    // foto_baru[], foto_asli_baru[], keterangan_baru[], urutan_baru[]
    // sehingga indeks array di PHP tetap sejajar walau ada baris yang dihapus.

    function addNewRow(originalURL, originalFile, file, blob, ratio) {
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
                <p>
                    <input type="text" name="keterangan_baru[]" placeholder="Keterangan">
                </p>
                <p>
                    <input type="number" name="urutan_baru[]" min="0" style="width:80px;"
                           value="${list.children.length}" title="Urutan">
                </p>
                <p>
                    <button type="button" class="btn-recrop">Crop Ulang</button>
                </p>
            </div>`;

        const img = row.querySelector('.foto-img');
        img.src = URL.createObjectURL(blob);

        // Hasil crop
        const input = document.createElement('input');
        input.type = 'file';
        input.name = 'foto_baru[]';
        input.style.display = 'none';
        setFile(input, file);
        row.appendChild(input);

        // Foto asli (tidak berubah saat crop ulang)
        const inputAsli = document.createElement('input');
        inputAsli.type = 'file';
        inputAsli.name = 'foto_asli_baru[]';
        inputAsli.style.display = 'none';
        setFile(inputAsli, originalFile);
        row.appendChild(inputAsli);

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
            row.remove(); // belum tersimpan, cukup dibuang dari form
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
                addNewRow(url, f, file, blob, ratio);
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
