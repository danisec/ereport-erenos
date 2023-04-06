<x-layouts.app-layout title="{{ $title }}">

    <x-organisms.header-dashboard />

    <section class="layout min-h-screen bg-hero py-14 font-rubik">
        <div class="w-full rounded-2xl bg-white py-5 shadow-sm">

            <div class="w-6/12 rounded-r-2xl bg-hero py-2">
                <h4 class="text-gray-9000 px-11 text-2xl font-bold text-white">Menambah Data Siswa</h4>
            </div>

            <form class="flex flex-col gap-6 px-11 pt-9" action="{{ route('siswa.store') }}" method="post">
                @csrf

                <div class="flex flex-col gap-1">
                    <div class="flex flex-row items-center">
                        <label class="mb-2 w-64 text-xl font-medium leading-9">Nomor Induk Siswa</label>
                        <input class="field-input-blue w-52" name="nis" type="number" value="{{ old('nis') }}"
                            maxlength="8" placeholder="Nomor" required>
                    </div>

                    @error('nis')
                        <p class="invalid-feedback ml-64">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="flex flex-col gap-1">
                    <div class="flex flex-row items-center gap-16">
                        <label class="mb-2 w-48 text-xl font-medium leading-9">Nama Siswa</label>
                        <input class="field-input-blue w-8/12" name="nama_siswa" type="text"
                            value="{{ old('nama_siswa') }}" placeholder="Nama" required>
                    </div>

                    @error('nama_siswa')
                        <p class="invalid-feedback ml-64">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="flex flex-col gap-1">
                    <div class="flex flex-row items-center gap-16">
                        <label class="mb-2 w-48 text-xl font-medium leading-9">Nama Panggilan</label>
                        <input class="field-input-blue w-96" name="nama_panggilan" type="text"
                            value="{{ old('nama_panggilan') }}" placeholder="Nama Panggilan" required>
                    </div>

                    @error('nama_panggilan')
                        <p class="invalid-feedback ml-64">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="flex flex-col gap-1">
                    <div class="flex flex-row items-center gap-16">
                        <label class="mb-2 w-48 text-xl font-medium leading-9">Berat Badan</label>
                        <input class="field-input-blue w-32" name="berat_badan" type="text"
                            value="{{ old('berat_badan') }}" placeholder="Berat Badan" required>
                    </div>

                    @error('berat_badan')
                        <p class="invalid-feedback ml-64">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="flex flex-col gap-1">
                    <div class="flex flex-row items-center gap-16">
                        <label class="mb-2 w-48 text-xl font-medium leading-9">Tinggi Badan</label>
                        <input class="field-input-blue w-32" name="tinggi_badan" type="text"
                            value="{{ old('tinggi_badan') }}" placeholder="Tinggi Badan" required>
                    </div>

                    @error('tinggi_badan')
                        <p class="invalid-feedback ml-64">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="flex flex-row items-center gap-14 py-3">
                    <button
                        class="ml-64 rounded-sm bg-cyan-300 px-10 py-3 text-center text-sm font-normal shadow-xl shadow-gray-300">Submit</button>

                    <a class="rounded-sm bg-cyan-300 px-10 py-3 text-center text-sm font-normal shadow-xl shadow-gray-300"
                        href="{{ URL('dashboard/siswa') }}">Cancel</a>
                </div>
            </form>

        </div>

    </section>

</x-layouts.app-layout>
