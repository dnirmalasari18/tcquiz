@extends('layouts.admin')

@section('quiz', 'active')

@section('breadcrumbs')
<li><a href="#">Dashboard</a></li>
<li><a href="#">Quiz</a></li>
<li class="active">List of Quizzes</li>
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
                            <a class="btn btn-primary float-right" href="/admin/create-quiz" role="button">Add Quiz</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table id="bootstrap-data-table" class="table table-bordered">
                        <thead class="thead-light" align="center">
                            <tr>
                                <th>Quiz ID</th>
                                <th>Kelas</th>
                                <th>Jadwal</th>
                                <th>Menu</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr >
                                <td>1</td>
                                <td>Pemrograman Berbasis Kerangka Kerja - A</td>
                                <td>Senin | 12.00 - 12.30</td>
                                <td align="center">
                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#mediumModal">Detail
                                    </button>
                                    <a class="btn btn-warning btn-sm" href="/admin/edit-quiz/1" role="button">Edit</a>
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
                            <td>Quiz ID</td>
                            <td>: Q123</td>
                        </tr>
                        <tr>
                            <td>Kelas</td>
                            <td>: Pemrograman Berbasis Kerangka Kerja - A</td>
                        </tr>
                        <tr>
                            <td>Jadwal</td>
                            <td>: Senin | 12.00 - 12.30</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection