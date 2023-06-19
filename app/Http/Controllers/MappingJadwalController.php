<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Kelas;
use App\Models\MappingJadwal;
use App\Models\Pelajaran;
use App\Models\TahunAjaran;
use App\Services\MappingJadwalService;
use Illuminate\Http\Request;

class MappingJadwalController extends Controller
{
    public function __construct(MappingJadwalService $mappingJadwalService)
    {
        $this->mappingJadwalService = $mappingJadwalService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.dashboard.mappingjadwal.index', [
            'title' => 'Mapping Jadwal',
            'jadwal' => MappingJadwal::with('tahunajaran', 'kelas', 'guru', 'pelajaran')->sortable(['idThnAjaran' => 'desc'])->filter(request(['search']))->paginate(10)->withQueryString(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.dashboard.mappingjadwal.create', [
            'title' => 'Tambah Mapping Jadwal',
            'tahunajaran' => TahunAjaran::orderBy('thnAjaran', 'desc')->get()->unique('thnAjaran'),
            'kelas' => Kelas::orderBy('kelas', 'asc')->get(),
            'guru' => Guru::orderBy('namaGuru', 'asc')->get(),
            'pelajaran' => Pelajaran::orderBy('nmPelajaran', 'asc')->get()
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
        $this->mappingJadwalService->storeMappingJadwal($request);

        $notif = notify()->success('Mapping Jadwal Berhasil Ditambahkan');

        return redirect('/dashboard/mappingjadwal')->with('notif', $notif);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MappingJadwal  $mappingJadwal
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('pages.dashboard.mappingjadwal.show', [
            'title' => 'View Mapping Jadwal',
            'jadwal' => MappingJadwal::where('idJadwal', $id)->first()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MappingJadwal  $mappingJadwal
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('pages.dashboard.mappingjadwal.edit', [
            'title' => 'Ubah Mapping Jadwal',
            'tahunajaran' => TahunAjaran::orderBy('thnAjaran', 'desc')->get(),
            'kelas' => Kelas::orderBy('kelas', 'asc')->get(),
            'guru' => Guru::orderBy('namaGuru', 'asc')->get(),
            'pelajaran' => Pelajaran::orderBy('nmPelajaran', 'asc')->get(),
            'jadwal' => MappingJadwal::where('idJadwal', $id)->first(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MappingJadwal  $mappingJadwal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->mappingJadwalService->updateMappingJadwal($request, $id);

        $notif = notify()->success('Data Mapping Jadwal Berhasil Diubah');

        return redirect('/dashboard/mappingjadwal')->with('notif', $notif);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MappingJadwal  $mappingJadwal
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        MappingJadwal::where('idJadwal', $id)->delete();
        
        $notif = notify()->success('Data Mapping Jadwal Berhasil Dihapus');
        session()->flash('notif', $notif);
        
        return back();
    }
}
