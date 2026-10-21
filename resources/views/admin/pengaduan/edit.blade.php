
@extends('layouts.app')

@section('title', 'Periksa Pengaduan')

@section('content')

<h1>Periksa Pengaduan</h1>

@if ($errors->any())
    <div class="card">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="card">
    <p><strong>Nama:</strong> {{ $pengaduan->nama }}</p>
    <p><strong>Email:</strong> {{ $pengaduan->email }}</p>
    <p><strong>No. HP:</strong> {{ $pengaduan->no_hp ?? '-' }}</p>
    <p><strong>Kategori Keperluan:</strong> {{ $pengaduan->kategori_keperluan ?? 'Umum' }}</p>
    <p><strong>Judul:</strong> {{ $pengaduan->judul }}</p>
    <p><strong>Isi Pengaduan:</strong><br>{{ $pengaduan->isi }}</p>
    <p><strong>Dikirim:</strong> {{ $pengaduan->created_at->format('d-m-Y H:i') }}</p>

    <hr>

    <p>
        <strong>Tindak lanjut:</strong>
        Kirim balasan secara manual melalui Gmail ke alamat email pelapor.
    </p>

    <p>
        <a href="https://mail.google.com/mail/?view=cm&fs=1&to={{ urlencode($pengaduan->email) }}"
           target="_blank"
           rel="noopener noreferrer">
            Buka Gmail untuk Membalas
        </a>
    </p>

    <form
        action="{{ route('admin.pengaduan.update', $pengaduan->id) }}"
        method="POST"
    >
        @csrf
        @method('PUT')

        <p>
            <label for="status">Status Pengaduan</label><br>
            <select name="status" id="status" required>
                <option value="baru"
                    {{ old('status', $pengaduan->status) == 'baru' ? 'selected' : '' }}>
                    Baru
                </option>

                <option value="diproses"
                    {{ old('status', $pengaduan->status) == 'diproses' ? 'selected' : '' }}>
                    Diproses
                </option>

                <option value="selesai"
                    {{ old('status', $pengaduan->status) == 'selesai' ? 'selected' : '' }}>
                    Selesai
                </option>
            </select>
        </p>

        <p>
            <label for="tanggapan">Catatan Internal Admin (Opsional)</label><br>
            <textarea
                name="tanggapan"
                id="tanggapan"
                rows="5"
                maxlength="5000"
            >{{ old('tanggapan', $pengaduan->tanggapan) }}</textarea>
            <small>Catatan ini hanya untuk dokumentasi internal, bukan balasan email otomatis.</small>
        </p>

        <button type="submit">Simpan Perubahan</button>
    </form>
</div>

@endsection
