<x-app-layout title="{{ $title }}">

    <x-header-dashboard />

    <section class="layout min-h-screen bg-hero py-6 font-rubik">
        <div class="w-full rounded-2xl bg-white py-5 shadow-sm">

            <div class="w-6/12 rounded-r-2xl bg-hero py-2">
                <h4 class="text-gray-9000 px-11 text-2xl font-bold text-white">Menambah Nilai</h4>
            </div>

            <form class="flex flex-col gap-3 px-11 pt-9" action="{{ route('nilai.store') }}" method="post">
                @csrf

                <div class="flex flex-col gap-1">

                    <input name="NIP" type="hidden" value="{{ Auth::user()->NIP }}">

                    <div class="flex flex-row items-center gap-36">
                        <div class="flex flex-row items-center">
                            <label class="mb-2 w-36 text-xl font-medium leading-9">Tahun Ajaran</label>

                            <select class="field-input-indigo w-48" id="idThnAjaran" name="idSemester" required>
                                <option selected disabled hidden>Tahun</option>

                                @foreach ($semester as $item)
                                    <option value="{{ $item->idSemester }}">{{ $item->tahunajaran->thnAjaran }} -
                                        {{ $item->semester }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="flex flex-row items-center">
                            <label class="mb-2 w-28 text-xl font-medium leading-9">Tanggal</label>

                            <input class="field-input-indigo w-48" id="date" name="tanggal" type="date"
                                required />
                        </div>
                    </div>

                    @error('idSemester')
                        <p class="invalid-feedback ml-36">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="flex flex-col">
                    <div class="flex flex-row">
                        <label class="mb-2 w-36 text-xl font-medium leading-9">Kelas</label>

                        <select class="field-input-indigo w-48" id="idKelas" name="idKelas" required>
                            <option selected disabled hidden>Kelas</option>
                        </select>
                    </div>

                    @error('idKelas')
                        <p class="invalid-feedback ml-36">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="flex flex-row items-center">
                    <label class="mb-2 w-36 text-xl font-medium leading-9">Pelajaran</label>

                    <select class="field-input-indigo w-96" id="pelajaran" name="idPelajaran" required>
                        <option selected disabled hidden>Pelajaran</option>
                        @foreach ($pelajaran as $item)
                            <option value="{{ $item->idPelajaran }}">{{ $item->nmPelajaran }}</option>
                        @endforeach
                    </select>

                    @error('idPelajaran')
                        <p class="invalid-feedback ml-36">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="flex flex-col">
                    <div class="flex flex-row">
                        <label class="mb-2 w-36 text-xl font-medium leading-9">Materi</label>

                        <select class="field-input-indigo w-96" id="materi" name="idMateri" required>
                            <option selected disabled hidden>Materi</option>
                            @foreach ($materi as $item)
                                <option value="{{ $item->idMateri }}">{{ $item->materi }}</option>
                            @endforeach
                        </select>
                    </div>

                    @error('idMateri')
                        <p class="invalid-feedback ml-36">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="flex flex-col">
                    <div class="flex flex-row">
                        <label class="mb-2 w-36 text-xl font-medium leading-9">Aspek</label>

                        <select class="field-input-indigo w-48" name="aspek" required>
                            <option selected disabled hidden>Aspek</option>
                            @foreach ($aspek as $item)
                                <option value="{{ $item }}">{{ $item }}</option>
                            @endforeach
                        </select>
                    </div>

                    @error('aspek')
                        <p class="invalid-feedback ml-36">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="flex flex-col">
                    <div class="flex flex-row">
                        <label class="mb-2 w-36 text-xl font-medium leading-9">Jenis</label>

                        <select class="field-input-indigo w-48" name="jenis" required>
                            <option selected disabled hidden>Jenis</option>
                            @foreach ($jenis as $item)
                                <option value="{{ $item }}">{{ $item }}</option>
                            @endforeach
                        </select>
                    </div>

                    @error('jenis')
                        <p class="invalid-feedback ml-36">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div>
                    <table class="w-full text-left" id="siswaTable">

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

                        <tbody>
                        </tbody>

                    </table>
                </div>

                <div class="flex flex-row items-center gap-14 py-3">
                    <button
                        class="ml-64 rounded-sm bg-cyan-300 px-10 py-3 text-center text-sm font-normal shadow-xl shadow-gray-300">Submit</button>

                    <a class="rounded-sm bg-cyan-300 px-10 py-3 text-center text-sm font-normal shadow-xl shadow-gray-300"
                        href="{{ route('nilai.index') }}">Cancel</a>
                </div>
            </form>

        </div>

    </section>

    </x-layouts.app-layout>
