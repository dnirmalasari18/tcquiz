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
    public function index()
    {
        $quiz = Quiz::where('dosen_id', Auth::user()->id)->get();
        return view ('dosen.listofquizzes', compact('quiz'));
    }

    public function create()
    {
        $agenda = Agenda::orderBy('namaAgenda','asc')->get();
        $absenkuliah = AbsenKuliah::get();
        return view('dosen.createquiz', compact('absenkuliah', 'agenda'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kuis' => 'required',
            'durasi' => 'required',
            'absenkuliah_id' => 'required',
        ]);
        Quiz::create($request->all());
        return redirect('/dosen/quiz')->with(['create_done' => 'Quiz has been created']);
    }

    public function edit($quiz)
    {
        $quiz = Quiz::findorfail($quiz);
        $agenda = Agenda::orderBy('namaAgenda','asc')->get();
        $id_agenda = AbsenKuliah::find($quiz->absenkuliah_id)->fk_idAgenda;
        $jadwals = AbsenKuliah::where('fk_idAgenda', $id_agenda)->get();
        return view('dosen.editquiz', compact('quiz', 'agenda', 'jadwals'));
    }

    public function update(Request $request, $quiz)
    {
        $request->validate([
            'nama_kuis' => 'required',
            'durasi' => 'required',
            'absenkuliah_id' => 'required',
        ]);
        $kuis = Quiz::findorfail($quiz);
        $kuis->update($request->all());
        return redirect()->back()->with(['updatequiz_done' => 'Quiz has been updated']);
    }

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
            return redirect()->back()->with(['no_question' => 'There is no question! Add question first']);
        }

        if ($quiz->finalize_status=='1') {
            return redirect('/dosen/quiz/'. $quiz1)->with(['finalized' => 'Quiz has been finalized']);
        }

        foreach ($participants as $participant) {
            $randomized_questions = $questions->shuffle();

            $questions_ids = '';
            $questions_right_ans = '';
            $questions_flag = '';
            $user_ans_list = '';

            foreach ($randomized_questions as $rq) {
                $questions_ids .= $rq->id . ',';
                $questions_right_ans .= $rq->correct_answer . ',';
                $questions_flag .= '0,';
                $user_ans_list .= ',';
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
        $quiz->finalize_status = '1';
        $quiz->update();
        return redirect()->back();
    }

    public function show($quiz)
    {
        $kuis = Quiz::findorfail($quiz);
        if ($kuis->dosen_id != Auth::user()->id) {
            return abort(401);
        }
        $id_agenda = AbsenKuliah::find($kuis->absenkuliah_id)->fk_idAgenda;
        $participant = Kehadiran::where('idAgenda', $id_agenda)->get();
        $participant1 = MahasiswaPacket::whereHas('paketkuis', function($q) use ($quiz) {
                        $q->where('quiz_id', $quiz);})->with('paketkuis');

        $agenda = Agenda::orderBy('namaAgenda','asc')->get();
        $jadwals = AbsenKuliah::where('fk_idAgenda', $id_agenda)->get();

        $questions = Questions::where('quiz_id', $quiz)->get();
        $total_score = $questions->sum('question_score');
        $average = $participant1->avg('quiz_score');
        $min_score = $participant1->min('quiz_score');
        $max_score = $participant1->max('quiz_score');

        $participants = $participant1->get();
        $results = $participant1->where('quiz_score','!=',NULL)->get();
                
        $studentCount = array_fill(0, 101, 0);        
        foreach($results as $result){
            $studentCount[$result->quiz_score]++;
        }

        $array = [];
        for($i = 0; $i <= 100; $i++){
            array_push($array, [
                'score' => $i,
                'studentAmount' => $studentCount[$i]
            ]);
        }
        $array = json_encode($array);

        $allquiz = Quiz::where('id', '!=',$quiz)->get();

        $participant_details = [];
        $soal_details = [];

        return view('dosen.quizdetail',compact('kuis', 'participants', 'participant', 'agenda', 'jadwals', 'questions', 'allquiz', 'array', 'average', 'min_score', 'max_score', 'total_score'));
    }    
}