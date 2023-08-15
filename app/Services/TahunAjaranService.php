<?php

namespace App\Services;

use App\Models\Semester;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TahunAjaranService
{
    public function storeTahunAjaran(Request $request)
    {
        $validatedData = $request->validate([
            'thnAjaran' => 'required|max:15|unique:tahun_ajaran,thnAjaran',
        ], [
            'thnAjaran.required' => 'Tahun ajaran harus diisi',
            'thnAjaran.max' => 'Tahun ajaran maksimal 15 karakter',
            'thnAjaran.unique' => 'Tahun ajaran sudah terdaftar',
        ]);

        DB::beginTransaction();

        try {
            TahunAjaran::create($validatedData);

            DB::commit();
            

            return redirect('/dashboard/tahunajaran/tambah-tahunajaran/semester');
        } catch (\Exception $e) {
            // Rollback transaksi jika terjadi kesalahan
            DB::rollback();

            $notif = notify()->error('Terjadi kesalahan saat menyimpan data');

            return back()->with('notif', $notif);
        }
    }

    public function storeSemester(Request $request)
    {
        $validatedSemester = $request->validate([
            'idThnAjaran' => 'required',
            'semester' => 'required',
        ], [
            'idThnAjaran.required' => 'Tahun Ajaran harus diisi',
            'idThnAjaran.unique' => 'Tahun Ajaran sudah terdaftar',
            'semester.required' => 'Semester harus diisi',
        ]);

        DB::beginTransaction();

        try {
            Semester::create($validatedSemester);

            DB::commit();

            $notif = notify()->success('Data Tahun Ajaran Berhasil Ditambahkan');

            return back()->with('notif', $notif);
        } catch (\Exception $e) {
            // Rollback transaksi jika terjadi kesalahan
            DB::rollback();

            $notif = notify()->error('Terjadi kesalahan saat menyimpan data');

            return back();
        }
    }

    public function updateTahunAjaran(Request $request, $id)
    {
        $validatedData = $request->validate([
            'semester' => 'required',
        ], [
            'semester.required' => 'Semester harus diisi',
        ]);

        DB::beginTransaction();

        try {
            Semester::where('idSemester', $id)->update($validatedData);

            DB::commit();

            $notif = notify()->success('Data Tahun Ajaran Berhasil Diubah');

            return redirect('/dashboard/tahunajaran')->with('notif', $notif);
        } catch (\Exception $e) {
            // Rollback transaksi jika terjadi kesalahan
            DB::rollback();

            $notif = notify()->error('Terjadi kesalahan saat menyimpan data');

            return back();
        }
    }
}