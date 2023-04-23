<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class TahunAjaran extends Model
{
    use HasFactory, Sortable;

    protected $table = 'tahun_ajaran';

    protected $fillable = [
        'thnAjaran',
        'semester',
    ];

    public $sortable = [
        'thnAjaran',
        'semester',
    ];

    public function scopeFilter($query, array $filters)
    {  
        $query->when($filters['search'] ?? false, fn ($query, $search) =>
            $query->where('thnAjaran', 'like', '%' . $search . '%')
        );
    }
}
