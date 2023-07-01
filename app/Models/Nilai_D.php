<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nilai_D extends Model
{
    use HasFactory;

    protected $table = 'nilai_d';

    protected $guarded = ['idNilai_D'];

    public function siswa() 
    {
        return $this->belongsTo(Siswa::class, 'NIS', 'NIS');
    }
}
