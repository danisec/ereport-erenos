<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Services\GuruService;
use Illuminate\Http\Request;

class GuruController extends Controller
{
    public function __construct(GuruService $guruService)
    {
        $this->guruService = $guruService;
    }

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
        $this->guruService->storeGuru($request);

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
        return view('pages.dashboard.guru.show', [
            'title' => 'View Guru',
            'guru' => Guru::where('NIP', $id)->first(),
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
        return view('pages.dashboard.guru.edit', [
            'title' => 'Ubah Guru',
            'guru' => Guru::where('NIP', $id)->first(),
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
        $this->guruService->updateGuru($request, $id);

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
