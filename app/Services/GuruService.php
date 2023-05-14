<?php

namespace App\Services;

use App\Models\Guru;
use Illuminate\Http\Request;

class GuruService
{
    public function storeGuru(Request $request)
    {
        $validatedData = $request->validate([
            'NIP' => 'required|numeric|digits:10|unique:guru,NIP',
            'namaGuru' => 'required|max:100',
        ], [
            'NIP.required' => 'Nomor guru harus diisi',
            'NIP.numeric' => 'Nomor guru harus berupa angka',
            'NIP.digits' => 'Nomor guru harus berjumlah 10 digit',
            'NIP.unique' => 'Nomor guru sudah terdaftar',
            'namaGuru.required' => 'Nama guru harus diisi',
            'namaGuru.max' => 'Nama guru maksimal 100 karakter',
        ]);

        $guru = Guru::create($validatedData);

        return $guru;
    }

    public function updateGuru(Request $request, $id)
    {
        $validatedData = $request->validate([
            'NIP' => 'numeric|digits:10',
            'namaGuru' => 'required|max:100',
        ], [
            'NIP.numeric' => 'Nomor guru harus berupa angka',
            'NIP.digits' => 'Nomor guru harus berjumlah 10 digit',
            'namaGuru.required' => 'Nama guru harus diisi',
            'namaGuru.max' => 'Nama guru maksimal 100 karakter',
        ]);

        $guru = Guru::where('NIP', $id)->update($validatedData);
        
        return $guru;
    }
}