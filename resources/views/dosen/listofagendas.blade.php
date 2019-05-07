@extends('layouts.dosen')

@section('classes', 'active')

@section('breadcrumbs')
<li><a href="#">Dashboard</a></li>
<li class="active">Agenda</li>
@endsection

@section('content')
<div class="animated fadeIn">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-white">
                    <div class="row">
                        <div class="col">
                            <h3 class="m-0">Agenda</h3>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @if(count($agenda))
                    <table id="bootstrap-data-table" class="table table-bordered">
                        <thead class="thead-light" align="center">
                            <tr>
                                <th>Agenda ID</th>
                                <th>Agenda Name</th>
                                <th>Lecturer</th>
                                <th>Menu</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($agenda as $a)
                            <tr>
                                <td>{{ $a->idAgenda }}</td>
                                <td>{{ $a->singkatAgenda }}</td>
                                <td>{{ $a->dosenpengajar->users['name'] }}</td>
                                <td align="center">
                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#agenda-detail-{{ $a->idAgenda }}">Detail
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @else
                    <div class="alert alert-warning">
                        <i class="fa fa-exclamation-triangle"></i> There is no agenda(s).
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div><!-- .animated -->
@foreach($agenda as $a)
<div class="modal fade" id="agenda-detail-{{ $a->idAgenda }}" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mediumModalLabel">Agenda Detail</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table">
                    <tbody>
                        <tr style="border-top-style: hidden;">
                            <td>Agenda ID</td>
                            <td>: {{ $a->idAgenda }}</td>
                        </tr>
                        <tr>
                            <td>Agenda Name</td>
                            <td>: {{ $a->namaAgenda }}</td>
                        </tr>
                        <tr>
                            <td>Lecturer</td>
                            <td>: {{ $a->dosenpengajar->users['name'] }}</td>
                        </tr>
                        <tr>
                            <td>Class Room</td>
                            <td>: {{ $a->fk_idRuang }}</td>
                        </tr>
                        <tr>
                            <td>Schedule</td>
                            <td>: {{ $a->hari }} | {{ $a->WaktuMulai }} - {{ $a->WaktuSelesai }}</td>
                        </tr>
                        @foreach($a->pertemuan as $a)
                        <tr>
                            <td>Meeting time {{ $a->pertemuanKe }}</td>
                            <td>: {{ date('d M y', strtotime($a->tglPertemuan)) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endforeach
@endsection