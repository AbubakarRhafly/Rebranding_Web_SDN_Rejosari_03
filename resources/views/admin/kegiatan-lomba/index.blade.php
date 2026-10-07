@extends('layouts.app')

@section('title', 'Data Kegiatan Lomba')

@section('content')

<h1>Data Kegiatan Lomba</h1>

@if (session('success'))
    <div class="card">
        {{ session('success') }}
    </div>
@endif

<div class="card">

    <p>
        <a href="{{ route('admin.kegiatan-lomba.create') }}">
            + Tambah Kegiatan Lomba
        </a>
    </p>

    <table border="1" cellpadding="8" cellspacing="0" width="100%">

        <thead>
            <tr>
                <th>No</th>
                <th>Kategori</th>
                <th>Judul</th>
                <th>Peserta</th>
                <th>Kelas</th>
                <th>Tingkat</th>
                <th>Hasil</th>
                <th>Tanggal</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>

            @forelse ($kegiatan as $item)

                <tr>

                    <td>
                        {{ $loop->iteration }}
                    </td>

                    <td>
                        {{ $item->kategori }}
                    </td>

                    <td>
                        {{ $item->judul }}
                    </td>

                    <td>
                        {{ $item->nama_peserta ?? '-' }}
                    </td>

                    <td>
                        {{ $item->kelas ?? '-' }}
                    </td>

                    <td>
                        {{ $item->tingkat ?? '-' }}
                    </td>

                    <td>
                        {{ $item->hasil ?? '-' }}
                    </td>

                    <td>
                        {{ $item->tanggal
                            ? $item->tanggal->format('d-m-Y')
                            : '-' }}
                    </td>

                    <td>

                        <a href="{{ route('admin.kegiatan-lomba.edit', $item->id) }}">
                            Edit
                        </a>

                        <form
                            action="{{ route('admin.kegiatan-lomba.destroy', $item->id) }}"
                            method="POST"
                            style="display:inline;"
                        >

                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                onclick="return confirm('Yakin ingin menghapus kegiatan ini?')"
                            >
                                Hapus
                            </button>

                        </form>

                    </td>

                </tr>

            @empty

                <tr>
                    <td colspan="9">
                        Belum ada data kegiatan lomba.
                    </td>
                </tr>

            @endforelse

        </tbody>

    </table>

</div>

@endsection
