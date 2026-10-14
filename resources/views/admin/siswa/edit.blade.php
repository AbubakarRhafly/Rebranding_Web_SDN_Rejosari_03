@extends('layouts.app')

@section('title', 'Edit Siswa')

@section('content')

<h1>Edit Siswa</h1>

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
        id="siswaForm"
        action="{{ route('admin.siswa.update', $siswa->id) }}"
        method="POST"
        enctype="multipart/form-data"
    >

        @csrf
        @method('PUT')


        <p>

            <label>Nama</label><br>

            <input
                type="text"
                name="nama"
                value="{{ old('nama', $siswa->nama) }}"
                required
            >

        </p>


        <p>

            <label>Kelas</label><br>

            <input
                type="text"
                name="kelas"
                value="{{ old('kelas', $siswa->kelas) }}"
                required
            >

        </p>


        <!-- =============================== -->
        <!-- FOTO SAAT INI -->
        <!-- =============================== -->

        <p>

            <label>
                <strong>Foto Saat Ini</strong>
            </label>

            <br>


            @if ($siswa->foto)

                <img
                    src="{{ asset('storage/' . $siswa->foto) }}"
                    alt="{{ $siswa->nama }}"
                    style="
                        width:150px;
                        height:200px;
                        object-fit:cover;
                        border-radius:8px;
                        border:1px solid #ddd;
                    "
                >

            @else

                <span>
                    Belum ada foto.
                </span>

            @endif

        </p>


        <!-- =============================== -->
        <!-- GANTI FOTO -->
        <!-- =============================== -->

        <p>

            <label>
                <strong>Ganti Foto</strong>
            </label>

            <br>

            <input
                type="file"
                id="fotoInput"
                accept="image/*"
            >

        </p>


        <!-- Input foto yang dikirim -->

        <input
            type="file"
            id="fotoCropInput"
            name="foto"
            style="display:none;"
        >


        <!-- Preview foto baru -->

        <div
            id="previewContainer"
            style="display:none; margin-bottom:20px;"
        >

            <p>
                <strong>Preview Foto Baru:</strong>
            </p>

            <img
                id="previewFoto"
                src=""
                alt="Preview"
                style="
                    width:150px;
                    height:200px;
                    object-fit:cover;
                    border-radius:8px;
                    border:1px solid #ddd;
                "
            >

        </div>


        <!-- =============================== -->
        <!-- DESKRIPSI -->
        <!-- =============================== -->

        <p>

            <label>Deskripsi</label><br>

            <textarea
                name="deskripsi"
                rows="5"
            >{{ old('deskripsi', $siswa->deskripsi) }}</textarea>

        </p>


        <!-- =============================== -->
        <!-- STATUS -->
        <!-- =============================== -->

        <p>

            <label>Status</label><br>

            <select name="status" required>

                <option
                    value="aktif"
                    {{ old('status', $siswa->status) == 'aktif' ? 'selected' : '' }}
                >
                    Aktif
                </option>

                <option
                    value="nonaktif"
                    {{ old('status', $siswa->status) == 'nonaktif' ? 'selected' : '' }}
                >
                    Nonaktif
                </option>

            </select>

        </p>


        <button type="submit">
            Simpan Perubahan
        </button>

        <a href="{{ route('admin.siswa.index') }}">
            Batal
        </a>

    </form>

</div>


<!-- ================================================= -->
<!-- CROP MODAL -->
<!-- ================================================= -->

<div
    id="cropModal"
    style="
        display:none;
        position:fixed;
        inset:0;
        background:rgba(0,0,0,0.75);
        z-index:9999;
        align-items:center;
        justify-content:center;
        padding:20px;
    "
>

    <div
        style="
            background:white;
            width:100%;
            max-width:800px;
            max-height:95vh;
            border-radius:10px;
            padding:20px;
            overflow:auto;
        "
    >

        <h2>Atur Foto Siswa</h2>

        <p>
            Sesuaikan foto dengan area 3:4.
        </p>


        <div
            style="
                width:100%;
                max-height:60vh;
                overflow:hidden;
                background:#eee;
            "
        >

            <img
                id="cropImage"
                src=""
                alt="Crop"
                style="
                    display:block;
                    max-width:100%;
                "
            >

        </div>


        <div style="margin-top:15px;">

            <button
                type="button"
                id="zoomOut"
            >
                − Zoom
            </button>


            <button
                type="button"
                id="zoomIn"
            >
                + Zoom
            </button>


            <button
                type="button"
                id="rotateLeft"
            >
                ↶ Putar
            </button>


            <button
                type="button"
                id="rotateRight"
            >
                ↷ Putar
            </button>

        </div>


        <div style="margin-top:20px;">

            <button
                type="button"
                id="cancelCrop"
            >
                Batal
            </button>


            <button
                type="button"
                id="applyCrop"
            >
                Gunakan Crop
            </button>

        </div>

    </div>

