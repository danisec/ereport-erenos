<x-app-layout title="{{ $title }}">

    <x-header-dashboard />

    <section class="layout min-h-screen bg-hero py-6 font-rubik">
        <div class="w-full rounded-2xl bg-white py-5 shadow-sm">

            <div class="w-6/12 rounded-r-2xl bg-hero py-2">
                <h4 class="text-gray-9000 px-11 text-2xl font-bold text-white">Mengubah Data Pelajaran</h4>
            </div>

            <form class="flex flex-col gap-3 px-11 pt-9" action="/dashboard/pelajaran/{{ $pelajaran->kodePelajaran }}"
                method="post">
                @method('put')
                @csrf

                <div class="flex flex-col gap-1">
                    <div class="flex flex-row items-center">
                        <label class="mb-2 w-52 text-xl font-medium leading-9">Kode Pelajaran</label>
                        <input
                            class="@error('kodePelajaran') border-red-300 bg-red-300 @enderror field-input-indigo w-52"
                            name="kodePelajaran" type="number" value="{{ $pelajaran->kodePelajaran }}" maxlength="8"
                            placeholder="Nomor" required>
                    </div>

                    @error('kodePelajaran')
                        <p class="invalid-feedback ml-64">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="flex flex-col gap-1">
                    <div class="flex flex-row items-center">
                        <label class="mb-2 w-52 text-xl font-medium leading-9">Nama Pelajaran</label>
                        <input
                            class="@error('nmPelajaran') border-red-300 bg-red-300 @enderror field-input-indigo w-8/12"
                            name="nmPelajaran" type="text" value="{{ $pelajaran->nmPelajaran }}" placeholder="Nama"
                            required>
                    </div>

                    @error('nmPelajaran')
                        <p class="invalid-feedback ml-64">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="flex flex-col gap-1">
                    <div class="flex flex-row items-center">
                        <label class="mb-2 w-52 text-xl font-medium leading-9">Singkatan</label>
                        <input class="@error('nmSingkatan') border-red-300 bg-red-300 @enderror field-input-indigo w-96"
                            name="nmSingkatan" type="text" value="{{ $pelajaran->nmSingkatan }}"
                            placeholder="Nama Singkatan" required>
                    </div>

                    @error('nmSingkatan')
                        <p class="invalid-feedback ml-64">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="flex flex-col gap-1">
                    <div class="flex flex-row items-center">
                        <label class="mb-2 w-52 text-xl font-medium leading-9">Nilai KKM</label>
                        <input class="@error('KKM') border-red-300 bg-red-300 @enderror field-input-indigo w-52"
                            name="KKM" type="number" value="{{ $pelajaran->KKM }}" maxlength="3"
                            placeholder="Nilai KKM" required>
                    </div>

                    @error('KKM')
                        <p class="invalid-feedback ml-64">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="flex flex-col gap-1">
                    <div class="flex flex-row items-start">
                        <label class="mb-2 w-52 text-xl font-medium leading-9">Pengetahuan A</label>

                        <textarea class="@error('pengetahuanA') border-red-300 bg-red-300 @enderror materiTextarea field-input-indigo w-[50rem]"
                            name="pengetahuanA" placeholder="Deskripsi A">{{ $pelajaran->pengetahuanA }}</textarea>
                    </div>

                    @error('pengetahuanA')
                        <p class="invalid-feedback ml-32">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="flex flex-col gap-1">
                    <div class="flex flex-row items-start">
                        <label class="mb-2 w-52 text-xl font-medium leading-9">Pengetahuan B</label>

                        <textarea class="@error('pengetahuanB') border-red-300 bg-red-300 @enderror materiTextarea field-input-indigo w-[50rem]"
                            name="pengetahuanB" placeholder="Deskripsi A">{{ $pelajaran->pengetahuanB }}</textarea>
                    </div>

                    @error('pengetahuanB')
                        <p class="invalid-feedback ml-32">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="flex flex-col gap-1">
                    <div class="flex flex-row items-start">
                        <label class="mb-2 w-52 text-xl font-medium leading-9">Pengetahuan C</label>

                        <textarea class="@error('pengetahuanC') border-red-300 bg-red-300 @enderror materiTextarea field-input-indigo w-[50rem]"
                            name="pengetahuanC" placeholder="Deskripsi A">{{ $pelajaran->pengetahuanC }}</textarea>
                    </div>

                    @error('pengetahuanC')
                        <p class="invalid-feedback ml-32">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="flex flex-col gap-1">
                    <div class="flex flex-row items-start">
                        <label class="mb-2 w-52 text-xl font-medium leading-9">Pengetahuan D</label>

                        <textarea class="@error('pengetahuanD') border-red-300 bg-red-300 @enderror materiTextarea field-input-indigo w-[50rem]"
                            name="pengetahuanD" placeholder="Deskripsi D">{{ $pelajaran->pengetahuanD }}</textarea>
                    </div>

                    @error('pengetahuanD')
                        <p class="invalid-feedback ml-32">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="flex flex-col gap-1">
                    <div class="flex flex-row items-start">
                        <label class="mb-2 w-52 text-xl font-medium leading-9">Keterampilan A</label>

                        <textarea
                            class="@error('keterampilanA') border-red-300 bg-red-300 @enderror materiTextarea field-input-indigo w-[50rem]"
                            name="keterampilanA" placeholder="Deskripsi D">{{ $pelajaran->keterampilanA }}</textarea>
                    </div>

                    @error('keterampilanA')
                        <p class="invalid-feedback ml-32">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="flex flex-col gap-1">
                    <div class="flex flex-row items-start">
                        <label class="mb-2 w-52 text-xl font-medium leading-9">Keterampilan B</label>

                        <textarea
                            class="@error('keterampilanB') border-red-300 bg-red-300 @enderror materiTextarea field-input-indigo w-[50rem]"
                            name="keterampilanB" placeholder="Deskripsi D">{{ $pelajaran->keterampilanB }}</textarea>
                    </div>

                    @error('keterampilanB')
                        <p class="invalid-feedback ml-32">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="flex flex-col gap-1">
                    <div class="flex flex-row items-start">
                        <label class="mb-2 w-52 text-xl font-medium leading-9">Keterampilan C</label>

                        <textarea
                            class="@error('keterampilanC') border-red-300 bg-red-300 @enderror materiTextarea field-input-indigo w-[50rem]"
                            name="keterampilanC" placeholder="Deskripsi D">{{ $pelajaran->keterampilanC }}</textarea>
                    </div>

                    @error('keterampilanC')
                        <p class="invalid-feedback ml-32">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="flex flex-col gap-1">
                    <div class="flex flex-row items-start">
                        <label class="mb-2 w-52 text-xl font-medium leading-9">Keterampilan D</label>

                        <textarea
                            class="@error('keterampilanD') border-red-300 bg-red-300 @enderror materiTextarea field-input-indigo w-[50rem]"
                            name="keterampilanD" placeholder="Deskripsi D">{{ $pelajaran->keterampilanD }}</textarea>
                    </div>

                    @error('keterampilanD')
                        <p class="invalid-feedback ml-32">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="flex flex-row items-center gap-14 py-3">
                    <button
                        class="ml-64 rounded-sm bg-cyan-300 px-10 py-3 text-center text-sm font-normal shadow-xl shadow-gray-300">Update</button>

                    <a class="rounded-sm bg-cyan-300 px-10 py-3 text-center text-sm font-normal shadow-xl shadow-gray-300"
                        href="{{ URL('dashboard/pelajaran') }}">Cancel</a>

                </div>
            </form>

        </div>

    </section>

    </x-layouts.app-layout>
