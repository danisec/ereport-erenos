<x-app-layout title="{{ $title }}">

    <x-header-dashboard />

    <section class="layout min-h-screen bg-hero py-6 font-rubik">
        <div class="w-full rounded-2xl bg-white py-5 shadow-sm">

            <div class="w-8/12 rounded-r-2xl bg-hero py-2">
                <h4 class="text-gray-9000 px-11 text-2xl font-bold uppercase text-white">Rapor Peserta Didik Dan Profil
                    Peserta
                    Didik</h4>
            </div>

            <form action="{{ route('rapor.update', $rapor->idRapor) }}" method="post">
                @method('put')
                @csrf

                <section class="flex flex-col gap-3 px-11 pt-9">

                    <div class="flex flex-col gap-1">

                        <div class="flex flex-row items-center gap-20">
                            <div class="flex flex-row items-center">
                                <label class="mb-2 w-52 text-xl font-medium leading-9">Nama Murid</label>

                                <input class="field-input-gray w-96" name="nmSiswa" type="text"
                                    value="{{ $rapor->siswa->nmSiswa }}" required @disabled(true)
                                    @readonly(true) />
                            </div>

                            <div class="flex flex-row items-center">
                                <label class="mb-2 w-40 text-xl font-medium leading-9">Kelas</label>

                                <input class="field-input-gray w-40" name="kelas" type="text"
                                    value="{{ $rapor->kelas->kelas }} SD" required @disabled(true)
                                    @readonly(true) />
                            </div>
                        </div>

                    </div>

                    <div class="flex flex-col gap-1">

                        <div class="flex flex-row items-center gap-20">
                            <div class="flex flex-row items-center">
                                <label class="mb-2 w-52 text-xl font-medium leading-9">Nomor Induk/NISN</label>

                                <input class="field-input-gray w-96" name="NIS" type="text"
                                    value="{{ $rapor->NIS }}" required @readonly(true) />
                            </div>

                            <div class="flex flex-row items-center">
                                <label class="mb-2 w-40 text-xl font-medium leading-9">Semester</label>

                                <input class="field-input-gray w-40" name="semester" type="text"
                                    value="{{ $rapor->semester->semester == 'Genap' ? 'II ( DUA )' : 'I ( SATU )' }}"
                                    required @disabled(true) @readonly(true) />
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
                                    value="{{ $rapor->semester->tahunajaran->thnAjaran }}" required
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
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($raporSiswa as $item)
                                    @if (!empty($item->nmSikap))
                                        <tr class="bg-white text-base font-medium leading-5 hover:bg-gray-50">
                                            <th class="px-9" scope="row">{{ $loop->iteration }}</th>
                                            <td class="pl-3">
                                                <textarea class="field-input-indigo text-md sikap-input w-full font-normal" name="nmSikap[]" required rows="1"
                                                    placeholder="Sikap">{{ $item->nmSikap }}</textarea>
                                            </td>
                                            <td class="pl-3">
                                                <textarea class="deskripsiTextarea field-input-indigo text-md sikap-input w-full font-normal" name="deskripsiSikap[]"
                                                    required rows="1" placeholder="Deskripsi">{{ $item->deskripsiSikap }}</textarea>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
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
                                @foreach ($nilai as $item)
                                    <tr class="bg-white text-base font-medium leading-5 hover:bg-gray-50">
                                        <th class="px-9" scope="row">{{ $loop->iteration }}</th>
                                        <td class="pl-3">
                                            <input name="idPelajaran[]" type="hidden"
                                                value="{{ $item->pelajaran->idPelajaran }}">

                                            <textarea class="deskripsiTextarea field-input-gray text-md nilai-input w-full font-normal" required rows="1"
                                                placeholder="Pelajaran" @readonly(true)>{{ $item->pelajaran->nmPelajaran }}</textarea>
                                        </td>
                                        <td class="pl-3">
                                            <textarea class="field-input-gray text-md nilai-input w-20 font-normal" required rows="1" placeholder="KKM"
                                                @readonly(true)>{{ $item->pelajaran->KKM }}</textarea>
                                        </td>
                                        <td class="pl-3">
                                            <textarea class="field-input-gray text-md nilai-input w-20 font-normal" name="nilaiPengetahuan[]" required
                                                rows="1" placeholder="Nilai" @readonly(true)>{{ round($item->nilaiPengetahuan) }}</textarea>
                                        </td>
                                        <td class="pl-3">
                                            <textarea class="field-input-gray text-md nilai-input w-12 font-normal" name="predikatPengetahuan[]" required
                                                rows="1" @readonly(true)>{{ $item->predikatPengetahuan }}</textarea>
                                        </td>
                                        <td class="pl-3">
                                            <textarea class="deskripsiTextarea field-input-indigo nilai-input w-full text-base font-normal"
                                                name="deskripsiPengetahuan[]" required rows="1" placeholder="Deskripsi">{{ $item->deskripsiPengetahuan }}</textarea>
                                        </td>

                                        <td class="pl-3">
                                            <textarea class="field-input-gray text-md nilai-input w-20 font-normal" name="nilaiKeterampilan[]" required
                                                rows="1" placeholder="Nilai" @readonly(true)>{{ round($item->nilaiKeterampilan) }}</textarea>
                                        </td>
                                        <td class="pl-3">
                                            <textarea class="field-input-gray text-md nilai-input w-12 font-normal" name="predikatKeterampilan[]" required
                                                rows="1" @readonly(true)>{{ $item->predikatKeterampilan }}</textarea>
                                        </td>
                                        <td class="pl-3">
                                            <textarea class="deskripsiTextarea field-input-indigo nilai-input w-full text-base font-normal"
                                                name="deskripsiKeterampilan[]" required rows="1" placeholder="Deskripsi">{{ $item->deskripsiKeterampilan }}</textarea>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div>
                </section>

                <section class="flex flex-col gap-3 px-11 pt-9">
                    <h4 class="text-xl font-semibold text-gray-900">C. Ekstrakurikuler</h4>

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
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($raporSiswa as $item)
                                    @if (!empty($item->nmEkstrakurikuler))
                                        <tr class="bg-white text-base font-medium leading-5 hover:bg-gray-50">
                                            <th class="px-9" scope="row">{{ $loop->iteration }}</th>
                                            <td class="pl-3">
                                                <textarea class="field-input-indigo text-md ekstrakurikuler-input w-full font-normal" name="nmEkstrakurikuler[]"
                                                    required rows="1" placeholder="Kegiatan">{{ $item->nmEkstrakurikuler }}</textarea>
                                            </td>
                                            <td class="pl-3">
                                                <textarea class="field-input-indigo text-md ekstrakurikuler-input w-full font-normal"
                                                    name="deskripsiEkstrakurikuler[]" rows="1" placeholder="Keterangan">{{ $item->deskripsiEkstrakurikuler }}</textarea>
                                            </td>
                                            <td class="w-10 text-center">
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>

                        </table>
                    </div>
                </section>

                <section class="flex flex-col gap-3 px-11 pt-9">
                    <h4 class="text-xl font-semibold text-gray-900">D. Saran-saran</h4>

                    <div>
                        <textarea class="deskripsiTextarea field-input-indigo w-full" name="saran" type="text"
                            placeholder="Saran-saran">{{ $rapor->saran }}</textarea>
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
                                        Semester @if ($rapor->semester->semester == 'Genap')
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
                                            value="{{ number_format($rapor->siswa->tinggi, 0) }} Cm" required
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
                                            value="{{ number_format($rapor->siswa->berat, 0) }} Kg" required
                                            @disabled(true) @readonly(true) />
                                    </td>
                                </tr>
                            </tbody>

                        </table>
                    </div>
                </section>

                <section class="flex flex-col gap-3 px-11 pt-9">
                    <h4 class="text-xl font-semibold text-gray-900">F. Prestasi</h4>

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
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($raporSiswa as $item)
                                    @if (!empty($item->nmPrestasi))
                                        <tr class="bg-white text-base font-medium leading-5 hover:bg-gray-50">
                                            <th class="px-9" scope="row">{{ $loop->iteration }}</th>
                                            <td class="pl-3">
                                                <textarea class="field-input-indigo text-md prestasi-input w-full font-normal" name="nmPrestasi[]" rows="1"
                                                    placeholder="Prestasi">{{ $item->nmPrestasi }}</textarea>
                                            </td>
                                            <td class="pl-3">
                                                <textarea class="field-input-indigo text-md prestasi-input w-full font-normal" name="deskripsiPrestasi[]"
                                                    rows="1" placeholder="Keterangan">{{ $item->deskripsiPrestasi }}</textarea>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>

                        </table>
                    </div>
                </section>

                <section class="flex flex-col gap-3 px-11 pt-9">
                    <h4 class="text-xl font-semibold text-gray-900">G. Ketidakhadiran</h4>

                    <div>
                        <table class="w-full text-left" id="table">

                            <tbody>
                                @foreach ($kehadiran as $index => $item)
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
                                @endforeach
                            </tbody>

                        </table>
                    </div>
                </section>

                <div class="flex flex-row items-center gap-14 px-11 py-3">
                    <button
                        class="ml-52 rounded-sm bg-cyan-300 px-10 py-3 text-center text-sm font-normal shadow-xl shadow-gray-300">Ubah</button>

                    <a class="flex flex-row gap-1 rounded-sm bg-cyan-300 px-8 py-3 text-center text-sm font-normal shadow-xl shadow-gray-300"
                        href="{{ route('rapor.pdfShow', $rapor->idRapor) }}" target="_blank"
                        rel="noopener noreferrer">
                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0110.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0l.229 2.523a1.125 1.125 0 01-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0021 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 00-1.913-.247M6.34 18H5.25A2.25 2.25 0 013 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 011.913-.247m10.5 0a48.536 48.536 0 00-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5zm-3 0h.008v.008H15V10.5z" />
                        </svg>
                        Cetak
                    </a>

                    <a class="rounded-sm bg-cyan-300 px-10 py-3 text-center text-sm font-normal shadow-xl shadow-gray-300"
                        href="{{ route('rapor.index') }}">Cancel</a>
                </div>

            </form>

        </div>

    </section>

    </x-layouts.app-layout>
