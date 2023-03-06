<x-layouts.app-layout title="{{ $title }}">

    <section class="min-h-screen overflow-x-hidden bg-hero py-8">
        <div class="layout grid grid-cols-2 gap-12">
            <div class="flex flex-col gap-4">
                <h2 class="font-josefin text-6xl font-normal text-red-500 drop-shadow-lg">Pengumuman</h2>
                <p class="font-crimson text-5xl font-normal text-white">Teks untuk pengumuman</p>
            </div>

            <div class="bg-hero-pattern bg-cover bg-center bg-no-repeat">
                <div class="mx-auto flex h-auto w-8/12 items-center">
                    <img alt="photo" src="{{ URL('images/photo-1.png') }}">
                </div>

                <div class="relative">
                    <img alt="erenos" class="absolute bottom-0 left-0 right-0 m-auto w-6/12 lg:top-20 2xl:top-24"
                        src="{{ URL('images/erenos.png') }}">
                </div>

                <div class="mx-auto flex h-auto w-6/12 justify-center">
                    <img alt="photo" class="" src="{{ URL('images/photo-2.png') }}">
                    <img alt="photo" class="" src="{{ URL('images/photo-3.png') }}">
                </div>
            </div>
        </div>
    </section>

    <footer class="flex-col gap-3 bg-hero pb-4">
        <div class="flex flex-row items-center justify-center gap-56">
            <a class="flex flex-row items-center" href="https://instagram.com/erenos.sch" target="_blank">
                <img alt="instagram" src="{{ URL('assets/icons/instagram.svg') }}">
                <p class="-ml-2 text-3xl font-semibold text-white">@erenos.sch</p>
            </a>

            <a class="flex flex-row items-center" href="https://www.facebook.com/erenos.sch" target="_blank">
                <img alt="facebook" src="{{ URL('assets/icons/facebook.svg') }}">
                <p class="text-3xl font-semibold text-white">Sekolah Erenos</p>
            </a>
        </div>

        <div class="flex justify-center">
            <p class="text-3xl font-normal leading-9 text-white">Jl. Palapa No.68, Serua, Kec. Ciputat, Kota
                Tangerang
                Selatan, Banten 15414</p>
        </div>
    </footer>

</x-layouts.app-layout>
