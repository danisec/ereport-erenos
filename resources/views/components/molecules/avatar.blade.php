<div class="mt-2" x-data="{ show: false }">
    <button class="focus:outline-none" type="button" @click="show = !show">
        <img class="h-16 w-16 rounded-2xl" src="{{ URL('assets/icons/profile.svg') }}" alt="profile">
    </button>

    <div class="absolute right-0 mr-14 mt-2 w-64 rounded-lg bg-white shadow-md shadow-slate-100" x-show="show">
        <div class="flex flex-col gap-3 p-4">
            <p class="mt-2 px-2 text-lg font-normal text-gray-900">
                {{ Auth::user()->name }}
            </p>

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

                    <p>Logout</p>
                </button>
            </form>
        </div>
    </div>
</div>
