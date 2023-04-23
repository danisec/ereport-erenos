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
            'guru' => Guru::sortable(['namaGuru' => 'asc'])->filter(request(['search']))->paginate(10)->withQueryString(),
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
            'NIP' => 'required|numeric|digits:10|unique:guru,NIP',
            'namaGuru' => 'required|max:100',
        ], [
            'NIP.required' => 'Nomor guru harus diisi',
            'NIP.numeric' => 'Nomor guru harus berupa angka',
            'NIP.digits' => 'Nomor guru harus berjumlah 10 digit',
            'NIP.unique' => 'Nomor guru sudah terdaftar',
            'namaGuru.required' => 'Nama guru harus diisi',
            'namaGuru.max' => 'Nama guru maksimal 100 karakter',
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
        $guru = Guru::where('NIP', $id)->first();

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
        $guru = Guru::where('NIP', $id)->first();

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
            'NIP' => 'numeric|digits:10',
            'namaGuru' => 'required|max:100',
        ], [
            'NIP.numeric' => 'Nomor guru harus berupa angka',
            'NIP.digits' => 'Nomor guru harus berjumlah 10 digit',
            'namaGuru.required' => 'Nama guru harus diisi',
            'namaGuru.max' => 'Nama guru maksimal 100 karakter',
        ]);

        Guru::where('NIP', $id)->update($validatedData);

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
        Guru::where('NIP', $id)->delete();
        
        $notif = notify()->success('Data Guru Berhasil Dihapus');
        session()->flash('notif', $notif);
        
        return back();
    }
}
