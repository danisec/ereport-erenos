<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\MappingJadwal;
use App\Models\Pelajaran;
use App\Models\Siswa;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() {
        // Perbandingan Jumlah guru dengan jumlah siswa
        $guruCount = Guru::count();
        $siswaCount = Siswa::count();

        // Jumlah siswa baru per Tahun Akademik
        $tahunAkademikSiswa = Siswa::selectRaw('YEAR(created_at) AS tahun_akademik')
        ->groupBy('tahun_akademik')
        ->orderBy('tahun_akademik')
        ->pluck('tahun_akademik');

        $jumlahSiswa = Siswa::selectRaw('COUNT(*) AS total_siswa')
            ->selectRaw('YEAR(created_at) AS tahun_akademik')
            ->groupBy('tahun_akademik')
            ->orderBy('tahun_akademik')
            ->pluck('total_siswa');

        // Jumlah guru per Tahun Akademik
        $tahunAkademikGuru = Guru::selectRaw('YEAR(created_at) AS tahun_akademik')
            ->groupBy('tahun_akademik')
            ->orderBy('tahun_akademik')
            ->pluck('tahun_akademik');

        $jumlahGuru = Guru::selectRaw('COUNT(*) AS total_guru')
            ->selectRaw('YEAR(created_at) AS tahun_akademik')
            ->groupBy('tahun_akademik')
            ->orderBy('tahun_akademik')
            ->pluck('total_guru');
        
        // Rata-rata nilai per pelajaran
        $pelajaran = Pelajaran::with('materi.nilai.nilai_d')->get();

        $rataRata = $pelajaran->map(function ($item) {
            return [
                'pelajaran' => $item->nmPelajaran,
                'rataRata' => $item->materi->map(function ($item) {
                    return $item->nilai->map(function ($item) {
                        return $item->nilai_d->avg('nilai');
                    })->avg();
                })->avg()
            ];
        });

        $chartNilai = [];
        foreach ($rataRata as $item) {
            $chartNilai[] = [
                'pelajaran' => $item['pelajaran'],
                'rata_rata' => $item['rataRata'],
                'backgroundColor' => '#' . substr(md5(rand()), 0, 6), // warna acak untuk setiap pelajaran
            ];
        }

        // Presensi siswa
        $presensiSiswa = MappingJadwal::with('kehadiran.kehadiran_d')->get();

        $persentaseKehadiran = $presensiSiswa->map(function ($item) {
            return [
                'kelas' => $item->kelas->kelas,
                'tanggal' => $item->kehadiran->map(function ($item) {
                    return $item->tanggal;
                }),
                'jumlahHadir' => $item->kehadiran->map(function ($item) {
                    return $item->kehadiran_d->where('status', 'Hadir')->count();
                }),
                'jumlahIzin' => $item->kehadiran->map(function ($item) {
                    return $item->kehadiran_d->where('status', 'Izin')->count();
                }),
                'jumlahSakit' => $item->kehadiran->map(function ($item) {
                    return $item->kehadiran_d->where('status', 'Sakit')->count();
                }),
                'jumlahAlpha' => $item->kehadiran->map(function ($item) {
                    return $item->kehadiran_d->where('status', 'Alpha')->count();
                }),
            ];
        });

        $chartPresensi = [];
        foreach ($persentaseKehadiran as $item) {
            $chartPresensi[] = [
                'kelas' => $item['kelas'],
                'tanggal' => $item['tanggal'],
                'jumlah_hadir' => $item['jumlahHadir'],
                'jumlah_izin' => $item['jumlahIzin'],
                'jumlah_sakit' => $item['jumlahSakit'],
                'jumlah_alpha' => $item['jumlahAlpha'],
                'backgroundColor' => '#' . substr(md5(rand()), 0, 6),
            ];
        }

        return view('pages.dashboard.home.index', [
            'title' => 'Dashboard',
            'guruCount' => $guruCount,
            'siswaCount' => $siswaCount,
            'tahunAkademikSiswa' => $tahunAkademikSiswa,
            'jumlahSiswa' => $jumlahSiswa,
            'tahunAkademikGuru' => $tahunAkademikGuru,
            'jumlahGuru' => $jumlahGuru,
            'chartNilai' => $chartNilai,
            'chartPresensi' => $chartPresensi,
        ]);
    }
}
