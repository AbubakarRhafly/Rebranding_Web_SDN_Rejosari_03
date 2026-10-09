@extends('layouts.app')

@section('title', 'Edit Guru')

@section('content')

<h1>Edit Guru</h1>

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
        id="guruForm"
        action="{{ route('admin.guru.update', $guru->id) }}"
        method="POST"
        enctype="multipart/form-data"
    >

        @csrf
        @method('PUT')


        <!-- ========================= -->
        <!-- NAMA -->
        <!-- ========================= -->

        <p>

            <label>Nama</label><br>

            <input
                type="text"
                name="nama"
                value="{{ old('nama', $guru->nama) }}"
                required
            >

        </p>


        <!-- ========================= -->
        <!-- JABATAN -->
        <!-- ========================= -->

        <p>

            <label>Jabatan</label><br>

            <input
                type="text"
                name="jabatan"
                value="{{ old('jabatan', $guru->jabatan) }}"
                required
            >

        </p>


        <!-- ========================= -->
        <!-- FOTO SAAT INI -->
        <!-- ========================= -->

        <hr>

        <h3>Foto Saat Ini</h3>


        <div
            style="
                display:flex;
                gap:30px;
                flex-wrap:wrap;
                margin-bottom:20px;
            "
        >

            <!-- FOTO AWAL -->

            <div>

                <p>
                    <strong>Foto Awal</strong>
                </p>

                @if ($guru->foto_awal)

                    <img
                        src="{{ asset('storage/' . $guru->foto_awal) }}"
                        alt="Foto awal {{ $guru->nama }}"
                        style="
                            width:225px;
                            height:300px;
                            object-fit:contain;
                            background:#eee;
                            border:1px solid #ddd;
                            border-radius:8px;
                        "
                    >

                @else

                    <p>
                        Belum ada foto awal.
                    </p>

                @endif

            </div>


            <!-- FOTO CROP -->

            <div>

                <p>
                    <strong>Foto Crop 1</strong>
                </p>

                @if ($guru->foto)

                    <img
                        src="{{ asset('storage/' . $guru->foto) }}"
                        alt="Foto crop {{ $guru->nama }}"
                        style="
                            width:225px;
                            height:300px;
                            object-fit:cover;
                            background:#eee;
                            border:1px solid #ddd;
                            border-radius:8px;
                        "
                    >

                @else

                    <p>
                        Belum ada foto crop.
                    </p>

                @endif

            </div>

        </div>


        <!-- ========================= -->
        <!-- PILIH FOTO BARU -->
        <!-- ========================= -->

        <p>

            <label>
                <strong>Upload Foto Baru</strong>
            </label>

            <br>

            <input
                type="file"
                id="fotoInput"
                accept="image/*"
            >

        </p>


        <!-- ========================= -->
        <!-- CROP ULANG -->
        <!-- ========================= -->

        @if ($guru->foto_awal)

            <p>

                <button
                    type="button"
                    id="recropButton"
                >
                    Crop Ulang dari Foto Awal
                </button>

            </p>

        @endif


        <div
            id="fotoInfo"
            style="
                display:none;
                margin:15px 0;
                padding:10px;
                background:#e5e7eb;
                border-radius:5px;
            "
        >

            Foto baru berhasil diatur.

        </div>


        <!-- ========================= -->
        <!-- PREVIEW CROP BARU -->
        <!-- ========================= -->

        <div
            id="previewContainer"
            style="display:none;"
        >

            <p>
                <strong>Preview Crop Baru:</strong>
            </p>

            <img
                id="previewFoto"
                src=""
                alt="Preview foto"
                style="
                    width:150px;
                    height:200px;
                    object-fit:cover;
                    border-radius:8px;
                    border:1px solid #ddd;
                "
            >

        </div>


        <!-- ========================= -->
        <!-- INPUT TERSEMBUNYI -->
        <!-- ========================= -->

        <!--
            Hanya akan terisi jika user upload
            foto baru.
        -->
        <input
            type="file"
            id="fotoAwalInput"
            name="foto_awal"
            style="display:none;"
        >


        <!--
            Akan berisi hasil crop baru.
        -->
        <input
            type="file"
            id="fotoCropInput"
            name="foto"
            style="display:none;"
        >


        <!-- ========================= -->
        <!-- KATA-KATA -->
        <!-- ========================= -->

        <p>

            <label>Kata-kata</label><br>

            <textarea
                name="kata_kata"
                rows="4"
            >{{ old('kata_kata', $guru->kata_kata) }}</textarea>

        </p>


        <!-- ========================= -->
        <!-- URUTAN -->
        <!-- ========================= -->

        <p>

            <label>Urutan</label><br>

            <input
                type="number"
                name="urutan"
                value="{{ old('urutan', $guru->urutan) }}"
                min="0"
            >

        </p>


        <!-- ========================= -->
        <!-- STATUS -->
        <!-- ========================= -->

        <p>

            <label>Status</label><br>

            <select name="status">

                <option
                    value="aktif"
                    {{ $guru->status == 'aktif' ? 'selected' : '' }}
                >
                    Aktif
                </option>

                <option
                    value="nonaktif"
                    {{ $guru->status == 'nonaktif' ? 'selected' : '' }}
                >
                    Nonaktif
                </option>

            </select>

        </p>


        <!-- ========================= -->
        <!-- BUTTON -->
        <!-- ========================= -->

        <button type="submit">
            Simpan Perubahan
        </button>

        <a href="{{ route('admin.guru.index') }}">
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

        <h2>Atur Foto</h2>

        <p>
            Sesuaikan foto dengan area 3:4.
            Foto dapat digeser, diperbesar, diperkecil,
            atau diputar.
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


        <!-- ========================= -->
        <!-- CONTROL -->
        <!-- ========================= -->

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


        <!-- ========================= -->
        <!-- ACTION -->
        <!-- ========================= -->

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

