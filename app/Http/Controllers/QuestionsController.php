<?php

namespace App\Http\Controllers;

use App\Questions;
use App\Quiz;
use Illuminate\Http\Request;
use Validator;
use App\Http\Requests\CreateQuestion;

class QuestionsController extends Controller
{
    public function create($idquiz)
    {
        $quiz = Quiz::findorfail($idquiz);
        if ($quiz->finalize_status=='1') {
            // return redirect('/dosen/quiz/'. $idquiz.'/questions')->with(['error' => 'Tidak dapat menambah soal! Kuis sudah difinalisasi']);
            return redirect('/dosen/quiz/'. $idquiz)->with(['cannot_add' => 'Cannot add question! Quiz has been finalized']);
        }
        return view('dosen.createquestion', compact('quiz'));
    }

    public function store(CreateQuestion $request)
    {
        $validated = $request->validated();
        Questions::create($request->all());
        // return redirect('/dosen/quiz/'. $request->quiz_id.'/questions')->with(['create_done' => 'Question has been created']);
        return redirect('/dosen/quiz/'. $request->quiz_id)->with(['create_done' => 'Question has been created']);
        // ->withInput(['tab'=>'nav-question'])
    }

    public function edit($idquiz, $idquestions)
    {
        $quiz = Quiz::findorfail($idquiz);
        if ($quiz->finalize_status=='1') {
            // return redirect('/dosen/quiz/'. $idquiz.'/questions')->with(['error' => 'Tidak dapat edit soal! Kuis sudah difinalisasi']);
            return redirect('/dosen/quiz/'. $idquiz)->with(['cannot_edit' => 'Cannot edit question! Quiz has been finalized']);
        }
        $questions = Questions::findorfail($idquestions);
        return view('dosen.editquestion', compact('quiz', 'questions'));
    }

    public function update(Request $request, $questions)
    {
        $question = Questions::findorfail($questions);
        $question->update($request->all());
        // return redirect('/dosen/quiz/'. $question->quiz_id.'/questions')->with(['update_done' => 'Question has been updated']);
        return redirect('/dosen/quiz/'. $question->quiz_id)->with(['update_done' => 'Question has been updated']);
    }

    public function destroy($questions)
    {
        $soal = Questions::findorfail($questions);
        $soal->delete();
        // return redirect('/dosen/quiz/'.$soal->quiz_id.'/questions');
        return redirect('/dosen/quiz/'.$soal->quiz_id);
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
}
