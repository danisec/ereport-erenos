<?php

namespace App\Services;

use App\Models\Siswa;
use Illuminate\Http\Request;

class SiswaService 
{
    public function storeSiswa(Request $request)
    {
        $validatedData = $request->validate([
            'NIS' => 'required|numeric|digits:8|unique:siswa,NIS',
            'nmSiswa' => 'required|max:100',
            'nmPanggil' => 'required|max:50',
            'tinggi' => 'required|decimal:0',
            'berat' => 'required|decimal:0',
            'nmOrangTua' => 'required|max:100',
        ], [
            'NIS.required' => 'NIS harus diisi',
            'NIS.numeric' => 'NIS harus berupa angka',
            'NIS.digits' => 'NIS harus berjumlah 8 digit',
            'NIS.unique' => 'NIS sudah terdaftar',
            'nmSiswa.required' => 'Nama siswa harus diisi',
            'nmSiswa.max' => 'Nama siswa maksimal 100 karakter',
            'nmPanggil.required' => 'Nama panggilan harus diisi',
            'nmPanggil.max' => 'Nama panggilan maksimal 50 karakter',
            'tinggi.required' => 'Tinggi badan harus diisi',
            'tinggi.decimal' => 'Tinggi Badan harus berupa angka desimal',
            'berat.required' => 'Berat badan harus diisi',
            'berat.decimal' => 'Berat Badan harus berupa angka desimal',
            'nmOrangTua.required' => 'Nama orang tua harus diisi',
            'nmOrangTua.max' => 'Nama orang tua maksimal 100 karakter',
        ]);

        $siswa = Siswa::create($validatedData);

        return $siswa;
    }

    public function updateSiswa(Request $request, $id)
    {
        $validatedData = $request->validate([
            'NIS' => 'numeric|digits:8',
            'nmSiswa' => 'required|max:100',
            'nmPanggil' => 'required|max:50',
            'tinggi' => 'required|decimal:0',
            'berat' => 'required|decimal:0',
            'nmOrangTua' => 'required|max:100',
        ], [
            'NIS.numeric' => 'NIS harus berupa angka',
            'NIS.digits' => 'NIS harus berjumlah 8 digit',
            'nmSiswa.required' => 'Nama Siswa harus diisi',
            'nmSiswa.max' => 'Nama Siswa maksimal 100 karakter',
            'nmPanggil.required' => 'Nama Panggilan harus diisi',
            'nmPanggil.max' => 'Nama Panggilan maksimal 50 karakter',
            'tinggi.required' => 'Tinggi Badan harus diisi',
            'tinggi.decimal' => 'Tinggi Badan harus berupa angka desimal',
            'berat.required' => 'Berat Badan harus diisi',
            'berat.decimal' => 'Berat Badan harus berupa angka desimal',
            'nmOrangTua.required' => 'Nama orang tua harus diisi',
            'nmOrangTua.max' => 'Nama orang tua maksimal 100 karakter',
        ]);

        $siswa = Siswa::where('NIS', $id)->update($validatedData);

        return $siswa;
    }
}