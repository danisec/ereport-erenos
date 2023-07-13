<?php

namespace App\Http\Controllers;

use App\Models\KelolaAkun;
use App\Models\User;
use App\Services\KelolaAkunService;
use Illuminate\Http\Request;

class KelolaAkunController extends Controller
{
    public function __construct(KelolaAkunService $kelolaAkunService)
    {
        $this->kelolaAkunService = $kelolaAkunService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.dashboard.kelola-akun.index', [
            'title' => 'Kelola Akun',
            'akun' => User::sortable(['name' => 'asc'])->filter(request(['search']))->paginate(10)->withQueryString(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.dashboard.kelola-akun.create', [
            'title' => 'Register',
            'role' => [
                '1' => 'Superadmin',
                '0' => 'Guru',
            ],
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
        $this->kelolaAkunService->storeKelolaAkun($request);

        $notif = notify()->success('Pendaftaran akun berhasil');

        return redirect('/dashboard/kelola-akun')->with('notif', $notif);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\KelolaAkun  $kelolaAkun
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('pages.dashboard.kelola-akun.show', [
            'title' => 'View Akun',
            'akun' => User::where('id', $id)->first(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\KelolaAkun  $kelolaAkun
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('pages.dashboard.kelola-akun.edit', [
            'title' => 'Ubah Akun',
            'akun' => User::where('id', $id)->first(),
            'role' => [
                '1' => 'Superadmin',
                '0' => 'Guru',
            ],
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->kelolaAkunService->updateKelolaAkun($request, $id);

        $notif = notify()->success('Data Akun Berhasil Diubah');

        return redirect('/dashboard/kelola-akun')->with('notif', $notif);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\KelolaAkun  $kelolaAkun
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::where('id', $id)->delete();
        
        $notif = notify()->success('Data Akun Berhasil Dihapus');
        session()->flash('notif', $notif);
        
        return back();
    }
}
