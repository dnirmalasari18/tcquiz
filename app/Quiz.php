<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    protected $table = 'quizzes';
    protected $primaryKey = 'id';
    public $incrementing = true;

    protected $fillable = [
        'nama_kuis', 'durasi', 'terms_conditions', 'absenkuliah_id', 'dosen_id', 
    ];

    public function pertemuanke() {
        return $this->belongsTo('App\AbsenKuliah', 'absenkuliah_id', 'id');
    }

    public function creator() {
        return $this->belongsTo('App\User', 'dosen_id', 'id');
    }

    public function quiz() {
        return $this->hasMany('App\Questions', 'quiz_id', 'id');
    }

    public function pakets() {
        return $this->hasMany('App\QuizPacket', 'id', 'id');
    }
}
