<?php

namespace App\Services;

use App\Models\HistorySiswa;
use App\Models\HistorySiswa_D;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HistorySiswaService
{
    public function storeHistorySiswa(Request $request)
    {
        $validatedData = $request->validate([
            'idSemester' => 'required|unique:history_siswa,idSemester,NULL,idHistory,idKelas,' . $request->input('idKelas') . ',NIS,' . $request->input('NIS'),
            'idKelas' => 'required',
            'NIS' => 'required',
        ], [
            'idSemester' => 'Semester harus diisi',
            'idSemester.unique' => 'Data sudah ada',
            'idKelas' => 'Kelas harus diisi',
            'NIS' => 'Siswa harus diisi',
        ]);

        DB::beginTransaction();

        try {
            $historySiswa = HistorySiswa::create($validatedData);
            $idHistory = $historySiswa->id;

            $validatedHistorySiswaD = $request->validate([
                'keterangan' => 'required',
            ], [
                'keterangan.required' => 'Keterangan harus diisi',
            ]);

            $historySiswaD_Data = [];
            foreach ($validatedHistorySiswaD['keterangan'] as $index => $keterangan) {
                $historySiswaD_Data[] = [
                    'keterangan' => $keterangan,
                    'idHistory' => $idHistory,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }

            // Simpan data nilai_d ke dalam tabel nilai_d secara banyak
            HistorySiswa_D::insert($historySiswaD_Data);

            DB::commit();

            $notif = notify()->success('Data History Siswa Berhasil Ditambahkan');

            return redirect('/dashboard/history-siswa')->withInput()->with('notif', $notif);

        } catch (\Throwable $th) {
            // Rollback transaksi jika terjadi kesalahan
            DB::rollback();

            $notif = notify()->error('Terjadi kesalahan saat menyimpan data');

            return back();
        }
    }

    public function updateHistorySiswa(Request $request, $id)
    {
        $validatedData = $request->validate([
            'idSemester' => '',
            'idKelas' => '',
            'NIS' => '',
        ]);

        DB::beginTransaction();

        try {
            HistorySiswa::where('idHistory', $id)->update($validatedData);
            $idHistory = $id;

            $historySiswaD_Data = [];
            foreach ($request->input('keterangan') as $index => $keterangan) {
                $historySiswaD_Data[] = [
                    'keterangan' => $keterangan,
                    'idHistory' => $idHistory,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }

            HistorySiswa_D::where('idHistory', $id)->delete();
            HistorySiswa_D::insert($historySiswaD_Data);

            DB::commit();

            $notif = notify()->success('Data History Siswa Berhasil Diperbarui');

            return redirect('/dashboard/history-siswa')->with('notif', $notif);
            
        } catch (\Throwable $th) {
            DB::rollback();

            $notif = notify()->error('Terjadi kesalahan saat memperbarui data');

            return redirect('/dashboard/history-siswa/ubah-historysiswa/' . $id . '/edit')->with('notif', $notif);
        }
    }
}