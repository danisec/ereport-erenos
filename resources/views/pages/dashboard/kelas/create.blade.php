<x-layouts.app-layout title="{{ $title }}">

    <x-organisms.header-dashboard />

    <section class="layout min-h-screen bg-hero py-6 font-rubik">
        <div class="w-full rounded-2xl bg-white py-5 shadow-sm">

            <div class="w-6/12 rounded-r-2xl bg-hero py-2">
                <h4 class="text-gray-9000 px-11 text-2xl font-bold text-white">Menambah Data Kelas</h4>
            </div>

            <form class="flex flex-col gap-3 px-11 pt-9" action="{{ route('kelas.store') }}" method="post">
                @csrf

                <div class="flex flex-col gap-1">
                    <div class="flex flex-row items-center gap-16">
                        <label class="mb-2 w-48 text-xl font-medium leading-9">Nama Kelas</label>
                        <input class="field-input-indigo w-8/12" name="kelas" type="text"
                            value="{{ old('kelas') }}" placeholder="Nama" required>
                    </div>

                    @error('kelas')
                        <p class="invalid-feedback ml-64">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="mt-32 flex flex-row items-center gap-14">
                    <button
                        class="ml-64 rounded-sm bg-cyan-300 px-10 py-3 text-center text-sm font-normal shadow-xl shadow-gray-300">Submit</button>

                    <a class="rounded-sm bg-cyan-300 px-10 py-3 text-center text-sm font-normal shadow-xl shadow-gray-300"
                        href="{{ URL('dashboard/kelas') }}">Cancel</a>
                </div>
            </form>

        </div>

    </section>

</x-layouts.app-layout>
