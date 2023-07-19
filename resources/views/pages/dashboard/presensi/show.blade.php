<x-layouts.app-layout title="{{ $title }}">

    <x-organisms.header-dashboard />

    <section class="layout min-h-screen bg-hero py-6 font-rubik">
        <div class="w-full rounded-2xl bg-white py-5 shadow-sm">

            <div class="w-6/12 rounded-r-2xl bg-hero py-2">
                <h4 class="text-gray-9000 px-11 text-2xl font-bold text-white">View Presensi Siswa</h4>
            </div>

            <div class="flex flex-col gap-6 px-11 pt-9">

                <div class="flex flex-row items-start gap-14">

                    <div class="flex flex-col gap-1">
                        <div class="flex flex-col gap-1">
                            <div class="flex flex-row items-center">
                                <label class="mb-2 w-36 text-xl font-medium leading-9">Tahun Ajaran</label>
                                <p class="mb-2 w-8 text-xl font-medium leading-9">:</p>

                                <input class="field-input-gray w-64"
                                    value="{{ $presensi->jadwal->tahunajaran->thnAjaran }} - {{ $presensi->jadwal->tahunajaran->semester }}"
                                    @disabled(true) @readonly(true) />
                            </div>
                        </div>

                        <div class="flex flex-col gap-1">
                            <div class="flex flex-row items-center">
                                <label class="mb-2 w-36 text-xl font-medium leading-9">Kelas</label>
                                <p class="mb-2 w-8 text-xl font-medium leading-9">:</p>

                                <input class="field-input-gray w-64" value="{{ $presensi->jadwal->kelas->kelas }}"
                                    @disabled(true) @readonly(true) />
                            </div>
                        </div>

                        <div class="flex flex-col gap-1">
                            <div class="flex flex-row items-center">
                                <label class="mb-2 w-36 text-xl font-medium leading-9">Tanggal</label>
                                <p class="mb-2 w-8 text-xl font-medium leading-9">:</p>

                                <input class="field-input-gray w-64" value="{{ $presensi->tanggal }}"
                                    @disabled(true) @readonly(true) />
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-col gap-1">
                        <div class="flex flex-col gap-1">
                            <div class="flex flex-row items-center">
                                <label class="mb-2 w-28 text-xl font-medium leading-9">Pelajaran</label>
                                <p class="mb-2 w-8 text-xl font-medium leading-9">:</p>

                                <input class="field-input-gray w-72"
                                    value="{{ $presensi->jadwal->pelajaran->nmPelajaran }}" @disabled(true)
                                    @readonly(true) />
                            </div>
                        </div>

                        <div class="flex flex-col gap-1">
                            <div class="flex flex-row items-center">
                                <label class="mb-2 w-28 text-xl font-medium leading-9">Guru</label>
                                <p class="mb-2 w-8 text-xl font-medium leading-9">:</p>

                                <input
                                    class="w-72 rounded-md border-gray-200 bg-gray-400/60 px-3 py-1 text-lg text-white placeholder:text-white focus:outline-none"
                                    value="{{ $presensi->jadwal->guru->namaGuru }}" @disabled(true)
                                    @readonly(true) />
                            </div>
                        </div>
                    </div>

                </div>

                <div class="sticky top-0 hidden" id="scroll-button">
                    <div class="absolute right-16 flex flex-col gap-72">

                        <x-molecules.scroll-top class="mt-24 focus:outline-none" />

                        <x-molecules.scroll-bottom class="focus:outline-none" />

                    </div>
                </div>

                <div>
                    <table class="w-full text-left" id="siswaTable">
                        <thead class="bg-hero text-base font-medium text-gray-500" id="table-mapping">
                            <tr>
                                <th class="w-10 px-6 py-3 text-white" scope="col">
                                    No.
                                </th>
                                <th class="py-3 pl-14 text-white" scope="col">
                                    <div class="flex flex-row items-center gap-1">
                                        @sortablelink('siswa.NIS', 'NIS')

                                        <img src="{{ asset('assets/icons/sorting.svg') }}" alt="sorting">
                                    </div>
                                </th>
                                <th class="px-6 py-3 text-white" scope="col">
                                    <div class="flex flex-row items-center gap-1">
                                        @sortablelink('siswa.nmSiswa', 'NAMA SISWA')

                                        <img src="{{ asset('assets/icons/sorting.svg') }}" alt="sorting">
                                    </div>
                                </th>
                                <th class="w-96 py-3 pl-36 text-center text-white" scope="col">
                                    <div class="flex flex-row items-center gap-1">
                                        @sortablelink('status', 'STATUS')

                                        <img src="{{ asset('assets/icons/sorting.svg') }}" alt="sorting">
                                    </div>
                                </th>
                            </tr>
                        </thead>

                        @if ($presensiSiswa->count())
                            @foreach ($presensiSiswa as $item)
                                <tbody>
                                    <tr class="bg-white text-base font-medium leading-5 hover:bg-gray-50">
                                        <th class="px-9 py-2" scope="row">
                                            {{ $loop->iteration }}
                                        </th>
                                        <td class="py-2 pl-6">
                                            {{ $item->siswa->NIS }}
                                        </td>
                                        <td class="py-2 pl-6">
                                            {{ $item->siswa->nmSiswa }}
                                        </td>
                                        <td class="pl-20">
                                            <input class="field-input-gray mt-1 w-40" value="{{ $item->status }}"
                                                @disabled(true) @readonly(true) />
                                        </td>
                                    </tr>
                                </tbody>
                            @endforeach
                        @endif
                    </table>
                </div>

                <div class="mt-6 flex flex-row items-center justify-start gap-40">
                    <a class="rounded-sm bg-cyan-300 px-10 py-3 text-center text-sm font-normal shadow-xl shadow-gray-300"
                        href="{{ URL('dashboard/presensi') }}">Back</a>
                </div>

                </form>

            </div>

    </section>

    <script>
        function hideScrollTopButton() {
            const scrollTopButton = document.getElementById(
                'scroll-button');

            if (window.pageYOffset < 150) {
                scrollTopButton.style.display = 'none';
            } else {
                scrollTopButton.style.display = 'block';
            }
        }

        window.addEventListener('scroll', hideScrollTopButton);
    </script>

</x-layouts.app-layout>
