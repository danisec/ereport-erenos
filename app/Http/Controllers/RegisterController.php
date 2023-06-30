<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function index()
    {
        return view('pages.register.index', [
            'title' => 'Register',
        ]);
    }

    public function store(Request $request)
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
