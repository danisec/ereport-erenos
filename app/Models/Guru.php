<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Guru extends Model
{
    use HasFactory, Sortable;

    protected $table = 'guru';

    protected $fillable = [
        'NIP',
        'namaGuru',
    ];

    public $sortable = [
        'NIP',
        'namaGuru',
    ];

    public function scopeFilter($query, array $filters)
    {  
        $query->when($filters['search'] ?? false, fn($query, $search) =>
            $query->where('namaGuru', 'like', '%'. $search . '%')
        );
    }
}
