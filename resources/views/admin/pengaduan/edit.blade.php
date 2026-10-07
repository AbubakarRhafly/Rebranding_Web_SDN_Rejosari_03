@extends('layouts.app')

@section('title', 'Edit Pengaduan')

@section('content')

<h1>Edit Pengaduan</h1>

<div class="card">

    <p>
        <strong>Nama:</strong>
        {{ $pengaduan->nama }}
    </p>

    <p>
        <strong>Judul:</strong>
        {{ $pengaduan->judul }}
    </p>

    <p>
        <strong>Isi:</strong><br>
        {{ $pengaduan->isi }}
    </p>

    <form
        action="{{ route('admin.pengaduan.update', $pengaduan->id) }}"
        method="POST"
    >

        @csrf
        @method('PUT')

        <p>
            <label>Status</label><br>

            <select name="status">

                <option value="baru"
                    {{ $pengaduan->status == 'baru' ? 'selected' : '' }}>
                    Baru
                </option>

                <option value="diproses"
                    {{ $pengaduan->status == 'diproses' ? 'selected' : '' }}>
                    Diproses
                </option>

                <option value="selesai"
                    {{ $pengaduan->status == 'selesai' ? 'selected' : '' }}>
                    Selesai
                </option>

            </select>
        </p>

        <p>
            <label>Tanggapan</label><br>

            <textarea
                name="tanggapan"
                rows="7"
            >{{ old('tanggapan', $pengaduan->tanggapan) }}</textarea>
        </p>

        <button type="submit">
            Simpan Perubahan
        </button>

    </form>

</div>

@endsection
