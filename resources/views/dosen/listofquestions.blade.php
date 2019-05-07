@extends('layouts.dosen')

@section('quiz-list', 'active')

@section('breadcrumbs')
<li><a href="#">Dashboard</a></li>
<li><a href="{{route('quiz.index')}}">Quiz</a></li>
<li class="active">{{ $quiz->nama_kuis }} Questions</li>
@endsection

@section('content')
<div class="animated fadeIn">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-white">
                    <div class="row">
                        <div class="col">
                            <h3 class="m-0">{{ $quiz->nama_kuis }}</h3>
                        </div>
                        <div class="col ">
                            <a class="btn btn-secondary float-right" href="/dosen/quiz" role="button">Back</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="col-md-12">
                        @if (\Session::has('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                              {!! \Session::get('success') !!}
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>                                    
                            </div>
                        @endif
                    </div>
                    <div class="col-md-12">
                        @if (\Session::has('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                              {!! \Session::get('error') !!}
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>                                    
                            </div>
                        @endif
                    </div>
                    @if(count($questions))
                        <div class="">
                            <div class="col-md-4 float-right">
                                <div class="card">
                                    <div class="card-header text-center">
                                        <strong class="card-title mb-3">PANEL SOAL</strong>
                                    </div>
                                    <div class="card-body">
                                        <div align="left">
                                            @for ($i = 1; $i <= $questions->total(); $i++)
                                                @if($questions->currentPage()==$i)
                                                    <a href="?page={{$i}}" class="mt-2 btn2 btn-info btn-sm" style="height: 30px; width: 40px;">{{$i}}</a>
                                                @else
                                                    <a href="?page={{$i}}" class="mt-2 btn2 btn-light btn-sm" style="height: 30px; width: 40px;">{{$i}}</a>
                                                @endif
                                            @endfor
                                        </div>
                                        <hr>
                                        <div class="card-text" >
                                            @if ($quiz->finalize_status=='0')
                                            <div class="row">
                                                <div class="col text-center">
                                                    <a href="{{route('createquestion', $quiz->id)}}" class="btn btn-primary" style="width: 150px;">Add Question</a>
                                                </div>
                                            </div>
                                            
                                            <div class="row">
                                                <div class="col text-center">
                                                    <a href="{{route('generatepacket', $quiz->id)}}" class="btn btn-danger" style="width: 150px;">Finalize Questions</a>
                                                </div>
                                            </div>
                                            @else
                                            <div class="row">
                                                <div class="col text-center">
                                                    <a class="btn btn-light " disabled="disabled" style="width: 150px;">Already Finalized</a>
                                                </div>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @for ($i = 0; $i < count($questions); $i++)
                        <div class="">
                            <div class="col-md-8 float-left">
                                <div class="card">
                                    <div class="card-header text-center">
                                        <strong class="card-title mb-3">SOAL {{$questions->currentPage()}}</strong>
                                        @if($quiz->finalize_status=='0')
                                        
                                        <form class="delete-form" method="POST" action="{{ route('questions.destroy', $questions[$i]->id) }}" accept-charset="UTF-8">
                                            <input name="_method" type="hidden" value="Delete">
                                            <input name="_token" type="hidden" value="{{ csrf_token() }}">
                                            <input type="button" class="btn btn-sm btn-danger delete-btn float-right" value="Delete">
                                        </form>

                                        <a class="btn btn-sm btn-warning float-right" href="{{route('editquestion', [$quiz->id, $questions[$i]->id])}}" role="button">Edit</a>
                                        @endif
                                        
                                    </div>
                                    <div class="card-body">
                                        <div align="left">
                                            {!!$questions[$i]->question_description!!}
                                            @if($questions[$i]->correct_answer==1)
                                                <mark style="background-color: green; color: white;">A</mark>
                                            @else
                                                A
                                            @endif
                                            {!! $questions[$i]->option_1!!}

                                            @if($questions[$i]->correct_answer==2)
                                                <mark style="background-color: green; color: white;">B</mark>
                                            @else
                                                B
                                            @endif
                                            {!! $questions[$i]->option_2!!} 
                                           
                                            @if($questions[$i]->option_3!=null)    
                                                @if($questions[$i]->correct_answer==3)
                                                    <mark style="background-color: green; color: white;">C</mark>
                                                @else
                                                C
                                                @endif
                                                {!! $questions[$i]->option_3!!}
                                            @endif
                                            @if($questions[$i]->option_4!=null)    
                                                @if($questions[$i]->correct_answer==4)
                                                    <mark style="background-color: green; color: white;">D</mark>
                                                @else
                                                D
                                                @endif
                                                {!! $questions[$i]->option_4!!}
                                            @endif
                                            @if($questions[$i]->option_5!=null)    
                                                @if($questions[$i]->correct_answer==5)
                                                    <mark style="background-color: green; color: white;">E</mark>
                                                @else
                                                E
                                                @endif
                                                {!! $questions[$i]->option_5!!}
                                            @endif
                                        </div>
                                        <hr>
                                        <div class="card-text">
                                            <div class="row">
                                                <div class="col-md">
                                                    @if($questions->currentPage()!=1)
                                                        <a href="{{$questions->previousPageUrl()}}" class="btn btn-outline-info"><i class="fa fa-chevron-left"></i></a>
                                                    @endif
                                                </div>
                                                <div class="col-md-10" align="right">
                                                    @if($questions->currentPage()!=$questions->total())
                                                        <a href="{{$questions->nextPageurl()}}" class="btn btn-outline-info" ><i class="fa fa-chevron-right"></i></a>
                                                    @endif
                                                </div>
                                            </div>  
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        @endfor
                    @else
                    <div class="col-md-12">
                        <div class="alert alert-warning">
                            <i class="fa fa-exclamation-triangle"></i> There is no question(s).
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="col text-center">
                            <a href="{{route('createquestion', $quiz->id)}}" class="btn btn-primary">Add Question</a>
                        </div>
                        </div> 
                    @endif
                </div>
            </div>
        </div>
    </div>
</div><!-- .animated -->

@endsection

@section('script')
<script>
(function($) {

function deleteQuestion() {
  swal({
  title: "Are you sure?",
  text: "Once deleted, you will not be able to recover this question!",
  icon: "warning",
  buttons: true,
  dangerMode: true,
})
.then((willDelete) => {
  if (willDelete) {
    $(".delete-form").submit();
     swal("Question has been deleted!", {
      icon: "success",
    });
  }
});
}
    $(".delete-btn").click(function() {
      deleteQuestion();
});

    
})(jQuery);
</script>
@endsection