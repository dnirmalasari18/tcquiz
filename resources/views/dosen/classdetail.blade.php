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
                            <h3 class="m-0">{{ $namakelas->matakuliah->nama_mata_kuliah }} - {{ $namakelas->kelas }}</h3>
                        </div>
                        <div class="col ">
                            <a class="btn btn-secondary float-right" href="/dosen/kelas" role="button">Back</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @if(count($mahasiswa))
                    <table id="bootstrap-data-table" class="table table-bordered">
                        <thead class="thead-light" align="center">
                            <tr>
                                <th>NRP</th>
                                <th>Nama Mahasiswa</th>
                                <th>Menu</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($mahasiswa as $m)
                            <tr>
                                <td align="center">A</td>
                                <td>B</td>
                                <form method="POST" action="" accept-charset="UTF-8">
                                    <div class="col-md-12">
                                        <br>
                                        <input name="_method" type="hidden" value="Delete">
                                        <input name="_token" type="hidden" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-lg btn-danger btn-block" onclick="return confirm('Anda yakin akan menghapus data?');" value="Delete">
                                    </div>
                                </form>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @else
                    <div class="alert alert-warning">
                        <i class="fa fa-exclamation-triangle"></i> Data mahasiswa belum ada
                    </div>
                    @endif
                    <div class="col ">
                        <a class="btn btn-lg btn-primary btn-block" href="" role="button">Add Mahasiswa</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><!-- .animated -->
@endsection