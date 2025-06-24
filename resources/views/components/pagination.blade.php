@if ($paginator->hasPages())
    <nav class="flex justify-center mt-6">
        <ul class="flex items-center space-x-2 text-sm">

            @if ($paginator->onFirstPage())
                <li>
                    <span class="px-3 py-1 bg-gray-300 text-white rounded-lg cursor-not-allowed">«</span>
                </li>
            @else
                <li>
                    <a href="{{ $paginator->previousPageUrl() }}"
                        class="px-3 py-1 bg-white hover:bg-lime-200 border border-gray-300 rounded-lg transition-all duration-300">«</a>
                </li>
            @endif

            {{-- Nomor Halaman --}}
            @foreach ($elements as $element)
                {{-- Tanda “...” --}}
                @if (is_string($element))
                    <li><span class="px-3 py-1 text-gray-500">{{ $element }}</span></li>
                @endif

                {{-- Link ke Halaman --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li>
                                <span
                                    class="px-3 py-1 bg-lime-500 text-white rounded-lg font-semibold">{{ $page }}</span>
                            </li>
                        @else
                            <li>
                                <a href="{{ $url }}"
                                    class="px-3 py-1 bg-white hover:bg-lime-100 border border-gray-300 rounded-lg transition-all duration-300">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            
            @if ($paginator->hasMorePages())
                <li>
                    <a href="{{ $paginator->nextPageUrl() }}"
                        class="px-3 py-1 bg-white hover:bg-lime-200 border border-gray-300 rounded-lg transition-all duration-300">»</a>
                </li>
            @else
                <li>
                    <span class="px-3 py-1 bg-gray-300 text-white rounded-lg cursor-not-allowed">»</span>
                </li>
            @endif
        </ul>
    </nav>
@endif
