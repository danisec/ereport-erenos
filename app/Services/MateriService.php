<?php

namespace App\Services;

use App\Models\Materi;
use App\Models\Pelajaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MateriService 
{
    public function storeMateri(Request $request)
    {
        $validatedData = $request->validate([
            'idPelajaran' => 'required',
            'materi' => 'required',
        ], [
            'idPelajaran.required' => 'Nama Pelajaran Harus Diisi',
            'materi.required' => 'Materi Harus Diisi',
        ]);

        $materi = $validatedData['materi'];
        
        foreach ($materi as $item) {
            Materi::create([
                'idPelajaran' => $validatedData['idPelajaran'],
                'materi' => $item,
            ]);
        }
    }

    public function updateMateri(Request $request, $id)
    {
        $validatedData = $request->validate([
            'idPelajaran' => '',
            'materi' => '',
        ]);

        DB::beginTransaction();

        try {
            // get idPelajaran from table materi
            $idPelajaran = Pelajaran::where('idPelajaran', $id)->first()->idPelajaran;

            $materi_data = [];
            foreach ($validatedData['materi'] as $item) {

                $materi_data[] = [
                    'idPelajaran' => $request->input('idPelajaran') ?? $idPelajaran,
                    'materi' => $item,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }

            Materi::where('idPelajaran', $id)->delete();
            Materi::insert($materi_data);

            DB::commit();

            $notif = notify()->success('Data Materi Berhasil Diubah');

            return redirect('/dashboard/materi')->with('notif', $notif);
        } catch (\Throwable $e) {
            DB::rollback();
            
            $error = $e->getMessage();
            $notif = notify()->error('Terjadi kesalahan saat memperbarui data: ' . $error);

            return redirect('/dashboard/materi/ubah-materi/' . $id . '/edit')->with('notif', $notif);
        } 
    }
}