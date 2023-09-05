<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class HistorySiswa extends Model
{
    use HasFactory, Sortable;

    protected $table = "history_siswa";
    protected $guarded = ['idHistory'];

    public $sortable = [
        'idHistory',
        'idSemester',
        'idKelas',
        'NIS',
    ];

    public function scopeFilter($query, array $filters)
    {  
        $query->when($filters['search'] ?? false, function ($query, $search) {
            $query->where(function ($query) use ($search) {
                $query->whereHas('siswa', function ($query) use ($search) {
                    $query->where('nmSiswa', 'like', '%' . $search . '%');
                });
            });
        });
    }

    public function semester()
    {
        return $this->belongsTo(Semester::class, 'idSemester', 'idSemester');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'idKelas', 'idKelas');
    }

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'NIS', 'NIS');
    }

    public function historysiswa_d()
    {
        return $this->hasMany(HistorySiswa_D::class, 'idHistory', 'idHistory');
    }
}