let currentObjectURL = null;


const fotoInput =
    document.getElementById('fotoInput');

const fotoAwalInput =
    document.getElementById('fotoAwalInput');

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

const fotoInfo =
    document.getElementById('fotoInfo');


// =================================================
// BUKA CROPPER
// =================================================

function openCropper(imageSource)
{

    if (cropper) {

        cropper.destroy();

        cropper = null;

    }


    if (currentObjectURL) {

        URL.revokeObjectURL(currentObjectURL);

        currentObjectURL = null;

    }


    cropImage.src = imageSource;

    cropModal.style.display = 'flex';


    cropImage.onload = function ()
    {

        cropper = new Cropper(
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


// =================================================
// UPLOAD FOTO BARU
// =================================================

fotoInput.addEventListener(
    'change',
    function ()
    {

        const file = this.files[0];

        if (!file) {
            return;
        }


        // Simpan foto baru sebagai FOTO AWAL

        const dataTransfer =
            new DataTransfer();

        dataTransfer.items.add(file);

        fotoAwalInput.files =
            dataTransfer.files;


        // Buka cropper

        currentObjectURL =
            URL.createObjectURL(file);

        openCropper(currentObjectURL);

    }
);


// =================================================
// CROP ULANG FOTO LAMA
// =================================================

const recropButton =
    document.getElementById('recropButton');


if (recropButton) {

    recropButton.addEventListener(
        'click',
        function ()
        {

            @if ($guru->foto_awal)

                openCropper(
                    "{{ asset('storage/' . $guru->foto_awal) }}"
                );

            @endif

        }
    );

}


// =================================================
// ZOOM IN
// =================================================

document.getElementById('zoomIn')
    .addEventListener(
        'click',
        function ()
        {

            if (cropper) {

                cropper.zoom(0.1);

            }

        }
    );


// =================================================
// ZOOM OUT
// =================================================

document.getElementById('zoomOut')
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
// ROTATE LEFT
// =================================================

document.getElementById('rotateLeft')
    .addEventListener(
        'click',
        function ()
        {

            if (cropper) {

                cropper.rotate(-1);

            }

        }
    );


// =================================================
// ROTATE RIGHT
// =================================================

document.getElementById('rotateRight')
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

document.getElementById('cancelCrop')
    .addEventListener(
        'click',
        function ()
        {

            if (cropper) {

                cropper.destroy();

                cropper = null;

            }


            cropModal.style.display = 'none';


            if (currentObjectURL) {

                URL.revokeObjectURL(currentObjectURL);

                currentObjectURL = null;

            }

        }
    );


// =================================================
// GUNAKAN CROP
// =================================================

document.getElementById('applyCrop')
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
                                'guru_crop.jpg',
                                {
                                    type: 'image/jpeg'
                                }
                            );


                        // =================================
                        // MASUKKAN HASIL CROP
                        // =================================

                        const dataTransfer =
                            new DataTransfer();

                        dataTransfer.items.add(file);

                        fotoCropInput.files =
                            dataTransfer.files;


                        // =================================
                        // PREVIEW
                        // =================================

                        const previewURL =
                            URL.createObjectURL(blob);

                        previewFoto.src =
                            previewURL;

                        previewContainer.style.display =
                            'block';

                        fotoInfo.style.display =
                            'block';


                        // =================================
                        // TUTUP
                        // =================================

                        cropper.destroy();

                        cropper = null;

                        cropModal.style.display =
                            'none';


                        if (currentObjectURL) {

                            URL.revokeObjectURL(
                                currentObjectURL
                            );

                            currentObjectURL = null;

                        }

                    },
                    'image/jpeg',
                    0.90
                );

        }
    );


// =================================================
// SUBMIT
// =================================================

document.getElementById('guruForm')
    .addEventListener(
        'submit',
        function (event)
        {

            const fotoBaru =
                fotoAwalInput.files.length > 0;

            const cropBaru =
                fotoCropInput.files.length > 0;


            /*
             * Jika upload foto baru,
             * wajib memiliki crop baru.
             */

            if (fotoBaru && !cropBaru) {

                event.preventDefault();

                alert(
                    'Silakan lakukan crop foto baru terlebih dahulu.'
                );

                return;

            }

        }
    );

</script>

@endsection
