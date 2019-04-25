@extends('layouts.mahasiswa')

@section('dashboard', 'active')

@section('breadcrumbs')
<li class="active">Dashboard</li>
@endsection

@section('content')
<div class="col-sm-12">
    <div class="alert  alert-success alert-dismissible fade show" role="alert">
      <span class="badge badge-pill badge-success">Reminder</span> You have upcoming quizzes!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
</div>
<style type="text/css">
	.nuzha{
		height: 110px;
		font-size: 20px; background-color: #3b5998;
		background-position-x: 0%;
		background-position-y: 0%;
		background-repeat: repeat;
		background-attachment: scroll;
		background-image: none;
		background-size: auto;
		background-origin: padding-box;
		background-clip: border-box;
	}
</style>
<div class="col-lg-3 col-md-6">
    <div class="social-box">
    	<div class="nuzha">
	    </div>
        <ul>
        	<li>
                <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#">Detail
                </button>
            </li>
            <li>
                <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#">Take Quiz
                </button>
            </li>
        </ul>
    </div>
</div>
<div class="col-lg-3 col-md-6">
    <div class="social-box">
    	<div class="nuzha">
	    </div>
        <ul>
        	<li>
                <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#">Detail
                </button>
            </li>
            <li>
                <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#">Take Quiz
                </button>
            </li>
        </ul>
    </div>
</div>
<div class="col-lg-3 col-md-6">
    <div class="social-box">
    	<div class="nuzha">
	    </div>
        <ul>
        	<li>
                <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#">Detail
                </button>
            </li>
            <li>
                <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#">Take Quiz
                </button>
            </li>
        </ul>
    </div>
</div>
<div class="col-lg-3 col-md-6">
    <div class="social-box">
    	<div class="nuzha">
	    </div>
        <ul>
        	<li>
                <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#">Detail
                </button>
            </li>
            <li>
                <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#">Take Quiz
                </button>
            </li>
        </ul>
    </div>
</div>

<!-- .animated -->
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