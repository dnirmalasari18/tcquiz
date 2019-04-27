<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MahasiswaMengambil extends Model
{
    protected $table = 'mahasiswa_mengambils';
    protected $primaryKey = 'id';
    public $incrementing = true;
    
    protected $fillable = [
        'kelas_id', 'mahasiswa_nrp',
    ];

    public function mahasiswamengambil()
    {
        return $this->belongsTo('App\User', 'mahasiswa_nrp', 'username');
    }

    public function kelas() {
        return $this->belongsTo('App\Kelas', 'kelas_id', 'id');
    }

}
