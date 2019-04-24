<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class pengguna extends Model
{
    protected $table = 'pengguna';
    protected $primaryKey = 'iduser';
    public $incrementing = false;
    protected $fillable = [
    'nip_nrp','password'
    ];
    protected $hidden = ['password'];
}
