@extends('layouts.app')

@section('title', 'Data Gallery')

@section('content')

<h1>Data Gallery</h1>

@if (session('success'))
    <div class="card">
        {{ session('success') }}
    </div>
@endif

<div class="card">

    <p>
        <a href="{{ route('admin.gallery.create') }}">
            + Tambah Gallery
        </a>
    </p>

    <table border="1" cellpadding="8" cellspacing="0" width="100%">

        <thead>
            <tr>
                <th>No</th>
                <th>Judul</th>
                <th>Tanggal</th>
                <th>Jumlah Foto</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>

            @forelse ($gallery as $item)

                <tr>

                    <td>
                        {{ $loop->iteration }}
                    </td>

                    <td>
                        {{ $item->judul }}
                    </td>

                    <td>
                        {{ $item->tanggal
                            ? $item->tanggal->format('d-m-Y')
                            : '-' }}
                    </td>

                    <td>
                        {{ $item->foto->count() }}
                    </td>

                    <td>
                        {{ $item->status }}
                    </td>

                    <td>

                        <a href="{{ route('admin.gallery.edit', $item->id) }}">
                            Edit
                        </a>

                        <form
                            action="{{ route('admin.gallery.destroy', $item->id) }}"
                            method="POST"
                            style="display:inline;"
                        >

                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                onclick="return confirm('Yakin ingin menghapus gallery ini?')"
                            >
                                Hapus
                            </button>

                        </form>

                    </td>

                </tr>

            @empty

                <tr>
                    <td colspan="6">
                        Belum ada gallery.
                    </td>
                </tr>

            @endforelse

        </tbody>

    </table>

</div>

@endsection
