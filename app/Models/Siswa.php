<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Siswa extends Model
{
    use HasFactory, Sortable;

    protected $fillable = [
        'nis',
        'nama_siswa',
        'nama_panggilan',
        'tinggi_badan',
        'berat_badan',
    ];

    public $sortable = [
        'nis',
        'nama_siswa',
        'nama_panggilan',
        'tinggi_badan',
        'berat_badan',  
        'created_at', 
        'updated_at'
    ];

    public function scopeFilter($query, array $filters)
    {  
        $query->when($filters['search'] ?? false, fn($query, $search) =>
            $query->where('nama_siswa', 'like', '%'. $search . '%')
        );

        $query->when($filters['nama_panggilan'] ?? false, fn($query, $nama_panggilan) =>
            $query->where('nama_panggilan', 'like', '%'. $nama_panggilan . '%')
        );
    }
}
