@extends('layouts.mahasiswa')

@section('dashboard', 'active')

@section('title')
<h1>Dashboard</h1>
@endsection

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
		font-size: 40px; 
        background-color: #3b5998;
		background-position-x: 0%;
		background-position-y: 0%;
		background-repeat: repeat;
		background-attachment: scroll;
		background-image: none;
		background-size: auto;
		background-origin: padding-box;
		background-clip: border-box;
        line-height: 110px;
        color: white;
	}
</style>
<div class="col-lg-3 col-md-6">
    <div class="social-box">
    	<div class="nuzha">
            PBKK
	    </div>
        <ul>
        	<li>
                <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#quizDetail">Detail
                </button>
            </li>
            <li>
                <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#takeQuiz">Take Quiz
                </button>
            </li>
        </ul>
    </div>
</div>
<div class="col-lg-3 col-md-6">
    <div class="social-box">
    	<div class="nuzha">
            MPPL
	    </div>
        <ul>
        	<li>
                <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#quizDetail">Detail
                </button>
            </li>
            <li>
                <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#takeQuiz">Take Quiz
                </button>
            </li>
        </ul>
    </div>
</div>
<div class="col-lg-3 col-md-6">
    <div class="social-box">
    	<div class="nuzha">
            IMK
	    </div>
        <ul>
        	<li>
                <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#quizDetail">Detail
                </button>
            </li>
            <li>
                <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#takeQuiz">Take Quiz
                </button>
            </li>
        </ul>
    </div>
</div>
<div class="col-lg-3 col-md-6">
    <div class="social-box">
    	<div class="nuzha">
            RK
	    </div>
        <ul>
        	<li>
                <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#quizDetail">Detail
                </button>
            </li>
            <li>
                <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#takeQuiz">Take Quiz
                </button>
            </li>
        </ul>
    </div>
</div>

<!-- .animated -->
<div class="modal fade" id="quizDetail" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mediumModalLabel">Quiz Detail</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table">
                    <tbody >
                        <tr style="border-top-style: hidden;">
                            <td>Mata Kuliah</td>
                            <td>: Manajemen Proyek Perangkat Lunak</td>
                        </tr>
                        <tr>
                            <td>Kelas</td>
                            <td>: A</td>
                        </tr>
                        <tr>
                            <td>Tanggal</td>
                            <td>: 25 April 2019</td>
                        </tr>
                        <tr>
                            <td>Status</td>
                            <td>: <span class="badge badge-pill badge-success">Active</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
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
                <div align="center">
                    <a href="/mahasiswa/test">
                        <button type="button" class="btn btn-primary btn-sm">Enroll Me</button>
                    </a>
                </div>
                
            </div>
        </div>
    </div>
</div>
@endsection