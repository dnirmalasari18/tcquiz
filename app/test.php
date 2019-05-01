<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class test extends Model
{
    protected $table = 'test';
    protected $primaryKey = 'id';
    public $incrementing = true;

    protected $fillable = [
    	'no_soal', 'soal', 'jawaban_soal', 
    ];
}
