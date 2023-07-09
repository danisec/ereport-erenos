<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Pelajaran extends Model
{
    use HasFactory, Sortable;

    protected $table = 'pelajaran';

    protected $guarded = ['idPelajaran'];

    public $sortable = [
        'kodePelajaran',
        'nmPelajaran',
        'nmSingkatan',
        'KKM',
    ];

    public function scopeFilter($query, array $filters)
    {  
        $query->when($filters['search'] ?? false, fn ($query, $search) =>
            $query->where('nmPelajaran', 'like', '%' . $search . '%')
                        ->orWhere('nmSingkatan', 'like', '%' . $search . '%')
        );
    }

    public function materi()
    {
        return $this->hasMany(Materi::class, 'idPelajaran', 'idPelajaran');
    }
}
