<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Services\SiswaService;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function __construct(SiswaService $siswaService)
    {
        $this->siswaService = $siswaService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.dashboard.siswa.index', [
            'title' => 'Siswa',
            'siswa' => Siswa::sortable(['nmSiswa' => 'asc'])->filter(request(['search']))->paginate(10)->withQueryString(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.dashboard.siswa.create', [
            'title' => 'Tambah Siswa',
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
        $this->siswaService->storeSiswa($request);

        $notif = notify()->success('Data Siswa Berhasil Ditambahkan');

        return redirect('/dashboard/siswa')->with('notif', $notif);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('pages.dashboard.siswa.show', [
            'title' => 'View Siswa',
            'siswa' => Siswa::where('NIS', $id)->first(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('pages.dashboard.siswa.edit', [
            'title' => 'Ubah Siswa',
            'siswa' => Siswa::where('NIS', $id)->first(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->siswaService->updateSiswa($request, $id);

        $notif = notify()->success('Data Siswa Berhasil Diubah');

        return redirect('/dashboard/siswa')->with('notif', $notif);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Siswa::where('NIS', $id)->delete();
        
        $notif = notify()->success('Data Siswa Berhasil Dihapus');
        session()->flash('notif', $notif);
        
        return back();
    }
}
