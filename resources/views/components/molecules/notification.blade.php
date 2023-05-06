<div class="mt-2.5" x-data="{ show: false }">
    <button class="focus:outline-none" type="button" @click="show = !show">
        <img class="w-h-16 h-16 rounded-2xl" src="{{ URL('assets/icons/notification.svg') }}" alt="notification">
    </button>

    <div class="absolute right-0 z-10 mr-14 mt-2 w-64 rounded-lg bg-white shadow-md shadow-slate-100" x-show="show"
        x-on:click.outside="show = !show" x-bind:class="hidden = !show"
        x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95"
        x-transition:enter-end="transform opacity-100 scale-100" x-cloak>
        <div class="flex flex-col gap-3 p-4">
            <p>Notification</p>
        </div>
    </div>
</div>
