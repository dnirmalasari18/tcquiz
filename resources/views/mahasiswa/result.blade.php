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
        <h3 class="m-0">Test Result</h3>
        </div>
        <div class="card-body">
        <div class="modal-body">
                <table class="table">
                    <tbody>
                        <tr style="border-top-style: hidden;">
                            <td>Quiz Name</td>
                            <td>: Kuis-10</td>
                        </tr>
                        <tr>
                            <td>Class</td>
                            <td>: Human Computer Interaction</td>
                        </tr>
                        <tr>
                            <td>Begin Time</td>
                            <td>: 13:00:00</td>
                        </tr>
                        <tr>
                            <td>End Time</td>
                            <td>: 14:26:08</td>
                        </tr>
                        <tr>
                            <td>Point</td>
                            <td>: 80.000 / 100.000 (80%)</td>
                        </tr>
                        <tr>
                            <td>Correct Answers</td>
                            <td>: 16 / 20</td>
                        </tr>
                        <tr>
                            <td>Comment</td>
                            <td>: -</td>
                        </tr>
                    </tbody>
                    
                </table>
            </div>
            <a href="/mahasiswa" class="btn btn-info" style="float: right;"> Go Home </a>
        </div>
    </div>
</div>
@endsection

