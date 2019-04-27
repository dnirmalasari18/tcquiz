@extends('layouts.dosen')

@section('classes', 'active')

@section('breadcrumbs')
<li><a href="#">Dashboard</a></li>
<li class="active">Classes</li>
@endsection

@section('content')
<div class="animated fadeIn">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-white">
                    <div class="row">
                        <div class="col">
                            <h3 class="m-0">Classes</h3>
                        </div>
                        <div class="col ">
                            <a class="btn btn-primary float-right" href="{{route('kelas.create')}}" role="button">Add Class</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @if(count($classes))
                    <table id="bootstrap-data-table" class="table table-bordered">
                        <thead class="thead-light" align="center">
                            <tr>
                                <th>Mata Kuliah</th>
                                <th>Kelas</th>
                                <th>Dosen Pengajar</th>
                                <th>Jumlah Mahasiswa</th>
                                <th>Menu</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($classes as $class)
                            <tr>
                                <td>{{ $class->matakuliah->nama_mata_kuliah }}</td>
                                <td align="center">{{ $class->kelas }}</td>
                                <td>{{ $class->dosenpengajar->name }}</td>
                                <td align="center">MASIH BELUM</td>
                                <td align="center">
                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#class-detail-{{ $class->id }}"">Detail
                                    </button>
                                    <a class="btn btn-warning btn-sm" href="{{route('kelas.edit', $class->id)}}" role="button">Edit</a>
                                    <a class="btn btn-light btn-sm" href="kelas/{{ $class->id }}/detail" role="button">Kelola Peserta</a>
                                </td>
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
@foreach($classes as $class)
<div class="modal fade" id="class-detail-{{ $class->id }}" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
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
                        <tr>
                            <td>Mata Kuliah</td>
                            <td>: {{ $class->matakuliah->nama_mata_kuliah }}</td>
                        </tr>
                        <tr>
                            <td>Kelas</td>
                            <td>: {{ $class->kelas }}</td>
                        </tr>
                        <tr>
                            <td>Jumlah Mahasiswa</td>
                            <td>: BELUM</td>
                        </tr>
                        <tr>
                            <td>Kuota</td>
                            <td>: {{ $class->kuota }}</td>
                        </tr>
                        <tr>
                            <td>SKS</td>
                            <td>: {{ $class->matakuliah->sks }}</td>
                        </tr>
                        <tr>
                            <td>Semester</td>
                            <td>: {{ $class->matakuliah->semester }}</td>
                        </tr>
                        <tr>
                            <td>Dosen Pengajar</td>
                            <td>: {{ $class->dosenpengajar->name }}</td>
                        </tr>
                        
                        <tr>
                            <td>Ruangan</td>
                            <td>: {{ $class->ruangan->nama_ruangan }}</td>
                        </tr>
                        <tr>
                            <td>Jadwal</td>
                            <td>: {{ $class->hari }} | {{ $class->jam }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endforeach
@endsection