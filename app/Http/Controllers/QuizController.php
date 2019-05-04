<?php

namespace App\Http\Controllers;

use App\Quiz;
use App\AbsenKuliah;
use App\Agenda;
use App\Kehadiran;
use App\Questions;
use App\QuizPacket;
use App\MahasiswaPacket;
use Auth;

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
        $quiz = Quiz::where('dosen_id', Auth::user()->id)->get();
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
        $id_agenda = AbsenKuliah::find($quiz->absenkuliah_id)->fk_idAgenda;
        $jadwals = AbsenKuliah::where('fk_idAgenda', $id_agenda)->get();        
        return view('dosen.editquiz',compact('quiz', 'agenda', 'jadwals'));
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

    public function participantsList($quiz)
    {
        $kuis = Quiz::findorfail($quiz);
        $agenda = AbsenKuliah::find($kuis->absenkuliah_id)->fk_idAgenda;
        $participant = Kehadiran::where('idAgenda', $agenda)->get();
        $participants = MahasiswaPacket::whereHas('paketkuis', function($q) use ($quiz) {
 $q->where('quiz_id', $quiz);})->with('paketkuis')->get();
        return view('dosen.listofparticipants',compact('kuis', 'participants', 'participant'));
    }

    public function generatePacket($quiz1)
    {
        $quiz = Quiz::findorfail($quiz1);
        $agenda = AbsenKuliah::find($quiz->absenkuliah_id)->fk_idAgenda;
        $participants = Kehadiran::where('idAgenda', $agenda)->get();
        $questions = Questions::where('quiz_id', $quiz1)->get();

        if ($questions->count()==0) {
            return redirect()->back()->with(['empty_question' => 'Data pertanyaan pada kuis kosong! Tambahkan pertanyaan terlebih dahulu']);
        }

        foreach ($participants as $participant) { 
            //randomize question orders
            $randomized_questions = $questions->shuffle();
            
            $questions_ids = '';
            $questions_right_ans = '';
            $questions_flag = '';
            $user_ans_list = "";

            foreach ($randomized_questions as $rq) {
                $questions_ids .= $rq->id . ',';
                $questions_right_ans .= $rq->correct_answer . ',';
                $questions_flag .= '0,';
                $user_ans_list .= ",";
            }
            $q = QuizPacket::create([
                'quiz_id' => $quiz1,
                'question_id_list' => $questions_ids,
                'packet_answer_list' => $questions_right_ans,
            ]);

            MahasiswaPacket::create([
                'user_id' => $participant->user->id, 
                'quizpacket_id' => $q->id, 
                'question_flag_list' => $questions_flag, 
                'user_answer_list' => $user_ans_list
            ]);
        }
        return redirect()->back();
    }
}