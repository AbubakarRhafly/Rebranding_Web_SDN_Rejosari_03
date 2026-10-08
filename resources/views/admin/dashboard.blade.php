@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')

<h1>Dashboard Admin</h1>

<div class="card">

    <h2>Selamat datang</h2>

    <p>
        Anda login sebagai:
        <strong>{{ auth()->user()->name }}</strong>
    </p>

    <p>
        Silakan pilih menu untuk mengelola website.
    </p>

</div>

<div class="card">

    <h2>Menu Pengelolaan</h2>

    <ul>
        <li>
            <a href="{{ route('admin.guru.index') }}">
                Kelola Guru
            </a>
        </li>

        <li>
            <a href="{{ route('admin.siswa.index') }}">
                Kelola Siswa
            </a>
        </li>

        <li>
            <a href="{{ route('admin.berita.index') }}">
                Kelola Berita
            </a>
        </li>

        <li>
            <a href="{{ route('admin.pengumuman.index') }}">
                Kelola Pengumuman
            </a>
        </li>

        <li>
            <a href="{{ route('admin.gallery.index') }}">
                Kelola Gallery
            </a>
        </li>

        <li>
            <a href="{{ route('admin.kegiatan-lomba.index') }}">
                Kelola Kegiatan Lomba
            </a>
        </li>

        <li>
            <a href="{{ route('admin.pengaduan.index') }}">
                Kelola Pengaduan
            </a>
        </li>
    </ul>

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
