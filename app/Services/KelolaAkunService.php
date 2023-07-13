<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\Request;

class KelolaAkunService
{
    public function storeKelolaAkun(Request $request)
    {
        $validatedData = $request->validate([
                'name' => 'required|max:255',
                'username' => ['required', 'min:4', 'max:255', 'unique:users'],
                'email' => 'required|email:dns|unique:users',
                'NIP' => 'required|unique:users',
                'role' => 'required',
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
                'role.required' => 'Role harus diisi',
                'password.required' => 'Password harus diisi',
                'password.min' => 'Password minimal 8 karakter',
                'password.max' => 'Password maksimal 255 karakter',
            ]);

            $validatedData['password'] = bcrypt($validatedData['password']);
            
            $user = User::create($validatedData);

            return $user;
    }

    public function updateKelolaAkun(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'max:255',
            'username' => ['required', 'min:4', 'max:255'],
            'email' => 'email:dns',
            'NIP' => '',
            'role' => '',
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

        $user = User::where('id', $id)->update($validatedData);

        return $user;
    }
}