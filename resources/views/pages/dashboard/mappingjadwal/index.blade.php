<x-layouts.app-layout title="{{ $title }}">

    <x-organisms.header-dashboard />

    <section class="layout min-h-screen bg-hero py-6 font-rubik">

        <div class="relative overflow-x-auto rounded-2xl shadow-sm">
            <table class="w-full text-left">

                <div class="bg-white py-5 px-9">
                    <div class="flex h-14 flex-row items-center justify-between rounded-3xl bg-hero px-20">
                        <h4 class="text-2xl font-bold text-white">Daftar Mapping Jadwal</h4>

                        <div class="flex flex-row gap-4">
                            <form class="my-4" action="" method="GET">
                                @csrf

                                @if (request('nmPelajaran'))
                                    <input name="nmPelajaran" type="hidden" value="{{ request('nmPelajaran') }}">
                                @endif

                                <x-molecules.search :placeholder="'Cari Jadwal'" />
                            </form>

                            <a href="{{ URL('dashboard/mappingjadwal/tambah-mappingjadwal') }}">
                                <x-atoms.plus :alt="'tambah-mappingjadwal'" />
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
                                @sortablelink('idThnAjaran', 'Tahun Ajaran')

                                <x-atoms.sorting />
                            </div>
                        </th>
                        <th class="px-6 py-3" scope="col">
                            <div class="flex flex-row items-center gap-1">
                                @sortablelink('idKelas', 'Kelas')

                                <x-atoms.sorting />
                            </div>
                        </th>
                        <th class="px-6 py-3" scope="col">
                            <div class="flex flex-row items-center gap-1">
                                @sortablelink('idPelajaran', 'Pelajaran')

                                <x-atoms.sorting />
                            </div>
                        </th>
                        <th class="px-6 py-3" scope="col">
                            <div class="flex flex-row items-center gap-1">
                                @sortablelink('NIP', 'Guru')

                                <x-atoms.sorting />
                            </div>
                        </th>
                        <th class="px-6 py-3" scope="col">
                            <div class="flex flex-row items-center gap-1">
                                @sortablelink('hari', 'Hari')

                                <x-atoms.sorting />
                            </div>
                        </th>
                        <th class="px-6 py-3" scope="col">
                            Aksi
                        </th>
                    </tr>
                </thead>

                @if ($jadwal->count())
                    @foreach ($jadwal as $item)
                        <tbody>
                            <tr class="bg-white text-base font-medium leading-5 hover:bg-gray-50">
                                <th class="px-9" scope="row">
                                    {{ ($jadwal->currentPage() - 1) * $jadwal->perPage() + $loop->iteration }}
                                </th>
                                <td class="pl-6">
                                    {{ $item->tahunajaran->thnAjaran }}
                                </td>
                                <td class="pl-6">
                                    {{ $item->kelas->kelas }}
                                </td>
                                <td class="pl-6">
                                    {{ $item->pelajaran->nmPelajaran }}
                                </td>
                                <td class="pl-6">
                                    {{ $item->guru->namaGuru }}
                                </td>
                                <td class="pl-6 capitalize">
                                    {{ $item->hari }}
                                </td>
                                <td class="mr-3 flex flex-row items-center gap-5 2xl:m-0">
                                    <a href="{{ route('mappingjadwal.show', $item->idJadwal) }}">
                                        <x-atoms.eye :alt="'detail-mappingjadwal'" />
                                    </a>

                                    <a href="{{ route('mappingjadwal.edit', $item->idJadwal) }}">
                                        <x-atoms.pencil :alt="'edit-mappingjadwal'" />
                                    </a>

                                    <div x-data="{ show: false }">
                                        <button class="focus:outline-none" type="button" @click="show = !show">
                                            <x-atoms.trash :alt="'delete-mappingjadwal'" />
                                        </button>

                                        <x-molecules.modaldelete :title="'Apakah Anda akan menghapus Mapping Jadwal  : ' .
                                            $item->pelajaran->nmPelajaran .
                                            ' ?'" :action="route('mappingjadwal.destroy', $item->idJadwal)" />
                                    </div>

                                </td>
                            </tr>
                        </tbody>
                    @endforeach
                @endif
            </table>

            <div class="bg-white p-6">
                {{ $jadwal->links('vendor.pagination.tailwind') }}
            </div>

        </div>

    </section>

</x-layouts.app-layout>
