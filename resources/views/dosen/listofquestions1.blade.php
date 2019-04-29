@extends('layouts.dosen')

@section('quiz', 'active')

@section('breadcrumbs')
<li><a href="#">Dashboard</a></li>
<li><a href="#">Quiz</a></li>
<li class="active">{{ $quiz->nama_kuis }}</li>
@endsection

@section('content')
<div class="animated fadeIn">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-white">
                    <div class="row">
                        <div class="col">
                            <h3 class="m-0">{{ $quiz->nama_kuis }}</h3>
                        </div>
                        <div class="col ">
                            <a class="btn btn-secondary float-right" href="/dosen/quiz" role="button">Back</a>
                        </div>
                        
                    </div>
                </div>
                <div class="card-body">
                    <div class="col-md-4 float-right">
                        <a class="btn btn-primary btn-sm" href="/dosen/quiz/1/questions/addquestions" role="button">Add Question</a>
                        <div class="card">
                            <div class="card-header text-center">
                                <strong class="card-title mb-3">PANEL SOAL</strong>
                            </div>
                            <div class="card-body">
                                <div align="center">
                                    @for ($i = 1; $i < 31; $i++)
                                        <button type="button" class="mt-2 btn2 btn-light btn-sm" style="height: 30px; width: 40px;">{{$i}}</button>                                
                                    @endfor
                                </div>
                                <hr>
                                <div class="card-text">
                                    <h6><span class="badge badge-success"> </span> Dijawab</h6>
                                    <h6><span class="badge badge-warning"> </span> Ragu</h6>
                                    <h6><span class="badge badge-light"> </span> Kosong</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><!-- .animated -->
@endsection