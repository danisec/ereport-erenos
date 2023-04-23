<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Kelas extends Model
{
    use HasFactory, Sortable;

    protected $table = 'kelas';

    protected $fillable = [
        'kelas',
    ];

    public $sortable = [
        'kelas',
    ];

    public function scopeFilter($query, array $filters)
    {  
        $query->when($filters['search'] ?? false, fn ($query, $search) =>
            $query->where('kelas', 'like', '%' . $search . '%')
        );
    }
}
