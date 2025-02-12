<x-app-layout title="{{ $title }}">

    <div class="min-h-screen overflow-x-hidden bg-hero py-8">
        <section class="layout grid grid-cols-2 gap-12">
            <div class="flex flex-col gap-4" id="pengumumanLatest">
                <h2 class="font-josefin text-4xl font-normal text-red-500 drop-shadow-lg" id="pengumumanTitle">
                    {{ $pengumumanLatest->namaPengumuman ?? '' }}
                </h2>
                <p class="font-crimson text-2xl font-normal text-white" id="pengumumanContent">
                    {!! $pengumumanLatest->pengumuman ?? '' !!}
                </p>
            </div>

            <div class="hidden" id="newPengumuman">
                <!-- Hidden initially -->
                <div class="flex flex-col gap-4">
                    <h2 class="font-josefin text-4xl font-normal text-red-500 drop-shadow-lg" id="newPengumumanTitle">
                    </h2>
                    <p class="font-crimson text-2xl font-normal text-white" id="newPengumumanContent"></p>
                </div>
            </div>

            <div class="h-[28rem] bg-hero-pattern bg-cover bg-center bg-no-repeat p-10">
                <div class="mx-auto flex h-auto w-8/12 items-center">
                    <img src="{{ URL('images/photo-1.png') }}" alt="photo">
                </div>

                <div class="relative">
                    <img class="absolute bottom-0 left-0 right-0 m-auto w-6/12 lg:top-20 2xl:top-24"
                        src="{{ URL('images/erenos.png') }}" alt="erenos">
                </div>

                <div class="mx-auto flex h-auto w-6/12 justify-center">
                    <img class="" src="{{ URL('images/photo-2.png') }}" alt="photo">
                    <img class="" src="{{ URL('images/photo-3.png') }}" alt="photo">
                </div>
            </div>
        </section>

        <section class="layout mt-20">
            <h4 class="mb-6 text-2xl font-normal text-white underline">List Posts</h4>

            @foreach ($pengumuman as $item)
                <div class="my-2 flex flex-row items-center gap-1">
                    <p class="text-xl font-medium text-white">{{ $loop->iteration . '.' }}</p>
                    <a class="post-link" data-title="{{ $item->namaPengumuman }}" data-content="{{ $item->pengumuman }}"
                        href="/">
                        <h2 class="text-xl font-medium text-white">{!! $item->namaPengumuman !!}</h2>
                    </a>
                </div>
            @endforeach
        </section>
    </div>

    <footer class="flex-col gap-3 bg-hero pb-4">
        <div class="flex flex-row items-center justify-center gap-56">
            <a class="flex flex-row items-center" href="https://instagram.com/erenos.sch" target="_blank">
                <img class="h-auto w-20" src="{{ URL('assets/icons/instagram.svg') }}" alt="instagram">
                <p class="-ml-2 text-xl font-semibold text-white">@erenos.sch</p>
            </a>

            <a class="flex flex-row items-center" href="https://www.facebook.com/erenos.sch" target="_blank">
                <img class="h-auto w-16" src="{{ URL('assets/icons/facebook.svg') }}" alt="facebook">
                <p class="text-xl font-semibold text-white">Sekolah Erenos</p>
            </a>
        </div>

        <div class="flex justify-center">
            <p class="text-xl font-normal leading-9 text-white">Jl. Palapa No.68, Serua, Kec. Ciputat, Kota
                Tangerang
                Selatan, Banten 15414</p>
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const postLinks = document.querySelectorAll('.post-link');
            const pengumumanLatest = document.getElementById('pengumumanLatest');
            const pengumumanTitle = document.getElementById('pengumumanTitle');
            const pengumumanContent = document.getElementById('pengumumanContent');
            const newPengumuman = document.getElementById('newPengumuman');
            const newPengumumanTitle = document.getElementById('newPengumumanTitle');
            const newPengumumanContent = document.getElementById('newPengumumanContent');

            postLinks.forEach(function(link) {
                link.addEventListener('click', function(event) {
                    event.preventDefault();
                    const title = this.dataset.title;
                    const content = this.dataset.content;

                    // Hide the latest pengumuman
                    pengumumanLatest.style.display = 'none';

                    // Display the content in the newPengumuman div
                    newPengumumanTitle.innerHTML = title;
                    newPengumumanContent.innerHTML = content;
                    newPengumuman.style.display = 'block';
                });
            });
        });
    </script>

</x-app-layout>
