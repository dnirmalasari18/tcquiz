<?php

namespace App\Http\Controllers;

use App\Questions;
use App\Quiz;
use Illuminate\Http\Request;
use Validator;
use App\Http\Requests\CreateQuestion;

class QuestionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($idquiz)
    {
        $quiz = Quiz::findorfail($idquiz);
        if ($quiz->finalize_status=='1') {
            return redirect('/dosen/quiz/'. $idquiz.'/questions')->with(['error' => 'Tidak dapat menambah soal! Kuis sudah difinalisasi']);
        }
        return view('dosen.createquestion', compact('quiz'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateQuestion $request)
    {

        $validated = $request->validated();
        Questions::create($request->all());
        return redirect('/dosen/quiz/'. $request->quiz_id.'/questions')->with(['success' => 'Data berhasil ditambahkan']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Questions  $questions
     * @return \Illuminate\Http\Response
     */
    public function show(Questions $questions)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Questions  $questions
     * @return \Illuminate\Http\Response
     */
    public function edit($idquiz, $idquestions)
    {
        $quiz = Quiz::findorfail($idquiz);
        $questions = Questions::findorfail($idquestions);
        return view('dosen.editquestion', compact('quiz', 'questions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Questions  $questions
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $questions)
    {
        $question = Questions::findorfail($questions);
        $question->update($request->all());
        return redirect()->back()->with(['success' => 'Data berhasil diupdate', 'question' => $question]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Questions  $questions
     * @return \Illuminate\Http\Response
     */
    public function destroy($questions)
    {
        $soal = Questions::findorfail($questions);
        $soal->delete();
        return redirect('/dosen/quiz/'.$soal->quiz_id.'/questions')->with(['error' => 'Data berhasil dihapus']);;
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
