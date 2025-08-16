@if ($paginator->hasPages())
    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center">

            {{-- Tombol First --}}
            @if (!$paginator->onFirstPage())
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->url(1) }}">First</a>
                </li>
            @endif

            {{-- Tombol Previous --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled"><span class="page-link">«</span></li>
            @else
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev">«</a>
                </li>
            @endif

            {{-- Nomor Halaman --}}
            @foreach ($elements as $element)
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active">
                                <span class="page-link">{{ $page }}</span>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Tombol Next --}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next">»</a>
                </li>
            @else
                <li class="page-item disabled"><span class="page-link">»</span></li>
            @endif

            {{-- Tombol Last --}}
            @if ($paginator->currentPage() != $paginator->lastPage())
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->url($paginator->lastPage()) }}">Last</a>
                </li>
            @endif
        </ul>
    </nav>
@endif
