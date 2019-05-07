<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Questions extends Model
{
    protected $table = 'questions';
    protected $primaryKey = 'id';
    public $incrementing = true;

    protected $fillable = [
    	'quiz_id', 'question_description', 'option_1', 'option_2', 'option_3', 'option_4', 'option_5', 'correct_answer', 'question_score'
    ];

    public function quiz() {
        return $this->belongsTo('App\Quiz', 'quiz_id', 'id');
    }
}
