<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    protected $table = 'agenda';
    protected $primaryKey = 'idAgenda';
    public $incrementing = false;

    protected $fillable = [
        'idAgenda', 'namaAgenda', 'singkatAgenda', 'tanggal', 'hari', 'fk_idRuang', 'WaktuMulai', 'WaktuSelesai', 'fk_idPIC', 'notule',
    ];

    public function dosenpengajar() {
        return $this->belongsTo('App\Pic', 'fk_idPIC', 'idPIC');
    }

     public function pertemuan() {
        return $this->hasMany('App\AbsenKuliah', 'fk_idAgenda', 'idAgenda');
    }
    
    public function kehadiran() {
        return $this->hasMany('App\Kehadiran', 'idAgenda', 'idAgenda');
    }
}
