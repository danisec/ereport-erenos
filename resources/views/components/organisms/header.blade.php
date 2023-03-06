<header class="flex h-28 w-full items-center justify-between bg-header pr-11">
    <div class="flex flex-row items-center justify-start gap-4">
        <div>
            <x-atoms.logo classLogo="h-auto w-28 object-cover" />
        </div>

        <div class="flex flex-col items-start gap-2">
            <p class="text-3xl font-semibold uppercase leading-9 text-white">Sekolah Erenos</p>
            <p class="text-3xl font-semibold leading-9 text-white">Iman, Ilmu dan Damai Sejahtera</p>
        </div>
    </div>

    @auth
        <form action="{{ route('login.logout') }}" method="post">
            @csrf
            <button class="btn-header">Logout</button>
        </form>
    @else
        <a href="/login">
            <button class="btn-header">Login</button>
        </a>
    @endauth

</header>
