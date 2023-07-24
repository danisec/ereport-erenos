<x-layouts.app-layout title="{{ $title }}">

    <x-organisms.header-dashboard />

    <section class="layout min-h-screen bg-hero py-6 font-rubik">
        <div class="w-full rounded-2xl bg-white py-5 shadow-sm">

            <div class="w-6/12 rounded-r-2xl bg-hero py-2">
                <h4 class="text-gray-9000 px-11 text-2xl font-bold text-white">View Nilai</h4>
            </div>

            <div class="flex flex-col gap-3 px-11 pt-9">

                <div class="flex flex-col gap-1">

                    <div class="flex flex-row items-center gap-36">
                        <div class="flex flex-row items-center">
                            <label class="mb-2 w-36 text-xl font-medium leading-9">Tahun Ajaran</label>

                            <input class="field-input-gray w-48" name="idSemester"
                                value="{{ $nilai->semester->tahunajaran->thnAjaran }} - {{ $nilai->semester->semester }}"
                                required @disabled(true) @readonly(true) />
                        </div>

                        <div class="flex flex-row items-center">
                            <label class="mb-2 w-28 text-xl font-medium leading-9">Tanggal</label>

                            <input class="field-input-gray w-48" name="tanggal" value="{{ $nilai->tanggal }}" required
                                @disabled(true) @readonly(true) />
                        </div>
                    </div>

                </div>

                <div class="flex flex-row items-center">
                    <label class="mb-2 w-36 text-xl font-medium leading-9">Kelas</label>

                    <input class="field-input-gray w-48" name="idKelas" value="{{ $nilai->kelas->kelas }}" required
                        @disabled(true) @readonly(true) />
                </div>

                <div class="flex flex-row items-center">
                    <label class="mb-2 w-36 text-xl font-medium leading-9">Pelajaran</label>

                    <input class="field-input-gray w-96" name="idPelajaran"
                        value="{{ $nilai->materi->pelajaran->nmPelajaran }}" required @disabled(true)
                        @readonly(true) />
                </div>

                <div class="flex flex-row items-center">
                    <label class="mb-2 w-36 text-xl font-medium leading-9">Materi</label>

                    <input class="field-input-gray w-96" name="idMateri" value="{{ $nilai->materi->materi }}" required
                        @disabled(true) @readonly(true) />
                </div>

                <div class="flex flex-row items-center">
                    <label class="mb-2 w-36 text-xl font-medium leading-9">Aspek</label>

                    <input class="field-input-gray w-48" name="aspek" value="{{ $nilai->aspek }}" required
                        @disabled(true) @readonly(true) />
                </div>

                <div class="flex flex-row items-center">
                    <label class="mb-2 w-36 text-xl font-medium leading-9">Jenis</label>

                    <input class="field-input-gray w-48" name="jenis" value="{{ $nilai->jenis }}" required
                        @disabled(true) @readonly(true) />
                </div>

                <div>
                    <table class="w-full text-left" id="table">

                        <thead class="bg-hero text-base font-medium text-gray-500" id="table-mapping">
                            <tr>
                                <th class="w-10 px-6 py-3 text-white" scope="col">
                                    No.
                                </th>
                                <th class="py-3 pl-3 text-white" scope="col">
                                    NIS
                                </th>
                                <th class="py-3 pl-3 text-white" scope="col">
                                    Siswa
                                </th>
                                <th class="py-3 pl-3 text-white" scope="col">
                                    Nilai
                                </th>
                            </tr>
                        </thead>

                        @if ($nilaiSiswa->count())
                            @foreach ($nilaiSiswa as $item)
                                <tbody>
                                    <tr class="bg-white text-base font-medium leading-5 hover:bg-gray-50">
                                        <th class="px-9" scope="row"> {{ $loop->iteration }}</th>
                                        <td class="pl-3">
                                            <input
                                                class="field-input-gray nis-dropdown text-md nilai-input w-40 font-normal"
                                                name="NIS[]" value="{{ $item->siswa->NIS }}" required
                                                @disabled(true) @readonly(true) />
                                        </td>
                                        <td class="pl-3">
                                            <input class="field-input-gray text-md nilai-input w-72 font-normal"
                                                name="nmSiswa[]" value="{{ $item->siswa->nmSiswa }}" required
                                                @disabled(true) @readonly(true) />
                                        </td>
                                        <td class="pl-3">
                                            <input class="field-input-gray text-md nilai-input w-40 font-normal"
                                                name="nilai[]" value="{{ $item->nilai }}" required
                                                @disabled(true) @readonly(true) />
                                        </td>
                                    </tr>
                                </tbody>
                            @endforeach
                        @endif

                    </table>
                </div>

                <div class="mt-6 flex flex-row items-center justify-center">
                    <a class="rounded-sm bg-cyan-300 px-10 py-3 text-center text-sm font-normal shadow-xl shadow-gray-300"
                        href="{{ route('nilai.index') }}">Back</a>
                </div>
            </div>

        </div>

    </section>

</x-layouts.app-layout>
