<x-layouts.app-layout title="{{ $title }}">

    <x-organisms.header-dashboard />

    <section class="layout min-h-screen bg-hero py-6 font-rubik">
        <div class="w-full rounded-2xl bg-white py-5 shadow-sm">

            <div class="w-6/12 rounded-r-2xl bg-hero py-2">
                <h4 class="text-gray-9000 px-11 text-2xl font-bold text-white">View Data Siswa</h4>
            </div>

            <div class="flex flex-col gap-3 px-11 pt-9">

                <div class="flex flex-col gap-1">
                    <div class="flex flex-row items-center">
                        <label class="mb-2 w-64 text-xl font-medium leading-9">Nomor Induk Siswa</label>
                        <input class="field-input-gray w-52" value="{{ $siswa->NIS }}" @disabled(true)
                            @readonly(true)>
                    </div>
                </div>

                <div class="flex flex-col gap-1">
                    <div class="flex flex-row items-center gap-16">
                        <label class="mb-2 w-48 text-xl font-medium leading-9">Nama Siswa</label>
                        <input class="field-input-gray w-8/12" value="{{ $siswa->nmSiswa }}"
                            @disabled(true) @readonly(true)>
                    </div>
                </div>

                <div class="flex flex-col gap-1">
                    <div class="flex flex-row items-center gap-16">
                        <label class="mb-2 w-48 text-xl font-medium leading-9">Nama Panggilan</label>
                        <input class="field-input-gray w-96" value="{{ $siswa->nmPanggil }}"
                            @disabled(true) @readonly(true)>
                    </div>
                </div>

                <div class="flex flex-col gap-1">
                    <div class="flex flex-row items-center gap-16">
                        <label class="mb-2 w-48 text-xl font-medium leading-9">Berat Badan</label>
                        <input class="field-input-gray w-32" value="{{ number_format($siswa->berat) }}"
                            @disabled(true) @readonly(true)>
                    </div>
                </div>

                <div class="flex flex-col gap-1">
                    <div class="flex flex-row items-center gap-16">
                        <label class="mb-2 w-48 text-xl font-medium leading-9">Tinggi Badan</label>
                        <input class="field-input-gray w-32" value="{{ number_format($siswa->tinggi) }}"
                            @disabled(true) @readonly(true)>
                    </div>
                </div>

                <div class="flex flex-col gap-1">
                    <div class="flex flex-row items-center gap-16">
                        <label class="mb-2 w-48 text-xl font-medium leading-9">Nama Orang Tua</label>
                        <input class="field-input-gray w-8/12" value="{{ $siswa->nmOrangTua }}"
                            @disabled(true) @readonly(true)>
                    </div>
                </div>

                <div class="flex flex-row items-center justify-center py-3">
                    <a class="rounded-sm bg-cyan-300 px-10 py-3 text-center text-sm font-normal shadow-xl shadow-gray-300"
                        href="{{ URL('dashboard/siswa') }}">Back</a>
                </div>
            </div>

        </div>

    </section>

</x-layouts.app-layout>
