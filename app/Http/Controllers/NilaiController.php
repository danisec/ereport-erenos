<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\MappingKelas;
use App\Models\MappingKelasSiswa;
use App\Models\Materi;
use App\Models\Nilai;
use App\Models\Nilai_D;
use App\Models\Pelajaran;
use App\Models\Semester;
use App\Models\Siswa;
use App\Services\NilaiService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NilaiController extends Controller
{   
    public function __construct(NilaiService $nilaiService)
    {
        $this->nilaiService = $nilaiService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.dashboard.nilai.index', [
            'title' => 'Nilai',
            'nilai' => Nilai::with('materi.pelajaran', 'materi', 'kelas', 'guru')->sortable(['idKelas' => 'desc'])->filter(request(['search']))->paginate(10)->withQueryString(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $enumAspek = DB::select(DB::raw('SHOW COLUMNS FROM nilai WHERE Field = "aspek"'))[0]->Type;
        $enumJenis = DB::select(DB::raw('SHOW COLUMNS FROM nilai WHERE Field = "jenis"'))[0]->Type;

        return view('pages.dashboard.nilai.create', [
            'title' => 'Tambah Nilai',
            'semester' => Semester::orderBy('semester', 'desc')->get(),
            'kelas' => Kelas::orderBy('kelas', 'asc')->get(),
            'pelajaran' => Pelajaran::orderBy('nmPelajaran', 'asc')->get(),
            'materi' => Materi::orderBy('materi', 'asc')->get(),
            'aspek' => explode("','", substr($enumAspek, 6, (strlen($enumAspek)-8))),
            'jenis' => explode("','", substr($enumJenis, 6, (strlen($enumJenis)-8))),
            'namasiswa' => Siswa::orderBy('nmSiswa', 'asc')->get(),
            'nis' => Siswa::orderBy('NIS', 'asc')->get(),
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
        return $this->nilaiService->storeNilai($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Nilai  $nilai
     * @param  \App\Models\Nilai_D  $nilai_d
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('pages.dashboard.nilai.show', [
            'title' => 'View Nilai',
            'nilai' => Nilai::with('materi', 'materi.pelajaran')->where('idNilai', $id)->first(),
            'nilaiSiswa' => Nilai_D::with('siswa')->where('idNilai', $id)->get(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Nilai  $nilai
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $enumAspek = DB::select(DB::raw('SHOW COLUMNS FROM nilai WHERE Field = "aspek"'))[0]->Type;
        $enumJenis = DB::select(DB::raw('SHOW COLUMNS FROM nilai WHERE Field = "jenis"'))[0]->Type;

        $nilaiSiswa = Nilai_D::with('siswa')->where('idNilai', $id)->get();

        return view('pages.dashboard.nilai.edit', [
            'title' => 'Ubah Nilai',
            'nilai' => Nilai::where('idNilai', $id)->first(),
            'nilaiSiswa' => $nilaiSiswa,
            
            'kelas' => Kelas::orderBy('kelas', 'asc')->get(),
            'pelajaran' => Pelajaran::orderBy('nmPelajaran', 'asc')->get(),
            'materi' => Materi::orderBy('materi', 'asc')->get(),
            'aspek' => explode("','", substr($enumAspek, 6, (strlen($enumAspek)-8))),
            'jenis' => explode("','", substr($enumJenis, 6, (strlen($enumJenis)-8))),
            'namaSiswa' => Siswa::orderBy('nmSiswa', 'asc')->get(),
            'nis' => Siswa::orderBy('NIS', 'asc')->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Nilai  $nilai
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return $this->nilaiService->updateNilai($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Nilai  $nilai
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Nilai::where('idNilai', $id)->delete();
        
        $notif = notify()->success('Data Nilai Berhasil Dihapus');
        session()->flash('notif', $notif);
        
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Nilai_D  $nilai_d
     * @return \Illuminate\Http\Response
     */
    public function destroyUbahSiswa($id)
    {
        Nilai_D::where('idNilaiD', $id)->delete();
        
        $notif = notify()->success('Data Nilai Siswa Berhasil Dihapus');
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
        $tahunAjaran = Semester::with('tahunajaran')->where('idSemester', $tahunAjaran)->first();

        // Cari kelas berdasarkan idThnAjaran
        $kelas = MappingKelas::with('kelas')->where('idThnAjaran', $tahunAjaran->tahunajaran->idThnAjaran)->get();

        // $tahunAjaran = MappingKelas::with('tahunajaran', 'kelas')->where('idThnAjaran', $tahunAjaran)->get();

        return response()->json($kelas);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Materi  $Materi
     * @return \Illuminate\Http\Response
     */
    public function getPelajaranList($pelajaran)
    {
        $pelajaran = Materi::where('idPelajaran', $pelajaran)->get();
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
}
