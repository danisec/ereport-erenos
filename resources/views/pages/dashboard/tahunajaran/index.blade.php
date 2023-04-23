<x-layouts.app-layout title="{{ $title }}">

    <x-organisms.header-dashboard />

    <section class="layout min-h-screen bg-hero py-14 font-rubik">

        <div class="relative overflow-x-auto rounded-2xl shadow-sm">
            <table class="w-full text-left">

                <div class="bg-white py-5 px-9">
                    <div class="flex h-14 flex-row items-center justify-between rounded-3xl bg-hero px-20">
                        <h4 class="text-2xl font-bold text-white">Tahun Ajaran</h4>

                        <div class="flex flex-row gap-4">
                            <form class="my-4" action="" method="GET">
                                @csrf

                                @if (request('thnAjaran'))
                                    <input name="thnAjaran" type="hidden" value="{{ request('thnAjaran') }}">
                                @endif

                                <x-molecules.search :placeholder="'Cari Tahun'" />
                            </form>

                            <a href="{{ URL('dashboard/tahunajaran/tambah-tahunajaran') }}">
                                <x-atoms.plus :alt="'tambah-tahunajaran'" />
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
                                @sortablelink('thnAjaran', 'Tahun Ajaran')

                                <x-atoms.sorting />
                            </div>
                        </th>
                        <th class="px-6 py-3" scope="col">
                            <div class="flex flex-row items-center gap-1">
                                @sortablelink('semester', 'semester')

                                <x-atoms.sorting />
                            </div>
                        </th>
                        <th class="w-52 px-6 py-3" scope="col">
                            Aksi
                        </th>
                    </tr>
                </thead>

                @if ($tahunajaran->count())
                    @foreach ($tahunajaran as $item)
                        <tbody>
                            <tr class="bg-white text-base font-medium leading-5 hover:bg-gray-50">
                                <th class="py-4 px-9" scope="row">
                                    {{ ($tahunajaran->currentPage() - 1) * $tahunajaran->perPage() + $loop->iteration }}
                                </th>
                                <td class="py-4 pl-6">
                                    {{ $item->thnAjaran }}
                                </td>
                                <td class="py-4 pl-6">
                                    {{ $item->semester }}
                                </td>
                                <td class="mr-3 flex flex-row items-center gap-5 py-4 2xl:m-0">
                                    <a href="{{ route('tahunajaran.show', $item->idThnAjaran) }}">
                                        <x-atoms.eye :alt="'detail-tahunajaran'" />
                                    </a>

                                    <a href="{{ route('tahunajaran.edit', $item->idThnAjaran) }}">
                                        <x-atoms.pencil :alt="'edit-tahunajaran'" />
                                    </a>

                                    <div x-data="{ show: false }">
                                        <button class="focus:outline-none" type="button" @click="show = !show">
                                            <x-atoms.trash :alt="'delete-tahunajaran'" />
                                        </button>

                                        <x-molecules.modaldelete :title="'Apakah Anda akan menghapus tahun ajaran : ' .
                                            $item->thnAjaran .
                                            ' ?'" :action="route('tahunajaran.destroy', $item->idThnAjaran)" />
                                    </div>

                                </td>
                            </tr>
                        </tbody>
                    @endforeach
                @endif
            </table>

            <div class="bg-white p-6">
                {{ $tahunajaran->links('vendor.pagination.tailwind') }}
            </div>

        </div>

    </section>

</x-layouts.app-layout>
