@extends('layouts.dosen')

@section('dashboard', 'active')

@section('breadcrumbs')
<li><a href="#">Dashboard</a></li>
@endsection

@section('content')
<div class="row">

    <div class="col-md-4">
        <div class="card">
            <div class="card-header bg-dark text-light text-center">
                <h5>Kuis Controller</h5>
                <h6>PBKK I</h6>
            </div>
            <div class="card-body">
                <div class="mx-auto d-block">
                	<p>10 Mei 2019, 60 minutes</p>
                    <p>40 questions</p>
                </div>
                <hr>
                <div class="card-text text-sm-center">
                    <a href="" role="button" class="btn btn-sm btn-primary">Details</a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-header bg-dark text-light text-center">
                <h5>Kuis View</h5>
                <h6>PBKK F</h6>
            </div>
            <div class="card-body">
                <div class="mx-auto d-block">
                	<p>10 Mei 2019, 60 minutes</p>
                    <p>40 questions</p>
                </div>
                <hr>
                <div class="card-text text-sm-center">
                    <a href="" role="button" class="btn btn-sm btn-danger">Finalize Now</a>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection