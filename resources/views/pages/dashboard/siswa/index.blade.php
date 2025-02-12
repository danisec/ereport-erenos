<x-app-layout title="{{ $title }}">

    <x-header-dashboard />

    <section class="layout min-h-screen bg-hero py-6 font-rubik">

        <div class="relative overflow-x-auto rounded-2xl shadow-sm">
            <table class="w-full text-left">

                <div class="bg-white px-9 py-5">
                    <div class="flex h-14 flex-row items-center justify-between rounded-3xl bg-hero px-20">
                        <h4 class="text-2xl font-bold text-white">Data Siswa</h4>

                        <div class="flex flex-row gap-4">
                            <form class="my-4" action="" method="GET">
                                @csrf

                                @if (request('nmSiswa'))
                                    <input name="nmSiswa" type="hidden" value="{{ request('nmSiswa') }}">
                                @endif

                                <x-molecules.search :placeholder="'Cari Siswa'" />
                            </form>

                            <a href="{{ URL('dashboard/siswa/tambah-siswa') }}">
                                <x-atoms.plus :alt="'tambah-siswa'" />
                            </a>

                        </div>
                    </div>
                </div>

                <thead class="border-b border-gray-200 bg-white text-base font-medium text-gray-500">
                    <tr>
                        <th class="w-10 px-9 py-3" scope="col">
                            No.
                        </th>
                        <th class="px-6 py-3" scope="col">
                            <div class="flex flex-row items-center gap-1">
                                @sortablelink('NIS', 'NIS')

                                <x-atoms.sorting />
                            </div>
                        </th>
                        <th class="px-6 py-3" scope="col">
                            <div class="flex flex-row items-center gap-1">
                                @sortablelink('nmSiswa', 'Nama Siswa')

                                <x-atoms.sorting />
                            </div>
                        </th>
                        <th class="px-6 py-3" scope="col">
                            <div class="flex flex-row items-center gap-1">
                                @sortablelink('tinggi', 'Tinggi Badan (cm)')

                                <x-atoms.sorting />
                            </div>
                        </th>
                        <th class="px-6 py-3" scope="col">
                            <div class="flex flex-row items-center gap-1">
                                @sortablelink('berat', 'Berat Badan (kg)')

                                <x-atoms.sorting />
                            </div>
                        </th>
                        <th class="px-6 py-3" scope="col">
                            Aksi
                        </th>
                    </tr>
                </thead>

                @if ($siswa->count())
                    @foreach ($siswa as $index => $item)
                        <tbody>
                            <tr
                                class="{{ $index % 2 === 0 ? 'bg-white' : 'bg-blue-100' }} text-base font-medium leading-5">
                                <th class="px-9" scope="row">
                                    {{ ($siswa->currentPage() - 1) * $siswa->perPage() + $loop->iteration }}
                                </th>
                                <td class="pl-6">
                                    {{ $item->NIS }}
                                </td>
                                <td class="pl-6">
                                    {{ $item->nmSiswa }}
                                </td>
                                <td class="pl-32">
                                    {{ number_format($item->tinggi) }}
                                </td>
                                <td class="pl-32">
                                    {{ number_format($item->berat) }}
                                </td>
                                <td class="mr-3 flex flex-row items-center gap-5 2xl:m-0">
                                    <a href="{{ route('siswa.show', $item->NIS) }}">
                                        <x-atoms.eye :alt="'detail-siswa'" />
                                    </a>

                                    <a href="{{ route('siswa.edit', $item->NIS) }}">
                                        <x-atoms.pencil :alt="'edit-siswa'" />
                                    </a>

                                    <div x-data="{ show: false }">
                                        <button class="focus:outline-none" type="button" @click="show = !show">
                                            <x-atoms.trash :alt="'delete-siswa'" />
                                        </button>

                                        <x-molecules.modaldelete :title="'Apakah Anda akan menghapus nama siswa : ' . $item->nmSiswa . ' ?'" :action="route('siswa.destroy', $item->NIS)" />
                                    </div>

                                </td>
                            </tr>
                        </tbody>
                    @endforeach
                @endif
            </table>

            <div class="bg-white p-6">
                {{ $siswa->links('vendor.pagination.tailwind') }}
            </div>

        </div>

    </section>

    </x-layouts.app-layout>
