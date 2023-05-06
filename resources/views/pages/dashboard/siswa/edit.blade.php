<x-layouts.app-layout title="{{ $title }}">

    <x-organisms.header-dashboard />

    <section class="layout min-h-screen bg-hero py-6 font-rubik">
        <div class="w-full rounded-2xl bg-white py-5 shadow-sm">

            <div class="w-6/12 rounded-r-2xl bg-hero py-2">
                <h4 class="text-gray-9000 px-11 text-2xl font-bold text-white">Mengubah Data Siswa</h4>
            </div>

            <form class="flex flex-col gap-6 px-11 pt-9" action="/dashboard/siswa/{{ $siswa->NIS }}" method="post">
                @method('put')
                @csrf

                <div class="flex flex-col gap-1">
                    <div class="flex flex-row items-center">
                        <label class="mb-2 w-64 text-xl font-medium leading-9">Nomor Induk Siswa</label>
                        <input class="@error('NIS') border-red-300 bg-red-300 @enderror field-input-blue w-52"
                            name="NIS" type="number" value="{{ $siswa->NIS }}" maxlength="8" placeholder="Nomor"
                            required>
                    </div>

                    @error('NIS')
                        <p class="invalid-feedback ml-64">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="flex flex-col gap-1">
                    <div class="flex flex-row items-center gap-16">
                        <label class="mb-2 w-48 text-xl font-medium leading-9">Nama Siswa</label>
                        <input class="@error('nmSiswa') border-red-300 bg-red-300 @enderror field-input-blue w-8/12"
                            name="nmSiswa" type="text" value="{{ $siswa->nmSiswa }}" placeholder="Nama" required>
                    </div>

                    @error('nmSiswa')
                        <p class="invalid-feedback ml-64">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="flex flex-col gap-1">
                    <div class="flex flex-row items-center gap-16">
                        <label class="mb-2 w-48 text-xl font-medium leading-9">Nama Panggilan</label>
                        <input class="@error('nmPanggil') border-red-300 bg-red-300 @enderror field-input-blue w-96"
                            name="nmPanggil" type="text" value="{{ $siswa->nmPanggil }}" placeholder="Nama Panggilan"
                            required>
                    </div>

                    @error('nmPanggil')
                        <p class="invalid-feedback ml-64">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="flex flex-col gap-1">
                    <div class="flex flex-row items-center gap-16">
                        <label class="mb-2 w-48 text-xl font-medium leading-9">Berat Badan</label>
                        <input class="@error('berat') border-red-300 bg-red-300 @enderror field-input-blue w-32"
                            name="berat" type="text" value="{{ $siswa->berat }}" placeholder="Berat Badan"
                            required>
                    </div>

                    @error('berat')
                        <p class="invalid-feedback ml-64">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="flex flex-col gap-1">
                    <div class="flex flex-row items-center gap-16">
                        <label class="mb-2 w-48 text-xl font-medium leading-9">Tinggi Badan</label>
                        <input class="@error('tinggi') border-red-300 bg-red-300 @enderror field-input-blue w-32"
                            name="tinggi" type="text" value="{{ $siswa->tinggi }}" placeholder="Tinggi Badan"
                            required>
                    </div>

                    @error('tinggi')
                        <p class="invalid-feedback ml-64">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="flex flex-row items-center gap-14 py-3">
                    <button
                        class="ml-64 rounded-sm bg-cyan-300 px-10 py-3 text-center text-sm font-normal shadow-xl shadow-gray-300">Update</button>

                    <a class="rounded-sm bg-cyan-300 px-10 py-3 text-center text-sm font-normal shadow-xl shadow-gray-300"
                        href="{{ URL('dashboard/siswa') }}">Cancel</a>

                </div>
            </form>

        </div>

    </section>

</x-layouts.app-layout>
