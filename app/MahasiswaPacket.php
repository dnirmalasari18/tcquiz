<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MahasiswaPacket extends Model
{
    protected $table = 'mahasiswa_packets';
    protected $primaryKey = 'id';
    public $incrementing = true;

    protected $fillable = [
        'user_id', 'quizpacket_id', 'question_flag_list', 'user_answer_list'
    ];

    public function user() {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function paketkuis() {
        return $this->belongsTo('App\QuizPacket', 'quizpacket_id', 'id');
    }
}
