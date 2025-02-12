<x-app-layout title="{{ $title }}">

    <x-header-dashboard />

    <section class="layout min-h-screen bg-hero py-6 font-rubik">
        <div class="w-full rounded-2xl bg-white py-5 shadow-sm">

            <div class="w-6/12 rounded-r-2xl bg-hero py-2">
                <h4 class="text-gray-9000 px-11 text-2xl font-bold text-white">Menambah Tahun Ajaran</h4>
            </div>

            <form class="flex flex-col gap-3 px-11 pt-9" action="{{ route('tahunajaran.store') }}" method="post">
                @csrf

                <div class="flex flex-col gap-1">
                    <div class="flex flex-row items-center">
                        <label class="mb-2 w-64 text-xl font-medium leading-9">Tahun Ajaran</label>
                        <input class="field-input-indigo w-52" name="thnAjaran" type="text"
                            value="{{ old('thnAjaran') }}" placeholder="Tahun Ajaran" required>
                    </div>

                    @error('thnAjaran')
                        <p class="invalid-feedback ml-64">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="mt-32 flex flex-row items-center gap-14">
                    <button
                        class="ml-64 rounded-sm bg-cyan-300 px-10 py-3 text-center text-sm font-normal shadow-xl shadow-gray-300">Submit</button>

                    <a class="rounded-sm bg-cyan-300 px-10 py-3 text-center text-sm font-normal shadow-xl shadow-gray-300"
                        href="{{ URL('dashboard/tahunajaran') }}">Cancel</a>
                </div>
            </form>

        </div>

    </section>

    </x-layouts.app-layout>
