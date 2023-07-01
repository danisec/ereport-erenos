<x-layouts.app-layout title="{{ $title }}">

    <x-organisms.header-dashboard />

    <section class="layout min-h-screen bg-hero py-6 font-rubik">
        <div class="w-full rounded-2xl bg-white py-5 shadow-sm">

            <div class="w-6/12 rounded-r-2xl bg-hero py-2">
                <h4 class="text-gray-9000 px-11 text-2xl font-bold text-white">Menambah Nilai</h4>
            </div>

            <form class="flex flex-col gap-3 px-11 pt-9" action="{{ route('nilai.store') }}" method="post">
                @csrf

                <div class="flex flex-col gap-1">

                    <input name="NIP" type="hidden" value="{{ Auth::user()->NIP }}">

                    <div class="flex flex-row items-center gap-36">
                        <div class="flex flex-row items-center">
                            <label class="mb-2 w-32 text-xl font-medium leading-9">Kelas</label>

                            <select class="field-input-indigo w-40" name="idKelas" required>
                                <option selected disabled hidden>Kelas</option>
                                @foreach ($kelas as $item)
                                    <option value="{{ $item->idKelas }}">{{ $item->kelas }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="flex flex-row items-center">
                            <label class="mb-2 w-28 text-xl font-medium leading-9">Tanggal</label>

                            <input class="field-input-indigo w-48" id="date" name="tanggal" type="date"
                                required />
                        </div>
                    </div>

                    @error('idKelas')
                        <p class="invalid-feedback ml-32">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="flex flex-row items-center">
                    <label class="mb-2 w-32 text-xl font-medium leading-9">Pelajaran</label>

                    <select class="field-input-indigo w-96" id="pelajaran" name="idPelajaran" required>
                        <option selected disabled hidden>Pelajaran</option>
                        @foreach ($pelajaran as $item)
                            <option value="{{ $item->idPelajaran }}">{{ $item->nmPelajaran }}</option>
                        @endforeach
                    </select>

                    @error('idPelajaran')
                        <p class="invalid-feedback ml-44">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="flex flex-col">
                    <div class="flex flex-row">
                        <label class="mb-2 w-32 text-xl font-medium leading-9">Materi</label>

                        <select class="field-input-indigo w-96" id="materi" name="idMateri" required>
                            <option selected disabled hidden>Materi</option>
                            @foreach ($materi as $item)
                                <option value="{{ $item->idMateri }}">{{ $item->materi }}</option>
                            @endforeach
                        </select>
                    </div>

                    @error('idMateri')
                        <p class="invalid-feedback ml-32">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="flex flex-col">
                    <div class="flex flex-row">
                        <label class="mb-2 w-32 text-xl font-medium leading-9">Aspek</label>

                        <select class="field-input-indigo w-48" name="aspek" required>
                            <option selected disabled hidden>Aspek</option>
                            @foreach ($aspek as $item)
                                <option value="{{ $item }}">{{ $item }}</option>
                            @endforeach
                        </select>
                    </div>

                    @error('aspek')
                        <p class="invalid-feedback ml-32">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="flex flex-col">
                    <div class="flex flex-row">
                        <label class="mb-2 w-32 text-xl font-medium leading-9">Jenis</label>

                        <select class="field-input-indigo w-48" name="jenis" required>
                            <option selected disabled hidden>Jenis</option>
                            @foreach ($jenis as $item)
                                <option value="{{ $item }}">{{ $item }}</option>
                            @endforeach
                        </select>
                    </div>

                    @error('jenis')
                        <p class="invalid-feedback ml-32">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="flex flex-row justify-end">
                    <button
                        class="add-nilai-btn flex flex-row items-center rounded-md bg-cyan-300 px-2 py-1 shadow-lg shadow-gray-300 focus:outline-none"
                        id="add" type="button">
                        <p class="text-center text-xl font-normal">Tambah</p>
                        <x-atoms.plus :alt="'tambah-nilai'" />
                    </button>
                </div>

                <div>
                    <table class="w-full text-left" id="table">

                        <thead class="bg-hero text-base font-medium text-gray-500" id="table-mapping">
                            <tr>
                                <th class="w-10 px-6 py-3 text-white" scope="col">
                                    No.
                                </th>
                                <th class="py-3 pl-3 text-white" scope="col">
                                    Siswa
                                </th>
                                <th class="py-3 pl-3 text-white" scope="col">
                                    NIS
                                </th>
                                <th class="py-3 pl-3 text-white" scope="col">
                                    Nilai
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
                                    <select
                                        class="field-input-indigo nmSiswa-dropdown text-md nilai-input w-72 font-normal"
                                        name="nmSiswa[]" required>
                                        <option selected disabled hidden>Nama</option>
                                        @foreach ($namasiswa as $item)
                                            <option value="{{ $item->nmSiswa }}">{{ $item->nmSiswa }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td class="pl-3">
                                    <select class="field-input-indigo nis-dropdown text-md nilai-input w-40 font-normal"
                                        name="NIS[]" required>
                                        <option selected disabled hidden>NIS</option>
                                        @foreach ($nis as $item)
                                            <option value="{{ $item->NIS }}">{{ $item->NIS }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td class="pl-3">
                                    <input class="field-input-indigo text-md nilai-input w-40 font-normal"
                                        name="nilai[]" required placeholder="Nilai" />
                                </td>
                                <td class="w-10 text-center">
                                    <button class="delete-nilai-btn focus:outline-none" type="button">
                                        <x-atoms.trash :alt="'hapus-nilai'" />
                                    </button>
                                </td>
                            </tr>
                        </tbody>

                    </table>
                </div>

                <div class="flex flex-row items-center gap-14 py-3">
                    <button
                        class="ml-64 rounded-sm bg-cyan-300 px-10 py-3 text-center text-sm font-normal shadow-xl shadow-gray-300">Submit</button>

                    <a class="rounded-sm bg-cyan-300 px-10 py-3 text-center text-sm font-normal shadow-xl shadow-gray-300"
                        href="{{ route('nilai.index') }}">Cancel</a>
                </div>
            </form>

        </div>

    </section>

    <script type="module">
        // Event binding awal
        bindDropdownEvents();

        let i = 1; // Ubah nilai awal menjadi 1, agar nomor dimulai dari 1

        $("#add").click(function () {
            i++; // Increment nilai i

            $('#table').append(
            `<tr>
                <th class="px-9" scope="row">${i}</th>
                    <td class="pl-3">
                        <select class="field-input-indigo nmSiswa-dropdown nilai-input w-72" name="nmSiswa[]" required>
                            <option selected disabled hidden>Nama</option>
                            @foreach ($namasiswa as $item)
                                <option value="{{ $item->nmSiswa }}">{{ $item->nmSiswa }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td class="pl-3">
                        <select class="field-input-indigo nis-dropdown nilai-input w-40" name="NIS[]" required>
                            <option selected disabled hidden>NIS</option>
                            @foreach ($nis as $item)
                                <option value="{{ $item->NIS }}">{{ $item->NIS }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td class="pl-3">
                        <input class="field-input-indigo nilai-input w-40" name="nilai[]" required placeholder="Nilai" />
                    </td>
                        <td class="w-10 text-center">
                            <button class="delete-nilai-btn focus:outline-none" type="button">
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

            // Memanggil ulang event binding setelah menambahkan kolom baru
            bindDropdownEvents();
        });

        $(document).on("click", ".delete-nilai-btn", function () {
            $(this).parents("tr").remove();
            // Memanggil fungsi updateNomor untuk memperbarui nomor setelah menghapus baris
            updateNomor();
        });

        // Fungsi untuk memperbarui nomor setelah menghapus atau menambahkan baris
        function updateNomor() {
            let nomor = 1;
            $("#table tbody tr").each(function () {
                $(this).find("th").text(nomor);
                nomor++;
            });
        }

        // Fungsi untuk melakukan event binding pada dropdown
        function bindDropdownEvents() {
            $(".nis-dropdown").on("change", function () {
                const nis = $(this).val();
                const nmSiswaDropdown = $(this).closest("tr").find(".nmSiswa-dropdown");
                nmSiswaDropdown.empty();

                $.ajax({
                    url: "/dashboard/nilai/tambah-nilai/" + nis + "/getNis",
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        $.each(data, function (key, value) {
                            nmSiswaDropdown.append(
                                '<option value="' + value.nmSiswa + '">' + value.nmSiswa + "</option>"
                            );
                        });
                    },
                    error: function (xhr, status, error) {
                        console.error(xhr.responseText);
                    },
                });
            });

            $(".nmSiswa-dropdown").on("change", function () {
                const nmSiswa = $(this).val();
                const nisDropdown = $(this).closest("tr").find(".nis-dropdown");
                nisDropdown.empty();

                $.ajax({
                    url: "/dashboard/nilai/tambah-nilai/" + nmSiswa + "/getNmSiswa",
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        $.each(data, function (key, value) {
                            nisDropdown.append(
                                '<option value="' + value.NIS + '">' + value.NIS + "</option>"
                            );
                        });
                    },
                    error: function (xhr, status, error) {
                        console.error(xhr.responseText);
                    },
                });
            });
        }
    </script>

</x-layouts.app-layout>
