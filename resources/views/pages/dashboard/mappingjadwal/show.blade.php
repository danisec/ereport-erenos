<x-layouts.app-layout title="{{ $title }}">

    <x-organisms.header-dashboard />

    <section class="layout min-h-screen bg-hero py-6 font-rubik">
        <div class="w-full rounded-2xl bg-white py-5 shadow-sm">

            <div class="w-6/12 rounded-r-2xl bg-hero py-2">
                <h4 class="text-gray-9000 px-11 text-2xl font-bold text-white">View Mapping Jadwal</h4>
            </div>

            <div class="flex flex-col gap-6 px-11 pt-9">

                <div class="flex flex-row items-start gap-20">

                    <div class="flex flex-col gap-3">
                        <div class="flex flex-col gap-1">
                            <div class="flex flex-row items-center">
                                <label class="mb-2 w-40 text-xl font-medium leading-9">Tahun Ajaran</label>

                                <input class="field-input-gray w-72"
                                    value="{{ $jadwal->tahunajaran->thnAjaran }} - {{ $jadwal->tahunajaran->semester }}"
                                    @disabled(true) @readonly(true)>
                            </div>
                        </div>

                        <div class="flex flex-col gap-1">
                            <div class="flex flex-row items-center">
                                <label class="mb-2 w-40 text-xl font-medium leading-9">Kelas</label>

                                <input class="field-input-gray w-72" value=" {{ $jadwal->kelas->kelas }}"
                                    @disabled(true) @readonly(true)>
                            </div>
                        </div>

                        <div class="flex flex-col gap-1">
                            <div class="flex flex-row items-center">
                                <label class="mb-2 w-40 text-xl font-medium leading-9">Hari</label>

                                <input class="field-input-gray w-72 capitalize" value=" {{ $jadwal->hari }}"
                                    @disabled(true) @readonly(true)>
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

                                <input class="field-input-gray w-80" value=" {{ $jadwal->guru->namaGuru }}"
                                    @disabled(true) @readonly(true)>
                            </div>
                        </div>
                    </div>

                    <div class="mt-[3.5rem] flex flex-col gap-3">
                        <div class="flex flex-col gap-1">
                            <div class="flex flex-row items-center">
                                <label class="mb-2 w-32 text-xl font-medium leading-9">Pelajaran</label>

                                <input class="field-input-gray w-[25rem]" value=" {{ $jadwal->pelajaran->nmPelajaran }}"
                                    @disabled(true) @readonly(true)>
                            </div>
                        </div>

                        <div class="flex flex-col gap-1">
                            <div class="flex flex-row items-center">
                                <label class="mb-2 w-32 text-xl font-medium leading-9">Waktu</label>

                                <div>
                                    <input class="field-input-gray w-36" value=" {{ $jadwal->mulai }}"
                                        @disabled(true) @readonly(true)>
                                </div>

                                <p class="px-4 text-xl font-semibold leading-9">s/d</p>

                                <div>
                                    <input class="field-input-gray w-36" value=" {{ $jadwal->selesai }}"
                                        @disabled(true) @readonly(true)>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>

                <div class="mt-6 flex flex-row items-center justify-center py-3">
                    <a class="rounded-sm bg-cyan-300 px-10 py-3 text-center text-sm font-normal shadow-xl shadow-gray-300"
                        href="{{ URL('dashboard/mappingjadwal') }}">Back</a>
                </div>

            </div>

        </div>

    </section>

</x-layouts.app-layout>
