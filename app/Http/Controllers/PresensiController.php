<?php

namespace App\Http\Controllers;

use App\Models\MappingJadwal;
use App\Models\MappingKelas;
use App\Models\MappingKelasSiswa;
use App\Models\Presensi;
use App\Models\presensiSiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PresensiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kelas = MappingJadwal::with('kelas')
                ->get()
                ->unique('idKelas');

        return view('pages.dashboard.presensi.index', [
            'title' => 'Presensi',
            'presensi' => Presensi::with(['jadwal.kelas', 'jadwal.guru', 'jadwal.pelajaran'])
                        ->sortable(['tanggal' => 'desc'])
                        ->filter(request(['search']))
                        ->paginate(10)
                        ->withQueryString(),
            'kelas' => $kelas,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Get data from MappingJadwal model, get kelas using idKelas foreignkey
        $semester = MappingJadwal::with('semester')->orderBy('idSemester', 'desc')->get()->unique('idSemester');
        $kelas = MappingJadwal::with('kelas')->get()->unique('idKelas');
        $pelajaran = MappingJadwal::with('pelajaran')->get();
        $guru = MappingJadwal::with('guru')->get();

        return view('pages.dashboard.presensi.create', [
            'title' => 'Tambah Presensi',
            'semester' => $semester,
            'kelas' => $kelas,
            'pelajaran' => $pelajaran,
            'guru' => $guru,
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
        try {
            DB::beginTransaction();

            $validatedData = $request->validate([
                'tanggal' => 'required',
                'idJadwal' => 'required',
            ], [
                'tanggal.required' => 'Tanggal harus diisi',
            ]);

            // Simpan data ke tabel Presensi
            $presensi = Presensi::create($validatedData);

            // Kirim data NIS, status ke database dalam jumlah banyak menggunakan array
            $nis = $request->input('NIS');
            $status = $request->input('status');

            if (count($nis) !== count($status)) {
                throw new \Exception('Jumlah NIS dan status tidak sesuai');
            }

            $presensiSiswaData = [];
            foreach ($nis as $index => $nisValue) {
                $presensiSiswaData[] = [
                    'idKehadiran' => $presensi->id,
                    'NIS' => $nisValue,
                    'status' => $status[$index],
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }

            // Simpan data ke tabel presensiSiswa
            PresensiSiswa::insert($presensiSiswaData);

            DB::commit();

            $notif = notify()->success('Presensi Berhasil Ditambahkan');

            return redirect()->route('presensi.index')->with('notif', $notif);

        } catch (\Exception $e) {
            DB::rollback();
            $notif = notify()->error('Terjadi kesalahan: ' . $e->getMessage());
            return back()->with('notif', $notif);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Presensi  $presensi
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $presensi = Presensi::where('idKehadiran', $id)->first();

        $presensiSiswa = PresensiSiswa::with('siswa')->sortable(['siswa.nmSiswa' => 'asc'])->where('idKehadiran', $id)->get();

        return view('pages.dashboard.presensi.show', [
            'title' => 'View Mapping Jadwal',
            'presensi' => $presensi,
            'presensiSiswa' => $presensiSiswa,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Presensi  $presensi
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $presensi = Presensi::where('idKehadiran', $id)->first();

        $presensiSiswa = PresensiSiswa::with('siswa')->sortable(['siswa.nmSiswa' => 'asc'])->where('idKehadiran', $id)->get();

        return view('pages.dashboard.presensi.edit', [
            'title' => 'Ubah Mapping Jadwal',
            'presensi' => $presensi,
            'presensiSiswa' => $presensiSiswa,
            'status' => ['Hadir', 'Sakit', 'Izin', 'Alpha'],
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Presensi  $presensi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();

            $validatedData = $request->validate([
                'tanggal' => '',
                'idJadwal' => '',
            ]);

            // Peroleh model Presensi berdasarkan idKehadiran
            $presensi = Presensi::where('idKehadiran', $id);

            if (!$presensi) {
                throw new \Exception('Presensi tidak ditemukan');
            }

            // Perbarui data Presensi
            $presensi->update($validatedData);

            // Kirim data NIS, status ke database dalam jumlah banyak menggunakan array
            $nis = $request->input('NIS');
            $status = $request->input('status');

            if (is_null($nis)) {
                throw new \Exception('Data NIS tidak tersedia');
            }

            $presensiSiswaData = [];
            foreach ($nis as $index => $nisValue) {
                $presensiSiswaData[] = [
                    // get idKehadiran from Presensi model
                    'idKehadiran' => $presensi->first()->idKehadiran,
                    'NIS' => $nisValue,
                    'status' => isset($status[$index]) ? $status[$index] : null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }

            // Hapus data presensiSiswa yang terkait dengan Presensi ini
            PresensiSiswa::where('idKehadiran', $id)->delete();

            // Simpan data ke tabel presensiSiswa
            PresensiSiswa::insert($presensiSiswaData);

            DB::commit();

            $notif = notify()->success('Presensi Berhasil Diperbarui');

            return redirect()->route('presensi.index')->with('notif', $notif);

        } catch (\Exception $e) {
            DB::rollback();
            $notif = notify()->error('Terjadi kesalahan: ' . $e->getMessage());
            return back()->with('notif', $notif);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Presensi  $presensi
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Presensi::where('idKehadiran', $id)->delete();
        
        $notif = notify()->success('Data Kehadiran Berhasil Dihapus');
        session()->flash('notif', $notif);
        
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MappingJadwal  $MappingJadwal
     * @return \Illuminate\Http\Response
     */
    public function getTahunAjaranList($tahunAjaran)
    {
        $tahunAjaran = MappingJadwal::with('semester','kelas')->where('idSemester', $tahunAjaran)->get()->unique('idKelas');

        return response()->json($tahunAjaran);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MappingJadwal  $MappingJadwal
     * @return \Illuminate\Http\Response
     */
    public function getKelasList($kelas)
    {
        $kelas = MappingJadwal::with('kelas','pelajaran')->where('idKelas', $kelas)->get();

        return response()->json($kelas);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MappingJadwal  $MappingJadwal
     * @return \Illuminate\Http\Response
     */
    public function getPelajaranList($pelajaran)
    {
        $pelajaran = MappingJadwal:: with('pelajaran', 'guru')->where('idPelajaran', $pelajaran)->get();

        return response()->json($pelajaran);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MappingKelas  $MappingKelas
     * @return \Illuminate\Http\Response
     */
    public function getSiswaList($nis)
    {
        // Get input idKelas from ajax
        $kelas = MappingKelas::with('kelas')->where('idKelas', $nis)->get();
        
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
     * @param  \App\Models\MappingJadwal  $MappingJadwal
     * @return \Illuminate\Http\Response
     */
    public function filterKelasList($kelas)
    {
        $kelas = MappingJadwal::with('kelas','semester.tahunajaran')->where('idKelas', $kelas)->get()->unique('idSemester');

        return response()->json($kelas);
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MappingJadwal  $MappingJadwal
     * @return \Illuminate\Http\Response
     */
    public function getPresensiList($kelas, $tahun)
    {
        $presensi = Presensi::with(['jadwal.kelas', 'jadwal.guru', 'jadwal.pelajaran'])
        ->whereHas('jadwal', function ($query) use ($kelas, $tahun) {
            $query->where('idKelas', $kelas)
                  ->where('idSemester', $tahun);
        })
        ->get()
        ->unique('idKehadiran');

        return response()->json($presensi);
    }
}
