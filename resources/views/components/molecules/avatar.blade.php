<div class="mt-2" x-data="{ show: false }">
    <button class="focus:outline-none" type="button" @click="show = !show">
        <img class="h-16 w-16 rounded-2xl" src="{{ URL('assets/icons/profile.svg') }}" alt="profile">
    </button>

    <div class="absolute right-0 z-10 mr-14 mt-2 w-64 rounded-lg bg-white shadow-md shadow-slate-100" x-show="show"
        x-on:click.outside="show = !show" x-bind:class="hidden = !show"
        x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95"
        x-transition:enter-end="transform opacity-100 scale-100" x-cloak>
        <div class="flex flex-col gap-1 p-4">

            <div class="flex flex-row items-center border-b-2 border-slate-100">
                <p class="mt-2 px-2 pb-2 text-lg font-normal text-gray-900">
                    {{ Auth::user()->name }}
                </p>

                <span
                    class="rounded-full bg-green-400 p-1 text-xs font-normal text-white">{{ Auth::user()->role }}</span>
            </div>

            @if (request()->segment(1) == '')
                <a class="flex w-56 flex-row items-center justify-start gap-2 px-2 py-2 text-lg font-semibold text-gray-900 hover:rounded-md hover:bg-slate-100 focus:outline-none"
                    href="{{ url('') . '/dashboard' }}">
                    <svg class="h-6 w-6 text-blue-700" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M4.098 19.902a3.75 3.75 0 005.304 0l6.401-6.402M6.75 21A3.75 3.75 0 013 17.25V4.125C3 3.504 3.504 3 4.125 3h5.25c.621 0 1.125.504 1.125 1.125v4.072M6.75 21a3.75 3.75 0 003.75-3.75V8.197M6.75 21h13.125c.621 0 1.125-.504 1.125-1.125v-5.25c0-.621-.504-1.125-1.125-1.125h-4.072M10.5 8.197l2.88-2.88c.438-.439 1.15-.439 1.59 0l3.712 3.713c.44.44.44 1.152 0 1.59l-2.879 2.88M6.75 17.25h.008v.008H6.75v-.008z" />
                    </svg>

                    <p class="text-lg font-medium text-gray-800">Dashboard</p>
                </a>
            @else
                <a class="flex w-56 flex-row items-center justify-start gap-2 px-2 py-2 text-lg font-semibold text-gray-900 hover:rounded-md hover:bg-slate-100 focus:outline-none"
                    href="{{ url('') }}">
                    <svg class="h-6 w-6 text-blue-700" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                    </svg>

                    <p class="text-lg font-medium text-gray-800">Home</p>
                </a>

                @if (Auth::user()->role == 'superadmin')
                    <a class="flex w-56 flex-row items-center justify-start gap-2 px-2 py-2 text-lg font-semibold text-gray-900 hover:rounded-md hover:bg-slate-100 focus:outline-none"
                        href="{{ route('kelolaAkun.index') }}">
                        <svg class="h-6 w-6 text-blue-700" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M19 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM4 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 0110.374 21c-2.331 0-4.512-.645-6.374-1.766z" />
                        </svg>

                        <p class="text-lg font-medium text-gray-800">Kelola Akun</p>
                    </a>
                @endif
            @endif

            <form action="{{ route('login.logout') }}" method="post">
                @csrf

                <button
                    class="flex w-56 flex-row items-center justify-start gap-2 px-2 py-2 text-lg font-semibold text-gray-900 hover:rounded-md hover:bg-slate-100 focus:outline-none"
                    type="submit">
                    <svg class="-ml-0.5 h-6 w-6 text-red-500" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9" />
                    </svg>

                    <p class="ml-0.5 text-lg font-medium text-gray-800">Logout</p>
                </button>
            </form>
        </div>
    </div>
</div>
