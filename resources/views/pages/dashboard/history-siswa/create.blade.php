<x-app-layout title="{{ $title }}">

    <x-header-dashboard />

    <section class="layout min-h-screen bg-hero py-6 font-rubik">
        <div class="w-full rounded-2xl bg-white py-5 shadow-sm">

            <div class="w-6/12 rounded-r-2xl bg-hero py-2">
                <h4 class="text-gray-9000 px-11 text-2xl font-bold text-white">Menambah Data History Siswa</h4>
            </div>

            <form class="flex flex-col gap-3 px-11 pt-9" action="{{ route('historysiswa.store') }}" method="post">
                @csrf

                <div class="flex flex-col gap-1">
                    <div class="flex flex-row items-center">
                        <label class="mb-2 w-44 text-xl font-medium leading-9">Tahun Ajaran</label>

                        <select class="field-input-indigo w-64" id="idThnAjaran" name="idSemester" required>
                            <option selected disabled hidden>Tahun Ajaran</option>
                            @foreach ($semester as $item)
                                <option value="{{ $item->idSemester }}">
                                    {{ $item->tahunajaran->thnAjaran . ' - ' . $item->semester }}</option>
                            @endforeach
                        </select>
                    </div>

                    @error('idSemester')
                        <p class="invalid-feedback ml-44">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="flex flex-col gap-1">
                    <div class="flex flex-row items-center">
                        <label class="mb-2 w-44 text-xl font-medium leading-9">Kelas</label>

                        <select class="field-input-indigo w-64" id="idKelas" name="idKelas" required>
                            <option selected disabled hidden>Kelas</option>
                        </select>
                    </div>

                    @error('idKelas')
                        <p class="invalid-feedback ml-44">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="flex flex-col gap-1">
                    <div class="flex flex-row items-center">
                        <label class="mb-2 w-44 text-xl font-medium leading-9">Nama Siswa</label>

                        <select class="field-input-indigo w-64" id="NIS" name="NIS" required>
                            <option selected disabled hidden>Siswa</option>
                        </select>
                    </div>

                    @error('NIS')
                        <p class="invalid-feedback ml-44">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="flex flex-row justify-end">
                    <button
                        class="add-history-btn flex flex-row items-center rounded-md bg-cyan-300 px-2 py-1 shadow-lg shadow-gray-300 focus:outline-none"
                        id="add" type="button">
                        <p class="text-center text-xl font-normal">Tambah</p>
                        <x-atoms.plus :alt="'tambah-history'" />
                    </button>
                </div>

                <div>
                    <table class="w-full text-left" id="table">

                        <thead class="bg-hero text-base font-medium text-gray-500" id="table-mapping">
                            <tr>
                                <th class="w-10 px-6 py-3 text-white" scope="col">
                                    No.
                                </th>
                                <th class="py-3 pl-3 text-white" scope="col">
                                    Deskripsi
                                </th>
                                <th class="w-32 py-3 text-center text-white" scope="col">
                                    Aksi
                                </th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr class="bg-white text-base font-medium leading-5 hover:bg-gray-50">
                                <th class="px-9" scope="row">1</th>
                                <td class="pl-3">
                                    <textarea class="field-input-indigo keterangan-input text-md w-[55rem] font-normal" name="keterangan[]" rows="1"
                                        placeholder="Deskripsi History" required></textarea>
                                </td>
                                <td class="w-10 text-center">
                                    <button class="delete-history-btn focus:outline-none" type="button">
                                        <x-atoms.trash :alt="'hapus-keterangan'" />
                                    </button>
                                </td>
                            </tr>
                        </tbody>

                    </table>
                </div>

                <div class="flex flex-row items-center gap-14 py-3">
                    <button
                        class="ml-64 rounded-sm bg-cyan-300 px-10 py-3 text-center text-sm font-normal shadow-xl shadow-gray-300">Submit</button>

                    <a class="rounded-sm bg-cyan-300 px-10 py-3 text-center text-sm font-normal shadow-xl shadow-gray-300"
                        href="{{ route('historysiswa.index') }}">Cancel</a>
                </div>
            </form>

        </div>

    </section>

</x-app-layout>
