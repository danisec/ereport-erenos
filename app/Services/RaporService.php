<?php

namespace App\Services;

use App\Models\Nilai;
use App\Models\Nilai_D;
use App\Models\Presensi;
use App\Models\presensiSiswa;
use App\Models\Rapor;
use App\Models\Rapor_D;
use App\Models\RaporNilai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RaporService
{
    public function storeRapor(Request $request)
    {
        $validatedData = $request->validate([
            'NIS' => 'required',
            'idKelas' => 'required',
            'idSemester' => 'required',
            'saran' => 'required',
        ], [
            'NIS.required' => 'NIS harus diisi',
            'idKelas.required' => 'Kelas harus diisi',
            'idSemester.required' => 'Tahun Ajaran harus diisi',
            'saran.required' => 'Saran harus diisi',
        ]);

        // Mulai transaksi database
        DB::beginTransaction();

        try {
            // Simpan data rapor ke table rapor
            $rapor = Rapor::create($validatedData);
            $idRapor = $rapor->idRapor;

            // Validasi input rapor_d untuk memastikan data berupa array
            $validatedRaporD = $request->validate([
                'nmSikap' => 'required|array',
                'deskripsiSikap' => 'required|array',
                'nmEkstrakurikuler' => 'required|array',
                'deskripsiEkstrakurikuler' => 'required|array',
                'nmPrestasi' => 'required|array',
                'deskripsiPrestasi' => 'required|array',
            ], [
                'nmSikap.required' => 'Nama Sikap Harus Diisi',
                'deskripsiSikap.required' => 'Deskripsi Sikap Harus Diisi',
                'nmEkstrakurikuler.required' => 'Kegiatan Ekstrakurikuler Harus Diisi',
                'deskripsiEkstrakurikuler.required' => 'Keterangan Ekstrakurikuler Harus Diisi',
                'nmPrestasi.required' => 'Jenis Prestasi Harus Diisi',
                'deskripsiPrestasi.required' => 'Keterangan Prestasi Harus Diisi',
            ]);

            // Validasi input rapor_nilai untu memastikan data berupa array
            $validatedDataNilai = $request->validate([
                'idPelajaran' => 'required|array',
                'nilaiPengetahuan' => 'required|array',
                'predikatPengetahuan' => 'required|array',
                'deskripsiPengetahuan' => 'required|array',
                'nilaiKeterampilan' => 'required|array',
                'predikatKeterampilan' => 'required|array',
                'deskripsiKeterampilan' => 'required|array',
            ], [
                'idPelajaran.required' => 'Pelajaran Harus Diisi',
                'nilaiPengetahuan.required' => 'Nilai Pengetahuan Harus Diisi',
                'predikatPengetahuan.required' => 'Predikat Pengetahuan Harus Diisi',
                'deskripsiPengetahuan.required' => 'Deskripsi Pengetahuan Harus Diisi',
                'nilaiKeterampilan.required' => 'Nilai Keterampilan Harus Diisi',
                'predikatKeterampilan.required' => 'Predikat Keterampilan Harus Diisi',
                'deskripsiKeterampilan.required' => 'Deskripsi Keterampilan Harus Diisi',
            ]);

            $nmSikap = $validatedRaporD['nmSikap'];
            $deskripsiSikap = $validatedRaporD['deskripsiSikap'];
            $nmEkstrakurikuler = $validatedRaporD['nmEkstrakurikuler'];
            $deskripsiEkstrakurikuler = $validatedRaporD['deskripsiEkstrakurikuler'];
            $nmPrestasi = $validatedRaporD['nmPrestasi'];
            $deskripsiPrestasi = $validatedRaporD['deskripsiPrestasi'];

            // Ambil panjang terbesar dari ketiga array
            $length = max(count($nmSikap), count($nmEkstrakurikuler), count($nmPrestasi));

            $raporD_Data = [];
            for ($index = 0; $index < $length; $index++) {
                $raporD_Data[] = [
                    'idRapor' => $idRapor,
                    'nmSikap' => $nmSikap[$index] ?? '',
                    'deskripsiSikap' => $deskripsiSikap[$index] ?? '',
                    'nmEkstrakurikuler' => $nmEkstrakurikuler[$index] ?? '',
                    'deskripsiEkstrakurikuler' => $deskripsiEkstrakurikuler[$index] ?? '',
                    'nmPrestasi' => $nmPrestasi[$index] ?? '',
                    'deskripsiPrestasi' => $deskripsiPrestasi[$index] ?? '',
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }

            $raporNilai_Data = [];
            for ($index = 0; $index < count($validatedDataNilai['idPelajaran']); $index++) {
                $raporNilai_Data[] = [
                    'idRapor' => $idRapor,
                    'idPelajaran' => $validatedDataNilai['idPelajaran'][$index] ?? '',
                    'nilaiPengetahuan' => $validatedDataNilai['nilaiPengetahuan'][$index] ?? '',
                    'predikatPengetahuan' => $validatedDataNilai['predikatPengetahuan'][$index] ?? '',
                    'deskripsiPengetahuan' => $validatedDataNilai['deskripsiPengetahuan'][$index] ?? '',
                    'nilaiKeterampilan' => $validatedDataNilai['nilaiKeterampilan'][$index] ?? '',
                    'predikatKeterampilan' => $validatedDataNilai['predikatKeterampilan'][$index] ?? '',
                    'deskripsiKeterampilan' => $validatedDataNilai['deskripsiKeterampilan'][$index] ?? '',
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }

            // Simpan data rapor_d ke dalam tabel rapor_d secara banyak
            Rapor_D::insert($raporD_Data);
            // Simpan data rapor_nilai ke dalam tabel rapor_d secara banyak
            RaporNilai::insert($raporNilai_Data);

            // Commit transaksi jika semua operasi berhasil
            DB::commit();

            $notif = notify()->success('Data Rapor Berhasil Ditambahkan');

            return redirect()->route('rapor.edit', $idRapor)->with('notif',$notif);
        } catch (\Exception $e) {
            // Rollback transaksi jika terjadi kesalahan
            DB::rollback();

            $error = $e->getMessage();
            $notif = notify()->error('Terjadi kesalahan saat menyimpan data: ' . $error);

            return back();
        }
    }

    public function updateRapor(Request $request, $idRapor)
    {
        $validatedData = $request->validate([
            'NIS' => '',
            'idKelas' => '',
            'idSemester' => '',
            'saran' => '',
        ]);

        // Mulai transaksi database
        DB::beginTransaction();

        try {
            Rapor::where('idRapor', $idRapor)->update($validatedData);
            $idRapor = $idRapor;

            // Validasi input rapor_d untuk memastikan data berupa array
            $validatedRaporD = $request->validate([
                'nmSikap' => 'required|array',
                'deskripsiSikap' => 'required|array',
                'nmEkstrakurikuler' => 'required|array',
                'deskripsiEkstrakurikuler' => 'required|array',
                'nmPrestasi' => 'required|array',
                'deskripsiPrestasi' => 'required|array',
            ], [
                'nmSikap.required' => 'Nama Sikap Harus Diisi',
                'deskripsiSikap.required' => 'Deskripsi Sikap Harus Diisi',
                'nmEkstrakurikuler.required' => 'Kegiatan Ekstrakurikuler Harus Diisi',
                'deskripsiEkstrakurikuler.required' => 'Keterangan Ekstrakurikuler Harus Diisi',
                'nmPrestasi.required' => 'Jenis Prestasi Harus Diisi',
                'deskripsiPrestasi.required' => 'Keterangan Prestasi Harus Diisi',
            ]);

            // Validasi input rapor_nilai untu memastikan data berupa array
            $validatedDataNilai = $request->validate([
                'idPelajaran' => '|array',
                'nilaiPengetahuan' => 'required|array',
                'predikatPengetahuan' => 'required|array',
                'deskripsiPengetahuan' => 'required|array',
                'nilaiKeterampilan' => 'required|array',
                'predikatKeterampilan' => 'required|array',
                'deskripsiKeterampilan' => 'required|array',
            ], [
                'nilaiPengetahuan.required' => 'Nilai Pengetahuan Harus Diisi',
                'predikatPengetahuan.required' => 'Predikat Pengetahuan Harus Diisi',
                'deskripsiPengetahuan.required' => 'Deskripsi Pengetahuan Harus Diisi',
                'nilaiKeterampilan.required' => 'Nilai Keterampilan Harus Diisi',
                'predikatKeterampilan.required' => 'Predikat Keterampilan Harus Diisi',
                'deskripsiKeterampilan.required' => 'Deskripsi Keterampilan Harus Diisi',
            ]);

            $nmSikap = $validatedRaporD['nmSikap'];
            $deskripsiSikap = $validatedRaporD['deskripsiSikap'];
            $nmEkstrakurikuler = $validatedRaporD['nmEkstrakurikuler'];
            $deskripsiEkstrakurikuler = $validatedRaporD['deskripsiEkstrakurikuler'];
            $nmPrestasi = $validatedRaporD['nmPrestasi'];
            $deskripsiPrestasi = $validatedRaporD['deskripsiPrestasi'];

            // Ambil panjang terbesar dari ketiga array
            $length = max(count($nmSikap), count($nmEkstrakurikuler), count($nmPrestasi));

            $raporD_Data = [];
            for ($index = 0; $index < $length; $index++) {
                $raporD_Data[] = [
                    'idRapor' => $idRapor,
                    'nmSikap' => $nmSikap[$index] ?? '',
                    'deskripsiSikap' => $deskripsiSikap[$index] ?? '',
                    'nmEkstrakurikuler' => $nmEkstrakurikuler[$index] ?? '',
                    'deskripsiEkstrakurikuler' => $deskripsiEkstrakurikuler[$index] ?? '',
                    'nmPrestasi' => $nmPrestasi[$index] ?? '',
                    'deskripsiPrestasi' => $deskripsiPrestasi[$index] ?? '',
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }

            $raporNilai_Data = [];
            for ($index = 0; $index < count($validatedDataNilai['idPelajaran']); $index++) {
                $raporNilai_Data[] = [
                    'idRapor' => $idRapor,
                    'idPelajaran' => $validatedDataNilai['idPelajaran'][$index] ?? '',
                    'nilaiPengetahuan' => $validatedDataNilai['nilaiPengetahuan'][$index] ?? '',
                    'predikatPengetahuan' => $validatedDataNilai['predikatPengetahuan'][$index] ?? '',
                    'deskripsiPengetahuan' => $validatedDataNilai['deskripsiPengetahuan'][$index] ?? '',
                    'nilaiKeterampilan' => $validatedDataNilai['nilaiKeterampilan'][$index] ?? '',
                    'predikatKeterampilan' => $validatedDataNilai['predikatKeterampilan'][$index] ?? '',
                    'deskripsiKeterampilan' => $validatedDataNilai['deskripsiKeterampilan'][$index] ?? '',
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }

            // Hapus data rapor_d yang terkait dengan nilai sebelumnya
            Rapor_D::where('idRapor', $idRapor)->delete();

            // Simpan data rapor_d ke dalam tabel rapor_d secara banyak
            Rapor_D::insert($raporD_Data);

            // Hapus data rapor_nilai yang terkait dengan nilai sebelumnya
            RaporNilai::where('idRapor', $idRapor)->delete();

            // Simpan data rapor_nilai ke dalam tabel rapor_nilai secara banyak
            RaporNilai::insert($raporNilai_Data);

            // Commit transaksi jika semua operasi berhasil
            DB::commit();

            $notif = notify()->success('Data Rapor Berhasil Ditambahkan');

            return redirect()->route('rapor.edit', $idRapor)->with('notif',$notif);
        } catch (\Exception $e) {
            // Rollback transaksi jika terjadi kesalahan
            DB::rollback();

            $error = $e->getMessage();
            $notif = notify()->error('Terjadi kesalahan saat menyimpan data: ' . $error);

            return back();
        }
    }

    public function getNilaiRapor($nis, $idSemester)
    {
        // Cari nilai berdasarkan idSemester di model Nilai
        $getNilai = Nilai::with('materi.pelajaran')->where('idSemester', $idSemester)->get();

        // Dapatkan $getNilaiHarian berdasarkan query setiap nama pelajaran di relations nilai.materi.pelajaran
        // Buatkan kelompok masing-masing setiap nama pelajaran dengan ujian harian
        $nilaiHarianByPelajaran = [];
        $nilaiHarianPengetahuan = [];
        $nilaiPASByPelajaran = [];
        $nilaiHarianKeterampilan = [];

        foreach ($getNilai as $nilai) {
            $pelajaran = $nilai->materi->pelajaran->nmPelajaran;
            
            if ($nilai->jenis === 'Harian' && $nilai->aspek === 'Pengetahuan') {
                $nilaiHarianByPelajaran['Pengetahuan'][$pelajaran][] = $nilai;
            } elseif ($nilai->jenis === 'Harian' && $nilai->aspek === 'Keterampilan') {
                $nilaiHarianByPelajaran['Keterampilan'][$pelajaran][] = $nilai;
            } 
            
            if ($nilai->jenis === 'Pertengahan Akhir Semester') {
                $nilaiPASByPelajaran['PAS'][$pelajaran][] = $nilai;
            }
        }

       if (isset($nilaiHarianByPelajaran['Pengetahuan'])) {
            foreach ($nilaiHarianByPelajaran['Pengetahuan'] as $pelajaran => $nilaiHarian) {
                $idNilaiArray = [];

                foreach ($nilaiHarian as $harianNilai) {
                    $idNilaiArray[] = $harianNilai->idNilai;
                }

                $getNilaiD = Nilai_D::with(['nilai.materi.pelajaran'])
                    ->whereIn('idNilai', $idNilaiArray)
                    ->where('NIS', $nis)
                    ->get();
                
                $getPelajaran = Nilai::with('materi.pelajaran')
                    ->whereIn('idNilai', $idNilaiArray)
                    ->first()
                    ->materi
                    ->pelajaran;

                $totalNilai = 0;
                $jumlahNilai = count($getNilaiD);

                foreach ($getNilaiD as $nilaiD) {
                    $nilaiMataPelajaran = $nilaiD->nilai;
                    $totalNilai += $nilaiMataPelajaran;
                }

                $nilaiRataRata = $jumlahNilai > 0 ? $totalNilai / $jumlahNilai : 0;

                // Hitung grade A-D berdasarkan nilai dan KKM
                $KKM = $getPelajaran->KKM;
                $nilai = round($nilaiRataRata);
                $deskripsi = '';
                $grade = '';

                if ($nilai >= (100 - 1 - ((100 - $KKM) / 3))) {
                    $deskripsi = $getPelajaran->pengetahuanA;
                    $grade = 'A';
                } elseif ($nilai >= (100 - 1 - (2 * (100 - $KKM) / 3))) {
                    $deskripsi = $getPelajaran->pengetahuanB;
                    $grade = 'B';
                } elseif ($nilai >= (100 - (3 * (100 - $KKM) / 3))) {
                    $deskripsi = $getPelajaran->pengetahuanC;
                    $grade = 'C';
                } else {
                    $deskripsi = $getPelajaran->pengetahuanD;
                    $grade = 'D';
                }
            
                $nilaiHarianPengetahuan[$pelajaran]['rata_rata'] = [
                    'pelajaran' => $getPelajaran,
                    'pengetahuan' => [
                        'nilai' => round($nilaiRataRata),
                        'grade' => $grade,
                        'deskripsi' => $deskripsi,
                    ],
                ];
            }
        } else {
            $nilaiHarianPengetahuan = [];
        }

        if (isset($nilaiPASByPelajaran['PAS'])) {
            foreach ($nilaiPASByPelajaran['PAS'] as $pelajaran => $nilaiPAS) {
                $idNilaiArray = [];

                foreach ($nilaiPAS as $PASNilai) {
                    $idNilaiArray[] = $PASNilai->idNilai;
                }

                $getNilaiD = Nilai_D::with(['nilai.materi.pelajaran'])
                    ->whereIn('idNilai', $idNilaiArray)
                    ->where('NIS', $nis)
                    ->get();
                
                $getPelajaran = Nilai::with('materi.pelajaran')
                    ->whereIn('idNilai', $idNilaiArray)
                    ->first()
                    ->materi
                    ->pelajaran;

                foreach ($getNilaiD as $nilaiD) {
                    $nilaiMataPelajaran = $nilaiD->nilai;
                }

                $nilaiAkhirPAS = round((($nilaiRataRata * 2) + $nilaiMataPelajaran) / 3);

                // Hitung grade A-D berdasarkan nilai dan KKM
                $KKM = $getPelajaran->KKM;
                $nilai = round($nilaiRataRata);
                $deskripsi = '';
                $grade = '';

                if ($nilai >= (100 - 1 - ((100 - $KKM) / 3))) {
                    $deskripsi = $getPelajaran->pengetahuanA;
                    $grade = 'A';
                } elseif ($nilai >= (100 - 1 - (2 * (100 - $KKM) / 3))) {
                    $deskripsi = $getPelajaran->pengetahuanB;
                    $grade = 'B';
                } elseif ($nilai >= (100 - (3 * (100 - $KKM) / 3))) {
                    $deskripsi = $getPelajaran->pengetahuanC;
                    $grade = 'C';
                } else {
                    $deskripsi = $getPelajaran->pengetahuanD;
                    $grade = 'D';
                }

                $nilaiPASPelajaran[$pelajaran]['rata_rata'] = [
                    'PAS' => [
                        'nilai' => round($nilaiAkhirPAS),
                        'grade' => $grade,
                        'deskripsi' => $deskripsi,
                    ],
                ];
            }
        } else {
            $nilaiPASPelajaran = [];
        }

        if (isset($nilaiHarianByPelajaran['Keterampilan'])) {
            foreach ($nilaiHarianByPelajaran['Keterampilan'] as $pelajaran => $nilaiHarian) {
                $idNilaiArray = [];

                foreach ($nilaiHarian as $harianNilai) {
                    $idNilaiArray[] = $harianNilai->idNilai;
                }

                $getNilaiD = Nilai_D::with(['nilai.materi.pelajaran'])
                    ->whereIn('idNilai', $idNilaiArray)
                    ->where('NIS', $nis)
                    ->get();
                
                $getPelajaran = Nilai::with('materi.pelajaran')
                    ->whereIn('idNilai', $idNilaiArray)
                    ->first()
                    ->materi
                    ->pelajaran;

                $totalNilai = 0;
                $jumlahNilai = count($getNilaiD);

                foreach ($getNilaiD as $nilaiD) {
                    $nilaiMataPelajaran = $nilaiD->nilai;
                    $totalNilai += $nilaiMataPelajaran;
                }

                $nilaiRataRata = $jumlahNilai > 0 ? $totalNilai / $jumlahNilai : 0;

                // Hitung grade A-D berdasarkan nilai dan KKM
                $KKM = $getPelajaran->KKM;
                $nilai = round($nilaiRataRata);
                $deskripsi = '';
                $grade = '';

                if ($nilai >= (100 - 1 - ((100 - $KKM) / 3))) {
                    $deskripsi = $getPelajaran->keterampilanA;
                    $grade = 'A';
                } elseif ($nilai >= (100 - 1 - (2 * (100 - $KKM) / 3))) {
                    $deskripsi = $getPelajaran->keterampilanB;
                    $grade = 'B';
                } elseif ($nilai >= (100 - (3 * (100 - $KKM) / 3))) {
                    $deskripsi = $getPelajaran->keterampilanC;
                    $grade = 'C';
                } else {
                    $deskripsi = $getPelajaran->keterampilanD;
                    $grade = 'D';
                }

                // Simpan data rata-rata dan Keterampilan dalam variabel nilaiHarianKeterampilan
                $nilaiHarianKeterampilan[$pelajaran]['rata_rata'] = [
                    'keterampilan' => [
                        'nilai' => round($nilaiRataRata),
                        'grade' => $grade,
                        'deskripsi' => $deskripsi,
                    ],
                ];
            }
        } else {
            $nilaiHarianKeterampilan = [];
        }

        $nilaiAkhir = array_merge_recursive($nilaiHarianPengetahuan, $nilaiHarianKeterampilan, $nilaiPASPelajaran);

        return $nilaiAkhir;
    }

    public function getPresensiRapor($nis, $idSemester)
    {
        // Cari tahunajaran berdasarkan idSemester di model Presensi di relasi idJadwal
        $getKehadiran = Presensi::with('jadwal')->get();
        $getKehadiranSemester = $getKehadiran->where('jadwal.idSemester', $idSemester);
        // Cari kehadiran siswa di model PresensiSiswa idKehadiran yang telah di dapat dari $getKehadiranSemester
        $getKehadiranSiswa = presensiSiswa::with('siswa')->whereIn('idKehadiran', $getKehadiranSemester->pluck('idKehadiran'))->where('NIS', $nis)->get();

        // Jumlah kan total status hadir, sakit, izin, alpha
        // Count variable $getKehadiranSiswa berapa total status Hadir, Sakit, Izin, Alpha
        $statusCounts = $getKehadiranSiswa->groupBy('status')
                        ->map(fn ($group) => $group->count())
                        ->toArray();
        // Definisakan semua status
        $allStatus = ['Hadir', 'Sakit', 'Izin', 'Alpha'];
        // Fill in the counts for each status, set 0 if not present in $statusCounts
        $statusCounts = array_merge(array_fill_keys($allStatus, 0), $statusCounts);

        return $statusCounts;
    }
}