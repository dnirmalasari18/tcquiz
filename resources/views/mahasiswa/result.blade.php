@extends('layouts.mahasiswa')

@section('quiz', 'active')

@section('breadcrumbs')
<li><a href="#">Dashboard</a></li>
<li class="active">Quizzes</li>
@endsection

@section('content')
<div class="col-md-9">
    <div class="card">
        <div class="card-header">
            <strong class="card-title">Test Result</strong>
        </div>
        <div class="card-body">
        <div class="modal-body">
                <table class="table">
                    <tbody>
                        <tr style="border-top-style: hidden;">
                            <td>Waktu Mulai</td>
                            <td>: 13:02:11</td>
                        </tr>
                        <tr>
                            <td>Waktu Selesai</td>
                            <td>: 14:26:08</td>
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

