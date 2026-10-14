
@extends('layouts.app')

@section('title', 'Form Pengaduan')

@section('content')

<h1>Form Pengaduan</h1>

@if (session('success'))
    <div class="card">
        {{ session('success') }}
        <p>Pengaduan Anda akan diperiksa oleh pihak sekolah.</p>
        <p>Jika tindak lanjut diperlukan, admin akan menghubungi Anda melalui email.</p>
    </div>
@endif

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
    <p>
        Sampaikan pengaduan, kritik, atau masukan kepada pihak sekolah.
        Data dan isi pengaduan tidak ditampilkan secara publik.
    </p>

    <form action="{{ route('pengaduan.store') }}" method="POST">
        @csrf

        <p>
            <label for="nama">Nama</label><br>
            <input
                id="nama"
                type="text"
                name="nama"
                value="{{ old('nama') }}"
                maxlength="150"
                required
            >
        </p>

        <p>
            <label for="email">Email Aktif</label><br>
            <input
                id="email"
                type="email"
                name="email"
                value="{{ old('email') }}"
                maxlength="150"
                required
            >
            <small>Email digunakan admin untuk menghubungi Anda secara pribadi.</small>
        </p>

        <p>
            <label for="no_hp">Nomor HP (Opsional)</label><br>
            <input
                id="no_hp"
                type="text"
                name="no_hp"
                value="{{ old('no_hp') }}"
                maxlength="30"
            >
        </p>

        <p>
            <label for="judul">Judul Pengaduan</label><br>
            <input
                id="judul"
                type="text"
                name="judul"
                value="{{ old('judul') }}"
                maxlength="255"
                required
            >
        </p>

        <p>
            <label for="isi">Isi Pengaduan</label><br>
            <textarea
                id="isi"
                name="isi"
                rows="7"
                maxlength="5000"
                required
            >{{ old('isi') }}</textarea>
        </p>

        <button type="submit">Kirim Pengaduan</button>
    </form>
</div>

@endsection
