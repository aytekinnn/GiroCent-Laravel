@if ($paginator->hasPages())
    <ul>
        {{-- Önceki Sayfa Butonu --}}
        @if ($paginator->onFirstPage())
            <li class="prev disabled"><span><i class="fas fa-long-arrow-alt-left"></i> Önceki</span></li>
        @else
            <li class="prev"><a href="{{ $paginator->previousPageUrl() }}"><i class="fas fa-long-arrow-alt-left"></i> Önceki</a></li>
        @endif

        {{-- Sayfa Numaraları --}}
        @foreach ($elements as $element)
            @if (is_string($element))
                <li><span>{{ $element }}</span></li>
            @endif

            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="active"><span>{{ $page }}</span></li>
                    @else
                        <li><a href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Sonraki Sayfa Butonu --}}
        @if ($paginator->hasMorePages())
            <li class="next"><a href="{{ $paginator->nextPageUrl() }}">Sonraki <i class="fas fa-long-arrow-alt-right"></i></a></li>
        @else
            <li class="next disabled"><span>Sonraki <i class="fas fa-long-arrow-alt-right"></i></span></li>
        @endif
    </ul>
@endif
