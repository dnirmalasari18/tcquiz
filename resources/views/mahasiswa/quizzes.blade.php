@extends('layouts.mahasiswa')

@section('quiz', 'active')

@section('breadcrumbs')
<li><a href="#">Dashboard</a></li>
<li class="active">Quizzes</li>
@endsection

@section('content')
<div class="animated fadeIn">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-white">
                    <div class="row">
                        <div class="col">
                            <h3 class="m-0">Quizzes</h3>
                        </div>
                        <div class="col ">
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table id="bootstrap-data-table" class="table table-bordered">
                        <thead class="thead-light" align="center">
                            <tr>
                                <th>Mata Kuliah</th>
                                <th>Kelas</th>
                                <th>Tanggal</th>
                                <th>Waktu</th>
                                <th>Menu</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr >
                                <td>Manajemen Proyek Perangkat Lunak</td>
                                <td align="center">A</td>
                                <td>25 April 2019</td>
                                <td align="center">02:00:00</td>
                                <td align="center">
                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#mediumModal">Take Quiz
                                    </button>
                                </td>
                            </tr>
                            <tr >
                                <td>Pemrograman Berbasis Kerangka Kerja</td>
                                <td align="center">I</td>
                                <td>24 April 2019</td>
                                <td align="center">01:30:00</td>
                                <td align="center">
                                    <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#mediumModal">See Result
                                    </button>
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