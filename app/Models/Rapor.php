<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rapor extends Model
{
    use HasFactory;

    protected $table = 'rapor';

    protected $primaryKey = 'idRapor';
    protected $guarded = ['idRapor'];

    public function siswa() 
    {
        return $this->belongsTo(Siswa::class, 'NIS', 'NIS');
    }

    public function kelas() 
    {
        return $this->belongsTo(Kelas::class, 'idKelas', 'idKelas');
    }

    public function semester() 
    {
        return $this->belongsTo(Semester::class, 'idSemester', 'idSemester');
    }

    public function rapor_d()
    {
        return $this->hasMany(Rapor_D::class, 'idRapor', 'idRapor');
    }

    public function rapor_nilai()
    {
        return $this->hasMany(RaporNilai::class, 'idRapor', 'idRapor');
    }
}
