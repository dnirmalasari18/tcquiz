<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ruangan extends Model
{
    protected $table = 'ruangans';
    protected $primaryKey = 'id';
    public $incrementing = true;

    protected $fillable = [
    	'nama_ruangan', 'kuota_ruangan'
    ];

    public function punyajadwals() {
        return $this->hasMany('App\Kelas', 'ruangan_id', 'id');
    }
}
