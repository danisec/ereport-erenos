<?php

namespace App\Http\Controllers;

use App\Models\TahunAjaran;
use Illuminate\Http\Request;

class TahunAjaranController extends Controller
{
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
        $validatedData = $request->validate([
            'thnAjaran' => 'required|max:15|unique:tahun_ajaran,thnAjaran,NULL,id,semester,' . $request->semester,
            'semester' => 'required|in:Gasal,Genap,Pertengahan Tengah Semester 1,Pertengahan Akhir Semester 1,Pertengahan Tengah Semester 2,Pertengahan Akhir Semester 2',
        ], [
            'thnAjaran.required' => 'Tahun ajaran harus diisi',
            'thnAjaran.max' => 'Tahun ajaran maksimal 15 karakter',
            'thnAjaran.unique' => 'Tahun ajaran sudah terdaftar',
            'semester.required' => 'Semester harus diisi',
            'semester.in' => 'Semester harus berupa Gasal atau Genap',
        ]);

        TahunAjaran::create($validatedData);

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
        $tahunajaran = TahunAjaran::where('idThnAjaran', $id)->first();

        return view('pages.dashboard.tahunajaran.show', [
            'title' => 'View Pelajaran',
            'tahunajaran' => $tahunajaran,
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
        $tahunajaran = TahunAjaran::where('idThnAjaran', $id)->first();

        return view('pages.dashboard.tahunajaran.edit', [
            'title' => 'Ubah Tahun Ajaran',
            'tahunajaran' => $tahunajaran,
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
        $validatedData = $request->validate([
            'thnAjaran' => 'required|max:15|unique:tahun_ajaran,thnAjaran,NULL,id,semester,' . $request->semester,
            'semester' => 'required|in:Gasal,Genap,Pertengahan Tengah Semester 1,Pertengahan Akhir Semester 1,Pertengahan Tengah Semester 2,Pertengahan Akhir Semester 2',
        ], [
            'thnAjaran.required' => 'Tahun ajaran harus diisi',
            'thnAjaran.max' => 'Tahun ajaran maksimal 15 karakter',
            'thnAjaran.unique' => 'Tahun ajaran sudah terdaftar',
            'semester.required' => 'Semester harus diisi',
            'semester.in' => 'Semester harus berupa Gasal atau Genap',
        ]);

        TahunAjaran::where('idThnAjaran', $id)->update($validatedData);

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
