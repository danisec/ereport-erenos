<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Presensi extends Model
{
    use HasFactory, Sortable;

    protected $table = 'kehadiran';

    protected $guarded = ['idKehadiran'];

    public $sortable = [
        'idJadwal',
        'idKelas',
        'idPelajaran',
        'NIP', 
    ];

    public function scopeFilter($query, array $filters)
    {  
        $query->when($filters['search'] ?? false, function ($query, $search) {
            $query->where(function ($query) use ($search) {
                $query->whereHas('jadwal.kelas', function ($query) use ($search) {
                    $query->where('kelas', 'like', '%' . $search . '%');
                })
                ->orWhereHas('jadwal.pelajaran', function ($query) use ($search) {
                    $query->where('nmPelajaran', 'like', '%' . $search . '%');
                })
                ->orWhereHas('jadwal.guru', function ($query) use ($search) {
                    $query->where('namaGuru', 'like', '%' . $search . '%');
                });
            });
        });
    }

    public function jadwal() 
    {
        return $this->belongsTo(MappingJadwal::class, 'idJadwal', 'idJadwal');
    }

    public function kelas() 
    {
        return $this->belongsTo(Kelas::class, 'idKelas', 'idKelas');
    }

    public function guru() 
    {
        return $this->belongsTo(Guru::class, 'NIP', 'NIP');
    }

    public function kehadiran_d()
    {
        return $this->hasMany(presensiSiswa::class, 'idKehadiran', 'idKehadiran');
    }
}
