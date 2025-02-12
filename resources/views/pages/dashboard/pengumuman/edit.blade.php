<x-app-layout title="{{ $title }}">

    <x-header-dashboard />

    <section class="layout min-h-screen bg-hero py-6 font-rubik">
        <div class="w-full rounded-2xl bg-white py-5 shadow-sm">

            <div class="w-6/12 rounded-r-2xl bg-hero py-2">
                <h4 class="text-gray-9000 px-11 text-2xl font-bold text-white">Mengubah Data Pengumuman</h4>
            </div>

            <form class="flex flex-col gap-3 px-11 pt-9"
                action="{{ route('pengumuman.update', $pengumuman->idPengumuman) }}" method="post">
                @method('put')
                @csrf

                <div class="flex flex-col">
                    <div class="flex flex-row items-center">
                        <label class="mb-2 w-56 text-xl font-medium leading-9">Tanggal</label>

                        <input class="field-input-indigo w-64" name="tanggal" type="datetime-local"
                            value="{{ $pengumuman->tanggal }}" required />
                    </div>

                    @error('tanggal')
                        <p class="invalid-feedback ml-56">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="flex flex-col">
                    <div class="flex flex-row items-center">
                        <label class="mb-2 w-56 text-xl font-medium leading-9">Nama Pengumuman</label>

                        <input class="field-input-indigo w-8/12" name="namaPengumuman" type="text"
                            value="{{ $pengumuman->namaPengumuman }}" placeholder="Nama" required>
                    </div>

                    @error('namaPengumuman')
                        <p class="invalid-feedback ml-56">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="flex flex-col">
                    <div class="flex flex-row items-start">
                        <label class="mb-2 w-56 text-xl font-medium leading-9">Pengumuman</label>

                        <textarea class="field-input-indigo hidden w-96" name="pengumuman" placeholder="Pengumuman">{{ $pengumuman->pengumuman }}</textarea>
                    </div>

                    @error('pengumuman')
                        <p class="invalid-feedback ml-56">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="flex flex-row items-center gap-14 py-3">
                    <button
                        class="ml-56 rounded-sm bg-cyan-300 px-10 py-3 text-center text-sm font-normal shadow-xl shadow-gray-300">Ubah</button>

                    <a class="rounded-sm bg-cyan-300 px-10 py-3 text-center text-sm font-normal shadow-xl shadow-gray-300"
                        href="{{ route('pengumuman.index') }}">Cancel</a>
                </div>
            </form>

        </div>

    </section>

    <script src="{!! url('assets/tinymce/js/tinymce/tinymce.min.js') !!}"></script>

    </x-layouts.app-layout>
