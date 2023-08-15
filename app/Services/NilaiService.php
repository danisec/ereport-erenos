<?php

namespace App\Services;

use App\Models\Nilai;
use App\Models\Nilai_D;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NilaiService
{
    public function storeNilai(Request $request)
    {
        $validatedData = $request->validate([
            'idSemester' => 'required',
            'tanggal' => 'required|date',
            'aspek' => 'required|in:Pengetahuan,Keterampilan',
            'jenis' => 'required|in:Harian,Pertengahan Tengah Semester,Pertengahan Akhir Semester',
            'idMateri' => 'required',
            'idKelas' => 'required',
            'NIP' => 'required',
        ], [
            'idSemester.required' => 'Tahun Ajaran Harus Diisi',
            'tanggal.required' => 'Tanggal Harus Diisi',
            'tanggal.date' => 'Tanggal Harus Berupa Tanggal',
            'aspek.required' => 'Aspek Harus Diisi',
            'aspek.in' => 'Aspek Harus Berupa Pengetahuan atau Keterampilan',
            'jenis.required' => 'Jenis Harus Diisi',
            'jenis.in' => 'Jenis Harus Berupa Harian, Pertengahan Tengah Semester, atau Pertengahan Akhir Semester',
            'idMateri.required' => 'Materi Harus Diisi',
            'idKelas.required' => 'Kelas Harus Diisi',
            'NIP.required' => 'Guru Harus Diisi',
        ]);

        // Mulai transaksi database
        DB::beginTransaction();

        try {
            // Simpan data nilai ke tabel Nilai
            $nilai = Nilai::create($validatedData);
            $idNilai = $nilai->id;

            $validatedNilaiD = $request->validate([
                'nilai' => 'required',
                'NIS' => 'required',
            ], [
                'nilai.required' => 'Nilai Harus Diisi',
                'NIS.required' => 'NIS Harus Diisi',
            ]);

            $nilaiD_Data = [];
            foreach ($validatedNilaiD['NIS'] as $index => $NIS) {
                $nilaiD_Data[] = [
                    'nilai' => $validatedNilaiD['nilai'][$index],
                    'idNilai' => $idNilai,
                    'NIS' => $NIS,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }

            // Simpan data nilai_d ke dalam tabel nilai_d secara banyak
            Nilai_D::insert($nilaiD_Data);

            // Commit transaksi jika semua operasi berhasil
            DB::commit();

            $notif = notify()->success('Data Nilai Berhasil Ditambahkan');

            return redirect('/dashboard/nilai')->with('notif', $notif);
        } catch (\Exception $e) {
            // Rollback transaksi jika terjadi kesalahan
            DB::rollback();

            $notif = notify()->error('Terjadi kesalahan saat menyimpan data');

            return back();
        }
    }

    public function updateNilai(Request $request, $id)
    {
        $validatedData = $request->validate([
            'tanggal' => 'date',
            'aspek' => 'in:Pengetahuan,Keterampilan',
            'jenis' => 'in:Harian,Pertengahan Tengah Semester,Pertengahan Akhir Semester',
            'idMateri' => '',
            'idKelas' => '',
            'NIP' => '',
        ], [
            'tanggal.date' => 'Tanggal Harus Berupa Tanggal',
            'aspek.in' => 'Aspek Harus Berupa Pengetahuan atau Keterampilan',
            'jenis.in' => 'Jenis Harus Berupa Harian, Pertengahan Tengah Semester, atau Pertengahan Akhir Semester',
        ]);

        // Mulai transaksi database
        DB::beginTransaction();

       try {
            Nilai::where('idNilai', $id)->update($validatedData);

            // get idNilai
            $idNilai = Nilai::where('idNilai', $id)->first()->idNilai;

            $nilaiD_Data = [];
            foreach ($request->input('NIS') as $index => $NIS) {
                $nilai = $request->input('nilai')[$index];

                $nilaiD_Data[] = [
                    'nilai' => $nilai,
                    'idNilai' => $idNilai,
                    'NIS' => $NIS,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }

            // Hapus data nilai_d yang terkait dengan nilai sebelumnya
            Nilai_D::where('idNilai', $id)->delete();

            // Simpan data nilai_d yang baru ke dalam tabel nilai_d secara banyak
            Nilai_D::insert($nilaiD_Data);

            // Commit transaksi jika semua operasi berhasil
            DB::commit();

            $notif = notify()->success('Data Nilai Berhasil Diperbarui');

            return redirect('/dashboard/nilai')->with('notif', $notif);
        } catch (\Exception $e) {
            // Rollback transaksi jika terjadi kesalahan
            DB::rollback();

            $notif = notify()->error('Terjadi kesalahan saat memperbarui data');

            return redirect('/dashboard/nilai/ubah-nilai/' . $id . '/edit')->with('notif', $notif);
        }
    }
}