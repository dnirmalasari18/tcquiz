<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kehadiran extends Model
{
    protected $table = 'kehadiran';
    protected $primaryKey = 'id';
    public $incrementing = true;

    protected $fillable = [
        'idUser', 'idAgenda', 'p1', 'p2', 'p3', 'p4', 'p5', 'p6', 'p7', 'p8', 'p9', 'p10', 'p11', 'p12', 'p13', 'p14', 'p15', 'p16', 'p17', 'p18', 'p19', 'p20', 
    ];

    public function user() {
        return $this->belongsTo('App\User', 'idUser', 'username');
    }

    public function agenda() {
        return $this->belongsTo('App\Agenda', 'idAgenda', 'idAgenda');
    }
}
