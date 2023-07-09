<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Nilai extends Model
{
    use HasFactory, Sortable;

    protected $table = 'nilai';

    protected $guarded = ['idNilai'];

    public $sortable = [
        'idKelas',
        'idPelajaran',
        'idMateri',
        'aspek',
        'jenis'
    ];

    public function scopeFilter($query, array $filters)
    {  
        $query->when($filters['search'] ?? false, fn($query, $search) =>
            $query->whereHas('kelas', fn($query) =>
                $query->where('kelas', 'like', '%'.$search.'%')
            )
            ->orWhereHas('materi', fn($query) =>
                $query->where('materi', 'like', '%'.$search.'%')
            )
            ->orWhereHas('materi.pelajaran', fn($query) =>
                $query->where('nmPelajaran', 'like', '%'.$search.'%')
            )
        );
    }

    public function materi() 
    {
        return $this->belongsTo(Materi::class, 'idMateri', 'idMateri');
    }

    public function kelas() 
    {
        return $this->belongsTo(Kelas::class, 'idKelas', 'idKelas');
    }

    public function guru() 
    {
        return $this->belongsTo(Guru::class, 'NIP', 'NIP');
    }

    public function nilai_d()
    {
        return $this->hasMany(Nilai_D::class, 'idNilai', 'idNilai');
    }
}
