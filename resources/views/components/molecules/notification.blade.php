<div class="mt-2.5" x-data="{ show: false }">
    <button class="focus:outline-none" type="button" @click="show = !show">
        <img class="w-h-16 h-16 rounded-2xl" src="{{ URL('assets/icons/notification.svg') }}" alt="notification">
    </button>

    <div class="absolute right-0 mr-14 mt-2 w-64 rounded-lg bg-white shadow-md shadow-slate-100" x-show="show">
        <div class="flex flex-col gap-3 p-4">
            <p>Notification</p>
        </div>
    </div>
</div>
