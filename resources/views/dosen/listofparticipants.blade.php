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
                            <h3 class="m-0">{{$kuis->nama_kuis}} Participants</h3>
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
                                <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Participants</a>
                                <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Quiz Summary</a>
                            </div>
                        </nav>
                        <div class="tab-content pl-3 pt-2" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
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
                                            <td>{{ $p->user->name }}</td>
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
                                            <td>{{ $p->user->name }}</td>
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
                                    <i class="fa fa-exclamation-triangle"></i> There is no participant(s).
                                </div>
                                @endif
                            </div>
                            <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                                <p>Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor, williamsburg carles vegan helvetica. Reprehenderit
                                    butcher retro keffiyeh dreamcatcher synth. Cosby sweater eu banh mi, irure terry richardson ex sd. Alip placeat salvia cillum iphone. Seitan alip s cardigan american apparel, butcher voluptate nisi .</p>
                            </div>
                        </div>
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
                <h5 class="modal-title" id="mediumModalLabel">Participant Detail</h5>
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