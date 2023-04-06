<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Guru extends Model
{
    use HasFactory, Sortable;

    protected $fillable = [
        'nig',
        'nama_guru',
    ];

    public $sortable = [
        'nig',
        'nama_guru', 
        'created_at', 
        'updated_at'
    ];

    public function scopeFilter($query, array $filters)
    {  
        $query->when($filters['search'] ?? false, fn($query, $search) =>
            $query->where('nama_guru', 'like', '%'. $search . '%')
        );
    }
}
