    <nav class="h-16 w-full bg-login-pattern bg-cover bg-no-repeat">
        <ul class="layout flex h-16 items-center justify-start overflow-x-auto">
            <li class="flex flex-row items-center gap-12 whitespace-nowrap">
                @foreach ($navbar as $name => $url)
                    <a class="{{ request()->segment(2) == $url
                        ? 'text-white font-semibold text-xl leading-7 bg-nav-active/40 rounded-full py-2 px-5 transition-all ease-in'
                        : 'text-white font-semibold text-xl leading-7' }}"
                        href="{{ $url == '/' ? url('') : url('') . '/dashboard' . '/' . $url }}">{{ $name }}</a>
                @endforeach

                <div x-data="{ show: false }">
                    <button class="text-xl font-semibold leading-7 text-white focus:outline-none" type="button"
                        @click="show = !show">
                        Mapping
                    </button>

                    <div class="absolute z-10 mr-14 mt-4 w-56 rounded-lg bg-white shadow-md shadow-slate-100"
                        x-show="show" x-on:click.outside="show = !show" x-bind:class="hidden = !show"
                        x-transition:enter="transition ease-out duration-100"
                        x-transition:enter-start="transform opacity-0 scale-95"
                        x-transition:enter-end="transform opacity-100 scale-100" x-cloak>
                        <div class="m-2 flex flex-col gap-2">

                            @foreach ($mapping as $name => $url)
                                <a class="{{ request()->segment(2) == $url
                                    ? 'text-gray-900 font-semibold text-xl leading-7 bg-nav-active/40 px-2 py-2 rounded-full transition-all ease-in'
                                    : 'text-gray-900 font-semibold text-xl leading-7 px-2' }}"
                                    href="{{ $url == '/' ? url('') : url('') . '/dashboard' . '/' . $url }}">{{ $name }}</a>
                            @endforeach

                        </div>
                    </div>
                </div>

                @foreach ($navbarLast as $name => $url)
                    <a class="{{ request()->segment(2) == $url
                        ? 'text-white font-semibold text-xl leading-7 bg-nav-active/40 rounded-full py-2 px-5 transition-all ease-in'
                        : 'text-white font-semibold text-xl leading-7' }}"
                        href="{{ $url == '/' ? url('') : url('') . '/dashboard' . '/' . $url }}">{{ $name }}</a>
                @endforeach
            </li>
        </ul>
    </nav>
