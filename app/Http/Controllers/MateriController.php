<?php

namespace App\Http\Controllers;

use App\Models\Materi;
use App\Models\Pelajaran;
use App\Services\MateriService;
use Illuminate\Http\Request;

class MateriController extends Controller
{
    public function __construct(MateriService $materiService)
    {
        $this->materiService = $materiService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.dashboard.materi.index', [
            'title' => 'Materi',
            'materi' => Materi::sortable(['materi' => 'asc'])->filter(request(['search']))->paginate(10)->withQueryString(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.dashboard.materi.create', [
            'title' => 'Tambah Materi',
            'pelajaran' => Pelajaran::orderBy('nmPelajaran', 'asc')->get(),
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
        $this->materiService->storeMateri($request);

        $notif = notify()->success('Data Materi Berhasil Ditambahkan');

        return redirect('/dashboard/materi')->with('notif', $notif);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Materi  $materi
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('pages.dashboard.materi.show', [
            'title' => 'View Materi',
            'pelajaranMateri' => Pelajaran::where('idPelajaran', $id)->first(),
            'materi' => Materi::with('pelajaran')->where('idPelajaran', $id)->get(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Materi  $materi
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {     
        $pelajaranMateri = Pelajaran::where('idPelajaran', $id)->first();
        
        // get materi by idPelajaran with table pelajaran
        $materi = Materi::with('pelajaran')->where('idPelajaran', $id)->get();
        
        return view('pages.dashboard.materi.edit', [
            'title' => 'Ubah Materi',
            'pelajaran' => Pelajaran::orderBy('nmPelajaran', 'asc')->get(['idPelajaran', 'nmPelajaran']),
            'pelajaranMateri' => $pelajaranMateri,
            'materi' => $materi,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Materi  $materi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return $this->materiService->updateMateri($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Materi  $materi
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Materi::where('idMateri', $id)->delete();
        
        $notif = notify()->success('Data Materi Berhasil Dihapus');
        session()->flash('notif', $notif);
        
        return back();
    }
}
