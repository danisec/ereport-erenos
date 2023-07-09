<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class MappingJadwal extends Model
{
    use HasFactory, Sortable;

    protected $table = 'jadwal';

    protected $guarded = ['idJadwal'];

    public $sortable = [
        'idThnAjaran',
        'idKelas',
        'NIP',
        'hari',
        'idPelajaran', 
    ];

    public function scopeFilter($query, array $filters)
    {  
       $query->when($filters['search'] ?? false, fn($query, $search) =>
            $query->whereHas('kelas', fn($query) =>
                $query->where('kelas', 'like', '%'.$search.'%')
            )
            ->orWhereHas('pelajaran', fn($query) =>
                $query->where('nmPelajaran', 'like', '%'.$search.'%')
            )
            ->orWhereHas('guru', fn($query) =>
                $query->where('namaGuru', 'like', '%'.$search.'%')
            )
            ->orWhere('hari', 'like', '%'.$search.'%')
        );
    }

    public function kelas() 
    {
        return $this->belongsTo(Kelas::class, 'idKelas', 'idKelas');
    }

    public function tahunajaran() 
    {
        return $this->belongsTo(TahunAjaran::class, 'idThnAjaran', 'idThnAjaran');
    }

    public function guru() 
    {
        return $this->belongsTo(Guru::class, 'NIP', 'NIP');
    }

    public function pelajaran() 
    {
        return $this->belongsTo(Pelajaran::class, 'idPelajaran', 'idPelajaran');
    }

    public function kehadiran()
    {
        return $this->hasMany(Presensi::class, 'idJadwal', 'idJadwal');
    }
}
