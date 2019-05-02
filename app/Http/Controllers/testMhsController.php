<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\test;

class testMhsController extends Controller
{
    public function index(){
        $test = Test::all();
        return view('mahasiswa.test',compact('test'));
    }
    public function store(){
        $jawaban= new Test();
        $jawaban->jawaban_soal= $request['jawaban_soal'];
        
        $jawaban->save();

            );
        return redirect('/mahasiswa/test');
    }
}
