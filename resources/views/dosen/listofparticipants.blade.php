@extends('layouts.dosen')

@section('quiz-list', 'active')

@section('breadcrumbs')
<li><a href="#">Dashboard</a></li>
<li><a href="#">Quiz</a></li>
<li><a href="#">{{$kuis->nama_kuis}}</a></li>
<li class="active">Participants</li>
@endsection

@section('content')
<div class="animated fadeIn">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-white">
                    <div class="row">
                        <div class="col">
                            <h3 class="m-0">Partisipan {{$kuis->nama_kuis}}</h3>
                        </div>
                        <div class="col ">
                            <a class="btn btn-secondary float-right" href="/dosen/quiz" role="button">Back</a>

                            <a class="btn btn-primary float-right" href="{{route('generatepacket', $kuis->id)}}" role="button">Generate Packet</a>
                        </div>
                    </div>
                </div><br>
                <div class="col-md-12">
                        @if (\Session::has('empty_question'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                              {!! \Session::get('empty_question') !!}
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>                                    
                            </div>
                        @endif
                    </div>
                <div class="card-body">
                    
                    @if(count($participants))
                    <table id="bootstrap-data-table" class="table table-bordered">
                        <thead class="thead-light" align="center">
                            <tr align="center">
                                <th>NRP</th>
                                <th>Nama</th>
                                <th>Paket Soal</th>
                                <th>Nilai</th>
                                <th>Menu</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($participants as $p)
                            <tr>
                                <td align="center">{{ $p->user->username }}</td>
                                <td align="center">{{ $p->user->name }}</td>
                                <td align="center">{{ $p->paketkuis->id }}</td>
                                <td align="center">{{ $p->quiz_score }}</td>
                                <td align="center">
                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#participant-detail-{{ $p->id }}">Detail
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @elseif(count($participant))
                    <table id="bootstrap-data-table" class="table table-bordered">
                        <thead class="thead-light" align="center">
                            <tr align="center">
                                <th>NRP</th>
                                <th>Nama</th>
                                <th>Paket Soal</th>
                                <th>Nilai</th>
                                <th>Menu</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($participant as $p)
                            <tr>
                                <td align="center">{{ $p->user->username }}</td>
                                <td align="center">{{ $p->user->name }}</td>
                                <td align="center"></td>
                                <td align="center"></td>
                                <td align="center">
                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#participant-detail-{{ $p->id }}">Detail
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @else
                    <div class="alert alert-warning">
                        <i class="fa fa-exclamation-triangle"></i> Data partisipan kuis belum ada
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div><!-- .animated -->
@foreach($participants as $p)
<div class="modal fade" id="participant-detail-{{ $p->id }}" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mediumModalLabel">Partisipan Detail</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table">
                    <tbody >
                        <tr>
                            <td>NRP</td>
                            <td>: {{ $p->user->username }}</td>
                        </tr>
                        <tr>
                            <td>Nama</td>
                            <td>: {{ $p->user->name }}</td>
                        </tr>
                        <tr>
                            <td>ID Paket Kuis</td>
                            <td>: {{ $p->paketkuis->id }}</td>
                        </tr>
                        <tr>
                            <td>Detail Paket Kuis</td>
                            <td>: {{ $p->paketkuis->question_id_list }}</td>
                        </tr>
                        <tr>
                            <td>Nilai Kuis</td>
                            <td>: {{ $p->quiz_score }}</td>
                        </tr>
                        <tr>
                            <td>Tanggal Ambil Kuis</td>
                            <td>: {{ $p->end_time }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endforeach
@endsection