@extends('layouts.mahasiswa')

@section('quiz', 'active')

@section('title')
<h1>{{$q->nama_kuis}}</h1>
@endsection

@section('breadcrumbs')
<li><a href="/mahasiswa">Dashboard</a></li>
<li><a href="/mahasiswa/quizzes">Quizzes</a></li>
<li class="active">{{$q->nama_kuis}}</li>
@endsection

@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
        <h3 class="m-0">Test Result</h3>
        </div>
        <div class="card-body">
        <div class="modal-body">
                <table class="table">
                    <tbody>
                        <tr style="border-top-style: hidden;">
                            <td><strong>Quiz Name</strong></td>
                            <td>: {{$q->nama_kuis}}</td>
                        </tr>
                        <tr>
                            <td><strong>Class</strong></td>
                            <td>: {{$q->pertemuanke->agenda->namaAgenda}}</td>
                        </tr>
                        <tr>
                            <td><strong>Begin Time</strong></td>
                            <td>: {{date("H:i:s",strtotime($mp->end_time))}}</td>
                        </tr>
                        <tr>
                            <td><strong>End Time</strong></td>
                            <?php
                                $update = date("H:i:s",strtotime($mp->updated_at.'+7 hour'));
                                $selesai = $q->pertemuanke->waktuSelesai;
                                $real = date("H:i:s", strtotime($mp->end_time) + 60*$q->durasi);
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
                            <td><strong>Point</strong></td>
                            <td>: {{$mp->quiz_score}} %</td>
                        </tr>
                    </tbody>
                    
                </table>
            </div>
            <a href="/mahasiswa" class="btn btn-info" style="float: right;"> Go to Home </a>
        </div>
    </div>
</div>
@endsection

