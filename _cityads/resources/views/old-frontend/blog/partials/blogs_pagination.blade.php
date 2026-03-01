@if ($blogs->hasPages())
    <nav class="pagination-area style-two">
        <ul class="pagination p-0 align-items-center justify-content-center">

            {{-- Previous Page --}}
            @if ($blogs->onFirstPage())
                <li class="page-item disabled" aria-disabled="true">
                    <span class="page-link d-flex align-items-center justify-content-center shadow-none rounded-circle p-0">
                        <i class="ri-arrow-left-long-line"></i>
                    </span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link d-flex align-items-center justify-content-center shadow-none rounded-circle p-0"
                       href="{{ $blogs->previousPageUrl() }}" rel="prev">
                        <i class="ri-arrow-left-long-line"></i>
                    </a>
                </li>
            @endif

            {{-- Page Numbers --}}
            @foreach ($blogs->getUrlRange(1, $blogs->lastPage()) as $page => $url)
                @if ($page == $blogs->currentPage())
                    <li class="page-item">
                        <a class="page-link active d-flex align-items-center justify-content-center shadow-none rounded-circle p-0"
                           href="javascript:void(0)">
                            {{ $page }}
                        </a>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link d-flex align-items-center justify-content-center shadow-none rounded-circle p-0"
                           href="{{ $url }}">
                            {{ $page }}
                        </a>
                    </li>
                @endif
            @endforeach

            {{-- Next Page --}}
            @if ($blogs->hasMorePages())
                <li class="page-item">
                    <a class="page-link d-flex align-items-center justify-content-center shadow-none rounded-circle p-0"
                       href="{{ $blogs->nextPageUrl() }}" rel="next">
                        <i class="ri-arrow-right-long-line"></i>
                    </a>
                </li>
            @else
                <li class="page-item disabled" aria-disabled="true">
                    <span class="page-link d-flex align-items-center justify-content-center shadow-none rounded-circle p-0">
                        <i class="ri-arrow-right-long-line"></i>
                    </span>
                </li>
            @endif

        </ul>
    </nav>
@endif
