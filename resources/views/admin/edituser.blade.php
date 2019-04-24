@extends('layouts.admin')

@section('users', 'active')

@section('breadcrumbs')
<li><a href="#">Dashboard</a></li>
<li class="active">Manage Users</li>
@endsection

@section('content')
<div class="animated fadeIn">
    <div class="row">
        
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-white">
                    <div class="row">
                        <div class="col">
                            <h3 class="m-0">Edit User</h3>
                        </div>
                        <div class="col ">
                            <a class="btn btn-secondary float-right" href="/admin/users" role="button">Back</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                	<div class="col-12 col-md-6 offset-md-3">
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

                		<form action="{{route('users.update', $user->id)}}" method="POST">
                            <input name="_method" type="hidden" value="PATCH">
                            {{csrf_field()}}
                			<div class="form-group">
                			    <label class="font-weight-bold" for="">NRP/NIP</label>
                			    <input type="text" class="form-control" id="" placeholder="" value="{{ $user->username }}" name="username">
                			</div>
                			<div class="form-group">
                			    <label class="font-weight-bold" for="">Nama</label>
                			    <input type="text" class="form-control" id="" placeholder="" value="{{ $user->name }}" name="name">
                			</div>
                			<div class="form-group">
                				<label class="font-weight-bold" for="">Role</label>
                			    <select class="form-control" name="role">
                			      	@if($user->role == 'Admin')
                                        <option selected value="Admin">Admin</option>
                                        <option value="Dosen">Dosen</option>
                                        <option value="Mahasiswa">Mahasiswa</option>
                                    @elseif($user->role == 'Dosen')
                                        <option value="Admin">Admin</option>
                                        <option selected value="Dosen">Dosen</option>
                                        <option value="Mahasiswa">Mahasiswa</option>
                                    @else
                                        <option value="Admin">Admin</option>
                                        <option value="Dosen">Dosen</option>
                                        <option selected value="Mahasiswa">Mahasiswa</option>
                                    @endif
                                    
                			    </select>
                			</div>
                			<br>
                			<div>
                                <button id="" type="submit" class="btn btn-lg btn-info btn-block">Save</button>
                			</div>
                		</form><br>
                        <form method="POST" action="{{ route('users.destroy', $user->id) }}" accept-charset="UTF-8">
                            <input name="_method" type="hidden" value="Delete">
                            <input name="_token" type="hidden" value="{{ csrf_token() }}">
                            <input type="submit" class="btn btn-lg btn-danger btn-block" onclick="return confirm('Anda yakin akan menghapus data?');" value="Delete">
                        </form>
                	</div>
                	
                </div>
            </div>
        </div>
    </div>
</div><!-- .animated -->
@endsection