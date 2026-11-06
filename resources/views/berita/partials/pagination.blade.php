@if ($paginator->total() > 0)
    <div class="info-pagination">
        <span>Menampilkan {{ $paginator->firstItem() ?? 0 }}–{{ $paginator->lastItem() ?? 0 }} dari {{ $paginator->total() }} {{ $label }}</span>
        @if ($paginator->hasPages())
            <nav aria-label="Halaman {{ $label }}" class="info-pages">
                @if ($paginator->onFirstPage())
                    <span aria-disabled="true">‹ Sebelumnya</span>
                @else
                    <a href="{{ $paginator->previousPageUrl() }}" rel="prev">‹ Sebelumnya</a>
                @endif
                @php $lastShown = 0; @endphp
                @for ($page = 1; $page <= $paginator->lastPage(); $page++)
                    @if ($page === 1 || $page === $paginator->lastPage() || abs($page - $paginator->currentPage()) <= 1)
                        @if ($lastShown > 0 && $page - $lastShown > 1)
                            <span class="info-ellipsis">…</span>
                        @endif
                        @if ($page === $paginator->currentPage())
                            <span aria-current="page" aria-label="Halaman {{ $page }}">{{ $page }}</span>
                        @else
                            <a href="{{ $paginator->url($page) }}" aria-label="Halaman {{ $page }}">{{ $page }}</a>
                        @endif
                        @php $lastShown = $page; @endphp
                    @endif
                @endfor
                @if ($paginator->hasMorePages())
                    <a href="{{ $paginator->nextPageUrl() }}" rel="next">Berikutnya ›</a>
                @else
                    <span aria-disabled="true">Berikutnya ›</span>
                @endif
            </nav>
        @endif
    </div>
@endif
