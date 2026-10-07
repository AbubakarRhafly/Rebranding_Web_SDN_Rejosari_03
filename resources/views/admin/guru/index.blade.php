@extends('layouts.app')

@section('title', 'Admin - Guru')

@section('content')

<h1>Data Guru</h1>

@if (session('success'))
    <div class="card">
        {{ session('success') }}
    </div>
@endif

<p>
    <a href="{{ route('admin.guru.create') }}">
        + Tambah Guru
    </a>
</p>

<div class="card">

    @forelse ($guru as $item)

        <div style="border-bottom: 1px solid #ddd; padding: 15px 0;">

            <h2>{{ $item->nama }}</h2>

            <p>
                <strong>Jabatan:</strong>
                {{ $item->jabatan }}
            </p>

            <p>
                <strong>Kata-kata:</strong>
                {{ $item->kata_kata ?? '-' }}
            </p>

            <p>
                <strong>Urutan:</strong>
                {{ $item->urutan }}
            </p>

            <p>
                <strong>Status:</strong>
                {{ $item->status }}
            </p>

            <a href="{{ route('admin.guru.edit', $item->id) }}">
                Edit
            </a>

            <form
                action="{{ route('admin.guru.destroy', $item->id) }}"
                method="POST"
                style="display: inline;"
            >

                @csrf
                @method('DELETE')

                <button type="submit">
                    Hapus
                </button>

            </form>

        </div>

    @empty

        <p>Belum ada data guru.</p>

    @endforelse

</div>

@endsection
