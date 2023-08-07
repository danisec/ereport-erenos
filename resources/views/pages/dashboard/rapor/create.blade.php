<x-layouts.app-layout title="{{ $title }}">

    <x-organisms.header-dashboard />

    <section class="layout min-h-screen bg-hero py-6 font-rubik">
        <div class="w-full rounded-2xl bg-white py-5 shadow-sm">

            <div class="w-8/12 rounded-r-2xl bg-hero py-2">
                <h4 class="text-gray-9000 px-11 text-2xl font-bold uppercase text-white">Rapor Peserta Didik Dan Profil
                    Peserta
                    Didik</h4>
            </div>

            <form action="{{ route('rapor.store') }}" method="post">
                @csrf

                <section class="flex flex-col gap-3 px-11 pt-9">

                    <div class="flex flex-col gap-1">

                        <div class="flex flex-row items-center gap-20">
                            <div class="flex flex-row items-center">
                                <label class="mb-2 w-52 text-xl font-medium leading-9">Nama Murid</label>

                                <input class="field-input-gray w-96" name="nmSiswa" type="text"
                                    value="{{ $getSiswaNIS->siswa->nmSiswa }}" required @disabled(true)
                                    @readonly(true) />
                            </div>

                            <div class="flex flex-row items-center">
                                <label class="mb-2 w-40 text-xl font-medium leading-9">Kelas</label>

                                <input name="idKelas" type="hidden"
                                    value="{{ $getSiswaNIS->mappingkelas->kelas->idKelas }}">

                                <input class="field-input-gray w-40" name="kelas" type="text"
                                    value="{{ $getSiswaNIS->mappingkelas->kelas->kelas }} SD" required
                                    @disabled(true) @readonly(true) />
                            </div>
                        </div>

                    </div>

                    <div class="flex flex-col gap-1">

                        <div class="flex flex-row items-center gap-20">
                            <div class="flex flex-row items-center">
                                <label class="mb-2 w-52 text-xl font-medium leading-9">Nomor Induk/NISN</label>

                                <input class="field-input-gray w-96" name="NIS" type="text"
                                    value="{{ $getSiswaNIS->NIS }}" required @readonly(true) />
                            </div>

                            <div class="flex flex-row items-center">
                                <label class="mb-2 w-40 text-xl font-medium leading-9">Semester</label>

                                <input name="idSemester" type="hidden" value="{{ $semester->idSemester }}">

                                <input class="field-input-gray w-40" name="semester" type="text"
                                    value="{{ $semester->semester == 'Genap' ? 'II ( DUA )' : 'I ( SATU )' }}" required
                                    @disabled(true) @readonly(true) />
                            </div>
                        </div>

                    </div>

                    <div class="flex flex-col gap-1">

                        <div class="flex flex-row items-center gap-20">
                            <div class="flex flex-row items-center">
                                <label class="mb-2 w-52 text-xl font-medium leading-9">Nama Sekolah</label>

                                <input class="field-input-gray w-96" name="namaSekolah" type="text"
                                    value="{{ $namaSekolah }}" required @disabled(true)
                                    @readonly(true) />
                            </div>

                            <div class="flex flex-row items-center">
                                <label class="mb-2 w-40 text-xl font-medium leading-9">Tahun Ajaran</label>

                                <input class="field-input-gray w-40" name="thnAjaran" type="text"
                                    value="{{ $getSiswaNIS->mappingkelas->tahunajaran->thnAjaran }}" required
                                    @disabled(true) @readonly(true) />
                            </div>
                        </div>

                    </div>

                    <div class="flex flex-row items-center">
                        <label class="mb-2 w-52 text-xl font-medium leading-9">Alamat Sekolah</label>

                        <input class="field-input-gray w-[42rem]" name="alamatSekolah" type="text"
                            value="{{ $alamatSekolah }}" required @disabled(true) @readonly(true) />
                    </div>

                </section>

                <section class="flex flex-col gap-3 px-11 pt-9">
                    <h4 class="text-xl font-semibold text-gray-900">A. Sikap</h4>

                    <div class="flex flex-row justify-end">
                        <button
                            class="add-sikap-btn flex flex-row items-center rounded-md bg-cyan-300 px-2 py-1 shadow-lg shadow-gray-300 focus:outline-none"
                            id="add-sikap" type="button">
                            <p class="text-center text-xl font-normal">Tambah</p>
                            <x-atoms.plus :alt="'tambah-sikap'" />
                        </button>
                    </div>

                    <div>
                        <table class="w-full text-left" id="table-sikap">

                            <thead class="bg-hero text-base font-medium text-gray-500" id="table-mapping">
                                <tr>
                                    <th class="w-10 px-6 py-3 text-white" scope="col">
                                        No.
                                    </th>
                                    <th class="py-3 pl-3 text-white" scope="col">
                                        Sikap
                                    </th>
                                    <th class="py-3 pl-3 text-white" scope="col">
                                        Deskripsi
                                    </th>
                                    <th class="w-32 py-3 text-center text-white" scope="col">
                                        Aksi
                                    </th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr class="bg-white text-base font-medium leading-5 hover:bg-gray-50">
                                    <th class="px-9" scope="row">1</th>
                                    <td class="pl-3">
                                        <textarea class="field-input-indigo text-md sikap-input w-full font-normal" name="nmSikap[]" required rows="1"
                                            placeholder="Sikap"></textarea>
                                    </td>
                                    <td class="pl-3">
                                        <textarea class="field-input-indigo text-md sikap-input w-full font-normal" name="deskripsiSikap[]" required
                                            rows="3" placeholder="Deskripsi"></textarea>
                                    </td>
                                    <td class="w-10 text-center">
                                        <button class="delete-sikap-btn focus:outline-none" type="button">
                                            <x-atoms.trash :alt="'hapus-sikap'" />
                                        </button>
                                    </td>
                                </tr>
                            </tbody>

                        </table>
                    </div>
                </section>

                <section class="flex flex-col gap-3 px-11 pt-9">
                    <h4 class="text-xl font-semibold text-gray-900">B. Pengetahuan dan Keterampilan</h4>

                    <div>
                        <table class="w-full text-left" id="table">

                            <thead class="bg-hero text-base font-medium text-gray-500" id="">
                                <tr>
                                    <th class="w-10 px-6 py-3 text-white" rowspan="2">
                                        No.
                                    </th>
                                    <th class="py-3 pl-3 text-white" rowspan="2">
                                        Muatan Pelajaran
                                    </th>
                                    <th class="py-3 pl-3 text-white" rowspan="2">
                                        KKM
                                    </th>
                                    <th class="py-3 pl-3 text-center text-white" colspan="3">
                                        Pengetahuan
                                    </th>
                                    <th class="py-3 pl-3 text-center text-white" colspan="3">
                                        Keterampilan
                                    </th>
                                </tr>

                                <tr>
                                    <th class="py-3 pl-3 text-white">
                                        Nilai
                                    </th>
                                    <th class="py-3 pl-3 text-white">
                                        Predikat
                                    </th>
                                    <th class="py-3 pl-3 text-white">
                                        Deskripsi
                                    </th>

                                    <th class="py-3 pl-3 text-white">
                                        Nilai
                                    </th>
                                    <th class="py-3 pl-3 text-white">
                                        Predikat
                                    </th>
                                    <th class="py-3 pl-3 text-white">
                                        Deskripsi
                                    </th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($nilai as $pelajaran => $data)
                                    @foreach ($data as $item)
                                        <tr class="bg-white text-base font-medium leading-5 hover:bg-gray-50">
                                            <th class="px-9" scope="row">{{ $loop->parent->index + 1 }}</th>
                                            <td class="pl-3">
                                                <input name="idPelajaran[]" type="hidden"
                                                    value="{{ $item['pelajaran']['idPelajaran'] }}" />

                                                <textarea class="deskripsiTextarea field-input-gray text-md nilai-input w-full font-normal" required rows="1"
                                                    placeholder="Pelajaran" @disabled(true) @readonly(true)>{{ $pelajaran }}</textarea>
                                            </td>
                                            <td class="pl-3">
                                                <textarea class="field-input-gray text-md nilai-input w-20 font-normal" required rows="1" placeholder="KKM"
                                                    @disabled(true) @readonly(true)>{{ $item['pelajaran']->KKM ?? 0 }}</textarea>
                                            </td>
                                            <td class="pl-3">
                                                <textarea class="field-input-gray text-md nilai-input w-20 font-normal" name="nilaiPengetahuan[]" required
                                                    rows="1" placeholder="Nilai" @readonly(true)>
