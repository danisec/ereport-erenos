<x-layouts.app-layout title="{{ $title }}">

    <x-organisms.header-dashboard />

    <section class="layout min-h-screen bg-hero py-6 font-rubik">

        <div class="relative overflow-x-auto rounded-2xl shadow-sm">
            <table class="w-full text-left">

                <div class="bg-white py-5 px-9">
                    <div class="flex h-14 flex-row items-center justify-between rounded-3xl bg-hero px-20">
                        <h4 class="text-2xl font-bold text-white">Data Kelas</h4>

                        <div class="flex flex-row gap-4">
                            <form class="my-4" action="" method="GET">
                                @csrf

                                @if (request('kelas'))
                                    <input name="kelas" type="hidden" value="{{ request('kelas') }}">
                                @endif

                                <x-molecules.search :placeholder="'Cari Kelas'" />
                            </form>

                            <a href="{{ URL('dashboard/kelas/tambah-kelas') }}">
                                <x-atoms.plus :alt="'tambah-kelas'" />
                            </a>

                        </div>
                    </div>
                </div>

                <thead class="border-b border-gray-200 bg-white text-base font-medium text-gray-500">
                    <tr>
                        <th class="w-16 px-9 py-3" scope="col">
                            No.
                        </th>
                        <th class="px-6 py-3" scope="col">
                            <div class="flex flex-row items-center gap-1">
                                @sortablelink('kelas', 'Kelas')

                                <x-atoms.sorting />
                            </div>
                        </th>
                        <th class="w-52 px-6 py-3" scope="col">
                            Aksi
                        </th>
                    </tr>
                </thead>

                @if ($kelas->count())
                    @foreach ($kelas as $index => $item)
                        <tbody>
                            <tr
                                class="{{ $index % 2 === 0 ? 'bg-white' : 'bg-blue-100' }} text-base font-medium leading-5">
                                <th class="px-9" scope="row">
                                    {{ ($kelas->currentPage() - 1) * $kelas->perPage() + $loop->iteration }}
                                </th>
                                <td class="pl-6">
                                    {{ $item->kelas }}
                                </td>
                                <td class="mr-3 flex flex-row items-center gap-5 2xl:m-0">
                                    <a href="{{ route('kelas.show', $item->idKelas) }}">
                                        <x-atoms.eye :alt="'detail-kelas'" />
                                    </a>

                                    <a href="{{ route('kelas.edit', $item->idKelas) }}">
                                        <x-atoms.pencil :alt="'edit-kelas'" />
                                    </a>

                                    <div x-data="{ show: false }">
                                        <button class="focus:outline-none" type="button" @click="show = !show">
                                            <x-atoms.trash :alt="'delete-kelas'" />
                                        </button>

                                        <x-molecules.modaldelete :title="'Apakah Anda akan menghapus kelas : ' . $item->kelas . ' ?'" :action="route('kelas.destroy', $item->idKelas)" />
                                    </div>

                                </td>
                            </tr>
                        </tbody>
                    @endforeach
                @endif
            </table>

            <div class="bg-white p-6">
                {{ $kelas->links('vendor.pagination.tailwind') }}
            </div>

        </div>

    </section>

</x-layouts.app-layout>
