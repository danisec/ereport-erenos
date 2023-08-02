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
                        <label class="mb-2 w-52 text-xl font-medium leading-9">Pengetahuan A</label>

                        <textarea class="field-input-gray materiTextarea w-[50rem]" name="pengetahuanA" placeholder="Deskripsi Pengetahuan A"
                            @disabled(true) @readonly(true)>{{ $pelajaran->pengetahuanA }}</textarea>
                    </div>
                </div>

                <div class="flex flex-col gap-1">
                    <div class="flex flex-row items-start">
                        <label class="mb-2 w-52 text-xl font-medium leading-9">Pengetahuan B</label>

                        <textarea class="field-input-gray materiTextarea w-[50rem]" name="pengetahuanB" placeholder="Deskripsi Pengetahuan B"
                            @disabled(true) @readonly(true)>{{ $pelajaran->pengetahuanB }}</textarea>
                    </div>
                </div>

                <div class="flex flex-col gap-1">
                    <div class="flex flex-row items-start">
                        <label class="mb-2 w-52 text-xl font-medium leading-9">Pengetahuan C</label>

                        <textarea class="field-input-gray materiTextarea w-[50rem]" name="pengetahuanC" placeholder="Deskripsi Pengetahuan C"
                            @disabled(true) @readonly(true)>{{ $pelajaran->pengetahuanC }}</textarea>
                    </div>
                </div>

                <div class="flex flex-col gap-1">
                    <div class="flex flex-row items-start">
                        <label class="mb-2 w-52 text-xl font-medium leading-9">Pengetahuan D</label>

                        <textarea class="field-input-gray materiTextarea w-[50rem]" name="pengetahuanD" placeholder="Deskripsi Pengetahuan D"
                            @disabled(true) @readonly(true)>{{ $pelajaran->pengetahuanD }}</textarea>
                    </div>
                </div>

                <div class="flex flex-col gap-1">
                    <div class="flex flex-row items-start">
                        <label class="mb-2 w-52 text-xl font-medium leading-9">Keterampilan A</label>

                        <textarea class="field-input-gray materiTextarea w-[50rem]" name="keterampilanA" placeholder="Deskripsi Keterampilan A"
                            @disabled(true) @readonly(true)>{{ $pelajaran->keterampilanA }}</textarea>
                    </div>
                </div>

                <div class="flex flex-col gap-1">
                    <div class="flex flex-row items-start">
                        <label class="mb-2 w-52 text-xl font-medium leading-9">Keterampilan B</label>

                        <textarea class="field-input-gray materiTextarea w-[50rem]" name="keterampilanB" placeholder="Deskripsi Keterampilan B"
                            @disabled(true) @readonly(true)>{{ $pelajaran->keterampilanB }}</textarea>
                    </div>
                </div>

                <div class="flex flex-col gap-1">
                    <div class="flex flex-row items-start">
                        <label class="mb-2 w-52 text-xl font-medium leading-9">Keterampilan C</label>

                        <textarea class="field-input-gray materiTextarea w-[50rem]" name="keterampilanC" placeholder="Deskripsi Keterampilan C"
                            @disabled(true) @readonly(true)>{{ $pelajaran->keterampilanC }}</textarea>
                    </div>
                </div>

                <div class="flex flex-col gap-1">
                    <div class="flex flex-row items-start">
                        <label class="mb-2 w-52 text-xl font-medium leading-9">Keterampilan D</label>

                        <textarea class="field-input-gray materiTextarea w-[50rem]" name="keterampilanD" placeholder="Deskripsi Keterampilan D"
                            @disabled(true) @readonly(true)>{{ $pelajaran->keterampilanD }}</textarea>
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
