<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Questions extends Model
{
    protected $table = 'questions';
    protected $primaryKey = 'id';
    public $incrementing = true;

    protected $fillable = [
    	'quiz_id', 'question_description', 'option_a', 'option_b', 'option_c', 'option_d', 'option_e', 'correct_answer', 'question_score'
    ];

    public function quiz() {
        return $this->belongsTo('App\Quiz', 'quiz_id', 'id');
    }
}
