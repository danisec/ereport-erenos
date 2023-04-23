<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Siswa extends Model
{
    use HasFactory, Sortable;

    protected $table = 'siswa';

    protected $fillable = [
        'NIS',
        'nmSiswa',
        'nmPanggil',
        'tinggi',
        'berat',
    ];

    public $sortable = [
        'NIS',
        'nmSiswa',
        'nmPanggil',
        'tinggi',
        'berat',  
    ];

    public function scopeFilter($query, array $filters)
    {  
        $query->when($filters['search'] ?? false, fn($query, $search) =>
            $query->where('berat', 'like', '%'. $search . '%')
                ->orWhere('nmPanggil', 'like', '%' . $search . '%')
        );
    }
}
