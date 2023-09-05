<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistorySiswa_D extends Model
{
    use HasFactory;

    protected $table = "history_siswa_d";
    protected $guarded = ['idHistory_d'];

    public function historysiswa()
    {
        return $this->belongsTo(HistorySiswa::class, 'idHistory', 'idHistory');
    }
}
