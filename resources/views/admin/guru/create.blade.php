@extends('layouts.app')

@section('title', 'Tambah Guru')

@section('content')

<h1>Tambah Guru</h1>

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
        action="{{ route('admin.guru.store') }}"
        method="POST"
        enctype="multipart/form-data"
    >

        @csrf


        <p>
            <label>Nama</label><br>

            <input
                type="text"
                name="nama"
                value="{{ old('nama') }}"
                required
            >
        </p>


        <p>
            <label>Jabatan</label><br>

            <input
                type="text"
                name="jabatan"
                value="{{ old('jabatan') }}"
                required
            >
        </p>


        <p>
            <label>Foto</label><br>

            <input
                type="file"
                id="fotoInput"
                accept="image/*"
            >
        </p>


        <div id="fotoInfo" style="display:none; margin-bottom:15px;">
            <strong>Foto siap digunakan.</strong>
        </div>


        <div id="previewContainer" style="display:none;">

            <p>
                <strong>Preview Foto Crop:</strong>
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


        <!-- Foto asli -->
        <input
            type="file"
            id="fotoAwalInput"
            name="foto_awal"
            style="display:none;"
        >


        <!-- Foto hasil crop -->
        <input
            type="file"
            id="fotoCropInput"
            name="foto"
            style="display:none;"
        >


        <p>
            <label>Kata-kata</label><br>

            <textarea
                name="kata_kata"
                rows="4"
            >{{ old('kata_kata') }}</textarea>
        </p>


        <p>
            <label>Urutan</label><br>

            <input
                type="number"
                name="urutan"
                value="{{ old('urutan', 0) }}"
                min="0"
            >
        </p>


        <p>
            <label>Status</label><br>

            <select name="status">

                <option value="aktif">
                    Aktif
                </option>

                <option value="nonaktif">
                    Nonaktif
                </option>

            </select>
        </p>


        <button type="submit">
            Simpan
        </button>

        <a href="{{ route('admin.guru.index') }}">
            Batal
        </a>

    </form>

</div>


<!-- ========================= -->
<!-- CROP MODAL -->
<!-- ========================= -->

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
            Sesuaikan posisi foto dengan area 3:4.
            Foto dapat digeser, diperbesar, diperkecil, atau diputar.
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

            <button type="button" id="zoomOut">
                − Zoom
            </button>

            <button type="button" id="zoomIn">
                + Zoom
            </button>

            <button type="button" id="rotateLeft">
                ↶ Putar
            </button>

            <button type="button" id="rotateRight">
                ↷ Putar
            </button>

        </div>


        <div style="margin-top:20px;">

            <button type="button" id="cancelCrop">
                Batal
            </button>

            <button type="button" id="applyCrop">
                Gunakan Crop
            </button>

        </div>

    </div>

</div>


<!-- Cropper.js -->

<link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.2/cropper.min.css"
>

<script
    src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.2/cropper.min.js">
</script>


<script>

let cropper = null;

const fotoInput = document.getElementById('fotoInput');

const fotoAwalInput = document.getElementById('fotoAwalInput');

const fotoCropInput = document.getElementById('fotoCropInput');

const cropModal = document.getElementById('cropModal');

const cropImage = document.getElementById('cropImage');

const previewFoto = document.getElementById('previewFoto');

const previewContainer = document.getElementById('previewContainer');

const fotoInfo = document.getElementById('fotoInfo');


// ===============================
// PILIH FOTO
// ===============================

fotoInput.addEventListener('change', function () {

    const file = this.files[0];

    if (!file) {
        return;
    }


    // Simpan file asli ke input foto_awal
    const dataTransfer = new DataTransfer();

    dataTransfer.items.add(file);

    fotoAwalInput.files = dataTransfer.files;


    // Tampilkan gambar ke Cropper
    const imageURL = URL.createObjectURL(file);

    cropImage.src = imageURL;

    cropModal.style.display = 'flex';


    cropImage.onload = function () {

        if (cropper) {
            cropper.destroy();
        }


        cropper = new Cropper(cropImage, {

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

            cropBoxResizable: false,

        });

    };

});


// ===============================
// ZOOM
// ===============================

document.getElementById('zoomIn')
    .addEventListener('click', function () {

        if (cropper) {
            cropper.zoom(0.1);
        }

    });


document.getElementById('zoomOut')
    .addEventListener('click', function () {

        if (cropper) {
            cropper.zoom(-0.1);
        }

    });


// ===============================
// ROTATE
// ===============================

document.getElementById('rotateLeft')
    .addEventListener('click', function () {

        if (cropper) {
            cropper.rotate(-1);
        }

    });


document.getElementById('rotateRight')
    .addEventListener('click', function () {

        if (cropper) {
            cropper.rotate(1);
        }

    });


// ===============================
// BATAL
// ===============================

document.getElementById('cancelCrop')
    .addEventListener('click', function () {

        if (cropper) {
            cropper.destroy();
            cropper = null;
        }

        cropModal.style.display = 'none';

    });


// ===============================
// GUNAKAN CROP
// ===============================

document.getElementById('applyCrop')
    .addEventListener('click', function () {

        if (!cropper) {
            return;
        }


        cropper.getCroppedCanvas({

            width: 600,
            height: 800,

            imageSmoothingEnabled: true,

            imageSmoothingQuality: 'high'

        }).toBlob(function (blob) {

            const file = new File(
                [blob],
                'guru_crop.jpg',
                {
                    type: 'image/jpeg'
                }
            );


            // Masukkan hasil crop ke input foto
            const dataTransfer = new DataTransfer();

            dataTransfer.items.add(file);

            fotoCropInput.files = dataTransfer.files;


            // Preview hasil crop
            const previewURL = URL.createObjectURL(blob);

            previewFoto.src = previewURL;

            previewContainer.style.display = 'block';

            fotoInfo.style.display = 'block';


            // Tutup modal
            cropper.destroy();

            cropper = null;

            cropModal.style.display = 'none';

        }, 'image/jpeg', 0.90);

    });


// ===============================
// CEGAH SUBMIT TANPA CROP
// ===============================

document.getElementById('guruForm')
    .addEventListener('submit', function (event) {

        const fotoDipilih = fotoAwalInput.files.length > 0;

        const fotoSudahCrop = fotoCropInput.files.length > 0;


        if (fotoDipilih && !fotoSudahCrop) {

            event.preventDefault();

            alert('Silakan lakukan crop foto terlebih dahulu.');

        }

    });

</script>

@endsection
