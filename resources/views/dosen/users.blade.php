@extends('layouts.dosen')

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
                            <h3 class="m-0">Users</h3>
                        </div>
                        <div class="col ">
                            <a class="btn btn-primary float-right" href="{{route('users.create')}}" role="button">Add User</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @if(count($users))
                    <table id="bootstrap-data-table" class="table table-bordered">
                        <thead class="thead-light" align="center">
                            <tr align="center">
                                <th>NRP/NIP</th>
                                <th>Nama</th>
                                <th>Role</th>
                                <th>Menu</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                            <tr>
                                <td align="center">{{ $user->username }}</td>
                                <td>{{ $user->name }}</td>
                                <td align="center">{{ $user->role }}</td>
                                <td align="center">
                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#user-detail-{{ $user->id }}">Detail
                                    </button>
                                    <a class="btn btn-warning btn-sm" href="{{route('users.edit', $user->id)}}" role="button">Edit</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @else
                    <div class="alert alert-warning">
                        <i class="fa fa-exclamation-triangle"></i> Data user belum ada
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div><!-- .animated -->
@foreach($users as $user)
<div class="modal fade" id="user-detail-{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mediumModalLabel">User Detail</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table">
                    <tbody >
                        <tr>
                            <td>NRP/NIP</td>
                            <td>: {{ $user->username }}</td>
                        </tr>
                        <tr>
                            <td>Nama</td>
                            <td>: {{ $user->name }}</td>
                        </tr>
                        <tr>
                            <td>Role</td>
                            <td>: {{ $user->role }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endforeach
@endsection