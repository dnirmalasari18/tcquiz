@extends('layouts.dosen')

@section('quiz', 'active')

@section('breadcrumbs')
<li><a href="#">Dashboard</a></li>
<li><a href="#">Quiz</a></li>
<li class="active">Create a Quiz</li>
@endsection

@section('content')
<div class="animated fadeIn">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-white">
                    <div class="row">
                        <div class="col">
                            <h3 class="m-0">Add Quiz</h3>
                        </div>
                        <div class="col ">
                            <a class="btn btn-secondary float-right" href="/dosen/quiz-list" role="button">Back</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                	<form action="" method="POST" accept-charset="UTF-8">
                		<div class="form-group col-md">
                	        <label class="font-weight-bold" for="">Nama Kuis</label>
                	        <input type="text" class="form-control" id="" placeholder="" name="">
                	    </div>
                	    <div class="form-group col-md">
                	        <label class="font-weight-bold" for="">Kelas</label>
                	        <select class="form-control">
                	            <option>Manajemen Proyek Perangkat Lunak - A</option>
                	            <option>Pemrograman Berbasis Kerangka Kerja - F</option>
                	            <option>Rekayasa Kebutuhan - B</option>
                	        </select>
                	    </div>
                	    <div class="form-group col-md-4">
                	        <label class="font-weight-bold" for="">Ruangan</label>
                	        <select class="form-control">
                	            <option>IF-101</option>
                	            <option>IF-102</option>
                	            <option>IF-103</option>
                	        </select>
                	    </div>
                	    <div class="form-group col-md-4">
                	        <label class="font-weight-bold" for="">Tanggal</label>
                	        <input type="date" class="form-control" id="" placeholder="" name="">
                	    </div>
                	    <div class="form-group col-md-4">
                	    	<label class="font-weight-bold" for="">Durasi</label>
                	        <div class="input-group">
                	            <input type="number" id="" name="" placeholder="" class="form-control">
                	            <div class="input-group-addon">Menit</div>
                	        </div>
                	    </div>
                	    <div class="form-group col-md">
                	        <label class="font-weight-bold" for="">Terms & Conditions</label>
                	        <input type="textarea" class="form-control" id="" placeholder="" name="">
                	    </div>
                	    <br>
                	    <div class="col-md-12">
                	        <button id="" type="submit" class="btn btn-lg btn-info btn-block ">
                	            Save
                	        </button>
                	    </div>
                	</form>
                </div>
            </div>
        </div>
    </div>
</div><!-- .animated -->
@endsection