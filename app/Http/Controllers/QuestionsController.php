<?php

namespace App\Http\Controllers;

use App\Questions;
use App\Quiz;
use Illuminate\Http\Request;
use Validator;

class QuestionsController extends Controller
{
    public function create($idquiz)
    {
        $quiz = Quiz::findorfail($idquiz);
        if ($quiz->finalize_status=='1') {
            return redirect('/dosen/quiz/'. $idquiz)->with(['cannot_add' => 'Cannot add question! Quiz has been finalized']);
        }
        return view('dosen.createquestion', compact('quiz'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'question_description' => 'required',
            'option_1' => 'required',
            'option_2' => 'required',
            'correct_answer' => 'required',
            'question_score' => 'required',
        ]);
        Questions::create($request->all());
        return redirect('/dosen/quiz/'. $request->quiz_id.'/#tab_question')->with(['create_done' => 'Question has been created']);
    }

    public function edit($idquiz, $idquestions)
    {
        $quiz = Quiz::findorfail($idquiz);
        if ($quiz->finalize_status=='1') {
            return redirect('/dosen/quiz/'. $idquiz)->with(['cannot_edit' => 'Cannot edit question! Quiz has been finalized']);
        }
        $questions = Questions::findorfail($idquestions);
        return view('dosen.editquestion', compact('quiz', 'questions'));
    }

    public function update(Request $request, $questions)
    {
        $request->validate([
            'question_description' => 'required',
            'option_1' => 'required',
            'option_2' => 'required',
            'correct_answer' => 'required',
            'question_score' => 'required',
        ]);
        $question = Questions::findorfail($questions);
        $question->update($request->all());
        return redirect('/dosen/quiz/'. $question->quiz_id.'/#tab_question')->with(['update_done' => 'Question has been updated']);
    }

    public function destroy($questions)
    {
        $soal = Questions::findorfail($questions);
        $soal->delete();
        return redirect('/dosen/quiz/'.$soal->quiz_id.'/#tab_question');
    }

    public function questionslist($idquiz)
    {
        $quiz = Quiz::findorfail($idquiz);
        $questions = Questions::where('quiz_id', $idquiz)->paginate(1);  
        return view('dosen.listofquestions', compact('quiz', 'questions'));
    }

    public function uploadImage(Request $request) {
        $path = asset('storage') . '/' . $request->file('file')->store('public/gambar-soal');
        $path = str_replace('/public', "", $path);
        return json_encode(['location' => $path]); 
    }

    public function importQuestion(Request $request) {
        $quiz = Quiz::find($request->import_id);
        foreach ($quiz->quiz as $q) {
            Questions::create([
                'quiz_id'  =>  $request->quiz_id,
                'question_description' =>  $q->question_description,
                'option_1' =>  $q->option_1,
                'option_2' =>  $q->option_2,
                'option_3' =>  $q->option_3,
                'option_4' =>  $q->option_4,
                'option_5' =>  $q->option_5,
                'correct_answer' =>  $q->correct_answer,
                'question_score' =>  $q->question_score,
            ]);
        }
        return redirect('/dosen/quiz/'.$request->quiz_id.'/#tab_question');
    }
}
