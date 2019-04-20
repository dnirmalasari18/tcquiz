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
                            <h3 class="m-0">Classes</h3>
                        </div>
                        <div class="col ">
                            <a class="btn btn-primary float-right" href="/admin/add-class" role="button">Add Class</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
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
                            <tr >
                                <td>Manajemen Proyek Perangkat Lunak</td>
                                <td>A</td>
                                <td>Dwi Sunaryono, S. Kom., M. Kom</td>
                                <td>34</td>
                                <td align="center">
                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#mediumModal">Detail
                                    </button>
                                    <a class="btn btn-warning btn-sm" href="/admin/edit-class/1" role="button">Edit</a>
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
                            <td>: Manajemen Proyek Perangkat Lunak</td>
                        </tr>
                        <tr>
                            <td>Kelas</td>
                            <td>: A</td>
                        </tr>
                        <tr>
                            <td>SKS</td>
                            <td>: 3</td>
                        </tr>
                        <tr>
                            <td>Semester</td>
                            <td>: 6</td>
                        </tr>
                        <tr>
                            <td>Dosen Pengajar</td>
                            <td>: Dwi Sunaryono, S. Kom., M. Kom</td>
                        </tr>
                        <tr>
                            <td>Jumlah Mahasiswa</td>
                            <td>: 34</td>
                        </tr>
                        <tr>
                            <td>Ruangan</td>
                            <td>: IF-105A</td>
                        </tr>
                        <tr>
                            <td>Jadwal</td>
                            <td>: Senin | 13.00 - 15.30</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection