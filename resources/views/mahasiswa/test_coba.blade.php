@extends('layouts.mahasiswa')

@section('dashboard', 'active')

@section('title')
<h1>Test</h1>
@endsection

@section('breadcrumbs')
<li><a href="#">Dashboard</a></li>
<li><a href="#">Quizzes</a></li>
<li class="active">PBKK</li>
@endsection

@section('content')
<div class="col-md-9">
    <div class="card">
        <div class="card-header">
            <strong class="card-title">Soal 1</strong>
            <strong class="card-title" style="float: right; margin-bottom: 0;">Flag</strong>
            <label class="switch switch-3d switch-warning mr-3" style="float: right; margin-bottom: 0;"><input type="checkbox" class="switch-input" checked="false"> <span class="switch-label"></span> <span class="switch-handle"></span></label>
        </div>
        <div class="card-body">
            Are you on the hunt for a free general knowledge quiz for your pub, party, social or school group? Look no further! The following quiz questions are suitable for all age groups and range from easy to profoundly thought-provoking, covering a wide range of topics so everyone can join in the fun.
        </div>
        <div class="card-body">
            <div style="margin-bottom: 10px;"><strong>Jawaban</strong></div>
            <div class="form-check">
                <?php

                    $x = 5;
                    $opt = array();
                    for ($i=0; $i <$x ; $i++) { 
                        $opt[$i] = $i + 1;
                    }

                ?>
                @foreach($opt as $o)
                <div class="radio">
                  <label for="radio1" class="form-check-label ">
                    <input type="radio" id="radio1" name="radios" value="option1" class="form-check-input">
                    Option {{$o}}
                  </label>
                </div>
                @endforeach
            </div>
        </div>
        <div class="card-header" style="border-top: 1px solid rgba(0,0,0,.125);">
            <button type="button" class="btn btn-info btn-sm" style="float: right; width: 70px;">Next</button>
        </div>
    </div>
</div>
<div class="col-md-3">
    <style type="text/css">
        .card{
            margin-bottom: 0;
        }
        .card-soal{
            margin-bottom: 20px;
        }
        .soal{
            padding-bottom: 0px;
        }
        .row{
            font-size: 10px;
            padding-right: 15px;
            margin-bottom: 15px;
        }
        .col{
            padding-right: 0;
            max-width: 20%;
        }
        .card-body .text-secondary{
            padding: 6px 6px;
            cursor: pointer;
        }
        .soal-aktif{
            background-color: #f2f2f2;
        }
        .soal-ragu{
            background-color: #ffc107;
        }
        .soal-ragu-aktif{
            background-color: #ffc107;
            color: white !important;
        }
    </style>
    <div class="card card-soal">
        <div class="card-header" align="center">
            <strong class="card-title">Daftar Soal</strong>
        </div>
        <div class="card-body soal">
            <?php

                $n = 24;
                $soal = array();
                for ($i=0; $i <$n ; $i++) { 
                    $soal[$i] = $i + 1;
                }

            ?>
            @foreach($soal as $m)
            @if($m%5==1)
            <div class="row">
                <div class="col">
                    <section class="card">
                        <div class="card-body text-secondary soal-aktif" align="center">{{$m}}</div>
                    </section>
                </div>
            @else
                <div class="col">
                    <section class="card">
                        <div class="card-body text-secondary soal-aktif" align="center">{{$m}}</div>
                    </section>
                </div>
            @endif
            @if($m%5==0 || $m==count($soal))
            </div>
            @endif
            @endforeach
        </div>                
    </div>
</div>

@endsection