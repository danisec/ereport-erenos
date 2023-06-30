<x-layouts.app-layout title="{{ $title }}">

    <x-organisms.header-dashboard />

    <section class="layout min-h-screen bg-hero py-6 font-rubik">

        <div class="relative overflow-x-auto rounded-2xl shadow-sm">
            <table class="w-full text-left">

                <div class="bg-white py-5 px-9">
                    <div class="flex h-14 flex-row items-center justify-between rounded-3xl bg-hero px-20">
                        <h4 class="text-2xl font-bold text-white">Data Akun</h4>

                        <div class="flex flex-row gap-4">
                            <form class="my-4" action="" method="GET">
                                @csrf

                                @if (request('name'))
                                    <input name="name" type="hidden" value="{{ request('name') }}">
                                @endif

                                <x-molecules.search :placeholder="'Cari Akun'" />
                            </form>

                            <a href="{{ route('kelolaAkun.create') }}">
                                <x-atoms.plus :alt="'tambah-akun'" />
                            </a>

                        </div>
                    </div>
                </div>

                <thead class="border-b border-gray-200 bg-white text-base font-medium text-gray-500">
                    <tr>
                        <th class="w-10 px-9 py-3" scope="col">
                            No.
                        </th>
                        <th class="py-3" scope="col">
                            <div class="flex flex-row items-center gap-1">
                                @sortablelink('name', 'Nama Lengkap')

                                <x-atoms.sorting />
                            </div>
                        </th>
                        <th class="py-3" scope="col">
                            <div class="flex flex-row items-center gap-1">
                                @sortablelink('username', 'Username')

                                <x-atoms.sorting />
                            </div>
                        </th>
                        <th class="py-3" scope="col">
                            <div class="flex flex-row items-center gap-1">
                                @sortablelink('role', 'Role')

                                <x-atoms.sorting />
                            </div>
                        </th>
                        <th class="px-6 py-3" scope="col">
                            Aksi
                        </th>
                    </tr>
                </thead>

                @if ($akun->count())
                    @foreach ($akun as $index => $item)
                        <tbody>
                            <tr
                                class="{{ $index % 2 === 0 ? 'bg-white' : 'bg-blue-100' }} text-base font-medium leading-5">
                                <th class="px-9" scope="row">
                                    {{ ($akun->currentPage() - 1) * $akun->perPage() + $loop->iteration }}
                                </th>
                                <td>
                                    {{ $item->name }}
                                </td>
                                <td>
                                    {{ $item->username }}
                                </td>
                                <td>
                                    {{ $item->role }}
                                </td>
                                <td class="mr-3 flex flex-row items-center gap-5 2xl:m-0">
                                    <a href="{{ route('kelolaAkun.show', $item->id) }}">
                                        <x-atoms.eye :alt="'detail-akun'" />
                                    </a>

                                    <a href="{{ route('kelolaAkun.edit', $item->id) }}">
                                        <x-atoms.pencil :alt="'edit-akun'" />
                                    </a>

                                    <div x-data="{ show: false }">
                                        <button class="focus:outline-none" type="button" @click="show = !show">
                                            <x-atoms.trash :alt="'delete-akun'" />
                                        </button>

                                        <x-molecules.modaldelete :title="'Apakah Anda akan menghapus nama akun : ' . $item->name . ' ?'" :action="route('kelolaAkun.destroy', $item->id)" />
                                    </div>

                                </td>
                            </tr>
                        </tbody>
                    @endforeach
                @endif
            </table>

            <div class="bg-white p-6">
                {{ $akun->links('vendor.pagination.tailwind') }}
            </div>

        </div>

    </section>

</x-layouts.app-layout>
