@props(['placeholder'])

<form class="my-4" action="" method="GET">
    @if (request('nama_siswa'))
        <input name="nama_siswa" type="hidden" value="{{ request('nama_siswa') }}">
    @endif

    <label class="sr-only mb-2 text-sm font-medium text-gray-900" for="default-search">Search</label>

    <div class="relative">
        <input
            class="block w-full rounded-md border border-gray-300 bg-white py-2.5 px-10 pl-3 text-sm font-medium text-gray-900 focus:outline-none"
            name="search" value="{{ request('search') ?? '' }}" placeholder="{{ $placeholder }}">

        <button class="absolute right-2.5 bottom-2.5 focus:outline-none" type="submit">
            <svg class="h-6 w-6 text-gray-500" aria-hidden="true" fill="none" stroke="currentColor"
                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" stroke-linecap="round" stroke-linejoin="round"
                    stroke-width="2"></path>
            </svg></button>
    </div>
</form>
