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
        $id_agenda = AbsenKuliah::find($kuis->absenkuliah_id)->fk_idAgenda;
        $participant = Kehadiran::where('idAgenda', $id_agenda)->get();
        $participants = MahasiswaPacket::whereHas('paketkuis', function($q) use ($quiz) {
                        $q->where('quiz_id', $quiz);})->with('paketkuis')->get();

        $agenda = Agenda::orderBy('namaAgenda','asc')->get();
        $jadwals = AbsenKuliah::where('fk_idAgenda', $id_agenda)->get();

        $questions = Questions::where('quiz_id', $quiz)->get();

        $average = $participants->avg('quiz_score');
        $min_score = $participants->min('quiz_score');
        $max_score = $participants->max('quiz_score');

        $participant_details = [];
        $soal_details = [];

        foreach ($participants as $p) {
            $user_ans = explode(',', $p->user_answer_list);
            array_pop($user_ans);

            
            $question_ids = $p->paketkuis->question_id_list;

            $questions_ids_arr = explode(',', $question_ids);

            $questions_arr = [];

            array_pop($questions_ids_arr);
            foreach ($questions_ids_arr as $q_id) {
                $q = Questions::find($q_id);
                array_push($questions_arr, $q);

                $soal_details[(string)$q_id] = ['id' =>$q_id, 'wrong' => 0, 'right' => 0];
            }

            $ans_idx = 0;
            $right = 0;
            $wrong = 0;
            foreach ($user_ans as $ans) {

                $ans = trim($ans);

                if ($ans == $questions_arr[$ans_idx]['correct_answer']) {

                    $soal_details[$questions_arr[$ans_idx]['id']]['right']++;
                    $right++;                    
                }
                else {
                    $soal_details[$questions_arr[$ans_idx]['id']]['wrong']++;
                    $wrong++;                    
                }

                $ans_idx++;
            }

            $participant_details [] = ['participant_id' => $p->id, 'wrong' => $wrong, 'right' => $right, 'correct_ans' =>implode(",",$questions_arr)];
        }

        return $soal_details;

    //    return view('dosen.quizdetail',compact('kuis', 'participants', 'participant', 'agenda', 'jadwals', 'questions'));
    }


}