@extends('layouts.app')

@section('title', 'Data Berita')

@section('content')

<h1>Data Berita</h1>

@if (session('success'))
    <div class="card">
        {{ session('success') }}
    </div>
@endif

<div class="card">

    <p>
        <a href="{{ route('admin.berita.create') }}">
            + Tambah Berita
        </a>
    </p>

    <table border="1" cellpadding="8" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>No</th>
                <th>Judul</th>
                <th>Kategori</th>
                <th>Penulis</th>
                <th>Tanggal Publish</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>

            @forelse ($berita as $item)

                <tr>
                    <td>{{ $loop->iteration }}</td>

                    <td>
                        {{ $item->judul }}
                    </td>

                    <td>
                        {{ $item->kategori ?? '-' }}
                    </td>

                    <td>
                        {{ $item->penulis ?? '-' }}
                    </td>

                    <td>
                        {{ $item->tanggal_publish
                            ? $item->tanggal_publish->format('d-m-Y H:i')
                            : '-' }}
                    </td>

                    <td>
                        {{ $item->status }}
                    </td>

                    <td>

                        <a href="{{ route('admin.berita.edit', $item->id) }}">
                            Edit
                        </a>

                        <form
                            action="{{ route('admin.berita.destroy', $item->id) }}"
                            method="POST"
                            style="display:inline;"
                        >
                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                onclick="return confirm('Yakin ingin menghapus berita ini?')"
                            >
                                Hapus
                            </button>

                        </form>

                    </td>
                </tr>

            @empty

                <tr>
                    <td colspan="7">
                        Belum ada berita.
                    </td>
                </tr>

            @endforelse

        </tbody>
    </table>

</div>

@endsection
