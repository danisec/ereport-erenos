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
            'pengetahuanA' => 'required|max:2000',
            'pengetahuanB' => 'required|max:2000',
            'pengetahuanC' => 'required|max:2000',
            'pengetahuanD' => 'required|max:2000',
            'keterampilanA' => 'required|max:2000',
            'keterampilanB' => 'required|max:2000',
            'keterampilanC' => 'required|max:2000',
            'keterampilanD' => 'required|max:2000',
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
            'pengetahuanA.required' => 'Deskripsi Pengetahuan A harus diisi',
            'pengetahuanA.max' => 'Deskripsi Pengetahuan A maksimal 2000 karakter',
            'pengetahuanB.required' => 'Deskripsi Pengetahuan B harus diisi',
            'pengetahuanB.max' => 'Deskripsi Pengetahuan B maksimal 2000 karakter',
            'pengetahuanC.required' => 'Deskripsi Pengetahuan C harus diisi',
            'pengetahuanC.max' => 'Deskripsi Pengetahuan C maksimal 2000 karakter',
            'pengetahuanD.required' => 'Deskripsi Pengetahuan D harus diisi',
            'pengetahuanD.max' => 'Deskripsi Pengetahuan D maksimal 2000 karakter',
            'keterampilanA.required' => 'Deskripsi Keterampilan A harus diisi',
            'keterampilanA.max' => 'Deskripsi Keterampilan A maksimal 2000 karakter',
            'keterampilanB.required' => 'Deskripsi Keterampilan B harus diisi',
            'keterampilanB.max' => 'Deskripsi Keterampilan B maksimal 2000 karakter',
            'keterampilanC.required' => 'Deskripsi Keterampilan C harus diisi',
            'keterampilanC.max' => 'Deskripsi Keterampilan C maksimal 2000 karakter',
            'keterampilanD.required' => 'Deskripsi Keterampilan D harus diisi',
            'keterampilanD.max' => 'Deskripsi Keterampilan D maksimal 2000 karakter',
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
            'pengetahuanA' => 'required|max:2000',
            'pengetahuanB' => 'required|max:2000',
            'pengetahuanC' => 'required|max:2000',
            'pengetahuanD' => 'required|max:2000',
            'keterampilanA' => 'required|max:2000',
            'keterampilanB' => 'required|max:2000',
            'keterampilanC' => 'required|max:2000',
            'keterampilanD' => 'required|max:2000',
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
            'pengetahuanA.required' => 'Deskripsi Pengetahuan A harus diisi',
            'pengetahuanA.max' => 'Deskripsi Pengetahuan A maksimal 2000 karakter',
            'pengetahuanB.required' => 'Deskripsi Pengetahuan B harus diisi',
            'pengetahuanB.max' => 'Deskripsi Pengetahuan B maksimal 2000 karakter',
            'pengetahuanC.required' => 'Deskripsi Pengetahuan C harus diisi',
            'pengetahuanC.max' => 'Deskripsi Pengetahuan C maksimal 2000 karakter',
            'pengetahuanD.required' => 'Deskripsi Pengetahuan D harus diisi',
            'pengetahuanD.max' => 'Deskripsi Pengetahuan D maksimal 2000 karakter',
            'keterampilanA.required' => 'Deskripsi Keterampilan A harus diisi',
            'keterampilanA.max' => 'Deskripsi Keterampilan A maksimal 2000 karakter',
            'keterampilanB.required' => 'Deskripsi Keterampilan B harus diisi',
            'keterampilanB.max' => 'Deskripsi Keterampilan B maksimal 2000 karakter',
            'keterampilanC.required' => 'Deskripsi Keterampilan C harus diisi',
            'keterampilanC.max' => 'Deskripsi Keterampilan C maksimal 2000 karakter',
            'keterampilanD.required' => 'Deskripsi Keterampilan D harus diisi',
            'keterampilanD.max' => 'Deskripsi Keterampilan D maksimal 2000 karakter',
        ]);

        $pelajaran = Pelajaran::where('kodePelajaran', $id)->update($validatedData);

        return $pelajaran;
    }
}