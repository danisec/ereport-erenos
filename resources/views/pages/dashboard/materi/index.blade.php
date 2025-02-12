<x-app-layout title="{{ $title }}">

    <x-header-dashboard />

    <section class="layout min-h-screen bg-hero py-6 font-rubik">

        <div class="relative overflow-x-auto rounded-2xl shadow-sm">
            <table class="w-full text-left">

                <div class="bg-white px-9 py-5">
                    <div class="flex h-14 flex-row items-center justify-between rounded-3xl bg-hero px-20">
                        <h4 class="text-2xl font-bold text-white">Data Materi</h4>

                        <div class="flex flex-row gap-4">
                            <form class="my-4" action="" method="GET">
                                @csrf

                                @if (request('materi'))
                                    <input name="materi" type="hidden" value="{{ request('materi') }}">
                                @endif

                                <x-molecules.search :placeholder="'Cari Materi'" />
                            </form>

                            <a href="{{ route('materi.create') }}">
                                <x-atoms.plus :alt="'tambah-materi'" />
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
                                @sortablelink('materi', 'Materi')

                                <x-atoms.sorting />
                            </div>
                        </th>
                        <th class="px-6 py-3" scope="col">
                            <div class="flex flex-row items-center gap-1">
                                @sortablelink('idPelajaran', 'Nama Pelajaran')

                                <x-atoms.sorting />
                            </div>
                        </th>
                        <th class="px-6 py-3" scope="col">
                            Aksi
                        </th>
                    </tr>
                </thead>

                @if ($materi->count())
                    @foreach ($materi as $index => $item)
                        <tbody>
                            <tr
                                class="{{ $index % 2 === 0 ? 'bg-white' : 'bg-blue-100' }} text-base font-medium leading-5">
                                <th class="px-9" scope="row">
                                    {{ ($materi->currentPage() - 1) * $materi->perPage() + $loop->iteration }}
                                </th>
                                <td class="pl-6">
                                    {{ Str::limit($item->materi, 50) }}
                                </td>
                                <td class="pl-6">
                                    {{ $item->pelajaran->nmPelajaran }}
                                </td>
                                <td class="mr-3 flex flex-row items-center gap-5 2xl:m-0">
                                    <a href="{{ route('materi.show', $item->idPelajaran) }}">
                                        <x-atoms.eye :alt="'detail-materi'" />
                                    </a>

                                    <a href="{{ route('materi.edit', $item->idPelajaran) }}">
                                        <x-atoms.pencil :alt="'edit-materi'" />
                                    </a>

                                    <div x-data="{ show: false }">
                                        <button class="focus:outline-none" type="button" @click="show = !show">
                                            <x-atoms.trash :alt="'delete-materi'" />
                                        </button>

                                        <x-molecules.modaldelete :title="'Apakah Anda akan menghapus materi : ' . $item->materi . ' ?'" :action="route('materi.destroy', $item->idMateri)" />
                                    </div>

                                </td>
                            </tr>
                        </tbody>
                    @endforeach
                @endif
            </table>

            <div class="bg-white p-6">
                {{ $materi->links('vendor.pagination.tailwind') }}
            </div>

        </div>

    </section>

    </x-layouts.app-layout>
