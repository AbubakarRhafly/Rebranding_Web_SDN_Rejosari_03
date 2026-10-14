@php
    $isAnnouncement = $jenis === 'pengumuman';
    $gambar = $isAnnouncement ? $item->foto : $item->thumbnail;
    $tanggal = $isAnnouncement ? $item->tanggal_mulai : $item->tanggal_publish;
    $label = $isAnnouncement ? 'Pengumuman' : ($item->kategori ?: 'Berita');
    $teks = trim(html_entity_decode(strip_tags(preg_replace('/<\s*(?:br\s*\/?|\/p|\/div|\/li)\s*>/i', "\n", $item->isi ?? '')), ENT_QUOTES | ENT_HTML5, 'UTF-8'));
@endphp
<article class="info-card">
    <div class="info-card__image">
        @if ($gambar)
            <img src="{{ asset('storage/'.$gambar) }}" alt="{{ $item->judul }}" loading="lazy" width="600" height="400">
        @else
            <div class="info-placeholder" role="img" aria-label="Gambar belum tersedia">
                <svg viewBox="0 0 48 48" width="48" height="48" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true"><rect x="7" y="9" width="34" height="30" rx="5"/><circle cx="17" cy="19" r="3"/><path d="m8 33 10-9 7 6 6-5 10 9"/></svg>
                <span>SDN Rejosari 03</span>
            </div>
        @endif
    </div>
    <div class="info-card__body">
        <div class="info-card__meta">
            <span class="info-tag">{{ $label }}</span>
            @if ($tanggal)
                <time datetime="{{ $tanggal->format('Y-m-d') }}">{{ $tanggal->locale('id')->translatedFormat('d M Y') }}</time>
            @endif
        </div>
        <h3>{{ $item->judul }}</h3>
        <p class="info-excerpt">{{ \Illuminate\Support\Str::limit($teks, 145) }}</p>
        <details class="info-detail">
            <summary>Baca selengkapnya <span aria-hidden="true">↗</span></summary>
            <div class="info-detail__text">{{ $teks !== '' ? $teks : 'Isi belum tersedia.' }}</div>
            @if ($isAnnouncement)
                @if ($item->tanggal_selesai)
                    <p class="info-detail__note">Sampai: {{ $item->tanggal_selesai->locale('id')->translatedFormat('d F Y') }}</p>
                @endif
                @if ($item->lampiran)
                    <a class="info-attachment" href="{{ asset('storage/'.$item->lampiran) }}" target="_blank" rel="noopener">Buka lampiran ↗</a>
                @endif
            @elseif ($item->penulis)
                <p class="info-detail__note">Penulis: {{ $item->penulis }}</p>
            @endif
        </details>
    </div>
</article>
