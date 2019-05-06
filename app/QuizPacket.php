<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuizPacket extends Model
{
    protected $table = 'quiz_packets';
    protected $primaryKey = 'id';
    public $incrementing = true;

    protected $fillable = [
        'quiz_id', 'question_id_list', 'packet_answer_list', 
    ];

    public function kuis() {
        return $this->belongsTo('App\Quiz', 'quiz_id', 'id');
    }

    public function user() {
        return $this->hasOne('App\MahasiswaPacket', 'quizpacket_id', 'id');
    }
}
