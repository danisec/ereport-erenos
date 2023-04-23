<x-layouts.app-layout title="{{ $title }}">

    <x-organisms.header-dashboard />

    <section class="layout min-h-screen bg-hero py-14 font-rubik">
        <div class="w-full rounded-2xl bg-white py-5 shadow-sm">

            <div class="w-6/12 rounded-r-2xl bg-hero py-2">
                <h4 class="text-gray-9000 px-11 text-2xl font-bold text-white">Menambah Data Pelajaran</h4>
            </div>

            <form class="flex flex-col gap-6 px-11 pt-9" action="{{ route('pelajaran.store') }}" method="post">
                @csrf

                <div class="flex flex-col gap-1">
                    <div class="flex flex-row items-center">
                        <label class="mb-2 w-64 text-xl font-medium leading-9">Kode Pelajaran</label>
                        <input class="field-input-blue w-52" name="kodePelajaran" type="number"
                            value="{{ old('kodePelajaran') }}" maxlength="8" placeholder="Nomor" required>
                    </div>

                    @error('kodePelajaran')
                        <p class="invalid-feedback ml-64">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="flex flex-col gap-1">
                    <div class="flex flex-row items-center gap-16">
                        <label class="mb-2 w-48 text-xl font-medium leading-9">Nama Pelajaran</label>
                        <input class="field-input-blue w-8/12" name="nmPelajaran" type="text"
                            value="{{ old('nmPelajaran') }}" placeholder="Nama" required>
                    </div>

                    @error('nmPelajaran')
                        <p class="invalid-feedback ml-64">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="flex flex-col gap-1">
                    <div class="flex flex-row items-center gap-16">
                        <label class="mb-2 w-48 text-xl font-medium leading-9">Singkatan</label>
                        <input class="field-input-blue w-96" name="nmSingkatan" type="text"
                            value="{{ old('nmSingkatan') }}" placeholder="Nama Singkatan" required>
                    </div>

                    @error('nmSingkatan')
                        <p class="invalid-feedback ml-64">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="flex flex-col gap-1">
                    <div class="flex flex-row items-center gap-16">
                        <label class="mb-2 w-48 text-xl font-medium leading-9">Nilai KKM</label>
                        <input class="field-input-blue w-52" name="KKM" type="number" value="{{ old('KKM') }}"
                            maxlength="3" placeholder="Nilai KKM" required>
                    </div>

                    @error('KKM')
                        <p class="invalid-feedback ml-64">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="flex flex-row items-center gap-14 py-3">
                    <button
                        class="ml-64 rounded-sm bg-cyan-300 px-10 py-3 text-center text-sm font-normal shadow-xl shadow-gray-300">Submit</button>

                    <a class="rounded-sm bg-cyan-300 px-10 py-3 text-center text-sm font-normal shadow-xl shadow-gray-300"
                        href="{{ URL('dashboard/pelajaran') }}">Cancel</a>
                </div>
            </form>

        </div>

    </section>

</x-layouts.app-layout>
