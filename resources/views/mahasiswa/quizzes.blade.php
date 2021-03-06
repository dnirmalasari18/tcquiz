@extends('layouts.mahasiswa')

@section('quiz', 'active')

@section('breadcrumbs')
<li><a href="/">Dashboard</a></li>
<li class="active">Quizzes</li>
@endsection

@section('content')

<div class="animated fadeIn">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-white">
                    <div class="row">
                        <div class="col">
                            <h3 class="m-0">Quizzes</h3>
                        </div>
                        <div class="col ">
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table id="bootstrap-data-table" class="table table-bordered">
                        <thead class="thead-light" align="center">
                            <tr>
                                <th>Name</th>
                                <th>Class</th>
                                <th>Date</th>
                                <th>Start</th>
                                <th>End</th>
                                <th>Duration</th>
                                <th>Status</th>
                                <th>Menu</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($quiz))
                                @foreach($quiz as $q)
                                    <tr >
                                        <td>{{$q->nama_kuis}}</td>
                                        <td>{{$q->pertemuanke->agenda->namaAgenda}}</td>
                                        <td align="center">{{ date('d M y', strtotime($q->pertemuanke->tglPertemuan)) }}</td>
                                        <td align="center">{{$q->pertemuanke->waktuMulai}}</td>
                                        <td align="center">{{$q->pertemuanke->waktuSelesai}}</td>
                                        <td align="center">{{$q->durasi}} minute(s)</td>

                                        @if(strtotime(date("Y-m-d", strtotime('7 hour'))) > strtotime($q->pertemuanke->tglPertemuan))
                                            <td align="center"><span class="badge badge-pill badge-danger">Closed</span></td>
                                            <td align="center">
                                                <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#resultModal{{$q->id}}">See Result
                                                </button>
                                            </td>
                                        @elseif(strtotime(date("Y-m-d", strtotime('7 hour'))) < strtotime($q->pertemuanke->tglPertemuan))
                                            <td align="center"><span class="badge badge-pill badge-dark">Inactive</span></td>
                                            <td align="center">
                                                <button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#takeQuiz{{$q->id}}" disabled style="cursor: not-allowed;">Take Quiz
                                                </button>
                                            </td>
                                        @else
                                            @if(strtotime(date("H:i:s", strtotime('7 hour'))) < strtotime($q->pertemuanke->waktuMulai))
                                                <td align="center"><span class="badge badge-pill badge-dark">Inactive</span></td>
                                                <td align="center">
                                                    <button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#takeQuiz{{$q->id}}" disabled style="cursor: not-allowed;">Take Quiz
                                                    </button>
                                                </td>
                                            @elseif(strtotime(date("H:i:s", strtotime('7 hour'))) > strtotime($q->pertemuanke->waktuSelesai))
                                                <td align="center"><span class="badge badge-pill badge-danger">Closed</span></td>
                                                <td align="center">
                                                    <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#resultModal{{$q->id}}">See Result
                                                    </button>
                                                </td>
                                            @else
                                                @if(count($q->pakets))
                                                    @foreach($q->pakets as $qp)
                                                        @if($qp->user['user_id'] == $user_id)
                                                            @if($qp->user->status_ambil)
                                                                <td align="center"><span class="badge badge-pill badge-danger">Closed</span></td>
                                                                <td align="center">
                                                                    <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#resultModal{{$q->id}}">See Result
                                                                    </button>
                                                                </td>
                                                                <?php
                                                                    break;
                                                                ?>
                                                            @else
                                                                <td align="center"><span class="badge badge-pill badge-success">Active</span></td>
                                                                <td align="center">
                                                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#takeQuiz{{$q->id}}">Take Quiz
                                                                    </button>
                                                                </td>
                                                            @endif
                                                        @endif
                                                    @endforeach
                                                @endif
                                            @endif
                                        @endif
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<style type="text/css">
    .nuzha3{
        max-width: 500px;
    }
</style>

@if(count($quiz))
    @foreach($quiz as $q)
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
                            .nuzha{
                                margin-bottom: 20px;
                            }
                            .nuzha2{
                                width: 75px;
                            }
                        </style>
                        <div class="nuzha" align="center">
                            <strong>Terms & Conditions</strong>
                            {!! $q->terms_conditions !!}
                        </div>
                        <div class="nuzha" align="center">
                            Are you sure you want to take this quiz?
                        </div>
                        <div align="center">
                            <button type="button" class="btn btn-danger btn-sm nuzha2" data-dismiss="modal">Cancel</button>
                            <a href="/mahasiswa/quiz/{{$q->id}}/questions"">
                                <button type="button" class="btn btn-success btn-sm nuzha2">Continue</button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endif

@if(count($quiz))
    @foreach($quiz as $q)
        <div class="modal fade" id="resultModal{{$q->id}}" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="mediumModalLabel">Result Detail</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <table class="table">
                            <tbody>
                                @if(count($q->pakets))
                                    @foreach($q->pakets as $qp)
                                        @if($qp->user['user_id'] == $user_id)
                                            @if($qp->user->end_time)
                                                <tr style="border-top-style: hidden;">
                                                    <td><strong>Start Time</strong></td>
                                                    <td>: {{date("H:i:s",strtotime($qp->user->end_time))}}</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>End Time</strong></td>
                                                    <?php
                                                        $update = date("H:i:s",strtotime($qp->user->updated_at.'+7 hour'));
                                                        $selesai = $q->pertemuanke->waktuSelesai;
                                                        $real = date("H:i:s", strtotime($qp->user->end_time) + 60*$q->durasi);
                                                    ?>
                                                    @if(strtotime($update) > strtotime($real))
                                                        @if(strtotime($real) > strtotime($selesai))
                                                            <td>: {{$selesai}}</td>
                                                        @else
                                                            <td>: {{$real}}</td>
                                                        @endif
                                                    @else
                                                        @if(strtotime($update) > strtotime($selesai))
                                                            <td>: {{$selesai}}</td>
                                                        @else
                                                            <td>: {{$update}}</td>
                                                        @endif
                                                    @endif
                                                </tr>
                                                <tr>
                                                    <td><strong>Score</strong></td>
                                                    <td>: {{$qp->user->quiz_score}}%</td>
                                                </tr>
                                                <?php
                                                    break;
                                                ?>
                                            @else
                                                <tr style="border-top-style: hidden;">
                                                    <td>Start Time</td>
                                                    <td>: -</td>
                                                </tr>
                                                <tr>
                                                    <td>End Time</td>
                                                    <td>: -</td>
                                                </tr>
                                                <tr>
                                                    <td>Score</td>
                                                    <td>: 0</td>
                                                </tr>
                                            @endif
                                        @endif
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endif    

@endsection