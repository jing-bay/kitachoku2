<style>
    .p-pagination {
        width: 250px;
        margin: 0 auto;
        padding-bottom: 5px
    }

    .p-pagination__inner {
        display: flex;
        justify-content: space-between;
    }

    .p-pagination__previous {
        text-align: center;
    }

    .p-pagination__next {
        text-align: center;
    }

    .p-pagination__previous-arrow {
        width: 20px;
    }

    .p-pagination__next-arrow {
        width: 20px;
    }

    .p-pagination__page {
        display: flex;
        justify-content: space-around;
    }

    .p-pagination__num {
        font-size: 24px;
    }

    .current-page {
        color: #87c957;
    }
</style>


@if ($paginator->hasPages())
    <nav class="p-pagination">
        <ul class="p-pagination__inner">
            <!-- 前へ移動ボタン -->
            @if ($paginator->onFirstPage())
            <li class="p-pagination__previous">
                <img src="{{ asset('images/arrow-previous.jpg') }}" class="p-pagination__previous-arrow" alt="前へ">
            </li>
            @else
            <li class="p-pagination__previous">
                <a href="{{ $paginator->previousPageUrl() }}">
                    <img src="{{ asset('images/arrow-previous.jpg') }}" class="p-pagination__previous-arrow" alt="前へ">
                </a>
            </li>
            @endif

            <!-- ページ番号　-->
            <div class="p-pagination__page">
                @foreach ($elements as $element)
                @if (is_string($element))
                <li class="p-pagination__num">
                    {{ $element }}
                </li>
                @endif

                @if (is_array($element))
                @foreach ($element as $page => $url)
                @if ($page == $paginator->currentPage())
                <li class="p-pagination__num current-page">
                    {{ $page }}
                </li>
                @else
                <li class="p-pagination__num">
                    <a href="{{ $url }}">{{ $page }}</a>
                </li>
                @endif
                @endforeach
                @endif
                @endforeach
            </div>

            <!-- 次へ移動ボタン -->
            @if ($paginator->hasMorePages())
            <li class="p-pagination__next">
                <a href="{{ $paginator->nextPageUrl() }}">
                    <img src="{{ asset('images/arrow-next.jpg') }}" class="p-pagination__next-arrow" alt="次へ">
                </a>
            </li>
            @else
            <li class="p-pagination__next">
                <img src="{{ asset('images/arrow-next.jpg') }}" class="p-pagination__next-arrow" alt="次へ">
            </li>
            @endif
        </ul>
    </nav>
@endif 