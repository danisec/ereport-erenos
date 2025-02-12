<x-app-layout title="{{ $title }}">

    <x-header-dashboard />

    <section class="layout min-h-screen bg-hero py-6 font-rubik">

        <div class="relative overflow-x-auto rounded-2xl shadow-sm">
            <table class="w-full text-left">

                <div class="bg-white px-9 py-5">
                    <div class="flex h-14 flex-row items-center justify-between rounded-3xl bg-hero px-20">
                        <h4 class="text-2xl font-bold text-white">Data Pelajaran</h4>

                        <div class="flex flex-row gap-4">
                            <form class="my-4" action="" method="GET">
                                @csrf

                                @if (request('nmPelajaran'))
                                    <input name="nmPelajaran" type="hidden" value="{{ request('nmPelajaran') }}">
                                @endif

                                <x-molecules.search :placeholder="'Cari Pelajaran'" />
                            </form>

                            <a href="{{ URL('dashboard/pelajaran/tambah-pelajaran') }}">
                                <x-atoms.plus :alt="'tambah-pelajaran'" />
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
                                @sortablelink('kodePelajaran', 'Kode Pelajaran')

                                <x-atoms.sorting />
                            </div>
                        </th>
                        <th class="px-6 py-3" scope="col">
                            <div class="flex flex-row items-center gap-1">
                                @sortablelink('nmPelajaran', 'Nama Pelajaran')

                                <x-atoms.sorting />
                            </div>
                        </th>
                        <th class="px-6 py-3" scope="col">
                            <div class="flex flex-row items-center gap-1">
                                @sortablelink('nmSingkatan', 'Singkatan')

                                <x-atoms.sorting />
                            </div>
                        </th>
                        <th class="px-6 py-3" scope="col">
                            <div class="flex flex-row items-center gap-1">
                                @sortablelink('KKM', 'Nilai KKM')

                                <x-atoms.sorting />
                            </div>
                        </th>
                        <th class="px-6 py-3" scope="col">
                            Aksi
                        </th>
                    </tr>
                </thead>

                @if ($pelajaran->count())
                    @foreach ($pelajaran as $index => $item)
                        <tbody>
                            <tr
                                class="{{ $index % 2 === 0 ? 'bg-white' : 'bg-blue-100' }} text-base font-medium leading-5">
                                <th class="px-9" scope="row">
                                    {{ ($pelajaran->currentPage() - 1) * $pelajaran->perPage() + $loop->iteration }}
                                </th>
                                <td class="pl-6">
                                    {{ $item->kodePelajaran }}
                                </td>
                                <td class="pl-6">
                                    {{ $item->nmPelajaran }}
                                </td>
                                <td class="pl-6">
                                    {{ $item->nmSingkatan }}
                                </td>
                                <td class="pl-20">
                                    {{ $item->KKM }}
                                </td>
                                <td class="mr-3 flex flex-row items-center gap-5 2xl:m-0">
                                    <a href="{{ route('pelajaran.show', $item->kodePelajaran) }}">
                                        <x-atoms.eye :alt="'detail-pelajaran'" />
                                    </a>

                                    <a href="{{ route('pelajaran.edit', $item->kodePelajaran) }}">
                                        <x-atoms.pencil :alt="'edit-pelajaran'" />
                                    </a>

                                    <div x-data="{ show: false }">
                                        <button class="focus:outline-none" type="button" @click="show = !show">
                                            <x-atoms.trash :alt="'delete-pelajaran'" />
                                        </button>

                                        <x-molecules.modaldelete :title="'Apakah Anda akan menghapus nama pelajaran : ' .
                                            $item->nmPelajaran .
                                            ' ?'" :action="route('pelajaran.destroy', $item->kodePelajaran)" />
                                    </div>

                                </td>
                            </tr>
                        </tbody>
                    @endforeach
                @endif
            </table>

            <div class="bg-white p-6">
                {{ $pelajaran->links('vendor.pagination.tailwind') }}
            </div>

        </div>

    </section>

    </x-layouts.app-layout>
