<x-layouts.app-layout title="{{ $title }}">

    <x-organisms.header-dashboard />

    <section class="layout min-h-screen bg-hero py-6 font-rubik">
        <div class="w-full rounded-2xl bg-white py-5 shadow-sm">

            <div class="w-6/12 rounded-r-2xl bg-hero py-2">
                <h4 class="text-gray-9000 px-11 text-2xl font-bold text-white">View Data Pelajaran</h4>
            </div>

            <div class="flex flex-col gap-3 px-11 pt-9">

                <div class="flex flex-col gap-1">
                    <div class="flex flex-row items-center">
                        <label class="mb-2 w-52 text-xl font-medium leading-9">Kode Pelajaran</label>
                        <input class="field-input-gray w-52" value="{{ $pelajaran->kodePelajaran }}"
                            @disabled(true) @readonly(true)>
                    </div>
                </div>

                <div class="flex flex-col gap-1">
                    <div class="flex flex-row items-center">
                        <label class="mb-2 w-52 text-xl font-medium leading-9">Nama Pelajaran</label>
                        <input class="field-input-gray w-8/12" value="{{ $pelajaran->nmPelajaran }}"
                            @disabled(true) @readonly(true)>
                    </div>
                </div>

                <div class="flex flex-col gap-1">
                    <div class="flex flex-row items-center">
                        <label class="mb-2 w-52 text-xl font-medium leading-9">Singkatan</label>
                        <input class="field-input-gray w-96" value="{{ $pelajaran->nmSingkatan }}"
                            @disabled(true) @readonly(true)>
                    </div>
                </div>

                <div class="flex flex-col gap-1">
                    <div class="flex flex-row items-center">
                        <label class="mb-2 w-52 text-xl font-medium leading-9">Nilai KKM</label>
                        <input class="field-input-gray w-52" value="{{ $pelajaran->KKM }}" @disabled(true)
                            @readonly(true)>
                    </div>
                </div>

                <div class="flex flex-col gap-1">
                    <div class="flex flex-row items-start">
                        <label class="mb-2 w-52 text-xl font-medium leading-9">Deskripsi A</label>

                        <textarea class="field-input-gray materiTextarea w-[50rem]" name="deskripsiA" placeholder="Deskripsi A"
                            @disabled(true) @readonly(true)>{{ $pelajaran->deskripsiA }}</textarea>
                    </div>
                </div>

                <div class="flex flex-col gap-1">
                    <div class="flex flex-row items-start">
                        <label class="mb-2 w-52 text-xl font-medium leading-9">Deskripsi B</label>

                        <textarea class="field-input-gray materiTextarea w-[50rem]" name="deskripsiB" placeholder="Deskripsi B"
                            @disabled(true) @readonly(true)>{{ $pelajaran->deskripsiB }}</textarea>
                    </div>
                </div>

                <div class="flex flex-col gap-1">
                    <div class="flex flex-row items-start">
                        <label class="mb-2 w-52 text-xl font-medium leading-9">Deskripsi C</label>

                        <textarea class="field-input-gray materiTextarea w-[50rem]" name="deskripsiC" placeholder="Deskripsi C"
                            @disabled(true) @readonly(true)>{{ $pelajaran->deskripsiC }}</textarea>
                    </div>
                </div>

                <div class="flex flex-col gap-1">
                    <div class="flex flex-row items-start">
                        <label class="mb-2 w-52 text-xl font-medium leading-9">Deskripsi D</label>

                        <textarea class="field-input-gray materiTextarea w-[50rem]" name="deskripsiD" placeholder="Deskripsi D"
                            @disabled(true) @readonly(true)>{{ $pelajaran->deskripsiD }}</textarea>
                    </div>
                </div>

                <div class="flex flex-row items-center justify-center py-3">
                    <a class="rounded-sm bg-cyan-300 px-10 py-3 text-center text-sm font-normal shadow-xl shadow-gray-300"
                        href="{{ URL('dashboard/pelajaran') }}">Back</a>
                </div>
            </div>

        </div>

    </section>

</x-layouts.app-layout>
