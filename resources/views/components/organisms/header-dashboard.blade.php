    <nav class="h-28 w-full bg-login-pattern bg-cover bg-no-repeat">
        <ul class="layout flex h-28 items-center justify-start overflow-x-auto">
            <li class="flex flex-row items-center gap-12 whitespace-nowrap">
                @foreach ($navbar as $name => $url)
                    <a class="{{ request()->segment(2) == $url
                        ? 'text-white font-semibold text-xl leading-7 bg-nav-active/40 rounded-full py-2 px-5 transition-all ease-in'
                        : 'text-white font-semibold text-xl leading-7' }}"
                        href="{{ $url == '/' ? url('') : url('') . '/dashboard' . '/' . $url }}">{{ $name }}</a>
                @endforeach
            </li>
        </ul>
    </nav>
