@extends('layouts.dosen')

@section('quiz-list', 'active')

@section('breadcrumbs')
<li><a href="#">Dashboard</a></li>
<li><a href="#">Quiz</a></li>
<li class="active">List of Quizzes</li>
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
                    </div>
                </div>
                <div class="card-body">
                    @if(count($quiz))
                    <table id="bootstrap-data-table" class="table table-bordered">
                        <thead class="thead-light" align="center">
                            <tr>
                                <th>Quiz Name</th>
                                <th>Class</th>
                                <th>Schedule</th>
                                <th>Duration</th>
                                <th>Menu</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($quiz as $q)
                            <tr>
                                <td>{{ $q->nama_kuis }}</td>
                                <td>{{ $q->pertemuanke->agenda->namaAgenda }}</td>
                                <td align="center">{{ date('d M y', strtotime($q->pertemuanke->tglPertemuan)) }}</td>
                                <td align="center">{{ $q->durasi }} menit</td>
                                <td align="center">
                                    <a class="btn btn-info btn-sm" href="{{route('quiz.edit', $q->id)}}" role="button">Info</a>
                                    <a class="btn btn-warning btn-sm" href="{{route('listofquestions', $q->id)}}" role="button">Questions</a>
                                    <a class="btn btn-light btn-sm" href="{{route('participantslist', $q->id)}}" role="button">Summary</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @else
                    <div class="alert alert-warning">
                        <i class="fa fa-exclamation-triangle"></i> There is no quiz(zes).
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div><!-- .animated -->
@foreach($quiz as $q)
<div class="modal fade" id="kuis-detail-{{ $q->id }}" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
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
                        <tr>
                            <td>Nama Kuis</td>
                            <td>: {{ $q->nama_kuis }}</td>
                        </tr>
                        <tr>
                            <td>Mata Kuliah</td>
                            <td>: {{ $q->pertemuanke->agenda->namaAgenda }}</td>
                        </tr>
                        <tr>
                            <td>Jadwal</td>
                            <td>: {{ date('d M y', strtotime($q->pertemuanke->tglPertemuan)) }}, {{ $q->pertemuanke->waktuMulai}} - {{ $q->pertemuanke->waktuSelesai}} WIB</td>
                        </tr>                               
                        <tr>
                            <td>Durasi</td>
                            <td>: {{ $q->durasi }} menit</td>
                        </tr>
                        <tr>
                            <td>Dosen Pembuat</td>
                            <td>: {{ $q->creator->name }}</td>
                        </tr>
                        <tr>
                            <td>Terms and Conditions</td>
                            <td>: {!! $q->terms_conditions !!}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endforeach
@endsection