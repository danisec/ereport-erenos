<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MappingKelasSiswa extends Model
{
    use HasFactory;

    protected $table = 'mappingkelas_d';

    protected $guarded= ['idMappingKelas_D'];

    public function siswa() 
    {
        return $this->belongsTo(Siswa::class, 'NIS', 'NIS');
    }

    public function mappingkelas()
    {
        return $this->belongsTo(MappingKelas::class, 'idMapping', 'idMapping');
    }
}
