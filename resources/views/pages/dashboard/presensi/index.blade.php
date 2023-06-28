<x-layouts.app-layout title="{{ $title }}">

    <x-organisms.header-dashboard />

    <section class="layout min-h-screen bg-hero py-6 font-rubik">

        <div class="relative overflow-x-auto rounded-2xl shadow-sm">
            <table class="w-full text-left" id="tabelData">

                <div class="bg-white py-5 px-9">
                    <div class="flex h-14 w-80 flex-row items-center justify-between rounded-3xl bg-hero px-12">
                        <h4 class="text-2xl font-bold text-white">Presensi Siswa</h4>
                    </div>

                    <div class="flex flex-row items-center gap-12">
                        <div class="flex flex-row items-center py-6">
                            <label class="mb-2 w-16 text-xl font-medium leading-9">Kelas</label>

                            <select class="field-input-indigo w-32" id="idKelas" name="idKelas" required>
                                <option selected disabled hidden>Kelas</option>

                                @foreach ($kelas as $item)
                                    <option value="{{ $item->idKelas }}">{{ $item->kelas->kelas }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="flex flex-row items-center py-6">
                            <label class="mb-2 w-36 text-xl font-medium leading-9">Tahun Ajaran</label>

                            <select class="field-input-indigo w-52" id="idThnAjaran" name="idThnAjaran" required>
                                <option selected disabled hidden>Tahun</option>
                            </select>
                        </div>
                    </div>

                    <div class="-mt-4 flex flex-row justify-end gap-4">
                        <form class="my-4" action="" method="GET">
                            @csrf

                            @if (request('kelas'))
                                <input name="kelas" type="hidden" value="{{ request('kelas') }}" />
                            @endif

                            <x-molecules.search :placeholder="'Cari'" />
                        </form>

                        <a href="{{ URL('dashboard/presensi/tambah-presensi') }}">
                            <x-atoms.plus :alt="'tambah-presensi'" />
                        </a>
                    </div>
                </div>

                <thead class="border-b border-gray-200 bg-white text-base font-medium text-gray-500">
                    <tr>
                        <th class="w-10 px-9 py-3" scope="col">
                            No.
                        </th>
                        <th class="px-6 py-3" scope="col">
                            <div class="flex flex-row items-center gap-1">
                                @sortablelink('jadwal.idKelas', 'Kelas')

                                <x-atoms.sorting />
                            </div>
                        </th>
                        <th class="px-6 py-3" scope="col">
                            <div class="flex flex-row items-center gap-1">
                                @sortablelink('tanggal', 'Tanggal')

                                <x-atoms.sorting />
                            </div>
                        </th>
                        <th class="px-6 py-3" scope="col">
                            <div class="flex flex-row items-center gap-1">
                                @sortablelink('jadwal.idPelajaran', 'Pelajaran')

                                <x-atoms.sorting />
                            </div>
                        </th>
                        <th class="px-6 py-3" scope="col">
                            <div class="flex flex-row items-center gap-1">
                                @sortablelink('jadwal.NIP', 'Guru')

                                <x-atoms.sorting />
                            </div>
                        </th>
                        <th class="px-6 py-3" scope="col">
                            Aksi
                        </th>
                    </tr>
                </thead>

                @if ($presensi->count())
                    @foreach ($presensi as $index => $item)
                        <tbody>
                            <tr
                                class="{{ $index % 2 === 0 ? 'bg-white' : 'bg-blue-100' }} text-base font-medium leading-5">
                                <th class="px-9" scope="row">
                                    {{ ($presensi->currentPage() - 1) * $presensi->perPage() + $loop->iteration }}
                                </th>
                                <td class="pl-6">
                                    {{ $item->jadwal->kelas->kelas }}
                                </td>
                                <td class="pl-6">
                                    {{ $item->tanggal }}
                                </td>
                                <td class="pl-6">
                                    {{ $item->jadwal->pelajaran->nmPelajaran }}
                                </td>
                                <td class="pl-6">
                                    {{ $item->jadwal->guru->namaGuru }}
                                </td>
                                <td class="mr-3 flex flex-row items-center gap-5 2xl:m-0">
                                    <a href="{{ route('presensi.show', $item->idKehadiran) }}">
                                        <x-atoms.eye :alt="'detail-presensi'" />
                                    </a>

                                    <a href="{{ route('presensi.edit', $item->idKehadiran) }}">
                                        <x-atoms.pencil :alt="'edit-presensi'" />
                                    </a>

                                    <div x-data="{ show: false }">
                                        <button class="focus:outline-none" type="button" @click="show = !show">
                                            <x-atoms.trash :alt="'delete-presensi'" />
                                        </button>

                                        <x-molecules.modaldelete :title="'Apakah Anda akan menghapus Presensi tanggal ' .
                                            $item->tanggal .
                                            ' untuk pelajaran : ' .
                                            $item->jadwal->pelajaran->nmPelajaran .
                                            ' ?'" :action="route('presensi.destroy', $item->idKehadiran)" />
                                    </div>

                                </td>
                            </tr>
                        </tbody>
                    @endforeach
                @endif
            </table>

            <div class="bg-white p-6">
                {{ $presensi->links('vendor.pagination.tailwind') }}
            </div>

        </div>

    </section>

</x-layouts.app-layout>
