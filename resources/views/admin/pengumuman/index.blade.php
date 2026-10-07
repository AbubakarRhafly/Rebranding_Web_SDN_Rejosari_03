@extends('layouts.app')

@section('title', 'Data Pengumuman')

@section('content')

<h1>Data Pengumuman</h1>

@if (session('success'))
    <div class="card">
        {{ session('success') }}
    </div>
@endif

<div class="card">

    <p>
        <a href="{{ route('admin.pengumuman.create') }}">
            + Tambah Pengumuman
        </a>
    </p>

    <table border="1" cellpadding="8" cellspacing="0" width="100%">

        <thead>
            <tr>
                <th>No</th>
                <th>Judul</th>
                <th>Tanggal Mulai</th>
                <th>Tanggal Selesai</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>

            @forelse ($pengumuman as $item)

                <tr>

                    <td>
                        {{ $loop->iteration }}
                    </td>

                    <td>
                        {{ $item->judul }}
                    </td>

                    <td>
                        {{ $item->tanggal_mulai
                            ? $item->tanggal_mulai->format('d-m-Y')
                            : '-' }}
                    </td>

                    <td>
                        {{ $item->tanggal_selesai
                            ? $item->tanggal_selesai->format('d-m-Y')
                            : '-' }}
                    </td>

                    <td>
                        {{ $item->status }}
                    </td>

                    <td>

                        <a href="{{ route('admin.pengumuman.edit', $item->id) }}">
                            Edit
                        </a>

                        <form
                            action="{{ route('admin.pengumuman.destroy', $item->id) }}"
                            method="POST"
                            style="display:inline;"
                        >

                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                onclick="return confirm('Yakin ingin menghapus pengumuman ini?')"
                            >
                                Hapus
                            </button>

                        </form>

                    </td>

                </tr>

            @empty

                <tr>
                    <td colspan="6">
                        Belum ada pengumuman.
                    </td>
                </tr>

            @endforelse

        </tbody>

    </table>

</div>

@endsection
