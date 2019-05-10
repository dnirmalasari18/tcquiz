<?php
namespace App\Http\Controllers;
use App\Kehadiran;
use App\Quiz;
use App\User;
use App\QuizPacket;
use App\MahasiswaPacket;
use Auth;
use DB;
use Illuminate\Http\Request;
Use App\Questions;
Use Response;
Use DateTime;
class MahasiswaController extends Controller
{
    public function myClass()
    {
        $classes = Kehadiran::where('idUser', Auth::user()->username)->get();
        return view('mahasiswa.classes', compact('classes'));
    }
    public function myQuizzes()
    {
        $user_id = Auth::user()->id;
        $classes = Kehadiran::where('idUser', Auth::user()->username)->get();
        $quiz = array();
        $i = 0;
        if(count($classes)){
            foreach($classes as $c){
                foreach($c->agenda->pertemuan as $p){
                    if(count($p->quiz)){
                        foreach($p->quiz as $q){
                            $quiz[$i] = $q;
                            $i = $i+1;
                        }
                    }
                }
            }
        }
        return view('mahasiswa.quizzes', compact('quiz', 'user_id'));
    }
    public function dashboard()
    {
        $user_id = Auth::user()->id;
        $classes = Kehadiran::where('idUser', Auth::user()->username)->get();
        $quiz = array();
        $i = 0;
        if(count($classes)){
            foreach($classes as $c){
                foreach($c->agenda->pertemuan as $p){
                    if(count($p->quiz)){
                        foreach($p->quiz as $q){
                            $quiz[$i] = $q;
                            $i = $i+1;
                        }
                    }
                }
            }
        }
        return view('mahasiswa.dashboard', compact('quiz', 'user_id'));
    }
    public function myQuestions($idquiz)
    {
        $user = User::where('username', Auth::user()->username)->first();
        $data['kuis'] = Quiz::findorfail($idquiz);
        $data['paket'] = DB::table('quizzes')
            ->join('quiz_packets', 'quizzes.id', '=', 'quiz_packets.quiz_id')
            ->join('mahasiswa_packets', 'quiz_packets.id', '=', 'mahasiswa_packets.quizpacket_id')
            ->select('mahasiswa_packets.id','question_id_list', 'packet_answer_list', 'quizpacket_id', 'user_id',
                'question_flag_list', 'user_answer_list', 'quiz_score', 'end_time')
            ->where([
                ['mahasiswa_packets.user_id', '=', $user->id],
                ['quizzes.id', '=', $idquiz],
            ])
            ->first();
        $data['test'] = Questions::where('quiz_id', $idquiz)->get();
        $data['durasi']=Quiz::where('id', $idquiz)->first()->durasi;
        if($data['paket']){
            $mp_id = $data['paket']->id;
            $mp = MahasiswaPacket::findorfail($mp_id);
            if ($mp->status_ambil) {
                return redirect('/mahasiswa/quiz/' .$idquiz. '/result');
            }
        }
        else{
            return abort(404);
        }
        
        $q = $data['kuis'];
        
        $classes = Kehadiran::where('idUser', Auth::user()->username)->get();
        
        if(strtotime(date("Y-m-d", strtotime('7 hour'))) == strtotime($q->pertemuanke->tglPertemuan)){
            if(strtotime(date("H:i:s", strtotime('7 hour'))) < strtotime($q->pertemuanke->waktuMulai)){
                return abort(404);
            }
            elseif(strtotime(date("H:i:s", strtotime('7 hour'))) > strtotime($q->pertemuanke->waktuSelesai)){
                if($mp->end_time){
                    return redirect('/mahasiswa/quiz/' .$idquiz. '/result');
                }
                return abort(404);
            }
            else{
                if(!$mp->end_time){
                    $now = date("Y-m-d H:i:s", strtotime('7 hour'));
                    $mp->end_time = $now;
                    $mp->save();
                }
                $dead = date("Y-m-d H:i:s", strtotime($mp->end_time) + 60*$q->durasi);
                $now = date("Y-m-d H:i:s", strtotime('7 hour'));
                if (strtotime(date("H:i:s",strtotime($mp->end_time) + 60*$q->durasi)) > strtotime($q->pertemuanke->waktuSelesai)) {
                    $selisih = strtotime(date("H:i:s",strtotime($mp->end_time) + 60*$q->durasi)) - strtotime($q->pertemuanke->waktuSelesai);
                    $dead = date("Y-m-d H:i:s",strtotime($mp->end_time) + 60*$q->durasi - $selisih);
                }
                if (strtotime($now) > strtotime($dead)) {
                    return redirect('/mahasiswa/quiz/' .$idquiz. '/result');
                }
                return view('mahasiswa.test', $data);
            }
        }
        else{
            if(strtotime(date("Y-m-d", strtotime('7 hour'))) > strtotime($q->pertemuanke->tglPertemuan)){
                if ($mp->status_ambil) {
                    return redirect('/mahasiswa/quiz/' .$idquiz. '/result');
                }
            }
            
            return abort(404);
        }
        
    }
    public function submitQuizAjax(Request $request)
    {
        $mp = MahasiswaPacket::findorfail($request->mp_id);
        $arr = array_map('intval', explode(",", $mp->user_answer_list));
        $fl = array_map('intval', explode(",", $mp->question_flag_list));
        for ($i=1; $i <= $request->jumlah ; $i++) {
            if (isset($request->ans[$i])) {
                $arr[$i-1] = $request->ans[$i];
            }
            else{
                $arr[$i-1] = 0;
            }
            if (isset($request->fl[$i])) {
                $fl[$i-1] = $request->fl[$i];
            }
            else{
                $fl[$i-1] = 0;
            }
            
        }
        $arr = implode(', ', $arr);
        $fl = implode(', ', $fl);
        $mp->update(array('user_answer_list' => $arr, 'question_flag_list' => $fl));
        $user = User::where('username', Auth::user()->username)->first();
        $quiz = Quiz::findorfail($request->quiz_id);
        $qp = QuizPacket::findorfail($mp->paketkuis->id);
        $qp_key = array_map('intval', explode(",", $qp->packet_answer_list));
        $mp_key = array_map('intval', explode(",", $mp->user_answer_list));
        $seq = array_map('intval', explode(",", $qp->question_id_list));
        $quiz_score = 0;
        $total_score = 0;
        for ($i=0; $i < count($qp_key)-1; $i++) { 
            $score = Questions::findorfail($seq[$i])->question_score;
            $total_score = $total_score + $score;
            if ($qp_key[$i] == $mp_key[$i]) {
                $score = Questions::findorfail($seq[$i])->question_score;
                $quiz_score = $quiz_score + $score;
            }
        }
        $quiz_score = $quiz_score / $total_score * 100;
        $mp->quiz_score = round($quiz_score);
        $mp->save();
        return Response::json($mp);
    }
    public function submitQuiz(Request $request)
    {
        $mp = MahasiswaPacket::findorfail($request->mp_id);
        $arr = array_map('intval', explode(",", $mp->user_answer_list));
        $fl = array_map('intval', explode(",", $mp->question_flag_list));
        for ($i=1; $i <= $request->jumlah ; $i++) {

            if (isset($request->ans[$i])) {
                $arr[$i-1] = $request->ans[$i];
            }
            else{
                $arr[$i-1] = 0;
            }
            if (isset($request->fl[$i])) {
                $fl[$i-1] = $request->fl[$i];
            }
            else{
                $fl[$i-1] = 0;
            }
            
        }
        $arr = implode(', ', $arr);
        $fl = implode(', ', $fl);
        $mp->update(array('user_answer_list' => $arr, 'question_flag_list' => $fl));
        return redirect('/mahasiswa/quiz/' .$request->quiz_id. '/result');
    }
    public function quizResult($idquiz){
        $user = User::where('username', Auth::user()->username)->first();
        $quiz = Quiz::findorfail($idquiz);
        $paket = DB::table('quizzes')
            ->join('quiz_packets', 'quizzes.id', '=', 'quiz_packets.quiz_id')
            ->join('mahasiswa_packets', 'quiz_packets.id', '=', 'mahasiswa_packets.quizpacket_id')
            ->select('mahasiswa_packets.id', 'quizpacket_id')
            ->where([
                ['mahasiswa_packets.user_id', '=', $user->id],
                ['quizzes.id', '=', $idquiz],
            ])
            ->first();
        $qp = QuizPacket::findorfail($paket->quizpacket_id);
        $mp = MahasiswaPacket::findorfail($paket->id);
        if($mp->status_ambil){
            $data['mp'] = $mp;
            $data['q'] = $quiz;
            return view('mahasiswa.result', $data);
        }
        $qp_key = array_map('intval', explode(",", $qp->packet_answer_list));
        $mp_key = array_map('intval', explode(",", $mp->user_answer_list));
        $seq = array_map('intval', explode(",", $qp->question_id_list));
        $quiz_score = 0;
        $total_score = 0;
        for ($i=0; $i < count($qp_key)-1; $i++) { 
            $score = Questions::findorfail($seq[$i])->question_score;
            $total_score = $total_score + $score;
            if ($qp_key[$i] == $mp_key[$i]) {
                $score = Questions::findorfail($seq[$i])->question_score;
                $quiz_score = $quiz_score + $score;
            }
        }
        $quiz_score = $quiz_score / $total_score * 100;
        $mp->quiz_score = round($quiz_score);
        
        $mp->status_ambil = 1;
        $mp->save();
        
        $data['mp'] = $mp;
        $data['q'] = $quiz;
        return view('mahasiswa.result', $data);
    }
}