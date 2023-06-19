<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class presensiSiswa extends Model
{
    use HasFactory, Sortable;

    protected $table = 'kehadiran_d';

    protected $guarded= ['idKehadiran_D'];

    public $sortable = [
        'NIS',
        'nmSiswa',
        'status',
    ];

    public function siswa() 
    {
        return $this->belongsTo(Siswa::class, 'NIS', 'NIS');
    }
}