</div>


<!-- ================================================= -->
<!-- CROPPER JS -->
<!-- ================================================= -->

<link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.2/cropper.min.css"
>


<script
    src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.2/cropper.min.js">
</script>


<script>

let cropper = null;


const fotoInput =
    document.getElementById('fotoInput');

const fotoCropInput =
    document.getElementById('fotoCropInput');

const cropModal =
    document.getElementById('cropModal');

const cropImage =
    document.getElementById('cropImage');

const previewFoto =
    document.getElementById('previewFoto');

const previewContainer =
    document.getElementById('previewContainer');


// =================================================
// BUKA CROPPER
// =================================================

fotoInput.addEventListener(
    'change',
    function ()
    {

        const file = this.files[0];

        if (!file) {
            return;
        }


        const objectURL =
            URL.createObjectURL(file);


        cropImage.src =
            objectURL;


        cropModal.style.display =
            'flex';


        cropImage.onload =
            function ()
            {

                if (cropper) {

                    cropper.destroy();

                }


                cropper =
                    new Cropper(
                        cropImage,
                        {

                            aspectRatio: 3 / 4,

                            viewMode: 1,

                            dragMode: 'move',

                            autoCropArea: 0.9,

                            responsive: true,

                            background: false,

                            zoomable: true,

                            movable: true,

                            rotatable: true,

                            cropBoxMovable: false,

                            cropBoxResizable: false

                        }
                    );

            };

    }
);


// =================================================
// ZOOM
// =================================================

document
    .getElementById('zoomIn')
    .addEventListener(
        'click',
        function ()
        {

            if (cropper) {

                cropper.zoom(0.1);

            }

        }
    );


document
    .getElementById('zoomOut')
    .addEventListener(
        'click',
        function ()
        {

            if (cropper) {

                cropper.zoom(-0.1);

            }

        }
    );


// =================================================
// ROTATE
// =================================================

document
    .getElementById('rotateLeft')
    .addEventListener(
        'click',
        function ()
        {

            if (cropper) {

                cropper.rotate(-1);

            }

        }
    );


document
    .getElementById('rotateRight')
    .addEventListener(
        'click',
        function ()
        {

            if (cropper) {

                cropper.rotate(1);

            }

        }
    );


// =================================================
// BATAL
// =================================================

document
    .getElementById('cancelCrop')
    .addEventListener(
        'click',
        function ()
        {

            if (cropper) {

                cropper.destroy();

                cropper = null;

            }


            cropModal.style.display =
                'none';

        }
    );


// =================================================
// GUNAKAN CROP
// =================================================

document
    .getElementById('applyCrop')
    .addEventListener(
        'click',
        function ()
        {

            if (!cropper) {
                return;
            }


            cropper
                .getCroppedCanvas(
                    {

                        width: 600,

                        height: 800,

                        imageSmoothingEnabled: true,

                        imageSmoothingQuality: 'high'

                    }
                )
                .toBlob(
                    function (blob)
                    {

                        const file =
                            new File(
                                [blob],
                                'siswa_crop.jpg',
                                {
                                    type: 'image/jpeg'
                                }
                            );


                        const dataTransfer =
                            new DataTransfer();

                        dataTransfer.items.add(file);


                        fotoCropInput.files =
                            dataTransfer.files;


                        // Preview

                        previewFoto.src =
                            URL.createObjectURL(blob);


                        previewContainer.style.display =
                            'block';


                        // Tutup

                        cropper.destroy();

                        cropper = null;

                        cropModal.style.display =
                            'none';

                    },
                    'image/jpeg',
                    0.90
                );

        }
    );


// =================================================
// SUBMIT
// =================================================

document
    .getElementById('siswaForm')
    .addEventListener(
        'submit',
        function (event)
        {

            const fotoDipilih =
                fotoInput.files.length > 0;

            const fotoSudahCrop =
                fotoCropInput.files.length > 0;


            if (
                fotoDipilih &&
                !fotoSudahCrop
            ) {

                event.preventDefault();

                alert(
                    'Silakan lakukan crop foto terlebih dahulu.'
                );

            }

        }
    );

</script>

@endsection
