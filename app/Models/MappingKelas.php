<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class MappingKelas extends Model
{
    use HasFactory, Sortable;

    protected $table = 'mapping_kelas';

    protected $fillable = [
        'idKelas',
        'idThnAjaran',
        'NIP',
    ];

    public $sortable = [
        'idKelas',
        'idThnAjaran',
        'NIP', 
    ];

    public function scopeFilter($query, array $filters)
    {  
        $query->when($filters['search'] ?? false, fn($query, $search) =>
            $query->whereHas('kelas', fn($query) =>
                $query->where('kelas', 'like', '%'.$search.'%')
            )
        );
    }

    public function tahunajaran() 
    {
        return $this->belongsTo(TahunAjaran::class, 'idThnAjaran', 'idThnAjaran');
    }

    public function kelas() 
    {
        return $this->belongsTo(Kelas::class, 'idKelas', 'idKelas');
    }

    public function guru() 
    {
        return $this->belongsTo(Guru::class, 'NIP', 'NIP');
    }
}
