<?php

namespace App\Http\Controllers;

use App\Models\Pelajaran;
use Illuminate\Http\Request;

class PelajaranController extends Controller
{
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
        $validatedData = $request->validate([
            'kodePelajaran' => 'required|numeric|unique:pelajaran,kodePelajaran',
            'nmPelajaran' => 'required|max:100',
            'nmSingkatan' => 'required|max:50',
            'KKM' => 'required:numeric|digits_between:1,3',
        ], [
            'kodePelajaran.required' => 'Kode pelajaran harus diisi',
            'kodePelajaran.numeric' => 'Kode pelajaran harus berupa angka',
            'kodePelajaran.unique' => 'Kode pelajaran sudah terdaftar',
            'nmPelajaran.required' => 'Nama pelajaran harus diisi',
            'nmPelajaran.max' => 'Nama pelajaran maksimal 100 karakter',
            'nmSingkatan.required' => 'Nama singkatan harus diisi',
            'nmSingkatan.max' => 'Nama singkatan maksimal 50 karakter',
            'KKM.required' => 'Nilai KKM harus diisi',
            'KKM.numeric' => 'Nilai KKM harus berupa angka',
            'KKM.digits_between' => 'Nilai KKM harus berjumlah 1-3 digit',
        ]);

        Pelajaran::create($validatedData);

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
        $pelajaran = Pelajaran::where('kodePelajaran', $id)->first();

        return view('pages.dashboard.pelajaran.show', [
            'title' => 'View Pelajaran',
            'pelajaran' => $pelajaran,
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
        $pelajaran = Pelajaran::where('kodePelajaran', $id)->first();

        return view('pages.dashboard.pelajaran.edit', [
            'title' => 'Ubah Pelajaran',
            'pelajaran' => $pelajaran,
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
        $validatedData = $request->validate([
            'kodePelajaran' => 'required|numeric',
            'nmPelajaran' => 'required|max:100',
            'nmSingkatan' => 'required|max:50',
            'KKM' => 'required:numeric|digits_between:1,3',
        ], [
            'kodePelajaran.required' => 'Kode pelajaran harus diisi',
            'kodePelajaran.numeric' => 'Kode pelajaran harus berupa angka',
            'nmPelajaran.required' => 'Nama pelajaran harus diisi',
            'nmPelajaran.max' => 'Nama pelajaran maksimal 100 karakter',
            'nmSingkatan.required' => 'Nama singkatan harus diisi',
            'nmSingkatan.max' => 'Nama singkatan maksimal 50 karakter',
            'KKM.required' => 'Nilai KKM harus diisi',
            'KKM.numeric' => 'Nilai KKM harus berupa angka',
            'KKM.digits_between' => 'Nilai KKM harus berjumlah 1-3 digit',
        ]);

        Pelajaran::where('kodePelajaran', $id)->update($validatedData);

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
