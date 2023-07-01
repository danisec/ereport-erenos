<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Materi extends Model
{
    use HasFactory, Sortable;

    protected $table = 'materi';

    protected $guarded = ['idMateri'];

    public $sortable = [
        'materi',
        'idPelajaran',
    ];

    public function scopeFilter($query, array $filters)
    {  
        $query->when($filters['search'] ?? false, fn ($query, $search) =>
            $query->where('materi', 'like', '%' . $search . '%')
                ->orWhereHas('pelajaran', fn($query) =>
                $query->where('nmPelajaran', 'like', '%'.$search.'%')
            )
        );
    }

    public function pelajaran() 
    {
        return $this->belongsTo(Pelajaran::class, 'idPelajaran', 'idPelajaran');
    }
}
