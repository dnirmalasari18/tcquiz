@extends('layouts.mahasiswa')

@section('dashboard', 'active')

@section('title')
<h1>Dashboard</h1>
@endsection

@section('breadcrumbs')
<li class="active">Dashboard</li>
@endsection

<?php
    $count = 0;
?>

@section('content')

@if(count($quiz))
    @foreach($quiz as $q)
        @if(strtotime(date("Y-m-d", strtotime('7 hour'))) == strtotime($q->pertemuanke->tglPertemuan))
            @if(strtotime(date("H:i:s", strtotime('7 hour'))) <= strtotime($q->pertemuanke->waktuSelesai))
                @if(count($q->pakets))
                    @foreach($q->pakets as $qp)
                        @if($qp->user->user_id == $user_id)
                            @if(!$qp->user->status_ambil)
                                <?php
                                    $count += 1;
                                ?>
                            @endif
                        @endif
                    @endforeach
                @endif
            @endif
        @endif
    @endforeach
@endif    

@if($count>0)
    <div class="col-sm-12">
        <div class="alert  alert-success alert-dismissible fade show" role="alert">
          <span class="badge badge-pill badge-success">Reminder</span> You have upcoming quizzes!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>
@else
    <div class="col-sm-12">
        <div class="alert  alert-danger alert-dismissible fade show" role="alert">
          <span class="badge badge-pill badge-danger">Note</span> You have no upcoming quizzes!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>
@endif

<style type="text/css">
	.nuzha{
		height: 110px;
		font-size: 40px; 
        background-color: #3b5998;
		background-position-x: 0%;
		background-position-y: 0%;
		background-repeat: repeat;
		background-attachment: scroll;
		background-image: none;
		background-size: auto;
		background-origin: padding-box;
		background-clip: border-box;
        line-height: 110px;
        color: white;
	}
</style>

@if($count>0)
    @if(count($quiz))
        @foreach($quiz as $q)
            @if(strtotime(date("Y-m-d", strtotime('7 hour'))) == strtotime($q->pertemuanke->tglPertemuan))
                @if(strtotime(date("H:i:s", strtotime('7 hour'))) <= strtotime($q->pertemuanke->waktuSelesai))
                    @if(count($q->pakets))
                        @foreach($q->pakets as $qp)
                            @if($qp->user->user_id == $user_id)
                                @if(!$qp->user->status_ambil)
                                    <div class="col-lg-3 col-md-6">
                                        <div class="social-box">
                                        	<div class="nuzha">
                                                {{$q->pertemuanke->agenda->singkatAgenda}}
                                    	    </div>
                                            <ul>
                                                <li>
                                                    <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#quizDetail{{$q->id}}">Detail
                                                    </button>
                                                </li>
                                                @if(strtotime(date("H:i:s", strtotime('7 hour'))) < strtotime($q->pertemuanke->waktuMulai))
                                                    <li>
                                                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#takeQuiz{{$q->id}}" disabled style="cursor: not-allowed;">
                                                            Take Quiz
                                                        </button>
                                                    </li>
                                                @else
                                                    <li>
                                                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#takeQuiz{{$q->id}}">
                                                            Take Quiz
                                                        </button>
                                                    </li>
                                                @endif
                                            </ul>
                                        </div>
                                    </div>
                                @endif
                            @endif
                        @endforeach
                    @endif
                @endif
            @endif
        @endforeach
    @endif    
@endif

<!-- .animated -->
@if($count>0)
    @if(count($quiz))
        @foreach($quiz as $q)
            @if(strtotime(date("Y-m-d", strtotime('7 hour'))) == strtotime($q->pertemuanke->tglPertemuan))
                @if(strtotime(date("H:i:s", strtotime('7 hour'))) <= strtotime($q->pertemuanke->waktuSelesai))
                    @if(count($q->pakets))
                        @foreach($q->pakets as $qp)
                            @if($qp->user->user_id == $user_id)
                                @if(!$qp->user->status_ambil)
                                    <div class="modal fade" id="quizDetail{{$q->id}}" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="mediumModalLabel">Quiz Detail</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <table class="table">
                                                        <tbody >
                                                            <tr style="border-top-style: hidden;">
                                                                <td>Name</td>
                                                                <td>: {{$q->nama_kuis}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Class</td>
                                                                <td>: {{$q->pertemuanke->agenda->namaAgenda}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Date</td>
                                                                <td>: {{$q->pertemuanke->tglPertemuan}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Begin Time</td>
                                                                <td>: {{$q->pertemuanke->waktuMulai}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>End Time</td>
                                                                <td>: {{$q->pertemuanke->waktuSelesai}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Duration</td>
                                                                <td>: {{$q->durasi}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Status</td>
                                                                @if(strtotime(date("H:i:s", strtotime('7 hour'))) < strtotime($q->pertemuanke->waktuMulai))
                                                                    <td>: <span class="badge badge-pill badge-dark">Inactive</span></td>
                                                                @else
                                                                    <td>: <span class="badge badge-pill badge-success">Active</span></td>
                                                                @endif
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endif
                        @endforeach
                    @endif
                @endif
            @endif
        @endforeach
    @endif    
@endif

<style type="text/css">
    .nuzha3{
        max-width: 500px;
    }
</style>

@if($count>0)
    @if(count($quiz))
        @foreach($quiz as $q)
            @if(strtotime(date("Y-m-d", strtotime('7 hour'))) == strtotime($q->pertemuanke->tglPertemuan))
                @if(strtotime(date("H:i:s", strtotime('7 hour'))) <= strtotime($q->pertemuanke->waktuSelesai))
                    @if(count($q->pakets))
                        @foreach($q->pakets as $qp)
                            @if($qp->user->user_id == $user_id)
                                @if(!$qp->user->status_ambil)
                                    <div class="modal fade" id="takeQuiz{{$q->id}}" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg nuzha3" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="mediumModalLabel">Quiz Confirmation</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <style type="text/css">
                                                        .nuzha4{
                                                            margin-bottom: 20px;
                                                        }
                                                        .nuzha2{
                                                            width: 75px;
                                                        }
                                                    </style>
                                                    <div class="nuzha4" align="center">
                                                        Are you sure you want to take this quiz?
                                                    </div>
                                                    <div align="center">
                                                        <button type="button" class="btn btn-danger btn-sm nuzha2" data-dismiss="modal">Cancel</button>
                                                        <a href="/mahasiswa/quiz/{{$q->id}}/questions">
                                                            <button type="button" class="btn btn-success btn-sm nuzha2">Continue</button>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endif
                        @endforeach
                    @endif
                @endif
            @endif
        @endforeach
    @endif    
@endif

@endsection