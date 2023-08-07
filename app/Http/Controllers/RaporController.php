<?php

namespace App\Http\Controllers;

use App\Models\MappingKelas;
use App\Models\MappingKelasSiswa;
use App\Models\Rapor;
use App\Models\Rapor_D;
use App\Models\Semester;
use App\Models\Setting;
use App\Services\RaporService;
use DateTime;
use Illuminate\Http\Request;
use PDF;

class RaporController extends Controller
{
    public function __construct(RaporService $raporService)
    {
        $this->raporService = $raporService;
        $this->namaSekolah = 'SD Erenos';
        $this->alamatSekolah = 'Jl. Palapa RT 03/18 (Villa Dago Tol) Serua, Ciputat, Kota Tangerang Selatan';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $semester = Semester::orderBy('idSemester', 'desc')->get();

        return view('pages.dashboard.rapor.index', [
            'title' => 'Rapor',
            'semester' => $semester,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($tahunAjaran, $nis)
    {
        // Data Siswa
        // Cari tahunajaran berdasarkan idSemester
        $semester = Semester::with('tahunajaran')->where('idSemester', $tahunAjaran)->first();
        // Dapatkan idThnAjaran dari $tahunAjaran
        $tahunAjaran = $semester->tahunajaran->idThnAjaran;
        // Cari siswa di mappingkelas berdasarkan idThnAjaran
        $getSiswaMapping = MappingKelas::with('mappingkelas_d')->where('idThnAjaran', $tahunAjaran)->first();
        $getSiswa = $getSiswaMapping->mappingkelas_d->where('NIS', $nis)->first();

        // Data Nilai
        $idSemester = $semester->idSemester;
        $nilaiAkhir = $this->raporService->getNilaiRapor($nis, $idSemester);
 
        // Data Presensi
        $idSemester = $semester->idSemester;
        $statusCounts = $this->raporService->getPresensiRapor($nis, $idSemester);
        
        return view('pages.dashboard.rapor.create', [
            'title' => 'Tambah Rapor',
            'getSiswaNIS' => $getSiswa,
            'semester' => $semester,
            'nilai' => $nilaiAkhir,
            'kehadiran' => $statusCounts,
            'namaSekolah' => $this->namaSekolah,
            'alamatSekolah' => $this->alamatSekolah,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->raporService->storeRapor($request);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Rapor  $rapor
     * @return \Illuminate\Http\Response
     */
    public function edit($idRapor)
    {
        // Dapatkan data rapor berdasarkan idRapor sebelumnya dari fungsi store di atas
        $rapor = Rapor::with('siswa', 'kelas', 'semester', 'rapor_d', 'rapor_nilai')->find($idRapor);
        $raporSiswa = Rapor_D::where('idRapor', $idRapor)->get();

        // Pastikan data rapor ditemukan
        if (!$rapor) {
            abort(404);
        }

        // Data Nilai
        $nis = $rapor->NIS;
        $idSemester = $rapor->idSemester;
        $getRaporNilai = $rapor->rapor_nilai()->where('idRapor', $idRapor)->with('pelajaran')->get();
        // $nilaiAkhir = $this->raporService->getNilaiRapor($nis, $idSemester);

        // Data Presensi
        $idSemester = $rapor->idSemester;
        $statusCounts = $this->raporService->getPresensiRapor($nis, $idSemester);

        return view('pages.dashboard.rapor.edit', [
            'title' => 'Ubah Rapor',
            'rapor' => $rapor,
            'raporSiswa' => $raporSiswa,
            'nilai' => $getRaporNilai,
            'kehadiran' => $statusCounts,
            'namaSekolah' => $this->namaSekolah,
            'alamatSekolah' => $this->alamatSekolah,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Rapor  $rapor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $idRapor)
    {
        return $this->raporService->updateRapor($request, $idRapor);
    }

    /**
     * Display a pdf.
     *
     * @return \Illuminate\Http\Response
     */
    public function pdfShow($idRapor)
    {
        // Dapatkan data rapor berdasarkan idRapor sebelumnya dari fungsi store di atas
        $rapor = Rapor::with('siswa', 'kelas', 'semester', 'rapor_d')->find($idRapor);
        $raporSiswa = Rapor_D::where('idRapor', $idRapor)->get();

        // Cari nama wali kelas berdasarkan idSemester, relasi idThnAjaran di model MappingKelas
        $getThnAjaran = Rapor::with('semester')->where('idSemester', $rapor->idSemester)->first();
        $thnAjaran = $getThnAjaran->semester->idThnAjaran;
        $getWaliKelas = MappingKelas::with('guru')->where('idThnAjaran', $thnAjaran)->first();

        // Cari nama kepala sekolah
        $namaKepSek = Setting::get()->first();

        // Pastikan data rapor ditemukan
        if (!$rapor) {
            abort(404); // Atau tampilkan pesan kesalahan sesuai kebutuhan
        }

        // Data Nilai
        $getRaporNilai = $rapor->rapor_nilai()->where('idRapor', $idRapor)->with('pelajaran')->get();
        
        // Data Presensi
        $nis = $rapor->NIS;
        $idSemester = $rapor->idSemester;
        $statusCounts = $this->raporService->getPresensiRapor($nis, $idSemester);
        
        // Buat tanggal, bulan, tahun secara otomatis
        $dateTime = new DateTime();
        $tanggal = $dateTime->format('d');
        $namaBulan = $dateTime->format('F');
        $tahun = $dateTime->format('Y');

        $bulan = [
            'January' => 'Januari',
            'February' => 'Februari',
            'March' => 'Maret',
            'April' => 'April',
            'May' => 'Mei',
            'June' => 'Juni',
            'July' => 'Juli',
            'August' => 'Agustus',
            'September' => 'September',
            'October' => 'Oktober',
            'November' => 'November',
            'December' => 'Desember',
        ];

        $namaBulan = $bulan[$namaBulan];

        $getDMY = $tanggal . ' ' . $namaBulan . ' ' . $tahun;

        $data = [
            'title' => 'RAPOR PESERTA DIDIK DAN PROFIL PESERTA DIDIK - ' . $rapor->siswa->nmSiswa,
            'rapor' => $rapor,
            'raporSiswa' => $raporSiswa,
            'waliKelas' => $getWaliKelas->guru->namaGuru,
            'kepsek' => $namaKepSek->KepSek,
            'nilai' => $getRaporNilai,
            'kehadiran' => $statusCounts,
            'tanggal' => $getDMY,
            'namaSekolah' => $this->namaSekolah,
            'alamatSekolah' => $this->alamatSekolah,
        ];

        $pdf = PDF::loadView('pages.dashboard.rapor.pdf', $data);

        $pdf->setPaper('A4');

        $pdf->render();

        return $pdf->stream('laporan.pdf');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MappingKelas  $MappingKelas
     * @return \Illuminate\Http\Response
     */
    public function getThnAjaranList($tahunAjaran)
    {
        // Cari tahunajaran berdasarkan idSemester
        $tahunAjaran = Semester::with('tahunajaran')->where('idSemester', $tahunAjaran)->first();

        // Cari kelas berdasarkan idThnAjaran
        $kelas = MappingKelas::with('kelas')->where('idThnAjaran', $tahunAjaran->tahunajaran->idThnAjaran)->get();

        return response()->json($kelas);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MappingKelas  $MappingKelas
     * @return \Illuminate\Http\Response
     */
    public function getSiswaList($kelas)
    {
        // Get input idKelas from ajax
        $kelas = MappingKelas::with('kelas')->where('idKelas', $kelas)->get();
        
        // Get idMapping from $kelas
        $idMapping = $kelas->pluck('idMapping');

        // Cari NIS berdasarkan idMapping yang didapat dari $idMapping pada table mappingkelas_d
        $siswa = MappingKelasSiswa::with('siswa')
                ->whereIn('idMapping', $idMapping)
                ->join('siswa', 'mappingkelas_d.NIS', '=', 'siswa.NIS')
                ->orderBy('siswa.nmSiswa')
                ->get();

        return response()->json($siswa);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Rapor  $Rapor
     * @return \Illuminate\Http\Response
     */
    public function cekRapor($tahunAjaran, $nis)
    {
        // Cek apakah siswa sudah memiliki rapor
        $cekRapor = Rapor::where('idSemester', $tahunAjaran)->where('NIS', $nis)->first();

        if ($cekRapor) {
            return response()->json([
                'status' => 'success',
                'message' => 'Siswa sudah memiliki rapor',
                'data' => $cekRapor
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Siswa belum memiliki rapor'
            ]);
        }
        
        return response()->json($cekRapor);
    }
}
