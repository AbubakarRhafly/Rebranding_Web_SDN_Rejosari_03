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


    <table
        border="1"
        cellpadding="8"
        cellspacing="0"
        width="100%"
    >

        <thead>

            <tr>

                <th>No</th>

                <th>Foto</th>

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


                    {{-- FOTO --}}
                    <td>
                        @if ($item->foto_url)
                            <img
                                src="{{ $item->foto_url }}"
                                alt="{{ $item->judul }}"
                                style="
                                    width: 100px;
                                    height: 70px;
                                    object-fit: cover;
                                    border-radius: 5px;
                                "
                                onerror="this.style.display='none'; if(this.nextElementSibling) this.nextElementSibling.style.display='inline';"
                            >
                            <span style="display:none;color:#94a3b8;font-size:13px;">Tidak ada foto</span>
                        @else
                            <span style="color:#94a3b8;font-size:13px;">Tidak ada foto</span>
                        @endif
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
                        <div class="admin-actions">
                            <a
                                href="{{ route('admin.pengumuman.edit', $item->id) }}"
                                class="btn-action-edit"
                                title="Edit Pengumuman"
                            >
                                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                </svg>
                                Edit
                            </a>

                            <form
                                action="{{ route('admin.pengumuman.destroy', $item->id) }}"
                                method="POST"
                                onsubmit="return confirm('Yakin ingin menghapus pengumuman ini?')"
                            >
                                @csrf
                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="btn-action-delete"
                                    title="Hapus Pengumuman"
                                >
                                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                        <polyline points="3 6 5 6 21 6"></polyline>
                                        <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                        <line x1="10" y1="11" x2="10" y2="17"></line>
                                        <line x1="14" y1="11" x2="14" y2="17"></line>
                                    </svg>
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="7">

                        Belum ada pengumuman.

                    </td>

                </tr>

            @endforelse

        </tbody>

    </table>

</div>

@endsection
