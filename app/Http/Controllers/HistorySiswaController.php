<?php

namespace App\Http\Controllers;

use App\Models\HistorySiswa;
use App\Models\HistorySiswa_D;
use App\Models\MappingKelas;
use App\Models\MappingKelasSiswa;
use App\Models\Semester;
use App\Services\HistorySiswaService;
use Illuminate\Http\Request;

class HistorySiswaController extends Controller
{
    public function __construct(HistorySiswaService $historySiswaService)
    {
        $this->historySiswaService = $historySiswaService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.dashboard.history-siswa.index', [
            'title' => 'History Siswa',
            'historySiswa' => HistorySiswa::with('semester', 'semester.tahunajaran', 'kelas', 'siswa')->sortable(['idHistory' => 'desc'])->filter(request(['search']))->paginate(10)->withQueryString(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.dashboard.history-siswa.create', [
            'title' => 'Tambah History Siswa',
            'semester' => Semester::with('tahunajaran')->orderBy('idSemester', 'desc')->get(),
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
        return $this->historySiswaService->storeHistorySiswa($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\HistorySiswa  $historySiswa
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('pages.dashboard.history-siswa.show', [
            'title' => 'View History Siswa',
            'historySiswa' => HistorySiswa::with('semester', 'semester.tahunajaran', 'kelas', 'siswa')->where('idHistory', $id)->first(),
            'historySiswaD' => HistorySiswa_D::where('idHistory', $id)->get(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\HistorySiswa  $historySiswa
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('pages.dashboard.history-siswa.edit', [
            'title' => 'Ubah History Siswa',
            'historySiswa' => HistorySiswa::with('semester', 'semester.tahunajaran', 'kelas', 'siswa')->where('idHistory', $id)->first(),
            'historySiswaD' => HistorySiswa_D::where('idHistory', $id)->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\HistorySiswa  $historySiswa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return $this->historySiswaService->updateHistorySiswa($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HistorySiswa  $historySiswa
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        HistorySiswa::where('idHistory', $id)->delete();
        
        $notif = notify()->success('Data History Siswa Berhasil Dihapus');
        
        return back()->with('notif', $notif);
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
}
