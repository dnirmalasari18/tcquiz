@extends('layouts.dosen')

@section('dashboard', 'active')

@section('breadcrumbs')
<li><a href="/">Dashboard</a></li>
@endsection
<?php 
	$currentTime = Carbon\Carbon::today();
?>
@section('content')
<div class="row">
	@if(count($quiz))
		@foreach($quiz as $q)
			<div class="col-md-4">
			    <div class="card">
			        <div class="card-header bg-dark text-light text-center">
			            <h5>{{$q->nama_kuis}}</h5>
			            <h6>{{$q->pertemuanke->agenda->singkatAgenda}}</h6>
			        </div>
			        <div class="card-body" align="center">
			            <div class="mx-auto d-block">
			            	<h6>{{ date('d M y', strtotime($q->pertemuanke->tglPertemuan)) }}, {{$q->durasi}} minute(s) </h6>
			                <p>{{ count( $q->quiz )}} question(s)</p>
			                @if($q->pertemuanke->tglPertemuan == $currentTime->toDateString())
			                	<p>{{$q->pertemuanke->waktuMulai}} - {{$q->pertemuanke->waktuSelesai}}</p>
			                @elseif($q->pertemuanke->tglPertemuan < $currentTime)
			                	<p>{{ $currentTime->diffInDays($q->pertemuanke->tglPertemuan) }} day(s) ago </p>
			                
			                @else
			                	<p>{{ $currentTime->diffInDays($q->pertemuanke->tglPertemuan) }} day(s) left until quiz</p>
			                @endif
			                
			            </div>
			            <hr>
			            @if ($q->finalize_status=='0')
			            	<div class="card-text text-sm-center">
			            	    <a href="{{route('quiz.show',$q->id)}}" role="button" class="btn btn-sm btn-danger">Finalize Now</a>
			            	</div>
			            @else
			            	<div class="card-text text-sm-center">
			            	    <a href="{{route('quiz.show',$q->id)}}" role="button" class="btn btn-sm btn-info">Summary</a>
			            	</div>
			            @endif
			            
			        </div>
			    </div>
			</div>
		@endforeach
	@else
	<div class="content mt-3" align="center">
		<h1>Welcome to TCQUIZ!</h1><br>
		<h3>Make a quiz here</h3><br>
		<a href="{{route('quiz.create')}}" role="button" class="btn btn-primary">Make Quiz</a>
	</div>
		
	@endif
</div>
@endsection