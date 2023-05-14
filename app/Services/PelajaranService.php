<?php

namespace App\Services;

use App\Models\Pelajaran;
use Illuminate\Http\Request;

class PelajaranService
{
    public function storePelajaran(Request $request)
    {
        $validatedData = $request->validate([
            'kodePelajaran' => 'required|numeric|unique:pelajaran,kodePelajaran',
            'nmPelajaran' => 'required|max:100',
            'nmSingkatan' => 'required|max:50',
            'KKM' => 'required:numeric|digits_between:1,3',
        ], [
            'kodePelajaran.required' => 'Kode pelajaran harus diisi',
            'kodePelajaran.numeric' => 'Kode pelajaran harus berupa angka',
            'kodePelajaran.unique' => 'Kode pelajaran sudah terdaftar',
            'nmPelajaran.required' => 'Nama pelajaran harus diisi',
            'nmPelajaran.max' => 'Nama pelajaran maksimal 100 karakter',
            'nmSingkatan.required' => 'Nama singkatan harus diisi',
            'nmSingkatan.max' => 'Nama singkatan maksimal 50 karakter',
            'KKM.required' => 'Nilai KKM harus diisi',
            'KKM.numeric' => 'Nilai KKM harus berupa angka',
            'KKM.digits_between' => 'Nilai KKM harus berjumlah 1-3 digit',
        ]);

        $pelajaran = Pelajaran::create($validatedData);

        return $pelajaran;
    }

    public function updatePelajaran(Request $request, $id)
    {
        $validatedData = $request->validate([
            'kodePelajaran' => 'required|numeric',
            'nmPelajaran' => 'required|max:100',
            'nmSingkatan' => 'required|max:50',
            'KKM' => 'required:numeric|digits_between:1,3',
        ], [
            'kodePelajaran.required' => 'Kode pelajaran harus diisi',
            'kodePelajaran.numeric' => 'Kode pelajaran harus berupa angka',
            'nmPelajaran.required' => 'Nama pelajaran harus diisi',
            'nmPelajaran.max' => 'Nama pelajaran maksimal 100 karakter',
            'nmSingkatan.required' => 'Nama singkatan harus diisi',
            'nmSingkatan.max' => 'Nama singkatan maksimal 50 karakter',
            'KKM.required' => 'Nilai KKM harus diisi',
            'KKM.numeric' => 'Nilai KKM harus berupa angka',
            'KKM.digits_between' => 'Nilai KKM harus berjumlah 1-3 digit',
        ]);

        $pelajaran = Pelajaran::where('kodePelajaran', $id)->update($validatedData);

        return $pelajaran;
    }
}