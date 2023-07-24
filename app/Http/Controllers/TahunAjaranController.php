<?php

namespace App\Http\Controllers;

use App\Models\Semester;
use App\Models\TahunAjaran;
use App\Services\TahunAjaranService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TahunAjaranController extends Controller
{
    public function __construct(TahunAjaranService $tahunAjaranService)
    {
        $this->tahunAjaranService = $tahunAjaranService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.dashboard.tahunajaran.index', [
            'title' => 'Tahun Ajaran',
            'semester' => Semester::with('tahunajaran')->sortable(['thnAjaran' => 'desc'])->filter(request(['search']))->paginate(10)->withQueryString(),
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
            'semester' => Semester::get(),
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
        return $this->tahunAjaranService->storeTahunAjaran($request);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createSemester()
    {
        // Dapatkan enum semester dari database semester
        $enumSemester = DB::select(DB::raw('SHOW COLUMNS FROM semester WHERE Field = "semester"'))[0]->Type;

        return view('pages.dashboard.tahunajaran.createSemester', [
            'title' => 'Tambah Tahun Ajaran',
            'tahunAjaran' => TahunAjaran::get(),
            'semester' => explode("','", substr($enumSemester, 6, (strlen($enumSemester) - 8))),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeSemester(Request $request)
    {
        return $this->tahunAjaranService->storeTahunAjaran($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Semester  $semester
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('pages.dashboard.tahunajaran.show', [
            'title' => 'View Pelajaran',
            'semester' => Semester::where('idSemester', $id)->first(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Semester  $semester
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Dapatkan enum semester dari database semester
        $enumSemester = DB::select(DB::raw('SHOW COLUMNS FROM semester WHERE Field = "semester"'))[0]->Type;
        // dd(explode("','", substr($enumSemester, 6, (strlen($enumSemester) - 8))));

        return view('pages.dashboard.tahunajaran.edit', [
            'title' => 'Ubah Tahun Ajaran',
            'semester' => Semester::where('idSemester', $id)->first(),
            'enumSemester' => explode("','", substr($enumSemester, 6, (strlen($enumSemester) - 8))),
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
        return $this->tahunAjaranService->updateTahunAjaran($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Semester  $semester
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Semester::where('idSemester', $id)->delete();
        
        $notif = notify()->success('Data Tahun Ajaran Berhasil Dihapus');
        session()->flash('notif', $notif);
        
        return back();
    }
}
