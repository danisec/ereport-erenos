<x-layouts.app-layout title="{{ $title }}">

    <x-organisms.header-dashboard />

    <section class="layout min-h-screen bg-hero py-6 font-rubik">
        <div class="w-full rounded-2xl bg-white py-5 shadow-sm">

            <div class="w-6/12 rounded-r-2xl bg-hero py-2">
                <h4 class="text-gray-9000 px-11 text-2xl font-bold text-white">Mapping Kelas Siswa</h4>
            </div>

            <form class="flex flex-col gap-6 px-11 pt-9" action="{{ route('mappingkelas.store') }}" method="post">
                @csrf

                <div class="flex flex-row items-start gap-12">

                    <div class="flex flex-col gap-2">
                        <div class="flex flex-col gap-1">
                            <div class="flex flex-row items-center">
                                <label class="mb-2 w-36 text-xl font-medium leading-9">Tahun Ajaran</label>
                                <p class="mb-2 w-8 text-xl font-medium leading-9">:</p>

                                <select class="field-input-indigo w-52" name="idThnAjaran" required>
                                    <option selected disabled hidden>Tahun Ajaran</option>
                                    @foreach ($tahunajaran as $item)
                                        <option value="{{ $item->idThnAjaran }}">{{ $item->thnAjaran }} -
                                            {{ $item->semester }}</option>
                                    @endforeach
                                </select>
                            </div>

                            @error('idThnAjaran')
                                <p class="invalid-feedback ml-44">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="flex flex-col gap-1">
                            <div class="flex flex-row items-center">
                                <label class="mb-2 w-36 text-xl font-medium leading-9">Kelas</label>
                                <p class="mb-2 w-8 text-xl font-medium leading-9">:</p>

                                <select class="field-input-indigo w-52" name="idKelas" required>
                                    <option selected disabled hidden>Kelas</option>
                                    @foreach ($kelas as $item)
                                        <option value="{{ $item->idKelas }}">{{ $item->kelas }}</option>
                                    @endforeach
                                </select>
                            </div>

                            @error('idKelas')
                                <p class="invalid-feedback ml-44">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>

                    <div class="mt-[3.3rem] flex flex-col gap-4">
                        <div class="flex flex-col gap-1">
                            <div class="flex flex-row items-center">
                                <label class="mb-2 w-28 text-xl font-medium leading-9">Wali Kelas</label>
                                <p class="mb-2 w-8 text-xl font-medium leading-9">:</p>

                                <select class="field-input-indigo w-64" name="NIP" required>
                                    <option selected disabled hidden>Wali Kelas</option>
                                    @foreach ($guru as $item)
                                        <option value="{{ $item->NIP }}">{{ $item->namaGuru }}</option>
                                    @endforeach
                                </select>
                            </div>

                            @error('NIP')
                                <p class="invalid-feedback ml-36">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>

                </div>

                <div class="mt-32 flex flex-row items-center justify-center gap-40">
                    <button
                        class="rounded-sm bg-cyan-300 px-10 py-3 text-center text-sm font-normal shadow-xl shadow-gray-300">Submit</button>

                    <a class="rounded-sm bg-cyan-300 px-10 py-3 text-center text-sm font-normal shadow-xl shadow-gray-300"
                        href="{{ URL('dashboard/mappingkelas') }}">Cancel</a>
                </div>

            </form>

        </div>

    </section>

</x-layouts.app-layout>
