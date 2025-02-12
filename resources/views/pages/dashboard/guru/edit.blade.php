<x-app-layout title="{{ $title }}">

    <x-header-dashboard />

    <section class="layout min-h-screen bg-hero py-6 font-rubik">
        <div class="w-full rounded-2xl bg-white py-5 shadow-sm">

            <div class="w-6/12 rounded-r-2xl bg-hero py-2">
                <h4 class="text-gray-9000 px-11 text-2xl font-bold text-white">Mengubah Data Guru</h4>
            </div>

            <form class="flex flex-col gap-3 px-11 pt-9" action="/dashboard/guru/{{ $guru->NIP }}" method="post">
                @method('put')
                @csrf

                <div class="flex flex-col gap-1">
                    <div class="flex flex-row items-center">
                        <label class="mb-2 w-64 text-xl font-medium leading-9">Nomor Guru</label>
                        <input class="@error('NIP') border-red-300 bg-red-300 @enderror field-input-indigo w-52"
                            name="NIP" type="number" value="{{ $guru->NIP }}" maxlength="8" placeholder="Nomor"
                            required>
                    </div>

                    @error('NIP')
                        <p class="invalid-feedback ml-64">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="flex flex-col gap-1">
                    <div class="flex flex-row items-center gap-16">
                        <label class="mb-2 w-48 text-xl font-medium leading-9">Nama Guru</label>
                        <input class="@error('namaGuru') border-red-300 bg-red-300 @enderror field-input-indigo w-8/12"
                            name="namaGuru" type="text" value="{{ $guru->namaGuru }}" placeholder="Nama" required>
                    </div>

                    @error('namaGuru')
                        <p class="invalid-feedback ml-64">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="mt-32 flex flex-row items-center gap-14">
                    <button
                        class="ml-64 rounded-sm bg-cyan-300 px-10 py-3 text-center text-sm font-normal shadow-xl shadow-gray-300">Update</button>

                    <a class="rounded-sm bg-cyan-300 px-10 py-3 text-center text-sm font-normal shadow-xl shadow-gray-300"
                        href="{{ URL('dashboard/guru') }}">Cancel</a>

                </div>
            </form>

        </div>

    </section>

</x-app-layout>
