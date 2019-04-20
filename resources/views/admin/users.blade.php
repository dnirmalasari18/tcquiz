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
                            <h3 class="m-0">Users</h3>
                        </div>
                        <div class="col ">
                            <a class="btn btn-primary float-right" href="/admin/add-user" role="button">Add User</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table id="bootstrap-data-table" class="table table-bordered">
                        <thead class="thead-light" align="center">
                            <tr>
                                <th>NRP/NIP</th>
                                <th>Nama</th>
                                <th>Role</th>
                                <th>Menu</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr >
                                <td>admin001</td>
                                <td>Admin</td>
                                <td>Admin</td>
                                <td align="center">
                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#mediumModal">Detail
                                    </button>
                                    <a class="btn btn-warning btn-sm" href="/admin/edit-user/1" role="button">Edit</a>
                                </td>
                            </tr>
                            <tr>
                                <td>197205281997021001</td>
                                <td>Dwi Sunaryono, S. Kom., M. Kom</td>
                                <td>Dosen</td>
                                <td align="center">
                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#mediumModal">Detail
                                    </button>
                                    <a class="btn btn-warning btn-sm" href="" role="button">Edit</a>
                                </td>
                            </tr>
                            <tr>
                                <td>197712172003121001</td>
                                <td>Dr. Eng. Darlis Herumurti,S.Kom.,M. Kom</td>
                                <td>Dosen</td>
                                <td align="center">
                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#mediumModal">Detail
                                    </button>
                                    <a class="btn btn-warning btn-sm" href="" role="button">Edit</a>
                                </td>
                            </tr>
                            <tr>
                                <td>05111640000057</td>
                                <td>Ghifaroza R.</td>
                                <td>Mahasiswa</td>
                                <td align="center">
                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#mediumModal">Detail
                                    </button>
                                    <a class="btn btn-warning btn-sm" href="" role="button">Edit</a>
                                </td>
                            </tr>
                            <tr>
                                <td>05111640000014</td>
                                <td>Nuzha Musyafira</td>
                                <td>Mahasiswa</td>
                                <td align="center">
                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#mediumModal">Detail
                                    </button>
                                    <a class="btn btn-warning btn-sm" href="" role="button">Edit</a>
                                </td>
                            </tr>
                            <tr>
                                <td>05111640000106</td>
                                <td>Azkiatunnisa F.</td>
                                <td>Mahasiswa</td>
                                <td align="center">
                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#mediumModal">Detail
                                    </button>
                                    <a class="btn btn-warning btn-sm" href="" role="button">Edit</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div><!-- .animated -->
<div class="modal fade" id="mediumModal" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
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
                            <td>NRP</td>
                            <td>: 05111640000057</td>
                        </tr>
                        <tr>
                            <td>Nama</td>
                            <td>: Ghifaroza R.</td>
                        </tr>
                        <tr>
                            <td>Role</td>
                            <td>: Mahasiswa</td>
                        </tr>
                        <tr>
                            <td>Semester</td>
                            <td>: 6</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection