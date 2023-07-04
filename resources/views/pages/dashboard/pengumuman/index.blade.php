<x-layouts.app-layout title="{{ $title }}">

    <x-organisms.header-dashboard />

    <section class="layout min-h-screen bg-hero py-6 font-rubik">

        <div class="relative overflow-x-auto rounded-2xl shadow-sm">
            <table class="w-full text-left">

                <div class="bg-white py-5 px-9">
                    <div class="flex h-14 flex-row items-center justify-between rounded-3xl bg-hero px-20">
                        <h4 class="text-2xl font-bold text-white">Data Pengumuman</h4>

                        <div class="flex flex-row gap-4">
                            <form class="my-4" action="" method="GET">
                                @csrf

                                @if (request('namaPengumuman'))
                                    <input name="namaPengumuman" type="hidden" value="{{ request('namaPengumuman') }}">
                                @endif

                                <x-molecules.search :placeholder="'Cari Pengumuman'" />
                            </form>

                            <a href="{{ route('pengumuman.create') }}">
                                <x-atoms.plus :alt="'tambah-pengumuman'" />
                            </a>

                        </div>
                    </div>
                </div>

                <thead class="border-b border-gray-200 bg-white text-base font-medium text-gray-500">
                    <tr>
                        <th class="w-10 px-9 py-3" scope="col">
                            No.
                        </th>
                        <th class="w-96 py-3" scope="col">
                            <div class="flex flex-row items-center gap-1">
                                @sortablelink('namaPengumuman', 'Nama Pengumuman')

                                <x-atoms.sorting />
                            </div>
                        </th>
                        <th class="px-6 py-3" scope="col">
                            <div class="flex flex-row items-center gap-1">
                                @sortablelink('pengumuman', 'Pengumuman')

                                <x-atoms.sorting />
                            </div>
                        </th>
                        <th class="w-44 py-3 px-12" scope="col">
                            Aksi
                        </th>
                    </tr>
                </thead>

                @if ($pengumuman->count())
                    @foreach ($pengumuman as $index => $item)
                        <tbody>
                            <tr
                                class="{{ $index % 2 === 0 ? 'bg-white' : 'bg-blue-100' }} text-base font-medium leading-5">
                                <th class="px-9" scope="row">
                                    {{ ($pengumuman->currentPage() - 1) * $pengumuman->perPage() + $loop->iteration }}
                                </th>
                                <td>
                                    {{ $item->namaPengumuman }}
                                </td>
                                <td class="px-6">
                                    {!! Str::limit(strip_tags($item->pengumuman), 100) !!}
                                </td>
                                <td class="flex flex-row items-center gap-5 2xl:m-0">
                                    <a href="{{ route('pengumuman.show', $item->idPengumuman) }}">
                                        <x-atoms.eye :alt="'detail-pengumuman'" />
                                    </a>

                                    <a href="{{ route('pengumuman.edit', $item->idPengumuman) }}">
                                        <x-atoms.pencil :alt="'edit-pengumuman'" />
                                    </a>

                                    <div x-data="{ show: false }">
                                        <button class="focus:outline-none" type="button" @click="show = !show">
                                            <x-atoms.trash :alt="'delete-pengumuman'" />
                                        </button>

                                        <x-molecules.modaldelete :title="'Apakah Anda akan menghapus Nama Pengumuman : ' .
                                            $item->namaPengumuman .
                                            ' ?'" :action="route('pengumuman.destroy', $item->idPengumuman)" />
                                    </div>

                                </td>
                            </tr>
                        </tbody>
                    @endforeach
                @endif
            </table>

            <div class="bg-white p-6">
                {{ $pengumuman->links('vendor.pagination.tailwind') }}
            </div>

        </div>

    </section>

</x-layouts.app-layout>
