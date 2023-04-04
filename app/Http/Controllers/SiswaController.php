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
            'siswa' => Siswa::sortable()->orderBy('nama_siswa', 'asc')->filter(request(['search', 'nama_panggilan']))->paginate(10)->withQueryString(),
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
            'nis' => 'required|numeric|digits:8|unique:siswas,nis',
            'nama_siswa' => 'required|max:100',
            'nama_panggilan' => 'required|max:50',
            'tinggi_badan' => 'required',
            'berat_badan' => 'required',
        ], [
            'nis.required' => 'NIS harus diisi',
            'nis.numeric' => 'NIS harus berupa angka',
            'nis.digits' => 'NIS harus berjumlah 8 digit',
            'nis.unique' => 'NIS sudah terdaftar',
            'nama_siswa.required' => 'Nama siswa harus diisi',
            'nama_siswa.max' => 'Nama siswa maksimal 100 karakter',
            'nama_panggilan.required' => 'Nama panggilan harus diisi',
            'nama_panggilan.max' => 'Nama panggilan maksimal 50 karakter',
            'tinggi_badan.required' => 'Tinggi badan harus diisi',
            'berat_badan.required' => 'Berat badan harus diisi',
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
    public function show(Siswa $siswa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $siswa = Siswa::where('nis', $id)->first();

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
            'nis' => 'numeric|digits:8',
            'nama_siswa' => 'required|max:100',
            'nama_panggilan' => 'required|max:50',
            'tinggi_badan' => 'required',
            'berat_badan' => 'required',
        ], [
            'nis.numeric' => 'NIS harus berupa angka',
            'nis.digits' => 'NIS harus berjumlah 8 digit',
            'nama_siswa.required' => 'Nama Siswa harus diisi',
            'nama_siswa.max' => 'Nama Siswa maksimal 100 karakter',
            'nama_panggilan.required' => 'Nama Panggilan harus diisi',
            'nama_panggilan.max' => 'Nama Panggilan maksimal 50 karakter',
            'tinggi_badan.required' => 'Tinggi Badan harus diisi',
            'berat_badan.required' => 'Berat Badan harus diisi',
        ]);

        Siswa::where('nis', $id)->update($validatedData);

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
        Siswa::where('nis', $id)->delete();
        
        $notif = notify()->success('Data Siswa Berhasil Dihapus');
        
        return redirect('/dashboard/siswa')->with('notif', $notif);
    }
}
