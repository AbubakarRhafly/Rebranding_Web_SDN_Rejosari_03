
@extends('layouts.app')

@section('title', 'Admin - Pengaduan')

@section('content')

<h1>Data Pengaduan</h1>

@if (session('success'))
    <div class="card">
        {{ session('success') }}
    </div>
@endif

@if ($pengaduan->isEmpty())
    <div class="card">
        Belum ada pengaduan.
    </div>
@else
    @foreach ($pengaduan as $item)
        <div class="card">
            <h2>{{ $item->judul }}</h2>

            <p><strong>Tanggal:</strong>
                {{ $item->created_at->format('d-m-Y H:i') }}
            </p>

            <p><strong>Nama:</strong> {{ $item->nama }}</p>
            <p><strong>Email:</strong> {{ $item->email }}</p>
            <p><strong>No. HP:</strong> {{ $item->no_hp ?? '-' }}</p>
            <p><strong>Kategori Keperluan:</strong> {{ $item->kategori_keperluan ?? 'Umum' }}</p>

            <p>
                <strong>Isi Pengaduan:</strong><br>
                {{ $item->isi }}
            </p>

            <p>
                <strong>Status:</strong>
                {{ ucfirst($item->status) }}
            </p>

            @if ($item->tanggapan)
                <p>
                    <strong>Catatan Internal Admin:</strong><br>
                    {{ $item->tanggapan }}
                </p>
            @endif

            <a href="{{ route('admin.pengaduan.edit', $item->id) }}">
                Periksa / Ubah Status
            </a>

            <form
                action="{{ route('admin.pengaduan.destroy', $item->id) }}"
                method="POST"
                style="display:inline"
                onsubmit="return confirm('Yakin ingin menghapus pengaduan ini?')"
            >
                @csrf
                @method('DELETE')

                <button type="submit">Hapus</button>
            </form>
        </div>
    @endforeach
@endif

@endsection
