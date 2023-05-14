<?php

namespace App\Services;

use App\Models\MappingJadwal;
use Illuminate\Http\Request;

class MappingJadwalService
{
    public function storeMappingJadwal(Request $request)
    {
        $validatedData = $request->validate([
            'idThnAjaran' => 'required',
            'idKelas' => 'required',
            'NIP' => 'required',
            'hari' => 'required',
            'idPelajaran' => 'required',
            'mulai' => 'required',
            'selesai' => 'required',
        ], [
            'idThnAjaran.required' => 'Tahun ajaran harus diisi',
            'thnAjaran.required' => 'Tahun ajaran harus diisi',
            'idKelas.required' => 'Kelas harus diisi',
            'NIP.required' => 'Guru harus diisi',
            'hari.required' => 'Hari harus diisi',
            'idPelajaran.required' => 'Pelajaran harus diisi',
            'mulai.required' => 'Jam Mulai harus diisi',
            'selesai.required' => 'Jam Selesai harus diisi',
        ]);

        $mappingJadwal = MappingJadwal::create($validatedData);

        return $mappingJadwal;
    }

    public function updateMappingJadwal(Request $request, $id)
    {
        $validatedData = $request->validate([
            'idThnAjaran' => 'required',
            'idKelas' => 'required',
            'NIP' => 'required',
            'hari' => 'required',
            'idPelajaran' => 'required',
            'mulai' => 'required',
            'selesai' => 'required',
        ], [
            'idThnAjaran.required' => 'Tahun ajaran harus diisi',
            'thnAjaran.required' => 'Tahun ajaran harus diisi',
            'idKelas.required' => 'Kelas harus diisi',
            'NIP.required' => 'Guru harus diisi',
            'hari.required' => 'Hari harus diisi',
            'idPelajaran.required' => 'Pelajaran harus diisi',
            'mulai.required' => 'Jam Mulai harus diisi',
            'selesai.required' => 'Jam Selesai harus diisi',
        ]);

        $mappingJadwal = MappingJadwal::where('idJadwal', $id)->update($validatedData);

        return $mappingJadwal;
    }
}