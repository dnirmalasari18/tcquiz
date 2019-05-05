<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\test;
use App\MahasiswaPacket;
use DB;

class testMhsController extends Controller
{
    public function index(){
        $mhsPack = DB::table('MahasiswaPacket')->paginate(1);
        return view('mahasiswa.test',compact('mhsPack'));
    }
    public function store(){
    

        $jawaban= new Test();
        $jawaban->jawaban_soal= $request['jawaban_soal'];
        
        $jawaban->save();

            
        return redirect('/mahasiswa/test');
    }
}
