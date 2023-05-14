<?php

namespace App\Services;

use App\Models\TahunAjaran;
use Illuminate\Http\Request;

class TahunAjaranService
{
    public function storeTahunAjaran(Request $request)
    {
        $validatedData = $request->validate([
            'thnAjaran' => 'required|max:15|unique:tahun_ajaran,thnAjaran,NULL,id,semester,' . $request->semester,
            'semester' => 'required|in:Gasal,Genap,Pertengahan Tengah Semester 1,Pertengahan Akhir Semester 1,Pertengahan Tengah Semester 2,Pertengahan Akhir Semester 2',
        ], [
            'thnAjaran.required' => 'Tahun ajaran harus diisi',
            'thnAjaran.max' => 'Tahun ajaran maksimal 15 karakter',
            'thnAjaran.unique' => 'Tahun ajaran sudah terdaftar',
            'semester.required' => 'Semester harus diisi',
            'semester.in' => 'Semester harus berupa Gasal atau Genap',
        ]);

        $tahunAjaran = TahunAjaran::create($validatedData);

        return $tahunAjaran;
    }

    public function updateTahunAjaran(Request $request, $id)
    {
        $validatedData = $request->validate([
            'thnAjaran' => 'required|max:15|unique:tahun_ajaran,thnAjaran,NULL,id,semester,' . $request->semester,
            'semester' => 'required|in:Gasal,Genap,Pertengahan Tengah Semester 1,Pertengahan Akhir Semester 1,Pertengahan Tengah Semester 2,Pertengahan Akhir Semester 2',
        ], [
            'thnAjaran.required' => 'Tahun ajaran harus diisi',
            'thnAjaran.max' => 'Tahun ajaran maksimal 15 karakter',
            'thnAjaran.unique' => 'Tahun ajaran sudah terdaftar',
            'semester.required' => 'Semester harus diisi',
            'semester.in' => 'Semester harus berupa Gasal atau Genap',
        ]);

        $tahunAjaran = TahunAjaran::where('idThnAjaran', $id)->update($validatedData);

        return $tahunAjaran;
    }
}