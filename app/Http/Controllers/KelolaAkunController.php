<?php

namespace App\Http\Controllers;

use App\Models\KelolaAkun;
use App\Models\User;
use Illuminate\Http\Request;

class KelolaAkunController extends Controller
{
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
        {
            $validatedData = $request->validate([
                'name' => 'required|max:255',
                'username' => ['required', 'min:4', 'max:255', 'unique:users'],
                'email' => 'required|email:dns|unique:users',
                'NIP' => 'required|unique:users',
                'password' => 'required|min:8|max:255',
            ], [
                'name.required' => 'Nama Lengkap harus diisi',
                'name.max' => 'Nama Lengkap maksimal 255 karakter',
                'username.min' => 'Username minimal 4 karakter',
                'username.max' => 'Username maksimal 255 karakter',
                'username.unique' => 'Username sudah terdaftar',
                'email.required' => 'Email harus diisi',
                'email.email' => 'Email tidak valid',
                'email.unique' => 'Email sudah terdaftar',
                'NIP.required' => 'NIP harus diisi',
                'NIP.unique' => 'NIP sudah terdaftar',
                'password.required' => 'Password harus diisi',
                'password.min' => 'Password minimal 8 karakter',
                'password.max' => 'Password maksimal 255 karakter',
            ]);

            $validatedData['password'] = bcrypt($validatedData['password']);
            
            User::create($validatedData);

            $notif = notify()->success('Pendaftaran akun berhasil');

            return redirect('/dashboard/kelola-akun')->with('notif', $notif);
        }
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
        // $akun = User::where('id', $id)->first();
        // dd($akun);

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
        $validatedData = $request->validate([
            'name' => 'max:255',
            'username' => ['required', 'min:4', 'max:255'],
            'email' => 'email:dns',
            'NIP' => '',
            'password' => 'min:8|max:255',
        ], [
            'name.max' => 'Nama Lengkap maksimal 255 karakter',
            'username.min' => 'Username minimal 4 karakter',
            'username.max' => 'Username maksimal 255 karakter',
            'email.email' => 'Email tidak valid',
            'password.min' => 'Password minimal 8 karakter',
            'password.max' => 'Password maksimal 255 karakter',
        ]);

        $validatedData['password'] = bcrypt($validatedData['password']);

        User::where('id', $id)->update($validatedData);

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
