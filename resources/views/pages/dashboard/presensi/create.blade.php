<x-layouts.app-layout title="{{ $title }}">

    <x-organisms.header-dashboard />

    <section class="layout min-h-screen bg-hero py-6 font-rubik">
        <div class="w-full rounded-2xl bg-white py-5 shadow-sm">

            <div class="w-6/12 rounded-r-2xl bg-hero py-2">
                <h4 class="text-gray-9000 px-11 text-2xl font-bold text-white">Menambah Presensi Siswa</h4>
            </div>

            <form class="flex flex-col gap-6 px-11 pt-9" action="{{ route('presensi.store') }}" method="post">
                @csrf

                <div class="flex flex-row items-start gap-14">

                    <div class="flex flex-col gap-1">
                        <div class="flex flex-col gap-1">
                            <input id="idJadwal" name="idJadwal" type="hidden">
                            <div class="flex flex-row items-center">
                                <label class="mb-2 w-36 text-xl font-medium leading-9">Tahun Ajaran</label>
                                <p class="mb-2 w-8 text-xl font-medium leading-9">:</p>

                                <select class="field-input-indigo w-64" id="idThnAjaran" name="idThnAjaran" required>
                                    <option selected disabled hidden>Tahun Ajaran</option>
                                    @foreach ($tahunAjaran as $item)
                                        <option value="{{ $item->idThnAjaran }}">
                                            {{ $item->tahunajaran->thnAjaran }} - {{ $item->tahunajaran->semester }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="flex flex-row items-center">
                                <label class="mb-2 w-36 text-xl font-medium leading-9">Kelas</label>
                                <p class="mb-2 w-8 text-xl font-medium leading-9">:</p>

                                <select class="field-input-indigo w-64" id="idKelas" name="idKelas" required>
                                    <option selected disabled hidden>Kelas</option>
                                </select>
                            </div>
                        </div>

                        <div class="flex flex-col gap-1">
                            <div class="flex flex-row items-center">
                                <label class="mb-2 w-36 text-xl font-medium leading-9">Tanggal</label>
                                <p class="mb-2 w-8 text-xl font-medium leading-9">:</p>

                                <input class="field-input-indigo w-64" id="datetime" name="tanggal"
                                    type="datetime-local" required />
                            </div>

                            @error('tanggal')
                                <p class="invalid-feedback ml-52">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>

                    <div class="flex flex-col gap-1">
                        <div class="flex flex-col gap-1">
                            <div class="flex flex-row items-center">
                                <label class="mb-2 w-28 text-xl font-medium leading-9">Pelajaran</label>
                                <p class="mb-2 w-8 text-xl font-medium leading-9">:</p>

                                <select class="field-input-indigo w-72" id="idPelajaran" name="idPelajaran" required>
                                    <option selected disabled hidden>Pelajaran</option>
                                </select>
                            </div>
                        </div>

                        <div class="flex flex-col gap-1">
                            <div class="flex flex-row items-center">
                                <label class="mb-2 w-28 text-xl font-medium leading-9">Guru</label>
                                <p class="mb-2 w-8 text-xl font-medium leading-9">:</p>

                                <input
                                    class="w-72 rounded-md border-gray-200 bg-gray-400/60 px-3 py-1 text-lg text-white placeholder:text-white focus:outline-none"
                                    id="namaGuru" name="NIP" placeholder="Guru" required
                                    @disabled(true) @readonly(true) />
                                </input>
                            </div>

                            @error('NIP')
                                <p class="invalid-feedback ml-52">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>

                </div>

                <div class="sticky top-0 hidden" id="scroll-button">
                    <div class="absolute right-16 flex flex-col gap-72">

                        <x-molecules.scroll-top class="mt-24 focus:outline-none" />

                        <x-molecules.scroll-bottom class="focus:outline-none" />

                    </div>
                </div>

                <div>
                    <table class="w-full text-left" id="siswaTable">

                        <thead class="bg-hero text-base font-medium text-gray-500" id="table-mapping">
                            <tr>
                                <th class="w-10 px-6 py-3 text-white" scope="col">
                                    No.
                                </th>
                                <th class="py-3 pl-14 text-white" scope="col">
                                    <div class="flex flex-row items-center gap-1">
                                        @sortablelink('NIS', 'NIS')

                                        <x-atoms.sorting />
                                    </div>
                                </th>
                                <th class="px-6 py-3 text-white" scope="col">
                                    <div class="flex flex-row items-center gap-1">
                                        @sortablelink('nmSiswa', 'NAMA')

                                        <x-atoms.sorting />
                                    </div>
                                </th>
                                <th class="w-96 py-3 text-center text-white" scope="col">
                                    STATUS
                                </th>
                            </tr>
                        </thead>

                        <input name="idKehadiran" type="hidden">
                        <tbody>
                        </tbody>

                    </table>
                </div>

                <div class="mt-6 flex flex-row items-center justify-center gap-40">
                    <button
                        class="rounded-sm bg-cyan-300 px-10 py-3 text-center text-sm font-normal shadow-xl shadow-gray-300">Submit</button>

                    <a class="rounded-sm bg-cyan-300 px-10 py-3 text-center text-sm font-normal shadow-xl shadow-gray-300"
                        href="{{ URL('dashboard/presensi') }}">Cancel</a>
                </div>

            </form>

        </div>

    </section>

</x-layouts.app-layout>
