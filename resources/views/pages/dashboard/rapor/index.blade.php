<x-app-layout title="{{ $title }}">

    <x-header-dashboard />

    <section class="layout min-h-screen bg-hero py-6 font-rubik">
        <div class="w-full rounded-2xl bg-white py-5 shadow-sm">

            <div class="w-6/12 rounded-r-2xl bg-hero py-2">
                <h4 class="text-gray-9000 px-11 text-2xl font-bold text-white">Cetak Rapor</h4>
            </div>

            <div class="flex flex-col gap-3 px-11 pt-9">

                <div class="flex flex-row items-center">
                    <label class="mb-2 w-48 text-xl font-medium leading-9">Tahun Akademik</label>

                    <select class="field-input-indigo w-96" id="idThnAjaran" name="idThnAjaran" required>
                        <option selected disabled hidden>Tahun Akademik</option>

                        @foreach ($semester as $item)
                            <option value="{{ $item->idSemester }}">{{ $item->tahunajaran->thnAjaran }} -
                                {{ $item->semester }}</option>
                        @endforeach
                    </select>

                    @error('idThnAjaran')
                        <p class="invalid-feedback ml-44">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="flex flex-row items-center">
                    <label class="mb-2 w-48 text-xl font-medium leading-9">Kelas</label>

                    <select class="field-input-indigo w-96" id="idKelas" name="idKelas" required>
                        <option selected disabled hidden>Kelas</option>
                    </select>

                    @error('idKelas')
                        <p class="invalid-feedback ml-44">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="flex flex-row items-center">
                    <label class="mb-2 w-48 text-xl font-medium leading-9">Siswa</label>

                    <select class="field-input-indigo w-96" id="NIS" name="NIS" required>
                        <option selected disabled hidden>Siswa</option>
                    </select>

                    @error('NIS')
                        <p class="invalid-feedback ml-44">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="flex flex-row items-center gap-14 py-3">
                    <a class="ml-48 rounded-sm bg-cyan-300 px-10 py-3 text-center text-sm font-normal shadow-xl shadow-gray-300"
                        href="">View</a>
                </div>
            </div>

        </div>

    </section>

    </x-layouts.app-layout>
