<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Pengumuman extends Model
{
    use HasFactory, Sortable;

    protected $table = 'pengumuman';

    protected $guarded = ['idPengumuman'];

    public $sortable = [
        'namaPengumuman',
        'pengumuman',
    ];

    public function scopeFilter($query, array $filters)
    {  
        $query->when($filters['search'] ?? false, fn($query, $search) =>
            $query->where('namaPengumuman', 'like', '%'. $search . '%')
                ->orWhere('pengumuman', 'like', '%' . $search . '%')
        );
    }
}
