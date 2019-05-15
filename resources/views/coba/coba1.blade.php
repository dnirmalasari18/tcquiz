@extends('layouts.dosen')

@section('quiz-list', 'active')

@section('breadcrumbs')
<li><a href="#">Dashboard</a></li>
<li><a href="#">Grafik</a></li>
<li class="active">((NAMA QUIZ))</li>
@endsection
@section('style')
<link href="{!! asset('morrisjs/morris.css') !!}" rel="stylesheet">
@endsection

@section('content')
<div class="animated fadeIn">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-white">
                    <div class="row">
                        <div class="col">
                            <h3 class="m-0">Grafik ((NAMA QUIZ))</h3>
                        </div>
                        <div class="col ">
                            <a class="btn btn-secondary float-right" href="/dosen/quiz" role="button">Back</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="default-tab">
                        <nav>
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Persebaran Nilai</a>
                                <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Persebaran Jawaban</a>
                            </div>
                        </nav>
                        
                        <div class="panel-body">
                            <div id="persebaranNilai"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><!-- .animated -->

@endsection

@section('script')
<script src="{!! asset('raphael/raphael.min.js') !!}"></script>
<script src="{!! asset('morrisjs/morris.min.js') !!}"></script>
<script src="{!! asset('morrisjs/morris-data.js') !!}"></script>
<script>
    new Morris.Line({
            element: 'persebaranNilai',
            data: [
                { Nilai: '60', studentAmount: 20 },
                { Nilai: '70', studentAmount: 10 },
                { Nilai: '80', studentAmount: 5 },
                { Nilai: '90', studentAmount: 5 },
                { Nilai: '100', studentAmount: 5 }
            ],
            xkey: 'Nilai',
            parseTime:false,
            ykeys: ['studentAmount'],
            labels: ['Jumlah Siswa'],
            fillOpacity: 0.6,
            hideHover: 'always',
            behaveLikeLine: true,
            resize: true,
            pointFillColors:['#ffffff'],
            pointStrokeColors: ['black'],
            lineColors:['blue']
        });  
</script>
@endsection