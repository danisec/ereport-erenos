<?php

namespace App\Services;

use App\Models\Pengumuman;
use Illuminate\Http\Request;

class PengumumanService
{
    public function storePengumuman(Request $request)
    {
        $validatedData = $request->validate([
            'tanggal' => 'required',
            'namaPengumuman' => 'required|max:255',
            'pengumuman' => 'required',
        ], [
            'tanggal.required' => 'Tanggal harus diisi',
            'namaPengumuman.required' => 'Nama pengumuman harus diisi',
            'namaPengumuman.max' => 'Nama pengumuman maksimal 255 karakter',
            'pengumuman.required' => 'Pengumuman harus diisi',
        ]);

        $pengumuman = Pengumuman::create($validatedData);

        return $pengumuman;
    }

    public function updatePengumuman(Request $request, $id)
    {
        $validatedData = $request->validate([
            'tanggal' => '',
            'namaPengumuman' => 'max:255',
            'pengumuman' => '',
        ], [
            'namaPengumuman.max' => 'Nama pengumuman maksimal 255 karakter',
        ]);

        $pengumuman = Pengumuman::where('idPengumuman', $id)->update($validatedData);

        return $pengumuman;
    }
}