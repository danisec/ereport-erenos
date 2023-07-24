<x-layouts.app-layout title="{{ $title }}">

    <x-organisms.header-dashboard />

    <section class="layout min-h-screen bg-hero py-6 font-rubik">

        <div class="relative overflow-x-auto rounded-2xl shadow-sm">
            <table class="w-full text-left">

                <div class="bg-white px-9 py-5">
                    <div class="flex h-14 flex-row items-center justify-between rounded-3xl bg-hero px-20">
                        <h4 class="text-2xl font-bold text-white">Data Mapping Kelas - Siswa</h4>

                        <div class="flex flex-row gap-4">
                            <form class="my-4" action="" method="GET">
                                @csrf

                                @if (request('kelas'))
                                    <input name="kelas" type="hidden" value="{{ request('kelas') }}">
                                @endif

                                <x-molecules.search :placeholder="'Cari Map'" />
                            </form>

                            <a href="{{ URL('dashboard/mappingkelas/tambah-mappingkelas') }}">
                                <x-atoms.plus :alt="'tambah-mappingkelas'" />
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
                                @sortablelink('NIP', 'Wali Kelas')

                                <x-atoms.sorting />
                            </div>
                        </th>
                        <th class="w-52 px-6 py-3" scope="col">
                            Aksi
                        </th>
                    </tr>
                </thead>

                @if ($mappingkelas->count())
                    @foreach ($mappingkelas as $index => $item)
                        <tbody>
                            <tr
                                class="{{ $index % 2 === 0 ? 'bg-white' : 'bg-blue-100' }} text-base font-medium leading-5">
                                <th class="px-9" scope="row">
                                    {{ ($mappingkelas->currentPage() - 1) * $mappingkelas->perPage() + $loop->iteration }}
                                </th>
                                <td class="pl-6">
                                    {{ $item->tahunajaran->thnAjaran }}
                                </td>
                                <td class="pl-6">
                                    {{ $item->kelas->kelas }}
                                </td>
                                <td class="pl-6">
                                    {{ $item->guru->namaGuru }}
                                </td>
                                <td class="mr-3 flex flex-row items-center gap-5 2xl:m-0">
                                    <a href="{{ route('mappingkelas.show', $item->idMapping) }}">
                                        <x-atoms.eye :alt="'detail-mappingkelas'" />
                                    </a>

                                    <a href="{{ route('mappingkelas.edit', $item->idMapping) }}">
                                        <x-atoms.pencil :alt="'edit-mappingkelas'" />
                                    </a>

                                    <div x-data="{ show: false }">
                                        <button class="focus:outline-none" type="button" @click="show = !show">
                                            <x-atoms.trash :alt="'delete-mappingkelas'" />
                                        </button>

                                        <x-molecules.modaldelete :title="'Apakah Anda akan menghapus map siswa : ' .
                                            $item->kelas->kelas .
                                            ' ?'" :action="route('mappingkelas.destroykelas', $item->idMapping)" />
                                    </div>

                                </td>
                            </tr>
                        </tbody>
                    @endforeach
                @endif
            </table>

            <div class="bg-white p-6">
                {{ $mappingkelas->links('vendor.pagination.tailwind') }}
            </div>

        </div>

    </section>

</x-layouts.app-layout>
