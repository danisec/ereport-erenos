<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rapor_D extends Model
{
    use HasFactory;

    protected $table = 'rapor_d';

    protected $guarded = ['idRapor_d'];

    public function rapor() 
    {
        return $this->belongsTo(Rapor::class, 'idRapor', 'idRapor');
    }
}
