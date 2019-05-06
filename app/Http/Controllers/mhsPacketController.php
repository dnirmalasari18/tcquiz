<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MahasiswaPacket;
use DB;

class mhsPacketController extends Controller
{
    public function index(){
        $mhsPack = DB::table('MahasiswaPacket')->paginate(1);
        return view('mahasiswa.test',compact('mhsPack'));
    }
    public function store(){

        $answers= new Test();
        $answers->user_answer_list= $request['user_answer_list'];
        
        $answers->save();

            
        return redirect('/mahasiswa/test');
    
    }
    public function show($id){
        return view('mahasiswa.test',['mhsPack' => MahasiswaPacket::findOrFail($id)]);
    }
}
