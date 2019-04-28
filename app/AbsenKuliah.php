<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AbsenKuliah extends Model
{
    protected $table = 'absenkuliah';
    protected $primaryKey = 'id';
    public $incrementing = true;

    protected $fillable = [
        'fk_idAgenda', 'tglPertemuan', 'waktuMulai', 'waktuSelesai', 'pertemuanKe', 'BeritaAcara',
    ];

    public function agenda() {
        return $this->belongsTo('App\Agenda', 'fk_idAgenda', 'idAgenda');
    }
}
