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
                            <h3 class="m-0">Add User</h3>
                        </div>
                        <div class="col ">
                            <a class="btn btn-secondary float-right" href="/admin/users" role="button">Back</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                	<div class="col-12 col-md-6 offset-md-3">
                		<form action="{{route('users.store')}}" method="POST">
                            {{csrf_field()}}
                			<div class="form-group">
                			    <label class="font-weight-bold" for="">NRP/NIP</label>
                			    <input type="text" class="form-control" id="" placeholder="" name="username">
                			</div>
                			<div class="form-group">
                			    <label class="font-weight-bold" for="">Nama</label>
                			    <input type="text" class="form-control" id="" placeholder="" name="name">
                			</div>
                			<div class="form-group">
                				<label class="font-weight-bold" for="">Role</label>
                			    <select class="form-control" name="role">
                			      	<option value="Admin">Admin</option>
                                    <option value="Dosen">Dosen</option>
                			      	<option value="Mahasiswa">Mahasiswa</option>
                			    </select>
                			</div>
                			<br>
                			<div>
                			    <button id="" type="submit" class="btn btn-lg btn-info btn-block">
                			        Add User
                			    </button>
                			</div>
                		</form>
                	</div>
                	
                </div>
            </div>
        </div>
    </div>
</div><!-- .animated -->
@endsection