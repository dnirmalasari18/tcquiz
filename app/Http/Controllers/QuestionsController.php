<?php

namespace App\Http\Controllers;

use App\Questions;
use App\Quiz;
use Illuminate\Http\Request;

class QuestionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Questions::create($request->all());
        return redirect()->back()->with(['create_done' => 'Data berhasil ditambahkan']);
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
    public function edit(Questions $questions)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Questions  $questions
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Questions $questions)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Questions  $questions
     * @return \Illuminate\Http\Response
     */
    public function destroy(Questions $questions)
    {
        //
    }

    public function questionslist($idquiz)
    {
        $quiz = Quiz::findorfail($idquiz);
        $questions = Questions::where('quiz_id', $idquiz)->get();  
        return view('dosen.listofquestions', compact('quiz', 'questions'));
    }

    public function uploadImage(Request $request) {
        $path = asset('storage') . '/' . $request->file('file')->store('public/gambar-soal');
        $path = str_replace('/public', "", $path);
        return json_encode(['location' => $path]); 
    }
}
