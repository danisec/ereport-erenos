<x-layouts.app-layout title="{{ $title }}">

    <x-organisms.header-dashboard />

    <section class="layout min-h-screen bg-hero py-6 font-rubik">
        <div class="w-full rounded-2xl bg-white py-5 shadow-sm">

            <div class="w-6/12 rounded-r-2xl bg-hero py-2">
                <h4 class="text-gray-9000 px-11 text-2xl font-bold text-white">View Mapping Kelas Siswa</h4>
            </div>

            <div class="flex flex-col gap-6 px-11 pt-9">

                <div class="flex flex-row items-start gap-12">

                    <div class="flex flex-col gap-3">
                        <div class="flex flex-row items-center">
                            <label class="mb-2 w-36 text-xl font-medium leading-9">Tahun Ajaran</label>
                            <p class="mb-2 w-8 text-xl font-medium leading-9">:</p>

                            <input class="field-input-gray w-52" name="idThnAjaran"
                                value="{{ $mappingkelas->tahunajaran->thnAjaran }}" @disabled(true)
                                @readonly(true)>
                        </div>

                        <div class="flex flex-row items-center">
                            <label class="mb-2 w-36 text-xl font-medium leading-9">Kelas</label>
                            <p class="mb-2 w-8 text-xl font-medium leading-9">:</p>

                            <input class="field-input-gray w-52" name="idKelas"
                                value="{{ $mappingkelas->kelas->kelas }}" @disabled(true)
                                @readonly(true)>
                        </div>
                    </div>

                    <div class="mt-[3.5rem] flex flex-col gap-4">
                        <div class="flex flex-row items-center">
                            <label class="mb-2 w-28 text-xl font-medium leading-9">Wali Kelas</label>
                            <p class="mb-2 w-8 text-xl font-medium leading-9">:</p>

                            <input class="field-input-gray w-64" name="NIP"
                                value="{{ $mappingkelas->guru->namaGuru }}" @disabled(true)
                                @readonly(true)>
                        </div>
                    </div>

                </div>

                <div class="sticky top-0 hidden" id="scroll-button">
                    <div class="absolute right-16 flex flex-col gap-64">

                        <x-molecules.scroll-top class="mt-28 focus:outline-none" />

                        <x-molecules.scroll-bottom class="focus:outline-none" />

                    </div>
                </div>

                <table class="mt-2 w-full text-left">

                    <thead class="border-b border-gray-200 bg-hero text-base font-medium text-gray-500"
                        id="table-mapping">
                        <tr>
                            <th class="w-10 px-6 py-3 text-white" scope="col">
                                No.
                            </th>
                            <th class="py-3 pl-14 text-white" scope="col">
                                <div class="flex flex-row items-center gap-1">
                                    NIS
                                </div>
                            </th>
                            <th class="px-6 py-3 text-white" scope="col">
                                <div class="flex flex-row items-center gap-1">
                                    NAMA
                                </div>
                            </th>
                        </tr>
                    </thead>

                    @if ($mappingkelasd->count())
                        @foreach ($mappingkelasd as $item)
                            <tbody>
                                <tr class="bg-white text-base font-medium leading-5 hover:bg-gray-50">
                                    <th class="py-2 px-9" scope="row">
                                        {{ ($mappingkelasd->currentPage() - 1) * $mappingkelasd->perPage() + $loop->iteration }}
                                    </th>
                                    <td class="py-2 pl-6">
                                        {{ $item->siswa->NIS }}
                                    </td>
                                    <td class="py-2 pl-6">
                                        {{ $item->siswa->nmSiswa }}
                                    </td>
                                </tr>
                            </tbody>
                        @endforeach
                    @endif

                </table>

                <div class="bg-white p-6">
                    {{ $mappingkelasd->links('vendor.pagination.tailwind') }}
                </div>

                <div class="mt-6 flex flex-row items-center justify-center gap-40">
                    <a class="rounded-sm bg-cyan-300 px-10 py-3 text-center text-sm font-normal shadow-xl shadow-gray-300"
                        href="{{ URL('dashboard/mappingkelas') }}">Back</a>
                </div>

            </div>

        </div>

    </section>

    <script>
        function hideScrollTopButton() {
            const scrollTopButton = document.getElementById(
                'scroll-button');

            if (window.pageYOffset < 550) {
                scrollTopButton.style.display = 'none';
            } else {
                scrollTopButton.style.display = 'block';
            }
        }

        window.addEventListener('scroll', hideScrollTopButton);
    </script>

</x-layouts.app-layout>
