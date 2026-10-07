@extends('layouts.app')

@section('title', 'Profil Guru dan Staf | SDN Rejosari 03')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/profil-guru.css') }}">

<style>
    .profil-guru {
        color: #202c46;
        font-family: Arial, sans-serif;
        line-height: 1.6;
    }

    .profil-guru__empty {
        padding: 32px 20px;
        border: 1px dashed #d5dae1;
        border-radius: 16px;
        background: #ffffff;
        text-align: center;
        color: #526076;
    }

    .profil-guru__placeholder {
        display: grid;
        place-items: center;
        padding: 20px;
        color: #647084;
        text-align: center;
    }
</style>
@endpush

@section('content')
<main class="profil-guru">
    <header class="profil-guru__intro">
        <p class="profil-guru__label">SDN REJOSARI 03</p>

        <h1>Mengenal Guru dan <span>Staf Kami</span></h1>

        <p class="profil-guru__description">
            Mengenal para pendidik dan tenaga kependidikan
            yang mendampingi kegiatan belajar di SDN Rejosari 03.
        </p>

        <a class="profil-guru__button" href="#daftar-guru">
            Lihat Daftar Guru
            <span aria-hidden="true">↓</span>
        </a>
    </header>

    <section
        class="profil-guru__section"
        id="daftar-guru"
        aria-labelledby="judul-daftar-guru">
        <div class="profil-guru__section-heading">
            <p class="profil-guru__label">
                PENDIDIK DAN TENAGA KEPENDIDIKAN
            </p>

            <h2 id="judul-daftar-guru">Guru dan Staf Sekolah</h2>

            <p>
                Bersama mendampingi siswa dalam belajar dan berkembang.
            </p>
        </div>

        @if ($guru->isEmpty())
        <div class="profil-guru__empty">
            <p>Data guru dan staf belum tersedia.</p>
        </div>
        @else
        <div class="profil-guru__grid">
            @foreach ($guru as $item)
            @php
            $fotoPath = ltrim((string) $item->foto, '/');
            $fotoUrl = null;

            // Foto bawaan proyek berada di public/images/guru.
            if (
            str_starts_with($fotoPath, 'images/guru/')
            && !str_contains($fotoPath, '..')
            && is_file(public_path($fotoPath))
            ) {
            $fotoUrl = asset($fotoPath);
            }
            @endphp

            <article class="profil-guru__card">
                @if ($fotoUrl)
                <img
                    class="profil-guru__photo"
                    src="{{ $fotoUrl }}"
                    alt="Foto {{ $item->nama }}"
                    width="600"
                    height="750"
                    loading="lazy">
                @else
                <div class="profil-guru__photo profil-guru__placeholder">
                    <span>Foto belum tersedia</span>
                </div>
                @endif

                <div class="profil-guru__card-content">
                    <p class="profil-guru__role">
                        {{ $item->jabatan }}
                    </p>

                    <h3>{{ $item->nama }}</h3>

                    <p class="profil-guru__school">
                        SDN Rejosari 03
                    </p>
                </div>
            </article>
            @endforeach
        </div>
        @endif
    </section>
</main>
@endsection