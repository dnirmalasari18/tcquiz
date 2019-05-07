<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class DosenController extends Controller
{
    public function listOfUsers()
    {
        $users = User::all();
        return view('dosen.listofusers',compact('users'));
    }
}
