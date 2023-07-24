<x-layouts.app-layout title="{{ $title }}">

    <x-organisms.header-dashboard />

    <section class="layout min-h-screen bg-hero py-6 font-rubik">
        <div class="w-full rounded-2xl bg-white py-5 shadow-sm">

            <div class="w-6/12 rounded-r-2xl bg-hero py-2">
                <h4 class="text-gray-9000 px-11 text-2xl font-bold text-white">Menambah Mapping Jadwal</h4>
            </div>

            <form class="flex flex-col gap-6 px-11 pt-9" action="{{ route('mappingjadwal.store') }}" method="post">
                @csrf

                <div class="flex flex-row items-start gap-20">

                    <div class="flex flex-col gap-3">
                        <div class="flex flex-col gap-1">
                            <div class="flex flex-row items-center">
                                <label class="mb-2 w-40 text-xl font-medium leading-9">Tahun Ajaran</label>

                                <select class="field-input-indigo w-72" name="idSemester" required>
                                    <option selected disabled hidden>Tahun Ajaran</option>
                                    @foreach ($semester as $item)
                                        <option value="{{ $item->idSemester }}">
                                            {{ $item->tahunajaran->thnAjaran }} -
                                            {{ $item->semester }}</option>
                                    @endforeach
                                </select>
                            </div>

                            @error('idSemester')
                                <p class="invalid-feedback ml-52">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="flex flex-col gap-1">
                            <div class="flex flex-row items-center">
                                <label class="mb-2 w-40 text-xl font-medium leading-9">Kelas</label>

                                <select class="field-input-indigo w-72" name="idKelas" required>
                                    <option selected disabled hidden>Kelas</option>
                                    @foreach ($kelas as $item)
                                        <option value="{{ $item->idKelas }}">{{ $item->kelas }}</option>
                                    @endforeach
                                </select>
                            </div>

                            @error('idKelas')
                                <p class="invalid-feedback ml-52">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="flex flex-col gap-1">
                            <div class="flex flex-row items-center">
                                <label class="mb-2 w-40 text-xl font-medium leading-9">Hari</label>

                                <select class="field-input-indigo w-72" name="hari" required>
                                    <option selected disabled hidden>Hari</option>
                                    <option value="senin">Senin</option>
                                    <option value="selasa">Selasa</option>
                                    <option value="rabu">Rabu</option>
                                    <option value="kamis">Kamis</option>
                                    <option value="jumat">Jumat</option>
                                    <option value="sabtu">Sabtu</option>
                                </select>
                            </div>

                            @error('hari')
                                <p class="invalid-feedback ml-52">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="flex flex-col gap-1">
                            <div class="flex flex-row items-center">
                                <label class="mb-2 w-40 text-xl font-medium leading-9">Guru</label>

                                <select class="field-input-indigo w-80" name="NIP" required>
                                    <option selected disabled hidden>Guru</option>
                                    @foreach ($guru as $item)
                                        <option value="{{ $item->NIP }}">{{ $item->namaGuru }}</option>
                                    @endforeach
                                </select>
                            </div>

                            @error('NIP')
                                <p class="invalid-feedback ml-52">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>

                    <div class="mt-[3.5rem] flex flex-col gap-3">
                        <div class="flex flex-col gap-1">
                            <div class="flex flex-row items-center">
                                <label class="mb-2 w-32 text-xl font-medium leading-9">Pelajaran</label>

                                <select class="field-input-indigo w-[25rem]" name="idPelajaran" required>
                                    <option selected disabled hidden>Pelajaran</option>
                                    @foreach ($pelajaran as $item)
                                        <option value="{{ $item->idPelajaran }}">{{ $item->nmPelajaran }}</option>
                                    @endforeach
                                </select>
                            </div>

                            @error('idPelajaran')
                                <p class="invalid-feedback ml-32">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="flex flex-col gap-1">
                            <div class="flex flex-row items-center">
                                <label class="mb-2 w-32 text-xl font-medium leading-9">Waktu</label>

                                <div>
                                    <input class="field-input-indigo w-36" name="mulai" type="time" value="08:00"
                                        required>
                                </div>

                                @error('mulai')
                                    <p class="invalid-feedback ml-36">
                                        {{ $message }}
                                    </p>
                                @enderror

                                <p class="px-4 text-xl font-semibold leading-9">s/d</p>

                                <div>
                                    <input class="field-input-indigo w-36" name="selesai" type="time" value="08:00"
                                        required>
                                </div>

                                @error('selesai')
                                    <p class="invalid-feedback ml-36">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                        </div>
                    </div>

                </div>

                <div class="mt-6 flex flex-row items-center justify-center gap-40">
                    <button
                        class="rounded-sm bg-cyan-300 px-10 py-3 text-center text-sm font-normal shadow-xl shadow-gray-300">Submit</button>

                    <a class="rounded-sm bg-cyan-300 px-10 py-3 text-center text-sm font-normal shadow-xl shadow-gray-300"
                        href="{{ URL('dashboard/mappingjadwal') }}">Cancel</a>
                </div>

            </form>

        </div>

    </section>

</x-layouts.app-layout>
