<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>
</head>

<style>
    body {
        font-family: Arial, Helvetica, sans-serif;
        line-height: 1.5;
    }

    .text-header-center {
        font-size: 16px;
        font-weight: bold;
        text-align: center;
    }

    .text-header-left {
        font-size: 16px;
        font-weight: bold;
        text-align: left;
    }

    .text-table-left-bold {
        font-size: 14px;
        font-weight: bold;
        text-align: left;
    }

    .text-table-left {
        font-size: 14px;
        text-align: left;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    td,
    th {
        border: 1px solid #000;
        text-align: left;
        font-size: 14px;
    }

    .no-border td,
    .no-border th {
        border: none;
    }

    .no-border-vertical td,
    .no-border-verical th {
        border-left: none;
        border-right: none;
    }
</style>

<body>
    <section>
        <h1 class="text-header-center">{{ $title }}</h1>

        <table>
            <tbody class="no-border">
                <tr>
                    <td>Nama Murid <span style="margin-left:54px;">:</span> <span
                            style="margin-left:12px;">{{ $rapor->siswa->nmSiswa }}</span></td>
                    <td>Kelas <span style="margin-left:82px;">:</span> <span
                            style="margin-left:12px;">{{ $rapor->kelas->kelas }} SD</span></td>
                </tr>

                <tr>
                    <td>Nomor Induk/NISN <span style="margin-left:13px;">:</span> <span
                            style="margin-left:12px;">{{ $rapor->NIS }}</span></td>
                    <td>Semester <span style="margin-left:57px;">:</span> <span
                            style="margin-left:12px;">{{ $rapor->semester->semester == 'Genap' ? 'II ( DUA )' : 'I ( SATU )' }}</span>
                    </td>
                </tr>

                <tr>
                    <td>Nama Sekolah <span style="margin-left:39px;">:</span>
                        <span style="margin-left:12px;">{{ $namaSekolah }}</span>
                    </td>
                    <td>Tahun Pelajaran <span style="margin-left:15px;">:</span> <span
                            style="margin-left:12px;">{{ $rapor->semester->tahunajaran->thnAjaran }}</span></td>
                </tr>

            </tbody>
        </table>

        <p style="font-size: 14px; margin-top: 3px">Alamat Sekolah <span style="margin-left: 34px">:</span>
            <span style="margin-left:12px;">{{ $alamatSekolah }}</span>
        </p>
    </section>

    <section>
        <h1 class="text-header-left">A. Sikap</h1>

        <table>
            <thead>
                <tr>
                    <th style="text-align: center; background-color: rgb(216, 216, 216)" colspan="2">DESKRIPSI</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($raporSiswa as $item)
                    @if (!empty($item->nmSikap))
                        <tr>
                            <td class="text-table-left-bold text-right" style="width: 25%;">{{ $loop->iteration }}.
                                {{ $item->nmSikap }}</td>
                            <td class="text-table-left text-right">{{ $item->deskripsiSikap }}</td>
                        </tr>
                    @endif
                @endforeach
            </tbody>

        </table>
    </section>

    <section>
        <h1 class="text-header-left">B. Pengetahuan dan Keterampilan</h1>

        <table>
            <thead>
                <tr style="background-color: rgb(216, 216, 216)">
                    <th style="text-align: center; width: 5%" rowspan="2">No</th>
                    <th style="text-align: center; width: 20%" rowspan="2">Muatan pelajaran</th>
                    <th style="text-align: center; width: 6%" rowspan="2">KKM</th>
                    <th style="text-align: center" colspan="3">Pengetahuan</th>
                    <th style="text-align: center" colspan="3">Keterampilan</th>
                </tr>
                <tr style="background-color: rgb(216, 216, 216)">
                    <th style="text-align: center; width: 8%">Nilai</th>
                    <th style="width: 5%;">Pre-dikat</th>
                    <th style="text-align: center">Deskripsi</th>
                    <th style="text-align: center; width: 8%">Nilai</th>
                    <th style="width: 5%;">Pre-dikat</th>
                    <th style="text-align: center">Deskripsi</th>
                </tr>
            </thead>

            <tbody>

                @foreach ($nilai as $item)
                    <tr>
                        <td style="text-align: center;">{{ $loop->iteration }}</td>
                        <td>{{ $item->pelajaran->nmPelajaran }}</td>
                        <td style="text-align: center; font-weight: bold">{{ $item->pelajaran->KKM }}</td>
                        <td style="text-align: center; font-weight: bold">{{ round($item->nilaiPengetahuan) }}</td>
                        <td style="text-align: center;">{{ $item->predikatPengetahuan }}</td>
                        <td style="font-size: 12px">{{ $item->deskripsiPengetahuan }}</td>
                        <td style="text-align: center; font-weight: bold">{{ round($item->nilaiKeterampilan) }}</td>
                        <td style="text-align: center;">{{ $item->predikatKeterampilan }}</td>
                        <td style="font-size: 12px">{{ $item->deskripsiKeterampilan }}</td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </section>

    <section>
        <div style="float: left; width: 50%">
            <h1 class="text-header-left">C. Ekstra Kurikuler</h1>

            <table>
                <thead>
                    <tr style="background-color: rgb(216, 216, 216)">
                        <th style="text-align: center; width: 5%">No</th>
                        <th style="text-align: center">Kegiatan Ekstrakurikuler</th>
                        <th style="text-align: center; width: 30%">Keterangan</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($raporSiswa as $item)
                        @if (!empty($item->nmEkstrakurikuler))
                            <tr>
                                <td style="text-align: center;">{{ $loop->iteration }}</td>
                                <td>{{ $item->nmEkstrakurikuler }}</td>
                                <td style="text-align: center; font-weight: bold">{{ $item->deskripsiEkstrakurikuler }}
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>

            </table>
        </div>

        <div style="float: right; width: 45%">
            <h1 class="text-header-left">D. Saran-saran</h1>

            <table>
                <tbody>
                    <tr>
                        <td style="padding: 6px"><span>{{ $rapor->saran }}</span></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>

    <section style="margin-top: 11rem">
        <div style="float: left; width: 50%">
            <h1 class="text-header-left">E. TInggi dan Berat Badan</h1>

            <table>
                <thead>
                    <tr style="background-color: rgb(216, 216, 216)">
                        <th style="text-align: center; width: 5%">No</th>
                        <th style="text-align: center">Aspek Yang Dinilai</th>
                        <th style="text-align: center; width: 30%">Semester Semester @if ($rapor->semester->semester == 'Genap')
                                {{ '2' }}
                            @else
                                {{ '1' }}
                            @endif
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="text-align: center;">1</td>
                        <td>Tinggi Badan</td>
                        <td style="text-align: center; font-weight: bold">{{ number_format($rapor->siswa->tinggi, 0) }}
                            Cm</td>
                    </tr>

                    <tr>
                        <td style="text-align: center;">2</td>
                        <td>Berat Badan</td>
                        <td style="text-align: center; font-weight: bold"> {{ number_format($rapor->siswa->berat, 0) }}
                            Kg</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div style="float: right; width: 45%">
            <h1 class="text-header-left">F. Prestasi</h1>

            <table>
                <thead>
                    <tr style="background-color: rgb(216, 216, 216)">
                        <th style="text-align: center; width: 5%">No</th>
                        <th style="text-align: center">Jenis Prestasi</th>
                        <th style="text-align: center; width: 30%">Keterangan</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($raporSiswa as $item)
                        @if (!empty($item->nmPrestasi))
                            <tr>
                                <td style="text-align: center;">{{ $loop->iteration }}</td>
                                <td>{{ $item->nmPrestasi }}</td>
                                <td style="text-align: center; font-weight: bold">{{ $item->deskripsiPrestasi }}</td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>

            </table>
        </div>
    </section>

    <section style="margin-top: 9rem">
        <div style="float: left; width: 50%">
            <h1 class="text-header-left">G. Ketidakhadiran</h1>

            <table>

                <tbody>
                    @foreach ($kehadiran as $index => $item)
                        <tr>
                            <td style="border-right: none; width: 40%">{{ $index }}</td>
                            <td style="border-left: none; border-right: none">:</td>
                            <td
                                style="text-align: center; font-weight: bold; border-left: none; border-right: none; width: 1%; text-align: left">
                                {{ $item }}</td>
                            <td style="border-left: none; text-align: right; padding: 0px 6px">Hari</td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>

        <div style="float: right; width: 45%">

            <table style="margin-top: 1.5rem">
                <tbody>
                    <tr>
                        <td style="padding: 0px 6px">
                            <span>Keputusan :</span>
                            </br>

                            <span>Berdasarkan pencapaian seluruh kompetensi,
                                peserta didik
                                dinyatakan :</span>
                            </br>

                            <span>Naik/</span> <span
                                style="text-decoration: line-through">Tinggal</span><sup>&#42;</sup>{!! ')' !!}
                            kelas : <span
                                style="font-weight: bold; border-bottom: 1px solid #000; padding: 0px 40px">Lulus</span>
                        </td>
                    </tr>
                </tbody>
            </table>

            <p style="text-align: right; font-size: 14px">Tangerang Selatan, {{ $tanggal }}</p>
        </div>
    </section>

    <section style="margin-top: 11rem">

        <table>
            <thead class="no-border">
                <tr>
                    <th style="text-align: center; font-weight: normal" colspan="1">Mengetahui:</th>
                    <th style="text-align: center; font-weight: normal" colspan="1">Kepala Sekolah</th>
                    <th style="text-align: center; font-weight: normal" colspan="1">Orang Tua / Wali Murid</th>
                </tr>
                <tr>
                    <th style="text-align: center; font-weight: normal">Guru Kelas / Wali Kelas</th>
                </tr>
            </thead>

            <tbody>
                <tr class="no-border">
                    <td style="text-align: center; font-weight: bold; padding-top: 5rem">
                        {{ $waliKelas }}
                    </td>
                    <td style="text-align: center; font-weight: bold; padding-top: 5rem">
                        {!! $kepsek !!}
                    </td>
                    <td style="text-align: center; font-weight: bold; padding-top: 5rem">
                        {{ $rapor->siswa->nmOrangTua }}
                    </td>
                </tr>
            </tbody>
        </table>

    </section>

</body>

</html>