@if (isset($item['PAS']['nilai']))
{{ $item['PAS']['nilai'] }}
@else
{{ $item['pengetahuan']['nilai'] }}
@endif
</textarea>
                                            </td>
                                            <td class="pl-3">
                                                <textarea class="field-input-gray text-md nilai-input w-12 font-normal" name="predikatPengetahuan[]" required
                                                    rows="1" @readonly(true)>
@if (isset($item['PAS']['grade']))
{{ $item['PAS']['grade'] }}
@else
{{ $item['pengetahuan']['grade'] }}
@endif
                                                </textarea>
                                            </td>
                                            <td class="pl-3">
                                                <textarea class="deskripsiTextarea field-input-indigo nilai-input w-full text-base font-normal"
                                                    name="deskripsiPengetahuan[]" required rows="1" placeholder="Deskripsi">
@if (isset($item['PAS']['deskripsi']))
{{ $item['PAS']['deskripsi'] }}
@else
{{ $item['pengetahuan']['deskripsi'] }}
@endif
</textarea>
                                            </td>

                                            <td class="pl-3">
                                                <textarea class="field-input-gray text-md nilai-input w-20 font-normal" name="nilaiKeterampilan[]" required
                                                    rows="1" placeholder="Nilai" @readonly(true)>
@if (isset($item['keterampilan']['nilai']))
{{ $item['keterampilan']['nilai'] }}
@endif
</textarea>
                                            </td>
                                            <td class="pl-3">
                                                <textarea class="field-input-gray text-md nilai-input w-12 font-normal" name="predikatKeterampilan[]" required
                                                    rows="1" @readonly(true)>
