@extends('layouts.mahasiswa')

@section('quiz', 'active')

@section('breadcrumbs')
<li><a href="#">Dashboard</a></li>
<li class="active">Quizzes</li>
@endsection

@section('content')
<div class="col-md-12">
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
                            <td>: UAS 3</td>
                        </tr>
                        <tr>
                            <td>Class</td>
                            <td>: Human Computer Interaction</td>
                        </tr>
                        <tr>
                            <td>Begin Time</td>
                            <td>: 10:00:00</td>
                        </tr>
                        <tr>
                            <td>End Time</td>
                            <td>: 12:30:00</td>
                        </tr>
                        <tr>
                            <td>Point</td>
                            <td>: 100.000 / 100.000 (100%)</td>
                        </tr>
                    </tbody>
                    
                </table>
            </div>
            <a href="/mahasiswa" class="btn btn-info" style="float: right;"> Go Home </a>
        </div>
    </div>
</div>
@endsection

