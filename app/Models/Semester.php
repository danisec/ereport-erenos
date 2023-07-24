<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Semester extends Model
{
    use HasFactory, Sortable;

    protected $table = 'semester';

    protected $guarded = ['idSemester'];

    public $sortable = [
        'idThnAjaran',
        'semester',
    ];

    public function scopeFilter($query, array $filters)
    {  
        $query->when($filters['search'] ?? false, function ($query, $search) {
            $query->where(function ($query) use ($search) {
                $query->whereHas('tahunajaran', function ($query) use ($search) {
                    $query->where('thnAjaran', 'like', '%' . $search . '%');
                });
            })
            ->orWhere('semester', 'like', '%' . $search . '%');
        });
    }

    public function tahunajaran()
    {
        return $this->belongsTo(TahunAjaran::class, 'idThnAjaran', 'idThnAjaran');
    }
}
