@extends('layouts.mahasiswa')

@section('classes', 'active')

@section('breadcrumbs')
<li><a href="#">Dashboard</a></li>
<li class="active">My Classes</li>
@endsection

@section('content')
<div class="animated fadeIn">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-white">
                    <div class="row">
                        <div class="col">
                            <h3 class="m-0">My Classes</h3>
                        </div>
                        <div class="col ">
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @if(count($classes))
                    <table id="bootstrap-data-table" class="table table-bordered">
                        <thead class="thead-light" align="center">
                            <tr>
                                <th>Kelas</th>
                                <th>Dosen Pengajar</th>
                                <th>Ruangan</th>
                                <th>Jadwal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($classes as $c)
                            <tr >
                                <td>{{ $c->agenda->namaAgenda }}</td>
                                <td>{{ $c->agenda->dosenpengajar->users->name }}</td>
                                <td align="center">{{ $c->agenda->fk_idRuang }}</td>
                                <td align="center">{{ $c->agenda->hari }}, {{ $c->agenda->WaktuMulai }} - {{ $c->agenda->WaktuSelesai}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @else
                    <div class="alert alert-warning">
                        <i class="fa fa-exclamation-triangle"></i> Data kelas belum ada
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div><!-- .animated -->
@foreach($classes as $c)
<div class="modal fade" id="class-detail-{{ $c->id }}" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mediumModalLabel">Class Detail</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table">
                    <tbody >
                        <tr style="border-top-style: hidden;">
                            <td>Kelas</td>
                            <td>: {{ $c->agenda->namaAgenda }}</td>
                        </tr>
                        <tr>
                            <td>Dosen Pengajar</td>
                            <td>: {{ $c->agenda->dosenpengajar->users->name }}</td>
                        </tr>
                        <tr>
                            <td>Ruangan</td>
                            <td>: {{ $c->agenda->fk_idRuang }}</td>
                        </tr>
                        <tr>
                            <td>Jadwal</td>
                            <td>: {{ $c->agenda->hari }}, {{ $c->agenda->WaktuMulai }} - {{ $c->agenda->WaktuSelesai}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endforeach
@endsection