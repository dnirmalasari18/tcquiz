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
                            <td>Start Time</td>
                            <td>: {{date("H:i:s",strtotime($mp->end_time))}}</td>
                        </tr>
                        <tr>
                            <td>End Time</td>
                            <td>: {{date("H:i:s",strtotime($mp->updated_at.'+7 hour'))}}</td>
                        </tr>
                        <tr>
                            <td>Score</td>
                            <td>: {{$mp->quiz_score}} / 100</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

