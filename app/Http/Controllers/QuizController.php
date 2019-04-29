<?php

namespace App\Http\Controllers;

use App\Quiz;
use App\AbsenKuliah;
use App\Agenda;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $quiz = Quiz::all();
        return view ('dosen.listofquizzes', compact('quiz'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $agenda = Agenda::orderBy('namaAgenda','asc')->get();
        $absenkuliah = AbsenKuliah::get();
        return view ('dosen.createquiz', compact('absenkuliah', 'agenda'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Quiz::create($request->all());      
        return redirect('/dosen/quiz');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Quiz  $quiz
     * @return \Illuminate\Http\Response
     */
    public function show(Quiz $quiz)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Quiz  $quiz
     * @return \Illuminate\Http\Response
     */
    public function edit($quiz)
    {
        $quiz = Quiz::findorfail($quiz);
        $agenda = Agenda::orderBy('namaAgenda','asc')->get();
        $absenkuliah = AbsenKuliah::pluck('pertemuanKe','id');
        $id_agenda = AbsenKuliah::find($quiz->absenkuliah_id)->fk_idAgenda;
        $jadwals = AbsenKuliah::where('fk_idAgenda', $id_agenda)->get();        
        return view('dosen.editquiz',compact('quiz', 'agenda', 'absenkuliah', 'jadwals'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Quiz  $quiz
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $quiz)
    {
        $kuis = Quiz::findorfail($quiz);
        $kuis->update($request->all());
        return redirect()->back()->with(['update_done' => 'Data berhasil diupdate', 'kuis' => $kuis]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Quiz  $quiz
     * @return \Illuminate\Http\Response
     */
    public function destroy($quiz)
    {
        $kuis = Quiz::findorfail($quiz);
        $kuis->delete();
        return redirect('/dosen/quiz');
    }

    public function uploadImage(Request $request) {
        $path = asset('storage') . '/' . $request->file('file')->store('public/gambar-terms');
        $path = str_replace('/public', "", $path);
        return json_encode(['location' => $path]); 
    }

    public function questionslist($quiz)
    {
        return view('dosen.listofquestions');
    }
}
