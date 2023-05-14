<?php

namespace App\Services;

use App\Models\Guru;
use App\Models\Kelas;
use App\Models\MappingKelas;
use App\Models\MappingKelasSiswa;
use App\Models\Siswa;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;

class MappingKelasService
{
    public function storeMappingKelas(Request $request)
    {
        $validatedData = $request->validate([
            'idThnAjaran' => 'required',
            'idKelas' => 'required|unique:mapping_kelas,idKelas',
            'NIP' => 'required',
        ], [
            'idThnAjaran.required' => 'Tahun ajaran harus diisi',
            'thnAjaran.required' => 'Tahun ajaran harus diisi',
            'idKelas.required' => 'Kelas harus diisi',
            'idKelas.unique' => 'Kelas sudah ada di mapping kelas',
            'NIP.required' => 'Wali Kelas harus diisi',
        ]);

        $mappingKelas = MappingKelas::create($validatedData);

        return $mappingKelas;
    }

    public function updateMappingKelas(Request $request, $id)
    {
        $validatedData = $request->validate([
            'idThnAjaran' => 'required',
            'idKelas' => 'required',
            'NIP' => 'required',
        ], [
            'idThnAjaran.required' => 'Tahun ajaran harus diisi',
            'thnAjaran.required' => 'Tahun ajaran harus diisi',
            'idKelas.required' => 'Kelas harus diisi',
            'idKelas.unique' => 'Kelas sudah ada di mapping kelas',
            'NIP.required' => 'Wali Kelas harus diisi',
        ]);

        $mappingKelas = MappingKelas::where('idMapping', $id)->update($validatedData);

        return $mappingKelas;
    }

    public function storeSiswa(Request $request)
    {
        $validatedData = $request->validate([
            'idMapping' => 'required',
            'NIS' => 'required|unique:mappingkelas_d,NIS',
        ], [
            'NIS.required' => 'NIS harus diisi',
            'NIS.unique' => 'Data siswa sudah ada di mapping kelas',
        ]);

        $mappingKelasSiswa = MappingKelasSiswa::create($validatedData);

        return $mappingKelasSiswa;
    }

    public function updateSiswa(Request $request)
    {
        $validatedData = $request->validate([
            'idMapping' => '',
            'NIS' => 'required|unique:mappingkelas_d,NIS',
        ], [
            'NIS.required' => 'NIS harus diisi',
            'NIS.unique' => 'Data siswa sudah ada di mapping kelas',
        ]);

        $mappingKelasSiswa = MappingKelasSiswa::create($validatedData);

        return $mappingKelasSiswa;
    }
}