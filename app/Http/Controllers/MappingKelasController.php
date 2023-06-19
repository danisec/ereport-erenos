<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Kelas;
use App\Models\MappingKelas;
use App\Models\MappingKelasSiswa;
use App\Models\Siswa;
use App\Models\TahunAjaran;
use App\Services\MappingKelasService;
use Illuminate\Http\Request;

class MappingKelasController extends Controller
{
    public function __construct(MappingKelasService $mappingKelasService)
    {
        $this->mappingKelasService = $mappingKelasService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.dashboard.mappingkelas.index', [
            'title' => 'Mapping Kelas',
            'mappingkelas' => MappingKelas::with(['tahunajaran', 'kelas', 'guru'])->sortable(['idThnAjaran' => 'desc'])->filter(request(['search']))->paginate(10)->withQueryString(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.dashboard.mappingkelas.create', [
            'title' => 'Tambah Mapping Kelas',
            'tahunajaran' => TahunAjaran::orderBy('thnAjaran', 'desc')->get()->unique('thnAjaran'),
            'kelas' => Kelas::orderBy('kelas', 'asc')->get(),
            'guru' => Guru::orderBy('namaGuru', 'asc')->get(),
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
        $this->mappingKelasService->storeMappingKelas($request);

        $notif = notify()->success('Mapping Kelas Berhasil Ditambahkan');

        return redirect('/dashboard/mappingkelas/tambah-datasiswa')->with('notif', $notif);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createsiswa(Request $request)
    {
        // Get idMapping from MappingKelas table latest
        $idMapping = MappingKelas::latest()->first();

        // input idMapping to input form hidden idMapping
        $request->request->add(['idMapping' => $idMapping->idMapping]);

        // Get data mappingkelas_d sort by idMapping latest
        $mappingkelasd = MappingKelasSiswa::orderBy('NIS', 'asc')->where('idMapping', $idMapping->idMapping)->get();

        $mappingkelas = MappingKelas::where('idMapping', $idMapping->idMapping)->first();

        return view('pages.dashboard.mappingkelas.createsiswa', [
            'title' => 'Tambah Map Data Siswa',
            'nis' => Siswa::orderBy('NIS', 'asc')->get(),
            'namasiswa' => Siswa::orderBy('nmSiswa', 'asc')->get(),
            'idMapping' => $idMapping,
            'mappingkelasd' => $mappingkelasd,
            'mappingkelas' => $mappingkelas,
            'tahunajaran' => TahunAjaran::orderBy('thnAjaran', 'desc')->get(),
            'kelas' => Kelas::orderBy('kelas', 'asc')->get(),
            'guru' => Guru::orderBy('namaGuru', 'asc')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storesiswa(Request $request)
    {
        $this->mappingKelasService->storeSiswa($request);

        $notif = notify()->success('Data Siswa Berhasil Ditambahkan');
        session()->flash('notif', $notif);
        
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MappingKelas  $mappingKelas
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $mappingkelas = MappingKelas::where('idMapping', $id)->first();

        $mappingkelasd = MappingKelasSiswa::with(['siswa'])->orderBy('NIS', 'asc')->where('idMapping', $mappingkelas->idMapping)->get();

        return view('pages.dashboard.mappingkelas.show', [
            'title' => 'View Mapping Kelas',
            'mappingkelas' => $mappingkelas,
            'mappingkelasd' => $mappingkelasd,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MappingKelas  $mappingKelas
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $mappingkelas = MappingKelas::where('idMapping', $id)->first();
        $mappingkelasd = MappingKelasSiswa::where('idMapping', $mappingkelas->idMapping);

        return view('pages.dashboard.mappingkelas.edit', [
            'title' => 'Ubah Mapping Kelas',
            'mappingkelas' => $mappingkelas,
            'mappingkelasd' => $mappingkelasd,
            'tahunajaran' => TahunAjaran::orderBy('thnAjaran', 'desc')->get()->unique('thnAjaran'),
            'kelas' => Kelas::orderBy('kelas', 'asc')->get(),
            'guru' => Guru::orderBy('namaGuru', 'asc')->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MappingKelas  $mappingKelas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->mappingKelasService->updateMappingKelas($request, $id);

        // return redirect to mappingkelas/ubah-datasiswa with idMapping
        return redirect('/dashboard/mappingkelas/ubah-datasiswa/' . $id . '/edit');
    }

    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MappingKelas  $mappingKelas
     * @return \Illuminate\Http\Response
     */
    public function editsiswa(Request $request, $id)
    {
        // Get idMapping from URL id
        $idMapping = MappingKelas::where('idMapping', $id)->first();

        // Get input idMapping from URL id to input form hidden idMapping
        $request->request->add(['idMapping' => $idMapping->idMapping]);

        // Get data mappingkelas_d sort by idMapping latest
        $mappingkelasd = MappingKelasSiswa::with(['siswa'])->orderBy('NIS', 'asc')->where('idMapping', $idMapping->idMapping)->get();

        $mappingkelas = MappingKelas::where('idMapping', $id)->first();

        return view('pages.dashboard.mappingkelas.editsiswa', [
            'title' => 'Ubah Map Data Siswa',
            'nis' => Siswa::orderBy('NIS', 'asc')->get(),
            'namasiswa' => Siswa::orderBy('nmSiswa', 'asc')->get(),
            'idMapping' => $idMapping,
            'mappingkelasd' => $mappingkelasd,
            'mappingkelas' => $mappingkelas,
            'tahunajaran' => TahunAjaran::orderBy('thnAjaran', 'desc')->get(),
            'kelas' => Kelas::orderBy('kelas', 'asc')->get(),
            'guru' => Guru::orderBy('namaGuru', 'asc')->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MappingKelas  $mappingKelas
     * @return \Illuminate\Http\Response
     */
    public function updatesiswa(Request $request, $id)
    {
        $this->mappingKelasService->updateSiswa($request);

        $notif = notify()->success('Mapping Kelas Berhasil Ditambahkan');

        return redirect('/dashboard/mappingkelas/ubah-datasiswa/' . $id . '/edit')->with('notif', $notif);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MappingKelas  $mappingKelas
     * @return \Illuminate\Http\Response
     */
    public function destroysiswa($id)
    {
        MappingKelasSiswa::where('idMappingKelas_D', $id)->delete();
        
        $notif = notify()->success('Data Berhasil Dihapus');
        session()->flash('notif', $notif);
        
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MappingKelas  $mappingKelas
     * @return \Illuminate\Http\Response
     */
    public function destroyubahsiswa(Request $request, $id)
    {
        MappingKelasSiswa::where('idMappingKelas_D', $id)->delete();

        $notif = notify()->success('Data Berhasil Dihapus');
        session()->flash('notif', $notif);
        
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MappingKelas  $mappingKelas
     * @return \Illuminate\Http\Response
     */
    public function destroykelas($id)
    {
        MappingKelas::where('idMapping', $id)->delete();
        
        $notif = notify()->success('Data Mapping Kelas Berhasil Dihapus');
        session()->flash('notif', $notif);
        
        return back();
    }

    /**
     * Destroy mappingkelas if data NIS NULL.
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MappingKelas  $mappingKelas
     * @return \Illuminate\Http\Response
     */
    public function destroykelasid($id)
    {
        MappingKelas::where('idMapping', $id)->delete();
        
        return redirect('/dashboard/mappingkelas');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Siswa  $Siswa
     * @return \Illuminate\Http\Response
     */
    public function getSiswaList($nis)
    {
        $siswa = Siswa::where('NIS', $nis)->get();
        return response()->json($siswa);
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Siswa  $Siswa
     * @return \Illuminate\Http\Response
     */
    public function getNmSiswaList($nmSiswa)
    {
        $nmSiswa = Siswa::where('nmSiswa', $nmSiswa)->get();
        return response()->json($nmSiswa);
    }
}

