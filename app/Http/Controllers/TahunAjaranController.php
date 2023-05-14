<?php

namespace App\Http\Controllers;

use App\Models\TahunAjaran;
use App\Services\TahunAjaranService;
use Illuminate\Http\Request;

class TahunAjaranController extends Controller
{
    public function __construct(TahunAjaranService $tahunAjaranService)
    {
        $this->tahunAjaranService = $tahunAjaranService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.dashboard.tahunajaran.index', [
            'title' => 'Tahun Ajaran',
            'tahunajaran' => TahunAjaran::sortable(['thnAjaran' => 'desc'])->filter(request(['search']))->paginate(10)->withQueryString(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.dashboard.tahunajaran.create', [
            'title' => 'Tambah Tahun Ajaran',
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
        $this->tahunAjaranService->storeTahunAjaran($request);

        $notif = notify()->success('Data Tahun Ajaran Berhasil Ditambahkan');

        return redirect('/dashboard/tahunajaran')->with('notif', $notif);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TahunAjaran  $tahunAjaran
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('pages.dashboard.tahunajaran.show', [
            'title' => 'View Pelajaran',
            'tahunajaran' => TahunAjaran::where('idThnAjaran', $id)->first(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TahunAjaran  $tahunAjaran
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('pages.dashboard.tahunajaran.edit', [
            'title' => 'Ubah Tahun Ajaran',
            'tahunajaran' => TahunAjaran::where('idThnAjaran', $id)->first(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TahunAjaran  $tahunAjaran
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->tahunAjaranService->updateTahunAjaran($request, $id);

        $notif = notify()->success('Data Tahun Ajaran Berhasil Diubah');

        return redirect('/dashboard/tahunajaran')->with('notif', $notif);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TahunAjaran  $tahunAjaran
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        TahunAjaran::where('idThnAjaran', $id)->delete();
        
        $notif = notify()->success('Data Tahun Ajaran Berhasil Dihapus');
        session()->flash('notif', $notif);
        
        return back();
    }
}
