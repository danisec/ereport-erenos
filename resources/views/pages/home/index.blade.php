<x-layouts.app-layout title="Home">
    <h1 class="text-2xl text-gray-900 font-semibold">Home Page</h1>

    <div x-data="{ show: false }">
        <button class="bg-white shadow-md shadow-gray-100 text-gray-900 text-base font-semibold rounded-md w-20 h-12" @click="show = !show">Show</button>
        <h1 x-show="show">Hello Alpine.js</h1>
    </div>
</x-layouts.app-layout>
