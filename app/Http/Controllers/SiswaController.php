<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
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
        $validatedData = $request->validate([
            'NIS' => 'required|numeric|digits:8|unique:siswa,NIS',
            'nmSiswa' => 'required|max:100',
            'nmPanggil' => 'required|max:50',
            'tinggi' => 'required',
            'berat' => 'required',
        ], [
            'NIS.required' => 'NIS harus diisi',
            'NIS.numeric' => 'NIS harus berupa angka',
            'NIS.digits' => 'NIS harus berjumlah 8 digit',
            'NIS.unique' => 'NIS sudah terdaftar',
            'nmSiswa.required' => 'Nama siswa harus diisi',
            'nmSiswa.max' => 'Nama siswa maksimal 100 karakter',
            'nmPanggil.required' => 'Nama panggilan harus diisi',
            'nmPanggil.max' => 'Nama panggilan maksimal 50 karakter',
            'tinggi.required' => 'Tinggi badan harus diisi',
            'berat.required' => 'Berat badan harus diisi',
        ]);

        Siswa::create($validatedData);

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
        $siswa = Siswa::where('NIS', $id)->first();

        return view('pages.dashboard.siswa.show', [
            'title' => 'View Siswa',
            'siswa' => $siswa,
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
        $siswa = Siswa::where('NIS', $id)->first();

        return view('pages.dashboard.siswa.edit', [
            'title' => 'Ubah Siswa',
            'siswa' => $siswa,
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
        $validatedData = $request->validate([
            'NIS' => 'numeric|digits:8',
            'nmSiswa' => 'required|max:100',
            'nmPanggil' => 'required|max:50',
            'tinggi' => 'required',
            'berat' => 'required',
        ], [
            'NIS.numeric' => 'NIS harus berupa angka',
            'NIS.digits' => 'NIS harus berjumlah 8 digit',
            'nmSiswa.required' => 'Nama Siswa harus diisi',
            'nmSiswa.max' => 'Nama Siswa maksimal 100 karakter',
            'nmPanggil.required' => 'Nama Panggilan harus diisi',
            'nmPanggil.max' => 'Nama Panggilan maksimal 50 karakter',
            'tinggi.required' => 'Tinggi Badan harus diisi',
            'berat.required' => 'Berat Badan harus diisi',
        ]);

        Siswa::where('NIS', $id)->update($validatedData);

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
