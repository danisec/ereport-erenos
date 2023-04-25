<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Kelas;
use App\Models\MappingJadwal;
use App\Models\Pelajaran;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;

class MappingJadwalController extends Controller
{
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
            'tahunajaran' => TahunAjaran::orderBy('thnAjaran', 'desc')->get(),
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
        $validatedData = $request->validate([
            'idThnAjaran' => 'required',
            'idKelas' => 'required',
            'NIP' => 'required',
            'hari' => 'required',
            'idPelajaran' => 'required',
            'mulai' => 'required',
            'selesai' => 'required',
        ], [
            'idThnAjaran.required' => 'Tahun ajaran harus diisi',
            'thnAjaran.required' => 'Tahun ajaran harus diisi',
            'idKelas.required' => 'Kelas harus diisi',
            'NIP.required' => 'Guru harus diisi',
            'hari.required' => 'Hari harus diisi',
            'idPelajaran.required' => 'Pelajaran harus diisi',
            'mulai.required' => 'Jam Mulai harus diisi',
            'selesai.required' => 'Jam Selesai harus diisi',
        ]);

        MappingJadwal::create($validatedData);

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
        $validatedData = $request->validate([
            'idThnAjaran' => 'required',
            'idKelas' => 'required',
            'NIP' => 'required',
            'hari' => 'required',
            'idPelajaran' => 'required',
            'mulai' => 'required',
            'selesai' => 'required',
        ], [
            'idThnAjaran.required' => 'Tahun ajaran harus diisi',
            'thnAjaran.required' => 'Tahun ajaran harus diisi',
            'idKelas.required' => 'Kelas harus diisi',
            'NIP.required' => 'Guru harus diisi',
            'hari.required' => 'Hari harus diisi',
            'idPelajaran.required' => 'Pelajaran harus diisi',
            'mulai.required' => 'Jam Mulai harus diisi',
            'selesai.required' => 'Jam Selesai harus diisi',
        ]);

        MappingJadwal::where('idJadwal', $id)->update($validatedData);;

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
