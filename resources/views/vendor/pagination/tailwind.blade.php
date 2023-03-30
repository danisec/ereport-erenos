@if ($paginator->hasPages())
    <nav class="flex items-center justify-between" role="navigation" aria-label="{{ __('Pagination Navigation') }}">
        <div class="flex flex-1 justify-between sm:hidden">
            @if ($paginator->onFirstPage())
                <span
                    class="relative inline-flex cursor-default items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium leading-5 text-gray-500">
                    {!! __('pagination.previous') !!}
                </span>
            @else
                <a class="relative inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium leading-5 text-gray-700 ring-gray-300 transition duration-150 ease-in-out hover:text-gray-500 focus:border-blue-300 focus:outline-none focus:ring active:bg-gray-100 active:text-gray-700"
                    href="{{ $paginator->previousPageUrl() }}">
                    {!! __('pagination.previous') !!}
                </a>
            @endif

            @if ($paginator->hasMorePages())
                <a class="relative ml-3 inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium leading-5 text-gray-700 ring-gray-300 transition duration-150 ease-in-out hover:text-gray-500 focus:border-blue-300 focus:outline-none focus:ring active:bg-gray-100 active:text-gray-700"
                    href="{{ $paginator->nextPageUrl() }}">
                    {!! __('pagination.next') !!}
                </a>
            @else
                <span
                    class="relative ml-3 inline-flex cursor-default items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium leading-5 text-gray-500">
                    {!! __('pagination.next') !!}
                </span>
            @endif
        </div>

        <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-center">
            <div>
                <span class="relative z-0 inline-flex rounded-md shadow-sm">
                    {{-- Previous Page Link --}}
                    @if ($paginator->onFirstPage())
                        <span aria-disabled="true" aria-label="{{ __('pagination.previous') }}">
                            <span
                                class="relative inline-flex cursor-default items-center rounded-l-md border border-gray-300 bg-indigo-900 px-2 py-2 text-sm font-medium leading-5 text-gray-500"
                                aria-hidden="true">
                                <svg class="h-5 w-5" fill="transparent" viewBox="0 0 15 14"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <<path
                                        d="M7.5 1.16668C4.27834 1.16668 1.66667 3.77835 1.66667 7.00001C1.66667 10.2217 4.27834 12.8333 7.5 12.8333C10.7217 12.8333 13.3333 10.2217 13.3333 7.00001C13.3333 3.77835 10.7217 1.16668 7.5 1.16668Z"
                                        stroke="white" stroke-width="0.875" stroke-miterlimit="10"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M8.235 4.94084L6.18166 7.00001L8.235 9.05917" stroke="white"
                                        stroke-width="0.875" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </span>
                        </span>
                    @else
                        <a class="relative inline-flex items-center rounded-l-md border border-gray-300 bg-indigo-900 px-2 py-2 text-sm font-medium leading-5 text-white ring-gray-300 transition duration-150 ease-in-out hover:text-gray-400 focus:z-10 focus:border-blue-300 focus:outline-none focus:ring active:bg-indigo-900 active:text-gray-500"
                            href="{{ $paginator->previousPageUrl() }}" aria-label="{{ __('pagination.previous') }}"
                            rel="prev">
                            <svg class="h-5 w-5" viewBox="0 0 15 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M7.5 1.16668C4.27834 1.16668 1.66667 3.77835 1.66667 7.00001C1.66667 10.2217 4.27834 12.8333 7.5 12.8333C10.7217 12.8333 13.3333 10.2217 13.3333 7.00001C13.3333 3.77835 10.7217 1.16668 7.5 1.16668Z"
                                    stroke="white" stroke-width="0.875" stroke-miterlimit="10" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path d="M8.235 4.94084L6.18166 7.00001L8.235 9.05917" stroke="white"
                                    stroke-width="0.875" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </a>
                    @endif

                    {{-- Pagination Elements --}}
                    @foreach ($elements as $element)
                        {{-- "Three Dots" Separator --}}
                        @if (is_string($element))
                            <span aria-disabled="true">
                                <span
                                    class="relative -ml-px inline-flex cursor-default items-center border border-gray-300 bg-white px-4 py-2 text-sm font-medium leading-5 text-gray-700">{{ $element }}</span>
                            </span>
                        @endif

                        {{-- Array Of Links --}}
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    <span aria-current="page">
                                        <span
                                            class="relative -ml-px inline-flex cursor-default items-center border border-gray-300 bg-white px-4 py-2 text-sm font-medium leading-5 text-gray-500">{{ $page }}</span>
                                    </span>
                                @else
                                    <a class="relative -ml-px inline-flex items-center border border-gray-300 bg-white px-4 py-2 text-sm font-medium leading-5 text-gray-700 ring-gray-300 transition duration-150 ease-in-out hover:text-gray-500 focus:z-10 focus:border-blue-300 focus:outline-none focus:ring active:bg-gray-100 active:text-gray-700"
                                        href="{{ $url }}"
                                        aria-label="{{ __('Go to page :page', ['page' => $page]) }}">
                                        {{ $page }}
                                    </a>
                                @endif
                            @endforeach
                        @endif
                    @endforeach

                    {{-- Next Page Link --}}
                    @if ($paginator->hasMorePages())
                        <a class="relative -ml-px inline-flex items-center rounded-r-md border border-gray-300 bg-indigo-900 px-2 py-2 text-sm font-medium leading-5 text-white ring-gray-300 transition duration-150 ease-in-out hover:text-gray-400 focus:z-10 focus:border-blue-300 focus:outline-none focus:ring active:bg-indigo-900 active:text-gray-500"
                            href="{{ $paginator->nextPageUrl() }}" aria-label="{{ __('pagination.next') }}"
                            rel="next">
                            <svg class="h-5 w-5" viewBox="0 0 15 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M7.5 12.8333C10.7217 12.8333 13.3333 10.2217 13.3333 6.99999C13.3333 3.77833 10.7217 1.16666 7.5 1.16666C4.27834 1.16666 1.66667 3.77833 1.66667 6.99999C1.66667 10.2217 4.27834 12.8333 7.5 12.8333Z"
                                    stroke="white" stroke-width="0.875" stroke-miterlimit="10" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path d="M6.765 9.05916L8.81833 6.99999L6.765 4.94083" stroke="white"
                                    stroke-width="0.875" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </a>
                    @else
                        <span aria-disabled="true" aria-label="{{ __('pagination.next') }}">
                            <span
                                class="relative -ml-px inline-flex cursor-default items-center rounded-r-md border border-gray-300 bg-indigo-900 px-2 py-2 text-sm font-medium leading-5 text-gray-500"
                                aria-hidden="true">
                                <svg class="h-5 w-5" fill="transparent" viewBox="0 0 15 14"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M7.5 12.8333C10.7217 12.8333 13.3333 10.2217 13.3333 6.99999C13.3333 3.77833 10.7217 1.16666 7.5 1.16666C4.27834 1.16666 1.66667 3.77833 1.66667 6.99999C1.66667 10.2217 4.27834 12.8333 7.5 12.8333Z"
                                        stroke="white" stroke-width="0.875" stroke-miterlimit="10"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M6.765 9.05916L8.81833 6.99999L6.765 4.94083" stroke="white"
                                        stroke-width="0.875" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </span>
                        </span>
                    @endif
                </span>
            </div>
        </div>
    </nav>
@endif
