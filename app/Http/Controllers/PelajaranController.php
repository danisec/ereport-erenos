<?php

namespace App\Http\Controllers;

use App\Models\Pelajaran;
use App\Services\PelajaranService;
use Illuminate\Http\Request;

class PelajaranController extends Controller
{
    public function __construct(PelajaranService $pelajaranService)
    {
        $this->pelajaranService = $pelajaranService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.dashboard.pelajaran.index', [
            'title' => 'Mata Pelajaran',
            'pelajaran' => Pelajaran::sortable(['nmPelajaran' => 'asc'])->filter(request(['search']))->paginate(10)->withQueryString(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.dashboard.pelajaran.create', [
            'title' => 'Tambah Pelajaran',
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
        $this->pelajaranService->storePelajaran($request);

        $notif = notify()->success('Data Pelajaran Berhasil Ditambahkan');

        return redirect('/dashboard/pelajaran')->with('notif', $notif);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pelajaran  $pelajaran
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('pages.dashboard.pelajaran.show', [
            'title' => 'View Pelajaran',
            'pelajaran' => Pelajaran::where('kodePelajaran', $id)->first(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pelajaran  $pelajaran
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('pages.dashboard.pelajaran.edit', [
            'title' => 'Ubah Pelajaran',
            'pelajaran' => Pelajaran::where('kodePelajaran', $id)->first(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pelajaran  $pelajaran
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->pelajaranService->updatePelajaran($request, $id);

        $notif = notify()->success('Data Pelajaran Berhasil Diubah');

        return redirect('/dashboard/pelajaran')->with('notif', $notif);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pelajaran  $pelajaran
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Pelajaran::where('kodePelajaran', $id)->delete();
        
        $notif = notify()->success('Data Pelajaran Berhasil Dihapus');
        session()->flash('notif', $notif);
        
        return back();
    }
}
