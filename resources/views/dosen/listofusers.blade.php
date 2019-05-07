@extends('layouts.dosen')

@section('users', 'active')

@section('breadcrumbs')
<li><a href="#">Dashboard</a></li>
<li class="active">Users</li>
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
                                @if ( $user->pics )
                                <td align="center">Dosen</td>
                                @else
                                <td align="center">Mahasiswa</td>
                                @endif
                                <td align="center">
                                    <button type="button" class="btn btn-info btn-sm mt-2" data-toggle="modal" data-target="#user-detail-{{ $user->id }}">Detail
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @else
                    <div class="alert alert-warning">
                        <i class="fa fa-exclamation-triangle"></i> There is no user(s).
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
                    <tbody>
                        <tr style="border-top-style: hidden;">
                            <td>NRP/NIP</td>
                            <td>: {{ $user->username }}</td>
                        </tr>
                        <tr>
                            <td>Nama</td>
                            <td>: {{ $user->name }}</td>
                        </tr>
                        <tr>
                            <td>E-mail</td>
                            <td>: {{ $user->email }}</td>
                        </tr>
                        <tr>
                            <td>Role</td>
                            @if ( $user->pics )
                            <td>: Dosen</td>
                            @else
                            <td>: Mahasiswa</td>
                            @endif
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endforeach
@endsection