@if ($paginator->hasPages())
    <nav class="pagination is-centered">

        <a class="pagination-previous" {{ $paginator->onFirstPage() ? 'disabled' : 'href=' . $paginator->previousPageUrl() . ' rel=prev' }}>
			<i class="fas fa-chevron-left"></i>
		</a>
		
        <a class="pagination-next" {{ $paginator->hasMorePages() ? 'href=' . $paginator->nextPageUrl() . ' rel=next' : 'disabled' }}>
			<i class="fas fa-chevron-right"></i>
		</a>
		
        <ul class="pagination-list">
            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li><span class="pagination-ellipsis"><span>{{ $element }}</span></span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li><a class="pagination-link is-current">{{ $page }}</a></li>
                        @else
                            <li><a href="{{ $url }}" class="pagination-link">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach
        </ul>
    </nav>
@endif