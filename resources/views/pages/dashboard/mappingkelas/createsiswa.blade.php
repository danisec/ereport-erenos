<x-layouts.app-layout title="{{ $title }}">

    <x-organisms.header-dashboard />

    <section class="layout min-h-screen bg-hero py-14 font-rubik">
        <div class="w-full rounded-2xl bg-white py-5 shadow-sm">

            <div class="w-6/12 rounded-r-2xl bg-hero py-2">
                <h4 class="text-gray-9000 px-11 text-2xl font-bold text-white">Menambah Data Siswa</h4>
            </div>

            <form class="flex flex-col gap-6 px-11 pt-9" action="{{ route('mappingkelas.storesiswa') }}" method="post">
                @csrf

                <div class="flex flex-row gap-40">

                    <div class="flex flex-col gap-6">
                        <input name="idMapping" type="hidden" value="{{ $idMapping->idMapping }}">
                        <div class="flex flex-col gap-1">
                            <div class="flex flex-row items-center">
                                <label class="mb-2 w-64 text-xl font-medium leading-9">NIS</label>

                                <select class="field-input-indigo w-96" id="nis" name="NIS" required>
                                    <option selected disabled hidden>NIS</option>
                                    @foreach ($nis as $item)
                                        <option value="{{ $item->NIS }}">{{ $item->NIS }}</option>
                                    @endforeach
                                </select>
                            </div>

                            @error('NIS')
                                <p class="invalid-feedback ml-64">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="flex flex-col gap-1">
                            <div class="flex flex-row items-center gap-16">
                                <label class="mb-2 w-48 text-xl font-medium leading-9">Nama</label>

                                <select class="field-input-indigo w-96" id="nmSiswa" name="nmSiswa" required>
                                    <option selected disabled hidden>Nama</option>
                                    @foreach ($namasiswa as $item)
                                        <option value="{{ $item->nmSiswa }}">{{ $item->nmSiswa }}</option>
                                    @endforeach
                                </select>
                            </div>

                            @error('nmSiswa')
                                <p class="invalid-feedback ml-64">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>

                    <div class="mt-[4.4rem] flex flex-col gap-4">
                        <button
                            class="flex flex-row items-center gap-2 rounded-md bg-cyan-300 px-4 py-2.5 shadow-xl shadow-gray-300"
                            type="submit">
                            <p class="text-center text-xl font-normal">Tambah</p>
                            <x-atoms.plus :alt="'tambah-datasiswa'" />
                        </button>
                    </div>

                </div>

            </form>

            <div class="sticky top-0 hidden" id="scroll-button">
                <div class="absolute right-16 flex flex-col gap-72">

                    <x-molecules.scroll-top class="mt-24 focus:outline-none" />

                    <x-molecules.scroll-bottom class="focus:outline-none" />

                </div>
            </div>

            <div class="mx-10">
                <table class="mt-6 w-full text-left" id="form-data-table">

                    <thead class="bg-hero text-base font-medium text-gray-500" id="table-mapping">
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
                            <th class="w-52 py-3 text-white" scope="col">
                                Aksi
                            </th>
                        </tr>
                    </thead>

                    @if ($mappingkelasd->count())
                        @foreach ($mappingkelasd as $item)
                            <tbody>
                                <tr class="bg-white text-base font-medium leading-5 hover:bg-gray-50">
                                    <th class="py-4 px-9" scope="row">
                                        {{ ($mappingkelasd->currentPage() - 1) * $mappingkelasd->perPage() + $loop->iteration }}
                                    </th>
                                    <td class="py-4 pl-6">
                                        {{ $item->siswa->NIS }}
                                    </td>
                                    <td class="py-4 pl-6">
                                        {{ $item->siswa->nmSiswa }}
                                    </td>
                                    <td class="py-4">
                                        <div x-data="{ show: false }">
                                            <button class="focus:outline-none" type="button" @click="show = !show">
                                                <x-atoms.trash :alt="'delete-siswa'" />
                                            </button>

                                            <x-molecules.modaldelete :title="'Apakah Anda akan menghapus map siswa : ' .
                                                $item->siswa->nmSiswa .
                                                ' ?'" :action="route('mappingkelas.destroysiswa', $item->idMappingKelas_D)" />
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        @endforeach
                    @endif

                </table>
            </div>

            <div class="mt-6 flex flex-row items-center justify-center gap-40">
                <a class="rounded-sm bg-cyan-300 px-10 py-3 text-center text-sm font-normal shadow-xl shadow-gray-300"
                    href="{{ URL('dashboard/mappingkelas') }}">Selesai</a>
            </div>

        </div>

    </section>

    <script>
        function hideScrollTopButton() {
            const scrollTopButton = document.getElementById(
                'scroll-button');

            if (window.pageYOffset < 500) {
                scrollTopButton.style.display = 'none';
            } else {
                scrollTopButton.style.display = 'block';
            }
        }

        window.addEventListener('scroll', hideScrollTopButton);
    </script>

</x-layouts.app-layout>
