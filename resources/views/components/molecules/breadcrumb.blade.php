@props(['title'])

<nav class="layout flex h-32 items-center justify-start" aria-label="Breadcrumb">
    <ol class="inline-flex items-center space-x-1 md:space-x-3">
        <li class="inline-flex items-center">
            @if (Auth::user())
                <a class="inline-flex items-center text-lg font-light text-white/70 hover:font-medium hover:text-white"
                    href="{{ route('kelolaAkun.index') }}">
                    Dashboard
                </a>
            @else
                <a class="inline-flex items-center text-lg font-light text-white/70 hover:font-medium hover:text-white"
                    href="{{ route('home.index') }}">
                    Home
                </a>
            @endif
        </li>
        <li aria-current="login">
            <div class="flex items-center">
                <svg class="h-6 w-6 text-white/70" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path clip-rule="evenodd"
                        d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                        fill-rule="evenodd"></path>
                </svg>
                <span class="ml-1 text-lg font-light text-white/70 md:ml-2">{{ $title }}</span>
            </div>
        </li>
    </ol>
</nav>
