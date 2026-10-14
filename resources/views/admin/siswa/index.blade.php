@extends('layouts.app')

@section('title', 'Data Siswa')

@section('content')

<h1>Data Siswa</h1>

@if (session('success'))
    <div class="card">
        {{ session('success') }}
    </div>
@endif

<div class="card">
    <p>
        <a href="{{ route('admin.siswa.create') }}">
            + Tambah Siswa
        </a>
    </p>

    <table border="1" cellpadding="8" cellspacing="0" width="100%">

        <thead>

            <tr>

                <th>No</th>

                <th>Foto</th>

                <th>Nama</th>

                <th>Kelas</th>

                <th>Deskripsi</th>

                <th>Status</th>

                <th>Aksi</th>

            </tr>

        </thead>


        <tbody>

            @forelse ($siswa as $item)

                <tr>

                    <td>
                        {{ $loop->iteration }}
                    </td>


                    <td>

                        @if ($item->foto)

                            <img
                                src="{{ asset('storage/' . $item->foto) }}"
                                alt="{{ $item->nama }}"
                                style="
                                    width:75px;
                                    height:100px;
                                    object-fit:cover;
                                    border-radius:5px;
                                "
                            >

                        @else

                            -

                        @endif

                    </td>


                    <td>
                        {{ $item->nama }}
                    </td>


                    <td>
                        {{ $item->kelas }}
                    </td>


                    <td>
                        {{ $item->deskripsi ?? '-' }}
                    </td>


                    <td>
                        {{ $item->status }}
                    </td>


                    <td>

                        <a
                            href="{{ route('admin.siswa.edit', $item->id) }}"
                        >
                            Edit
                        </a>


                        <form
                            action="{{ route('admin.siswa.destroy', $item->id) }}"
                            method="POST"
                            style="display:inline;"
                        >

                            @csrf

                            @method('DELETE')


                            <button
                                type="submit"
                                onclick="return confirm('Yakin ingin menghapus data siswa ini?')"
                            >
                                Hapus
                            </button>

                        </form>

                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="7">

                        Belum ada data siswa.

                    </td>

                </tr>

            @endforelse

        </tbody>

    </table>
</div>

@endsection
