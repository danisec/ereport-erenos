<x-layouts.app-layout title="{{ $title }}">

    <x-organisms.header-dashboard />

    <section class="layout min-h-screen bg-hero py-6 font-rubik">
        <div class="w-full rounded-2xl bg-white py-5 shadow-sm">

            <div class="w-6/12 rounded-r-2xl bg-hero py-2">
                <h4 class="text-gray-9000 px-11 text-2xl font-bold text-white">Mengubah Data History Siswa</h4>
            </div>

            <form class="flex flex-col gap-3 px-11 pt-9"
                action="{{ route('historysiswa.update', $historySiswa->idHistory) }}" method="post">
                @method('put')
                @csrf

                <div class="flex flex-col gap-1">
                    <div class="flex flex-row items-center">
                        <label class="mb-2 w-44 text-xl font-medium leading-9">Tahun Ajaran</label>

                        <input class="field-input-gray w-64" name="idSemester"
                            value="{{ $historySiswa->semester->tahunajaran->thnAjaran . ' - ' . $historySiswa->semester->semester }}"
                            @disabled(true) @readonly(true) />
                    </div>

                    @error('idSemester')
                        <p class="invalid-feedback ml-44">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="flex flex-col gap-1">
                    <div class="flex flex-row items-center">
                        <label class="mb-2 w-44 text-xl font-medium leading-9">Kelas</label>

                        <input class="field-input-gray w-64" name="idKelas" value="{{ $historySiswa->kelas->kelas }}"
                            @disabled(true) @readonly(true) />
                    </div>

                    @error('idKelas')
                        <p class="invalid-feedback ml-44">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="flex flex-col gap-1">
                    <div class="flex flex-row items-center">
                        <label class="mb-2 w-44 text-xl font-medium leading-9">Nama Siswa</label>

                        <input class="field-input-gray w-64" name="NIS" value="{{ $historySiswa->siswa->nmSiswa }}"
                            @disabled(true) @readonly(true) />
                    </div>

                    @error('NIS')
                        <p class="invalid-feedback ml-44">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div>
                    <table class="w-full text-left" id="table">

                        <thead class="bg-hero text-base font-medium text-gray-500" id="table-mapping">
                            <tr>
                                <th class="w-10 px-6 py-3 text-white" scope="col">
                                    No.
                                </th>
                                <th class="py-3 pl-3 text-white" scope="col">
                                    Deskripsi
                                </th>
                            </tr>
                        </thead>

                        @foreach ($historySiswaD as $item)
                            <tbody>
                                <tr class="bg-white text-base font-medium leading-5 hover:bg-gray-50">
                                    <input type="hidden" value="{{ $item->idHistory }}">
                                    <th class="px-9" scope="row">{{ $loop->iteration }}</th>
                                    <td class="pl-3">
                                        <textarea class="deskripsiTextarea field-input-indigo keterangan-input text-md w-full font-normal" name="keterangan[]"
                                            rows="1" placeholder="Deskripsi History" required>{{ $item->keterangan }}</textarea>
                                    </td>
                                </tr>
                            </tbody>
                        @endforeach

                    </table>
                </div>

                <div class="flex flex-row items-center gap-14 py-3">
                    <button
                        class="ml-64 rounded-sm bg-cyan-300 px-10 py-3 text-center text-sm font-normal shadow-xl shadow-gray-300">Update</button>

                    <a class="rounded-sm bg-cyan-300 px-10 py-3 text-center text-sm font-normal shadow-xl shadow-gray-300"
                        href="{{ route('historysiswa.index') }}">Cancel</a>

                </div>
            </form>

        </div>

    </section>

</x-layouts.app-layout>
