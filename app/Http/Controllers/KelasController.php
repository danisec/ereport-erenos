<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Services\KelasService;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    public function __construct(KelasService $kelasService)
    {
        $this->kelasService = $kelasService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.dashboard.kelas.index', [
            'title' => 'Kelas',
            'kelas' => Kelas::sortable(['kelas' => 'asc'])->filter(request(['search']))->paginate(10)->withQueryString(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.dashboard.kelas.create', [
            'title' => 'Tambah Kelas',
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
        $this->kelasService->storeKelas($request);

        $notif = notify()->success('Data Kelas Berhasil Ditambahkan');

        return redirect('/dashboard/kelas')->with('notif', $notif);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('pages.dashboard.kelas.show', [
            'title' => 'View Pelajaran',
            'kelas' => Kelas::where('idKelas', $id)->first(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('pages.dashboard.kelas.edit', [
            'title' => 'Ubah Kelas',
            'kelas' => Kelas::where('idKelas', $id)->first(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->kelasService->updateKelas($request, $id);

        $notif = notify()->success('Data Kelas Berhasil Diubah');

        return redirect('/dashboard/kelas')->with('notif', $notif);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Kelas::where('idKelas', $id)->delete();
        
        $notif = notify()->success('Data Kelas Berhasil Dihapus');
        session()->flash('notif', $notif);
        
        return back();
    }
}
