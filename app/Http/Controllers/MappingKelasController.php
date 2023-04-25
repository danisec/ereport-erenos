<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Kelas;
use App\Models\MappingKelas;
use App\Models\MappingKelasSiswa;
use App\Models\Siswa;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;

class MappingKelasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.dashboard.mappingkelas.index', [
            'title' => 'Mapping Kelas',
            'mappingkelas' => MappingKelas::with(['tahunajaran', 'kelas', 'guru'])->sortable(['idKelas' => 'desc'])->filter(request(['search']))->paginate(10)->withQueryString(),
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
    public function store(Request $request)
    {
        $validatedDataMapping = $request->validate([
            'idThnAjaran' => 'required',
            'idKelas' => 'required|unique:mapping_kelas,idKelas',
            'NIP' => 'required',
        ], [
            'idThnAjaran.required' => 'Tahun ajaran harus diisi',
            'thnAjaran.required' => 'Tahun ajaran harus diisi',
            'idKelas.required' => 'Kelas harus diisi',
            'idKelas.unique' => 'Kelas sudah ada di mapping kelas',
            'NIP.required' => 'Wali Kelas harus diisi',
        ]);

        MappingKelas::create($validatedDataMapping);

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
        $mappingkelasd = MappingKelasSiswa::orderBy('NIS', 'asc')->where('idMapping', $idMapping->idMapping)->paginate(10)->withQueryString();

        return view('pages.dashboard.mappingkelas.createsiswa', [
            'title' => 'Tambah Map Data Siswa',
            'nis' => Siswa::orderBy('NIS', 'asc')->get(),
            'namasiswa' => Siswa::orderBy('nmSiswa', 'asc')->get(),
            'idMapping' => $idMapping,
            'mappingkelasd' => $mappingkelasd,
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
        $validatedDataMapping = $request->validate([
            'idMapping' => 'required',
            'NIS' => 'required|unique:mappingkelas_d,NIS',
        ], [
            'NIS.required' => 'NIS harus diisi',
            'NIS.unique' => 'Data siswa sudah ada di mapping kelas',
        ]);

        MappingKelasSiswa::create($validatedDataMapping);

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

        $mappingkelasd = MappingKelasSiswa::with(['siswa'])->orderBy('NIS', 'asc')->where('idMapping', $mappingkelas->idMapping)->paginate(10)->withQueryString();

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
    public function update(Request $request, $id)
    {
        $validatedDataMapping = $request->validate([
            'idThnAjaran' => 'required',
            'idKelas' => 'required',
            'NIP' => 'required',
        ], [
            'idThnAjaran.required' => 'Tahun ajaran harus diisi',
            'thnAjaran.required' => 'Tahun ajaran harus diisi',
            'idKelas.required' => 'Kelas harus diisi',
            'idKelas.unique' => 'Kelas sudah ada di mapping kelas',
            'NIP.required' => 'Wali Kelas harus diisi',
        ]);

        MappingKelas::where('idMapping', $id)->update($validatedDataMapping);

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
        $mappingkelasd = MappingKelasSiswa::with(['siswa'])->orderBy('NIS', 'asc')->where('idMapping', $idMapping->idMapping)->paginate(10)->withQueryString();

        return view('pages.dashboard.mappingkelas.editsiswa', [
            'title' => 'Ubah Map Data Siswa',
            'nis' => Siswa::orderBy('NIS', 'asc')->get(),
            'namasiswa' => Siswa::orderBy('nmSiswa', 'asc')->get(),
            'idMapping' => $idMapping,
            'mappingkelasd' => $mappingkelasd,
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
        $validatedDataMapping = $request->validate([
            'idMapping' => '',
            'NIS' => 'required|unique:mappingkelas_d,NIS',
        ], [
            'NIS.required' => 'NIS harus diisi',
            'NIS.unique' => 'Data siswa sudah ada di mapping kelas',
        ]);

        MappingKelasSiswa::create($validatedDataMapping);

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

