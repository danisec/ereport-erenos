<?php

namespace App\Http\Controllers;

use App\Models\Pengumuman;
use Illuminate\Http\Request;

class PengumumanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.dashboard.pengumuman.index', [
            'title' => 'Pengumuman',
            'pengumuman' => Pengumuman::sortable(['title' => 'asc'])->filter(request(['search']))->paginate(10)->withQueryString(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.dashboard.pengumuman.create', [
            'title' => 'Tambah Pengumuman',
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
            'tanggal' => 'required',
            'namaPengumuman' => 'required|max:255',
            'pengumuman' => 'required',
        ], [
            'tanggal.required' => 'Tanggal harus diisi',
            'namaPengumuman.required' => 'Nama pengumuman harus diisi',
            'namaPengumuman.max' => 'Nama pengumuman maksimal 255 karakter',
            'pengumuman.required' => 'Pengumuman harus diisi',
        ]);

        Pengumuman::create($validatedData);

        $notif = notify()->success('Data Pengumuman Berhasil Ditambahkan');

        return redirect('/dashboard/pengumuman')->with('notif', $notif);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pengumuman  $pengumuman
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('pages.dashboard.pengumuman.show', [
            'title' => 'View Pengumuman',
            'pengumuman' => Pengumuman::where('idPengumuman', $id)->first(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pengumuman  $pengumuman
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('pages.dashboard.pengumuman.edit', [
            'title' => 'Ubah Pengumuman',
            'pengumuman' => Pengumuman::where('idPengumuman', $id)->first(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pengumuman  $pengumuman
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'tanggal' => '',
            'namaPengumuman' => 'max:255',
            'pengumuman' => '',
        ], [
            'namaPengumuman.max' => 'Nama pengumuman maksimal 255 karakter',
        ]);

        Pengumuman::where('idPengumuman', $id)->update($validatedData);

        $notif = notify()->success('Data Pengumuman Berhasil Ditambahkan');

        return redirect('/dashboard/pengumuman')->with('notif', $notif);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pengumuman  $pengumuman
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Pengumuman::where('idPengumuman', $id)->delete();
        
        $notif = notify()->success('Data Pengumuman Berhasil Dihapus');
        session()->flash('notif', $notif);
        
        return back();
    }
}
