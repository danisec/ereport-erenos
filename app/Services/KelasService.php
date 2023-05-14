<?php

namespace App\Services;

use App\Models\Kelas;
use Illuminate\Http\Request;

class KelasService
{
    public function storeKelas(Request $request)
    {
        $validatedData = $request->validate([
            'kelas' => 'required|max:2|unique:kelas,kelas',
        ], [
            'kelas.required' => 'Nama kelas harus diisi',
            'kelas.max' => 'Nama kelas maksimal 2 karakter',
            'kelas.unique' => 'Nama kelas sudah terdaftar',
        ]);

        $kelas = Kelas::create($validatedData);

        return $kelas;
    }

    public function updateKelas(Request $request, $id)
    {
        $validatedData = $request->validate([
            'kelas' => 'required|max:2|unique:kelas,kelas',
        ], [
            'kelas.required' => 'Nama kelas harus diisi',
            'kelas.max' => 'Nama kelas maksimal 2 karakter',
            'kelas.unique' => 'Nama kelas sudah terdaftar',
        ]);

        $kelas = Kelas::where('idKelas', $id)->update($validatedData);

        return $kelas;
    }
}