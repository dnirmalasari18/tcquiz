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
                            <h3 class="m-0">Edit Class</h3>
                        </div>
                        <div class="col ">
                            <a class="btn btn-secondary float-right" href="/admin/kelas" role="button">Back</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div>
                        @if (\Session::has('update_done'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                              {!! \Session::get('update_done') !!}
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>                                    
                            </div>
                        @endif
                    </div>
                    <form action="{{route('kelas.update', $class->id)}}" method="POST">
                        <input name="_method" type="hidden" value="PATCH">
                        {{csrf_field()}}
                        <div class="form-group col-md-6">
                            <label class="font-weight-bold" for="">Mata Kuliah</label>
                            {!! Form::select('mata_kuliah_id', $matakuliah, $class->mata_kuliah_id, array('class' => 'form-control')) !!}
                        </div>
                        <div class="form-group col-md-6">
                            <label class="font-weight-bold" for="">Kelas</label>
                            <input type="text" class="form-control" id="" placeholder="" value="{{ $class->kelas }}" name="kelas">
                        </div>
                        <div class="form-group col-md-6">
                            <label class="font-weight-bold" for="">Kuota</label>
                            <input type="number" min="1" class="form-control" id="" placeholder="" value="{{ $class->kuota }}" name="kuota">
                        </div>
                        <div class="form-group col-md-6">
                            <label class="font-weight-bold" for="">Dosen Pengajar</label>
                            {!! Form::select('user_nip', $dosen, $class->user_nip, array('class' => 'form-control')) !!}
                        </div>
                        <div class="form-group col-md-4">
                            <label class="font-weight-bold" for="">Ruangan</label>
                            {!! Form::select('ruangan_id', $ruang, $class->ruangan_id, array('class' => 'form-control')) !!}
                        </div>
                        <div class="form-group col-md-4">
                            <label class="font-weight-bold" for="">Hari</label>
                            {!! Form::select('hari', array('Senin' => 'Senin', 'Selasa' => 'Selasa', 'Rabu' => 'Rabu', 'Kamis' => 'Kamis', 'Jumat' => 'Jumat'), $class->hari, array('class' => 'form-control')) !!}
                        </div>
                        <div class="form-group col-md-4">
                            <label class="font-weight-bold" for="">Jam</label>
                            {!! Form::select('jam', array('08.30 - 10.00' => '08.30 - 10.00', '10.00 - 12.30' => '10.00 - 12.30', '13.00 - 15.30' => '13.00 - 15.30', '15.30 - 18.00' => '15.30 - 18.00'), $class->jam, array('class' => 'form-control')) !!}
                        </div>
                        <br>
                        <div class="col-md-12">
                            <button id="" type="submit" class="btn btn-lg btn-info btn-block ">
                                Save
                            </button>
                        </div>
                    </form>

                    <form method="POST" action="{{ route('kelas.destroy', $class->id) }}" accept-charset="UTF-8">
                        <div class="col-md-12">
                            <br>
                            <input name="_method" type="hidden" value="Delete">
                            <input name="_token" type="hidden" value="{{ csrf_token() }}">
                            <input type="submit" class="btn btn-lg btn-danger btn-block" onclick="return confirm('Anda yakin akan menghapus data?');" value="Delete">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div><!-- .animated -->
@endsection