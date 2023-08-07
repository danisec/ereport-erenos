<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RaporNilai extends Model
{
    use HasFactory;

    protected $table = 'rapor_nilai';

    protected $guarded = ['idRapor_nilai'];

    public function rapor() 
    {
        return $this->belongsTo(Rapor::class, 'idRapor', 'idRapor');
    }

    public function pelajaran() 
    {
        return $this->belongsTo(Pelajaran::class, 'idPelajaran', 'idPelajaran');
    }
}
