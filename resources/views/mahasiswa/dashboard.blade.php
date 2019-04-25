@extends('layouts.mahasiswa')

@section('dashboard', 'active')

@section('breadcrumbs')
<li class="active">Dashboard</li>
@endsection

@section('content')
<div class="animated fadeIn">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-white">
                    <div class="row">
                        <div class="col">
                            <h3 class="m-0">Upcoming Quizzes</h3>
                        </div>
                        <div class="col ">
                        </div>
                    </div>
                </div>
                <div class="card-body" style="height: 432px;">
                	There are no upcoming quizzes.
                </div>
            </div>
        </div>
    </div>
</div><!-- .animated -->
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
                        <tr>
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