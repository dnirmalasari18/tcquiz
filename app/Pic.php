<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pic extends Model
{
 	protected $table = 'pic';
    protected $primaryKey = 'idPIC';
    public $incrementing = false;

    protected $fillable = [
    	'idPIC', 
    ];

    public function users() {
        return $this->belongsTo('App\User', 'idPIC', 'username');
    }

    public function mengajar() {
        return $this->hasMany('App\Agenda', 'fk_idPIC', 'idPIC');
    }
}
