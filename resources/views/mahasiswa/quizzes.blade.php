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
                                <th>Status</th>
                                <th>Menu</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr >
                                <td>Interaksi Manusia dan Komputer</td>
                                <td align="center">A</td>
                                <td>25 April 2019</td>
                                <td align="center"><span class="badge badge-pill badge-dark">Inactive</span></td>
                                <td align="center">
                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#takeQuiz">Take Quiz
                                    </button>
                                </td>
                            </tr>
                            <tr >
                                <td>Manajemen Proyek Perangkat Lunak</td>
                                <td align="center">A</td>
                                <td>25 April 2019</td>
                                <td align="center"><span class="badge badge-pill badge-success">Active</span></td>
                                <td align="center">
                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#takeQuiz">Take Quiz
                                    </button>
                                </td>
                            </tr>
                            <tr >
                                <td>Pemrograman Berbasis Kerangka Kerja</td>
                                <td align="center">I</td>
                                <td>24 April 2019</td>
                                <td align="center"><span class="badge badge-pill badge-danger">Closed</span></td>
                                <td align="center">
                                    <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#resultModal">See Result
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
<div class="modal fade" id="takeQuiz" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mediumModalLabel">Quiz Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table">
                    <tbody>
                        <tr style="border-top-style: hidden;">
                            <td>Waktu</td>
                            <td>: 02:00:00</td>
                        </tr>
                        <tr>
                            <td>Total Soal</td>
                            <td>: 25</td>
                        </tr>
                    </tbody>
                </table>
                <div align="center"><button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#takeQuiz">Enroll Me
                </button></div>
                
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="resultModal" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mediumModalLabel">Result Detail</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table">
                    <tbody>
                        <tr style="border-top-style: hidden;">
                            <td>Waktu Mulai</td>
                            <td>: 24 April 2019, 13:02:11</td>
                        </tr>
                        <tr>
                            <td>Waktu Selesai</td>
                            <td>: 24 April 2019, 14:26:08</td>
                        </tr>
                        <tr>
                            <td>Poin</td>
                            <td>: 80.000 / 100.000 (80%)</td>
                        </tr>
                        <tr>
                            <td>Jawaban Benar</td>
                            <td>: 16 / 20</td>
                        </tr>
                        <tr>
                            <td>Komentar</td>
                            <td>: -</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection