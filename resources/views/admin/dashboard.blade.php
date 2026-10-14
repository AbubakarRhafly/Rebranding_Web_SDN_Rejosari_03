@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')

<h1>Dashboard Admin</h1>

<div class="card">

    <h2>Selamat Datang</h2>

    <p>
        Anda login sebagai:
        <strong>{{ auth()->user()->name }}</strong>
    </p>

    <p>
        Gunakan dashboard ini untuk mengelola konten website
        SDN Rejosari 03 Semarang.
    </p>

</div>

<h2>Statistik Website</h2>

<div class="card">
    <h3>Guru</h3>
    <p>{{ $jumlahGuru }}</p>

    <a href="{{ route('admin.guru.index') }}">
        Kelola Guru
    </a>
</div>

<div class="card">
    <h3>Siswa</h3>
    <p>{{ $jumlahSiswa }}</p>

    <a href="{{ route('admin.siswa.index') }}">
        Kelola Siswa
    </a>
</div>

<div class="card">
    <h3>Berita</h3>
    <p>{{ $jumlahBerita }}</p>

    <a href="{{ route('admin.berita.index') }}">
        Kelola Berita
    </a>
</div>

<div class="card">
    <h3>Pengumuman</h3>
    <p>{{ $jumlahPengumuman }}</p>

    <a href="{{ route('admin.pengumuman.index') }}">
        Kelola Pengumuman
    </a>
</div>

<div class="card">
    <h3>Gallery</h3>
    <p>{{ $jumlahGallery }}</p>

    <a href="{{ route('admin.gallery.index') }}">
        Kelola Gallery
    </a>
</div>

<div class="card">
    <h3>Kegiatan & Lomba</h3>
    <p>{{ $jumlahKegiatan }}</p>

    <a href="{{ route('admin.kegiatan-lomba.index') }}">
        Kelola Kegiatan & Lomba
    </a>
</div>

<div class="card">
    <h3>Pengaduan</h3>
    <p>{{ $jumlahPengaduan }}</p>

    <a href="{{ route('admin.pengaduan.index') }}">
        Kelola Pengaduan
    </a>
</div>

<div class="card">

    <form action="{{ route('logout') }}" method="POST">
        @csrf

        <button type="submit">
            Logout
        </button>
    </form>

</div>

@endsection
