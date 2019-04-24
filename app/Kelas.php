<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $table = 'kelas';
    protected $primaryKey = 'id';
    public $incrementing = true;

    protected $fillable = [
        'mata_kuliah_id', 'user_nip', 'ruangan_id', 'hari', 'jam', 'kelas', 'kuota'
    ];

    public function dosenpengajar() {
        return $this->belongsTo('App\User', 'user_nip', 'username');
    }

    public function matakuliah() {
        return $this->belongsTo('App\MataKuliah', 'mata_kuliah_id', 'id');
    }

    public function ruangan() {
        return $this->belongsTo('App\Ruangan', 'ruangan_id', 'id');
    }

}
