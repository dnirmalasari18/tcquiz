@extends('layouts.mahasiswa')

@section('quiz', 'active')

@section('breadcrumbs')
<li><a href="#">Dashboard</a></li>
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
                            @if(count($classes))
                            @foreach($classes as $c)
                            @foreach($c->agenda->pertemuan as $p)
                            @if(count($p->quiz))
                            @foreach($p->quiz as $q)
                            <tr >
                                <td>{{$q->nama_kuis}}</td>
                                <td>{{$q->pertemuanke->agenda->namaAgenda}}</td>
                                <td align="center">{{$q->pertemuanke->tglPertemuan}}</td>
                                <td align="center">{{$q->pertemuanke->waktuMulai}}</td>
                                <td align="center">{{$q->pertemuanke->waktuSelesai}}</td>
                                <td align="center">{{$q->durasi}}</td>

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
                                <td align="center"><span class="badge badge-pill badge-success">Active</span></td>
                                <td align="center">
                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#takeQuiz{{$q->id}}">Take Quiz
                                    </button>
                                </td>
                                @endif
                                @endif

                            </tr>
                            @endforeach
                            @endif    
                            @endforeach
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div><!-- .animated -->

<style type="text/css">
    .nuzha3{
        max-width: 500px;
    }
</style>

@if(count($classes))
@foreach($classes as $c)
@foreach($c->agenda->pertemuan as $p)
@if(count($p->quiz))
@foreach($p->quiz as $q)
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
@endforeach
@endforeach
@endif

@if(count($classes))
@foreach($classes as $c)
@foreach($c->agenda->pertemuan as $p)
@if(count($p->quiz))
@foreach($p->quiz as $q)
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
                        <tr style="border-top-style: hidden;">
                            <td>Waktu Mulai</td>
                            <td>: 13:02:11</td>
                        </tr>
                        <tr>
                            <td>Waktu Selesai</td>
                            <td>: 14:26:08</td>
                        </tr>
                        <tr>
                            <td>Poin</td>
                            <td>: 80.000 / 100.000 (80%)</td>
                        </tr>
                        <tr>
                            <td>Jawaban Benar</td>
                            <td>: 16 / 20</td>
                        </tr>
                        <tr>
                            <td>Komentar</td>
                            <td>: -</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endforeach
@endif    
@endforeach
@endforeach
@endif
@endsection