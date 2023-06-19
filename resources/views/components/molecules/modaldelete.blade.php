@props(['title', 'action'])

<div class="fixed left-0 right-0 top-2/4 z-20 mx-auto w-3/4 border-4 border-blue-700 bg-hero py-6" x-show="show"
    x-on:click.outside="show = !show" x-bind:class="hidden = !show" x-transition:enter="transition ease-out duration-100"
    x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100"
    x-cloak>

    <div class="flex flex-col gap-4">
        <h4 class="text-center text-2xl font-normal uppercase text-white">HAPUS
            DATA
        </h4>

        <p class="px-10 text-left text-xl font-normal text-white">{{ $title }}</p>
        </p>


        <div class="mx-auto mt-4 flex flex-row justify-between gap-56">
            <form action={{ $action }} method="post">
                @method('delete')
                @csrf

                <button
                    class="rounded-lg bg-cyan-300 py-2.5 px-6 text-lg font-semibold text-gray-800 focus:outline-none">
                    Delete
                </button>
            </form>

            <button class="rounded-lg bg-cyan-300 py-2.5 px-6 text-lg font-semibold text-gray-800 focus:outline-none"
                @click="show = !show">
                Cancel
            </button>
        </div>
    </div>
</div>
