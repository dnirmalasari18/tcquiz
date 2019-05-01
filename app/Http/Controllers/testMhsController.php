<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\test;

class testMhsController extends Controller
{
    public function index(){

    }
    public function store(){
        $jawaban= new User();
            $jawaban->jawaban_soal= $request['jawaban_soal'];
        
        $jawaban->save();

            );
        return redirect('/mahasiswa/test');
    }
}