@if (isset($item['keterampilan']['grade']))
{{ $item['keterampilan']['grade'] }}
@endif
                                                </textarea>
                                            </td>
                                            <td class="pl-3">
                                                <textarea class="deskripsiTextarea field-input-indigo nilai-input w-full text-base font-normal"
                                                    name="deskripsiKeterampilan[]" required rows="1" placeholder="Deskripsi">
@if (isset($item['keterampilan']['deskripsi']))
{{ $item['keterampilan']['deskripsi'] }}
@endif
                                                </textarea>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endforeach
                            </tbody>

                        </table>
                    </div>
                </section>

                <section class="flex flex-col gap-3 px-11 pt-9">
                    <h4 class="text-xl font-semibold text-gray-900">C. Ekstrakurikuler</h4>

                    <div class="flex flex-row justify-end">
                        <button
                            class="add-ekstrakurikuler-btn flex flex-row items-center rounded-md bg-cyan-300 px-2 py-1 shadow-lg shadow-gray-300 focus:outline-none"
                            id="add-ekstrakurikuler" type="button">
                            <p class="text-center text-xl font-normal">Tambah</p>
                            <x-atoms.plus :alt="'tambah-ekstrakurikuler'" />
                        </button>
                    </div>

                    <div>
                        <table class="w-full text-left" id="table-ekstrakurikuler">

                            <thead class="bg-hero text-base font-medium text-gray-500" id="table-mapping">
                                <tr>
                                    <th class="w-10 px-6 py-3 text-white" scope="col">
                                        No.
                                    </th>
                                    <th class="py-3 pl-3 text-white" scope="col">
                                        Kegiatan Ekstrakurikuler
                                    </th>
                                    <th class="py-3 pl-3 text-white" scope="col">
                                        Keterangan
                                    </th>
                                    <th class="w-32 py-3 text-center text-white" scope="col">
                                        Aksi
                                    </th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr class="bg-white text-base font-medium leading-5 hover:bg-gray-50">
                                    <th class="px-9" scope="row">1</th>
                                    <td class="pl-3">
                                        <textarea class="field-input-indigo text-md ekstrakurikuler-input w-full font-normal" name="nmEkstrakurikuler[]"
                                            required rows="1" placeholder="Kegiatan"></textarea>
                                    </td>
                                    <td class="pl-3">
                                        <textarea class="field-input-indigo text-md ekstrakurikuler-input w-full font-normal"
                                            name="deskripsiEkstrakurikuler[]" rows="1" placeholder="Keterangan"></textarea>
                                    </td>
                                    <td class="w-10 text-center">
                                        <button class="delete-ekstrakurikuler-btn focus:outline-none" type="button">
                                            <x-atoms.trash :alt="'hapus-ekstrakurikuler'" />
                                        </button>
                                    </td>
                                </tr>
                            </tbody>

                        </table>
                    </div>
                </section>

                <section class="flex flex-col gap-3 px-11 pt-9">
                    <h4 class="text-xl font-semibold text-gray-900">D. Saran-saran</h4>

                    <div>
                        <textarea class="field-input-indigo w-full" name="saran" type="text" placeholder="Saran-saran" cols="1"
                            rows="4"></textarea>
                    </div>
                </section>

                <section class="flex flex-col gap-3 px-11 pt-9">
                    <h4 class="text-xl font-semibold text-gray-900">E. Tinggi dan Berat Badan</h4>

                    <div>
                        <table class="w-full text-left" id="table">

                            <thead class="bg-hero text-base font-medium text-gray-500" id="table-mapping">
                                <tr>
                                    <th class="w-10 px-6 py-3 text-white" scope="col">
                                        No.
                                    </th>
                                    <th class="py-3 pl-3 text-white" scope="col">
                                        Aspek Yang Dinilai
                                    </th>
                                    <th class="py-3 pl-3 text-center text-white" scope="col">
                                        Semester @if ($semester->semester == 'Genap')
                                            {{ '2' }}
                                        @else
                                            {{ '1' }}
                                        @endif
                                    </th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr class="bg-white text-base font-medium leading-5 hover:bg-gray-50">
                                    <th class="px-9" scope="row">1</th>
                                    <td class="pl-3">
                                        <input class="field-input-gray text-md nilai-input w-full font-normal"
                                            type="text" placeholder="Tinggi Badan" required
                                            @disabled(true) @readonly(true) />
                                    </td>
                                    <td class="pl-3">
                                        <input
                                            class="field-input-gray text-md nilai-input w-full text-center font-normal"
                                            name="tinggi" type="text"
                                            value="{{ number_format($getSiswaNIS->siswa->tinggi, 0) }} Cm" required
                                            @disabled(true) @readonly(true) />
                                    </td>
                                </tr>

                                <tr class="bg-white text-base font-medium leading-5 hover:bg-gray-50">
                                    <th class="px-9" scope="row">2</th>
                                    <td class="pl-3">
                                        <input class="field-input-gray text-md nilai-input w-full font-normal"
                                            type="text" placeholder="Berat Badan" required
                                            @disabled(true) @readonly(true) />
                                    </td>
                                    <td class="pl-3">
                                        <input
                                            class="field-input-gray text-md nilai-input w-full text-center font-normal"
                                            name="tinggi" type="text"
                                            value="{{ number_format($getSiswaNIS->siswa->berat, 0) }} Kg" required
                                            @disabled(true) @readonly(true) />
                                    </td>
                                </tr>
                            </tbody>

                        </table>
                    </div>
                </section>

                <section class="flex flex-col gap-3 px-11 pt-9">
                    <h4 class="text-xl font-semibold text-gray-900">F. Prestasi</h4>

                    <div class="flex flex-row justify-end">
                        <button
                            class="add-prestasi-btn flex flex-row items-center rounded-md bg-cyan-300 px-2 py-1 shadow-lg shadow-gray-300 focus:outline-none"
                            id="add-prestasi" type="button">
                            <p class="text-center text-xl font-normal">Tambah</p>
                            <x-atoms.plus :alt="'tambah-prestasi'" />
                        </button>
                    </div>

                    <div>
                        <table class="w-full text-left" id="table-prestasi">

                            <thead class="bg-hero text-base font-medium text-gray-500" id="table-mapping">
                                <tr>
                                    <th class="w-10 px-6 py-3 text-white" scope="col">
                                        No.
                                    </th>
                                    <th class="py-3 pl-3 text-white" scope="col">
                                        Jenis Prestasi
                                    </th>
                                    <th class="py-3 pl-3 text-white" scope="col">
                                        Keterangan
                                    </th>
                                    <th class="w-32 py-3 text-center text-white" scope="col">
                                        Aksi
                                    </th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr class="bg-white text-base font-medium leading-5 hover:bg-gray-50">
                                    <th class="px-9" scope="row">1</th>
                                    <td class="pl-3">
                                        <textarea class="field-input-indigo text-md prestasi-input w-full font-normal" name="nmPrestasi[]" rows="1"
                                            placeholder="Prestasi"></textarea>
                                    </td>
                                    <td class="pl-3">
                                        <textarea class="field-input-indigo text-md prestasi-input w-full font-normal" name="deskripsiPrestasi[]"
                                            rows="1" placeholder="Keterangan"></textarea>
                                    </td>
                                    <td class="w-10 text-center">
                                        <button class="delete-prestasi-btn focus:outline-none" type="button">
                                            <x-atoms.trash :alt="'hapus-prestasi'" />
                                        </button>
                                    </td>
                                </tr>
                            </tbody>

                        </table>
                    </div>
                </section>

                <section class="flex flex-col gap-3 px-11 pt-9">
                    <h4 class="text-xl font-semibold text-gray-900">G. Ketidakhadiran</h4>

                    <div>
                        <table class="w-full text-left" id="table">

                            @foreach ($kehadiran as $index => $item)
                                <tbody>
                                    <tr class="bg-white text-base font-medium leading-5 hover:bg-gray-50">
                                        <td class="pl-3">
                                            <input class="field-input-gray text-md nilai-input w-full font-normal"
                                                value="{{ $index }}" required @disabled(true)
                                                @readonly(true) />
                                        </td>
                                        <td class="pl-3">
                                            <input
                                                class="field-input-gray text-md nilai-input w-full text-center font-normal"
                                                value="{{ $item }}" required @disabled(true)
                                                @readonly(true) />
                                        </td>
                                        <td class="pl-3">
                                            <input
                                                class="field-input-gray text-md nilai-input w-full text-center font-normal"
                                                value="Hari" required @disabled(true)
                                                @readonly(true) />
                                        </td>
                                    </tr>
                                </tbody>
                            @endforeach

                        </table>
                    </div>
                </section>

                <div class="flex flex-row items-center gap-14 px-11 py-3">
                    <button
                        class="ml-52 rounded-sm bg-cyan-300 px-10 py-3 text-center text-sm font-normal shadow-xl shadow-gray-300">Simpan</button>

                    <a class="rounded-sm bg-cyan-300 px-10 py-3 text-center text-sm font-normal shadow-xl shadow-gray-300"
                        href="{{ route('rapor.index') }}">Cancel</a>
                </div>
            </form>

        </div>

    </section>

    <script type="module">
        function sikap() {
            let i = 1; // Ubah nilai awal menjadi 1, agar nomor dimulai dari 1

            $("#add-sikap").click(function() {
                i++; // Increment nilai i

                $('#table-sikap').append(
                    `<tr>
                    <th class="px-9" scope="row">${i}</th>
                        <td class="pl-3">
                            <textarea class="field-input-indigo text-md sikap-input w-full font-normal" name="nmSikap[]" required rows="1"
                                placeholder="Sikap"></textarea>
                        </td>
                        <td class="pl-3">
                            <textarea class="field-input-indigo text-md sikap-input w-full font-normal" name="deskripsiSikap[]" required
                                rows="3" placeholder="Deskripsi"></textarea>
                        </td>
                        </td>
                            <td class="w-10 text-center">
                                <button class="delete-sikap-btn focus:outline-none" type="button">
                                    <svg class="mt-1.5 h-auto w-7" width="30" height="36" viewBox="0 0 30 36" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                    <rect width="30" height="36" fill="url(#pattern0)"/>
                                    <defs>
                                    <pattern id="pattern0" patternContentUnits="objectBoundingBox" width="1" height="1">
                                    <use xlink:href="#image0_100_2277" transform="matrix(0.0104167 0 0 0.00868056 0 0.0833333)"/>
                                    </pattern>
                                    <image id="image0_100_2277" width="96" height="96" xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAGAAAABgCAYAAADimHc4AAAACXBIWXMAAAsTAAALEwEAmpwYAAAB90lEQVR4nO2XTy5DcRSFzxwLUBOsggmxKZaCnXgmJiyBWAMmmDA60uRJRPKk3q/Ve/T7kt9MmvPn3tuSAAAAAAAAAAAAarAuqZPkka/rPwNGsCbpqiH8z3cjaYMGlhO+V6kEr9grx7IDMQUsPxSzAYsL4XrGOz7v7w9OkGYP/y9LKMeijHYjf8u3/g8RV8BXIkX/I/3xBhyuP96Aw/XHG3C4/ngDDtcfb8Dh+uMNOFx/vAGH64834HD98QYcrj/egMP1xxtwuP5fG3D435ejWkCmgKxAzQaIAlqoNqFmA7ICNSdIFNBCtQk1G5AVqDlBooAWqk2o2YCsQM0JEgW0UG1CzQZkBWpOkCighWoTajYgK1BzgkQBLVSbULMBWYGaEyQKaKHahJoNyArUnCBRQAvVJtRsQFag5gSJAlqoNqFmA7ICNSdIFNBCtQk1G5AVqFftBFUjXX+8AYfrjzfgcP3xBhyuP96Aw/XHG3C4/ngDDtcfb8Dh+uMNOFy/XgYMbKo+WwPanxXE/YCJY9XnZED7nYI4HzDx1pcwUT0mffjvA9pPFcTRD3c09R0ojMsCoXlO70KBbEt6KBCeG9+TpF2Fsi/psUCIHvmmA7SncHZCz1HXb/G/4VDSWf9z7rVAwP72pppu+187cV+4AAAAAAAAAACg8nwAeGeSplaV1ioAAAAASUVORK5CYII="/>
                                    </defs>
                                    </svg>
                                </button>
                            </td>
                    </tr>`
                )

                // Memanggil fungsi updateNomor untuk memperbarui nomor setelah menambahkan baris baru
                updateNomor();
            });

            $(document).on("click", ".delete-sikap-btn", function() {
                $(this).parents("tr").remove();
                // Memanggil fungsi updateNomor untuk memperbarui nomor setelah menghapus baris
                updateNomor();
            });

            // Fungsi untuk memperbarui nomor setelah menghapus atau menambahkan baris
            function updateNomor() {
                let nomor = 1;
                $("#table-sikap tbody tr").each(function() {
                    $(this).find("th").text(nomor);
                    nomor++;
                });
            }
        }

        function ekstrakurikuler() {
            let i = 1; // Ubah ekstrakurikuler awal menjadi 1, agar nomor dimulai dari 1

            $("#add-ekstrakurikuler").click(function() {
                i++; // Increment ekstrakurikuler i

                $('#table-ekstrakurikuler').append(
                    `<tr>
                    <th class="px-9" scope="row">${i}</th>
                        <td class="pl-3">
                           <textarea class="field-input-indigo text-md ekstrakurikuler-input w-full font-normal"
                                name="nmEkstrakurikuler[]" required rows="1" placeholder="Kegiatan"></textarea>
                        </td>
                        <td class="pl-3">
                            <textarea class="field-input-indigo text-md ekstrakurikuler-input w-full font-normal"
                                name="deskripsiEkstrakurikuler[]" rows="1" placeholder="Keterangan"></textarea>
                        </td>
                        </td>
                            <td class="w-10 text-center">
                                <button class="delete-ekstrakurikuler-btn focus:outline-none" type="button">
                                    <svg class="mt-1.5 h-auto w-7" width="30" height="36" viewBox="0 0 30 36" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                    <rect width="30" height="36" fill="url(#pattern0)"/>
                                    <defs>
                                    <pattern id="pattern0" patternContentUnits="objectBoundingBox" width="1" height="1">
                                    <use xlink:href="#image0_100_2277" transform="matrix(0.0104167 0 0 0.00868056 0 0.0833333)"/>
                                    </pattern>
                                    <image id="image0_100_2277" width="96" height="96" xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAGAAAABgCAYAAADimHc4AAAACXBIWXMAAAsTAAALEwEAmpwYAAAB90lEQVR4nO2XTy5DcRSFzxwLUBOsggmxKZaCnXgmJiyBWAMmmDA60uRJRPKk3q/Ve/T7kt9MmvPn3tuSAAAAAAAAAAAAarAuqZPkka/rPwNGsCbpqiH8z3cjaYMGlhO+V6kEr9grx7IDMQUsPxSzAYsL4XrGOz7v7w9OkGYP/y9LKMeijHYjf8u3/g8RV8BXIkX/I/3xBhyuP96Aw/XHG3C4/ngDDtcfb8Dh+uMNOFx/vAGH64834HD98QYcrj/egMP1xxtwuP5fG3D435ejWkCmgKxAzQaIAlqoNqFmA7ICNSdIFNBCtQk1G5AVqDlBooAWqk2o2YCsQM0JEgW0UG1CzQZkBWpOkCighWoTajYgK1BzgkQBLVSbULMBWYGaEyQKaKHahJoNyArUnCBRQAvVJtRsQFag5gSJAlqoNqFmA7ICNSdIFNBCtQk1G5AVqFftBFUjXX+8AYfrjzfgcP3xBhyuP96Aw/XHG3C4/ngDDtcfb8Dh+uMNOFy/XgYMbKo+WwPanxXE/YCJY9XnZED7nYI4HzDx1pcwUT0mffjvA9pPFcTRD3c09R0ojMsCoXlO70KBbEt6KBCeG9+TpF2Fsi/psUCIHvmmA7SncHZCz1HXb/G/4VDSWf9z7rVAwP72pppu+187cV+4AAAAAAAAAACg8nwAeGeSplaV1ioAAAAASUVORK5CYII="/>
                                    </defs>
                                    </svg>
                                </button>
                            </td>
                    </tr>`
                )

                // Memanggil fungsi updateNomor untuk memperbarui nomor setelah menambahkan baris baru
                updateNomor();
            });

            $(document).on("click", ".delete-ekstrakurikuler-btn", function() {
                $(this).parents("tr").remove();
                // Memanggil fungsi updateNomor untuk memperbarui nomor setelah menghapus baris
                updateNomor();
            });

            // Fungsi untuk memperbarui nomor setelah menghapus atau menambahkan baris
            function updateNomor() {
                let nomor = 1;
                $("#table-ekstrakurikuler tbody tr").each(function() {
                    $(this).find("th").text(nomor);
                    nomor++;
                });
            }
        }

        function prestasi() {
            let i = 1; // Ubah prestasi awal menjadi 1, agar nomor dimulai dari 1

            $("#add-prestasi").click(function() {
                i++; // Increment prestasi i

                $('#table-prestasi').append(
                    `<tr>
                    <th class="px-9" scope="row">${i}</th>
                        <td class="pl-3">
                           <textarea class="field-input-indigo text-md prestasi-input w-full font-normal"
                                name="nmPrestasi[]" rows="1" placeholder="Prestasi"></textarea>
                        </td>
                        <td class="pl-3">
                            <textarea class="field-input-indigo text-md prestasi-input w-full font-normal"
                                name="deskripsiPrestasi[]" rows="1" placeholder="Keterangan"></textarea>
                        </td>
                        </td>
                            <td class="w-10 text-center">
                                <button class="delete-prestasi-btn focus:outline-none" type="button">
                                    <svg class="mt-1.5 h-auto w-7" width="30" height="36" viewBox="0 0 30 36" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                    <rect width="30" height="36" fill="url(#pattern0)"/>
                                    <defs>
                                    <pattern id="pattern0" patternContentUnits="objectBoundingBox" width="1" height="1">
                                    <use xlink:href="#image0_100_2277" transform="matrix(0.0104167 0 0 0.00868056 0 0.0833333)"/>
                                    </pattern>
                                    <image id="image0_100_2277" width="96" height="96" xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAGAAAABgCAYAAADimHc4AAAACXBIWXMAAAsTAAALEwEAmpwYAAAB90lEQVR4nO2XTy5DcRSFzxwLUBOsggmxKZaCnXgmJiyBWAMmmDA60uRJRPKk3q/Ve/T7kt9MmvPn3tuSAAAAAAAAAAAAarAuqZPkka/rPwNGsCbpqiH8z3cjaYMGlhO+V6kEr9grx7IDMQUsPxSzAYsL4XrGOz7v7w9OkGYP/y9LKMeijHYjf8u3/g8RV8BXIkX/I/3xBhyuP96Aw/XHG3C4/ngDDtcfb8Dh+uMNOFx/vAGH64834HD98QYcrj/egMP1xxtwuP5fG3D435ejWkCmgKxAzQaIAlqoNqFmA7ICNSdIFNBCtQk1G5AVqDlBooAWqk2o2YCsQM0JEgW0UG1CzQZkBWpOkCighWoTajYgK1BzgkQBLVSbULMBWYGaEyQKaKHahJoNyArUnCBRQAvVJtRsQFag5gSJAlqoNqFmA7ICNSdIFNBCtQk1G5AVqFftBFUjXX+8AYfrjzfgcP3xBhyuP96Aw/XHG3C4/ngDDtcfb8Dh+uMNOFy/XgYMbKo+WwPanxXE/YCJY9XnZED7nYI4HzDx1pcwUT0mffjvA9pPFcTRD3c09R0ojMsCoXlO70KBbEt6KBCeG9+TpF2Fsi/psUCIHvmmA7SncHZCz1HXb/G/4VDSWf9z7rVAwP72pppu+187cV+4AAAAAAAAAACg8nwAeGeSplaV1ioAAAAASUVORK5CYII="/>
                                    </defs>
                                    </svg>
                                </button>
                            </td>
                    </tr>`
                )

                // Memanggil fungsi updateNomor untuk memperbarui nomor setelah menambahkan baris baru
                updateNomor();
            });

            $(document).on("click", ".delete-prestasi-btn", function() {
                $(this).parents("tr").remove();
                // Memanggil fungsi updateNomor untuk memperbarui nomor setelah menghapus baris
                updateNomor();
            });

            // Fungsi untuk memperbarui nomor setelah menghapus atau menambahkan baris
            function updateNomor() {
                let nomor = 1;
                $("#table-prestasi tbody tr").each(function() {
                    $(this).find("th").text(nomor);
                    nomor++;
                });
            }
        }

        sikap();
        ekstrakurikuler();
        prestasi();
    </script>

</x-layouts.app-layout>
