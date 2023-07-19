<x-layouts.app-layout title="{{ $title }}">

    <x-organisms.header-dashboard />

    <section class="layout min-h-screen bg-hero py-6 font-rubik">
        <div class="w-full rounded-2xl bg-white py-5 shadow-sm">

            <div class="w-6/12 rounded-r-2xl bg-hero py-2">
                <h4 class="text-gray-9000 px-11 text-2xl font-bold text-white">Ubah Data Siswa</h4>
            </div>

            <div class="mx-10 my-4 flex flex-row items-start gap-12">

                <div class="flex flex-col gap-3">
                    <div class="flex flex-col gap-1">
                        <div class="flex flex-row items-center">
                            <label class="mb-2 w-36 text-xl font-medium leading-9">Tahun Ajaran</label>
                            <p class="mb-2 w-8 text-xl font-medium leading-9">:</p>

                            <input class="field-input-gray w-52" name="idThnAjaran"
                                value="{{ $mappingkelas->tahunajaran->thnAjaran }} - {{ $mappingkelas->tahunajaran->semester }}"
                                @disabled(true) @readonly(true)>
                        </div>
                    </div>

                    <div class="flex flex-col gap-1">
                        <div class="flex flex-row items-center">
                            <label class="mb-2 w-36 text-xl font-medium leading-9">Kelas</label>
                            <p class="mb-2 w-8 text-xl font-medium leading-9">:</p>

                            <input class="field-input-gray w-52" name="idKelas"
                                value="{{ $mappingkelas->kelas->kelas }}" @disabled(true)
                                @readonly(true)>
                        </div>
                    </div>
                </div>

                <div class="mt-[3.5rem] flex flex-col gap-4">
                    <div class="flex flex-col gap-1">
                        <div class="flex flex-row items-center">
                            <label class="mb-2 w-28 text-xl font-medium leading-9">Wali Kelas</label>
                            <p class="mb-2 w-8 text-xl font-medium leading-9">:</p>

                            <input class="field-input-gray w-52" name="NIP"
                                value="  {{ $mappingkelas->guru->namaGuru }}" @disabled(true)
                                @readonly(true)>
                        </div>
                    </div>
                </div>

            </div>

            <form class="mb-2 ml-32 mt-8 flex flex-col gap-6 px-11"
                action="/dashboard/mappingkelas/ubah-datasiswa/{{ $idMapping->idMapping }}" method="post">
                @method('put')
                @csrf

                <div class="flex flex-row gap-12">
                    <input name="idMapping" type="hidden" value="{{ $idMapping->idMapping }}" value="">
                    <div class="ml-1 flex flex-col items-center gap-1">
                        <div class="flex flex-row items-center">
                            <label class="mb-2 w-14 text-xl font-medium leading-9">NIS</label>

                            <select class="field-input-indigo w-40" id="nis" name="NIS" required>
                                <option selected disabled hidden>NIS</option>
                                @foreach ($nis as $item)
                                    <option value="{{ $item->NIS }}">{{ $item->NIS }}</option>
                                @endforeach
                            </select>
                        </div>

                        @error('NIS')
                            <p class="invalid-feedback ml-14">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div class="flex flex-col">
                        <div class="flex flex-row items-center gap-16">
                            <label class="mb-2 w-4 text-xl font-medium leading-9">Nama</label>

                            <select class="field-input-indigo w-56" id="nmSiswa" name="nmSiswa" required>
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

                    <div class="ml-28 flex flex-col">
                        <button
                            class="flex flex-row items-center gap-2 rounded-md bg-cyan-300 px-2 py-1 shadow-lg shadow-gray-300"
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
                                    <th class="px-9" scope="row">
                                        {{ $loop->iteration }}
                                    </th>
                                    <td class="pl-6">
                                        {{ $item->siswa->NIS }}
                                    </td>
                                    <td class="pl-6">
                                        {{ $item->siswa->nmSiswa }}
                                    </td>
                                    <td>
                                        <div x-data="{ show: false }">
                                            <button class="focus:outline-none" type="button" @click="show = !show">
                                                <x-atoms.trash :alt="'delete-siswa'" />
                                            </button>

                                            <x-molecules.modaldelete :title="'Apakah Anda akan menghapus map siswa : ' .
                                                $item->siswa->nmSiswa .
                                                ' ?'" :action="route('mappingkelas.destroyubahsiswa', $item->idMappingKelas_D)" />
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        @endforeach
                    @endif

                </table>
            </div>

            <div class="mt-6 flex flex-row items-center justify-center gap-40">
                @if ($mappingkelasd->where('idMapping', $idMapping->idMapping)->count() == 0)
                    <form action="{{ route('mappingkelas.destroykelasid', $idMapping->idMapping) }}" method="post">
                        @method('delete')
                        @csrf

                        <button
                            class="rounded-sm bg-cyan-300 px-10 py-3 text-center text-sm font-normal shadow-xl shadow-gray-300"
                            type="submit">Selesai</button>
                    </form>
                @else
                    <a class="rounded-sm bg-cyan-300 px-10 py-3 text-center text-sm font-normal shadow-xl shadow-gray-300"
                        href="{{ URL('dashboard/mappingkelas') }}">Selesai</a>
                @endif
            </div>

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
