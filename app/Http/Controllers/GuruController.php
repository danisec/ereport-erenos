<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use Illuminate\Http\Request;

class GuruController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.dashboard.guru.index', [
            'title' => 'Guru',
            'guru' => Guru::sortable(['nama_guru' => 'asc'])->filter(request(['search']))->paginate(10)->withQueryString(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.dashboard.guru.create', [
            'title' => 'Tambah Guru',
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
            'nig' => 'required|numeric|digits:8|unique:gurus,nig',
            'nama_guru' => 'required|max:100',
        ], [
            'nig.required' => 'Nomor guru harus diisi',
            'nig.numeric' => 'Nomor guru harus berupa angka',
            'nig.digits' => 'Nomor guru harus berjumlah 8 digit',
            'nig.unique' => 'Nomor guru sudah terdaftar',
            'nama_guru.required' => 'Nama guru harus diisi',
            'nama_guru.max' => 'Nama guru maksimal 100 karakter',
        ]);

        Guru::create($validatedData);

        $notif = notify()->success('Data Guru Berhasil Ditambahkan');

        return redirect('/dashboard/guru')->with('notif', $notif);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Guru  $guru
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $guru = Guru::where('nig', $id)->first();

        return view('pages.dashboard.guru.show', [
            'title' => 'View Guru',
            'guru' => $guru,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Guru  $guru
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $guru = Guru::where('nig', $id)->first();

        return view('pages.dashboard.guru.edit', [
            'title' => 'Ubah Guru',
            'guru' => $guru,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Guru  $guru
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nig' => 'numeric|digits:8',
            'nama_guru' => 'required|max:100',
        ], [
            'nig.numeric' => 'Nomor guru harus berupa angka',
            'nig.digits' => 'Nomor guru harus berjumlah 8 digit',
            'nama_guru.required' => 'Nama guru harus diisi',
            'nama_guru.max' => 'Nama guru maksimal 100 karakter',
        ]);

        Guru::where('nig', $id)->update($validatedData);

        $notif = notify()->success('Data Guru Berhasil Diubah');

        return redirect('/dashboard/guru')->with('notif', $notif);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Guru  $guru
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Guru::where('nig', $id)->delete();
        
        $notif = notify()->success('Data Guru Berhasil Dihapus');
        
        return redirect('/dashboard/guru')->with('notif', $notif);
    }
}
