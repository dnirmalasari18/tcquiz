@extends('layouts.admin')

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
                            <h3 class="m-0">Add Class</h3>
                        </div>
                        <div class="col ">
                            <a class="btn btn-secondary float-right" href="/admin/kelas" role="button">Back</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div>
                        @if (\Session::has('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                              {!! \Session::get('error') !!}
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>                                    
                            </div>
                        @endif
                    </div>
                   <form action="{{route('kelas.store')}}" method="POST">
                        {{csrf_field()}}
                        <div class="form-group col-md-6">
                            <label class="font-weight-bold" for="">Mata Kuliah</label>
                            <select class="form-control" name="mata_kuliah_id">
                            @foreach($matakuliah as $m)
                                <option value="{{$m->id}}"> {{$m->nama_mata_kuliah}} </option>
                            @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="font-weight-bold" for="">Kelas</label>
                            <input type="text" class="form-control" id="" placeholder="" name="kelas">
                        </div>
                        <div class="form-group col-md-6">
                            <label class="font-weight-bold" for="">Kuota</label>
                            <input type="number" min="1" class="form-control" id="" placeholder="" name="kuota">
                        </div>
                        <div class="form-group col-md-6">
                            <label class="font-weight-bold" for="">Dosen Pengajar</label>
                            <select class="form-control" name="user_nip">
                            @foreach($dosen as $d)
                                <option value="{{$d->username}}"> {{$d->name}} </option>
                            @endforeach
                        </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label class="font-weight-bold" for="">Ruangan</label>
                            <select class="form-control" name="ruangan_id">
                            @foreach($ruang as $r)
                                <option value="{{$r->id}}"> {{$r->nama_ruangan}} </option>
                            @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label class="font-weight-bold" for="">Hari</label>
                            <select class="form-control" name="hari">
                                <option value="Senin">Senin</option>
                                <option value="Selasa">Selasa</option>
                                <option value="Rabu">Rabu</option>
                                <option value="Kamis">Kamis</option>
                                <option value="Jumat">Jumat</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label class="font-weight-bold" for="">Jam</label>
                            <select class="form-control" name="jam">
                                <option value="08.30 - 10.00">08.30 - 10.00</option>
                                <option value="10.00 - 12.30">10.00 - 12.30</option>
                                <option value="13.00 - 15.30">13.00 - 15.30</option>
                                <option value="15.30 - 18.00">15.30 - 18.00</option>
                            </select>
                        </div>
                        <br>
                        <div class="col-md-12">
                            <button id="" type="submit" class="btn btn-lg btn-info btn-block ">
                                Add Class
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div><!-- .animated -->
@endsection