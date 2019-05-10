<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Agenda;
use App\AbsenKuliah;
use App\Quiz;
use App\Questions;
use Carbon\Carbon;
use Auth;

class DosenController extends Controller
{
	public function index()
    {
        $quiz = Quiz::whereHas('pertemuanke', function($q) {
                $q->whereBetween('tglPertemuan', [
                Carbon::parse('yesterday')->startOfDay(),
                Carbon::parse('next friday')->endOfDay(),]);})->with('pertemuanke')->get();

        return view('dosen.dashboard', compact('quiz'));
    }

    public function listOfUsers()
    {
        $users = User::all();
        return view('dosen.listofusers',compact('users'));
    }

    public function listOfAgenda()
    {
        $agenda = Agenda::all();
        return view('dosen.listofagendas',compact('agenda'));
    }

    public function getAgendaJadwals($agenda_id) {
        $jadwals = Agenda::find($agenda_id);
        return response()->json($jadwals->pertemuan);
    }

    public function getAgendaWaktu($jadwal_id) {
        $waktu = AbsenKuliah::find($jadwal_id);
        return response()->json($waktu);
    }
}
