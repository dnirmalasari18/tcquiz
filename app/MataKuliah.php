<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MataKuliah extends Model
{
    protected $table = 'mata_kuliahs';
    protected $primaryKey = 'id';
    public $incrementing = false;

    protected $fillable = [
    	'id', 'nama_mata_kuliah', 'sks', 'semester'
    ];

    public function punyajadwals() {
        return $this->hasMany('App\Kelas', 'mata_kuliah_id', 'id');
    }
}
