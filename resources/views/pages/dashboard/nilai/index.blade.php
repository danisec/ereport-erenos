<x-app-layout title="{{ $title }}">

    <x-header-dashboard />

    <section class="layout min-h-screen bg-hero py-6 font-rubik">

        <div class="relative overflow-x-auto rounded-2xl shadow-sm">
            <table class="w-full text-left">

                <div class="bg-white px-9 py-5">
                    <div class="flex h-14 flex-row items-center justify-between rounded-3xl bg-hero px-20">
                        <h4 class="text-2xl font-bold text-white">Data Nilai</h4>

                        <div class="flex flex-row gap-4">
                            <form class="my-4" action="" method="GET">
                                @csrf

                                @if (request('nilai'))
                                    <input name="nilai" type="hidden" value="{{ request('nilai') }}">
                                @endif

                                <x-molecules.search :placeholder="'Cari Nilai'" />
                            </form>

                            <a href="{{ route('nilai.create') }}">
                                <x-atoms.plus :alt="'tambah-nilai'" />
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
                                @sortablelink('idKelas', 'Kelas')

                                <x-atoms.sorting />
                            </div>
                        </th>
                        <th class="px-6 py-3" scope="col">
                            <div class="flex flex-row items-center gap-1">
                                @sortablelink('idMateri', 'Pelajaran')

                                <x-atoms.sorting />
                            </div>
                        </th>
                        <th class="flex justify-end px-6 py-3" scope="col">
                            <div class="flex flex-row items-center gap-1">
                                @sortablelink('idMateri', 'Materi')

                                <x-atoms.sorting />
                            </div>
                        </th>
                        <th class="px-6 py-3" scope="col">
                            <div class="flex flex-row items-center gap-1">
                                @sortablelink('aspek', 'Aspek')

                                <x-atoms.sorting />
                            </div>
                        </th>
                        <th class="px-6 py-3" scope="col">
                            <div class="flex flex-row items-center gap-1">
                                @sortablelink('jenis', 'jenis')

                                <x-atoms.sorting />
                            </div>
                        </th>
                        <th class="px-6 py-3" scope="col">
                            Aksi
                        </th>
                    </tr>
                </thead>

                @if ($nilai->count())
                    @foreach ($nilai as $index => $item)
                        <tbody>
                            <tr
                                class="{{ $index % 2 === 0 ? 'bg-white' : 'bg-blue-100' }} text-base font-medium leading-5">
                                <th class="px-9" scope="row">
                                    {{ ($nilai->currentPage() - 1) * $nilai->perPage() + $loop->iteration }}
                                </th>
                                <td class="pl-6">
                                    {{ $item->kelas->kelas }}
                                </td>
                                <td class="pl-6">
                                    {{ $item->materi->pelajaran->nmPelajaran }}
                                </td>
                                <td class="w-64 pl-6">
                                    {{ Str::limit($item->materi->materi, 50) }}
                                </td>
                                <td class="pl-6">
                                    {{ $item->aspek }}
                                </td>
                                <td class="pl-6">
                                    {{ $item->jenis }}
                                </td>
                                <td class="mr-3 flex flex-row items-center gap-5 2xl:m-0">
                                    <a href="{{ route('nilai.show', $item->idNilai) }}">
                                        <x-atoms.eye :alt="'detail-nilai'" />
                                    </a>

                                    <a href="{{ route('nilai.edit', $item->idNilai) }}">
                                        <x-atoms.pencil :alt="'edit-nilai'" />
                                    </a>

                                    <div x-data="{ show: false }">
                                        <button class="focus:outline-none" type="button" @click="show = !show">
                                            <x-atoms.trash :alt="'delete-nilai'" />
                                        </button>

                                        <x-molecules.modaldelete :title="'Apakah Anda akan menghapus Nilai Kelas : ' .
                                            $item->kelas->kelas .
                                            ' ?'" :action="route('nilai.destroy', $item->idNilai)" />
                                    </div>

                                </td>
                            </tr>
                        </tbody>
                    @endforeach
                @endif
            </table>

            <div class="bg-white p-6">
                {{ $nilai->links('vendor.pagination.tailwind') }}
            </div>

        </div>

    </section>

    </x-layouts.app-layout>
