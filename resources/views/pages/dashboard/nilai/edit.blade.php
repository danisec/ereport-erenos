<x-app-layout title="{{ $title }}">

    <x-header-dashboard />

    <section class="layout min-h-screen bg-hero py-6 font-rubik">
        <div class="w-full rounded-2xl bg-white py-5 shadow-sm">

            <div class="w-6/12 rounded-r-2xl bg-hero py-2">
                <h4 class="text-gray-9000 px-11 text-2xl font-bold text-white">Mengubah Nilai</h4>
            </div>

            <form class="flex flex-col gap-3 px-11 pt-9" action="{{ route('nilai.update', $nilai->idNilai) }}"
                method="post">
                @method('put')
                @csrf

                <div class="flex flex-col gap-1">
                    <input name="NIP" type="hidden" value="{{ Auth::user()->NIP }}">

                    <div class="flex flex-row items-center gap-36">
                        <div class="flex flex-row items-center">
                            <label class="mb-2 w-36 text-xl font-medium leading-9">Tahun Ajaran</label>

                            <input class="field-input-gray w-48" name="idSemester"
                                value="{{ $nilai->semester->tahunajaran->thnAjaran }} - {{ $nilai->semester->semester }}"
                                required @disabled(true) @readonly(true) />
                        </div>

                        <div class="flex flex-row items-center">
                            <label class="mb-2 w-28 text-xl font-medium leading-9">Tanggal</label>

                            <input class="field-input-indigo w-48" name="tanggal" type="date"
                                value="{{ $nilai->tanggal }}" required />
                        </div>
                    </div>

                    @error('idKelas')
                        <p class="invalid-feedback ml-44">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="flex flex-row items-center">
                    <label class="mb-2 w-36 text-xl font-medium leading-9">Kelas</label>

                    <input class="field-input-gray w-48" name="idKelas" value="{{ $nilai->kelas->kelas }}" required
                        @disabled(true) @readonly(true) />

                    @error('idKelas')
                        <p class="invalid-feedback ml-44">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="flex flex-row items-center">
                    <label class="mb-2 w-36 text-xl font-medium leading-9">Pelajaran</label>

                    <select class="field-input-indigo w-96" id="pelajaran" name="idPelajaran" required>
                        <option selected disabled hidden>Pelajaran</option>

                        @foreach ($pelajaran as $item)
                            <option value="{{ $item->idPelajaran }}"
                                {{ $nilai->materi->pelajaran->idPelajaran == $item->idPelajaran ? 'selected' : '' }}>
                                {{ $item->nmPelajaran }}
                            </option>
                        @endforeach
                    </select>

                    @error('idPelajaran')
                        <p class="invalid-feedback ml-44">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="flex flex-row items-center">
                    <label class="mb-2 w-36 text-xl font-medium leading-9">Materi</label>

                    <select class="field-input-indigo w-96" id="materi" name="idMateri" required>
                        <option selected disabled hidden>Materi</option>

                        @foreach ($materi as $item)
                            <option value="{{ $item->idMateri }}"
                                {{ $nilai->materi->idMateri == $item->idMateri ? 'selected' : '' }}>
                                {{ $item->materi }}
                            </option>
                        @endforeach
                    </select>

                    @error('idMateri')
                        <p class="invalid-feedback ml-44">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="flex flex-row items-center">
                    <label class="mb-2 w-36 text-xl font-medium leading-9">Aspek</label>

                    <select class="field-input-indigo w-48" name="aspek" required>
                        <option selected disabled hidden>Aspek</option>

                        @foreach ($aspek as $item)
                            <option value="{{ $item }}" {{ $nilai->aspek == $item ? 'selected' : '' }}>
                                {{ $item }}
                            </option>
                        @endforeach
                    </select>

                    @error('aspek')
                        <p class="invalid-feedback ml-44">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="flex flex-row items-center">
                    <label class="mb-2 w-36 text-xl font-medium leading-9">Jenis</label>

                    <select class="field-input-indigo w-48" name="jenis" required>
                        <option selected disabled hidden>Jenis</option>

                        @foreach ($jenis as $item)
                            <option value="{{ $item }}" {{ $nilai->jenis == $item ? 'selected' : '' }}>
                                {{ $item }}
                            </option>
                        @endforeach
                    </select>

                    @error('jenis')
                        <p class="invalid-feedback ml-44">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div>
                    <table class="w-full text-left" id="table">
                        <thead class="bg-hero text-base font-medium text-gray-500" id="table-mapping">
                            <tr>
                                <th class="w-10 px-6 py-3 text-white" scope="col">
                                    No.
                                </th>
                                <th class="py-3 pl-3 text-white" scope="col">
                                    Siswa
                                </th>
                                <th class="py-3 pl-3 text-white" scope="col">
                                    NIS
                                </th>
                                <th class="py-3 pl-3 text-white" scope="col">
                                    Nilai
                                </th>
                            </tr>
                        </thead>

                        @foreach ($nilaiSiswa as $itemSiswa)
                            <tbody>
                                <tr class="bg-white text-base font-medium leading-5 hover:bg-gray-50">
                                    <th class="px-9" scope="row">{{ $loop->iteration }}</th>
                                    <td class="pl-3">
                                        <input
                                            class="field-input-gray nmSiswa-dropdown text-md nilai-input w-72 font-normal"
                                            name="nmSiswa[]" value="{{ $itemSiswa->siswa->nmSiswa }}" required
                                            @disabled(true) @readonly(true) />
                                    </td>
                                    <td class="pl-3">
                                        <input
                                            class="field-input-gray nis-dropdown text-md nilai-input w-40 font-normal"
                                            name="NIS[]" value="{{ $itemSiswa->siswa->NIS }}" required
                                            @readonly(true) />
                                    </td>
                                    <td class="pl-3">
                                        <input class="field-input-indigo text-md nilai-input w-40 font-normal"
                                            name="nilai[]" value="{{ $itemSiswa->nilai }}" required
                                            placeholder="Nilai" />
                                    </td>
                                </tr>
                            </tbody>
                        @endforeach
                    </table>
                </div>

                <div class="flex flex-row items-center gap-14 py-3">
                    <button
                        class="ml-64 rounded-sm bg-cyan-300 px-10 py-3 text-center text-sm font-normal shadow-xl shadow-gray-300"
                        type="submit">Ubah</button>

                    <a class="rounded-sm bg-cyan-300 px-10 py-3 text-center text-sm font-normal shadow-xl shadow-gray-300"
                        href="{{ route('nilai.index') }}">Cancel</a>
                </div>
            </form>

        </div>

    </section>

    </x-layouts.app-layout>
