@extends('layouts.dosen')

@section('quiz', 'active')

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
                        @if (\Session::has('create_done'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                              {!! \Session::get('create_done') !!}
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
                                            @for ($i = 1; $i <= count($questions); $i++)
                                                <button type="button" class="mt-2 btn2 btn-light btn-sm" style="height: 30px; width: 40px;">{{$i}}</button>
                                            @endfor
                                        </div>
                                        <hr>
                                        <div class="card-text">
                                            <div class="row">
                                                <div class="col text-center">
                                                    <button href="#form_add" class="btn btn-primary" data-toggle="collapse">Add Question</button>
                                                </div>
                                            </div>  
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
                                        <strong class="card-title mb-3">SOAL {{$i+1}}</strong>
                                    </div>
                                    <div class="card-body">
                                        <div align="left">
                                            {!!$questions[$i]->question_description!!}
                                            A{!! $questions[$i]->option_a!!}
                                            B{!! $questions[$i]->option_b!!} 
                                            @if($questions[$i]->option_c!=null)    
                                                C{!! $questions[$i]->option_c!!}
                                            @endif
                                            @if($questions[$i]->option_d!=null)
                                                D{!! $questions[$i]->option_d!!} 
                                            @endif
                                            @if($questions[$i]->option_e!=null)
                                                E{!! $questions[$i]->option_e!!} 
                                            @endif
                                            
                                        </div>
                                        <hr>
                                        <div class="card-text">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <button href="" class="btn btn-outline-info"><i class="fa fa-chevron-left"></i></button>
                                                </div>
                                                <div class="col-md-3 ml-auto pull-right">
                                                    <button href="" class="btn btn-outline-info" ><i class="fa fa-chevron-right"></i></button>
                                                </div>
                                            </div>  
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        @endfor                 
                    @else
                    <div class="alert alert-warning">
                        <i class="fa fa-exclamation-triangle"></i> Data pertanyaan belum ada
                    </div>
                    <div class="row">
                            <div class="col text-center">
                                <button href="#form_add" class="btn btn-primary" data-toggle="collapse">Add Question</button>
                            </div>
                        </div> 
                    @endif

                    <div class="container">
                                        
                        <div id="form_add" class="collapse">
                            <form action="{{route('questions.store')}}" method="POST" >
                                {{csrf_field()}}
                                <input type="hidden" name="quiz_id" value="{{ $quiz->id }}">
                                <br><br>
                                <div class="form-group col-md-12">
                                    <div class="col col-md-3">
                                        <label class="font-weight-bold" for="">Question</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <input class="form-control question-desc" name="question_description">
                                    </div>
                                </div>
                                <div class="form-group col-md-12">
                                    <div class="col col-md-3">
                                        <label class="font-weight-bold" for="">Choices</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <div class="form-check">
                                            <div class="radio">
                                                <label for="a" class="form-check-label ">
                                                    <input type="radio" name="correct_answer" value="a" class="form-check-input">
                                                    <p class="font-weight-bold">A</p>
                                                    <input type="textarea" class="form-control multiple-choice" placeholder="" name="option_a">
                                                </label>
                                            </div><br>
                                            <div class="radio">
                                                <label for="b" class="form-check-label ">
                                                    <input type="radio" name="correct_answer" value="b" class="form-check-input">
                                                    <p class="font-weight-bold">B</p>
                                                    <input type="textarea" class="form-control multiple-choice" placeholder="" name="option_b">
                                                </label>
                                            </div><br>
                                            <div class="radio">
                                                <label for="c" class="form-check-label ">
                                                    <input type="radio" name="correct_answer" value="c" class="form-check-input">
                                                    <p class="font-weight-bold">C</p>
                                                    <input type="textarea" class="form-control multiple-choice" placeholder="" name="option_c">
                                                </label>
                                            </div><br>
                                            <div class="radio">
                                                <label for="d" class="form-check-label ">
                                                    <input type="radio" name="correct_answer" value="d" class="form-check-input">
                                                    <p class="font-weight-bold">D</p>
                                                    <input type="textarea" class="form-control multiple-choice" placeholder="" name="option_d">
                                                </label>
                                            </div><br>
                                            <div class="radio">
                                                <label for="e" class="form-check-label ">
                                                    <input type="radio" name="correct_answer" value="e" class="form-check-input">
                                                    <p class="font-weight-bold">E</p>
                                                    <input type="textarea" class="form-control multiple-choice" placeholder="" name="option_e">
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-12">
                                    <div class="col col-md-3">
                                        <label class="font-weight-bold" for="">Question Score</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <input type="number" min="0" class="form-control" id="" placeholder="" name="question_score">
                                    </div>
                                </div>
                                <br>
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-lg btn-info btn-block ">Save
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><!-- .animated -->
@endsection
@section('script')
<script type="text/javascript">             
    tinymce.init({
    selector: '.x, .question-desc',
    plugins : 'advlist autolink link image lists charmap print preview',
    relative_urls : false,
    remove_script_host : false,
    convert_urls : true,
    images_upload_handler: function (blobInfo, success, failure) {
           var xhr, formData;
           xhr = new XMLHttpRequest();
           xhr.withCredentials = false;
           xhr.open('POST', '/upload/image/question');
           var token = '{{ csrf_token() }}';
           xhr.setRequestHeader("X-CSRF-Token", token);
           xhr.onload = function() {
               var json;
               if (xhr.status != 200) {
                   failure('HTTP Error: ' + xhr.status);
                   return;
               }
               json = JSON.parse(xhr.responseText);

               if (!json || typeof json.location != 'string') {
                   failure('Invalid JSON: ' + xhr.responseText);
                   return;
               }
               success(json.location);
           };
           formData = new FormData();
           formData.append('file', blobInfo.blob(), blobInfo.filename());
           xhr.send(formData);
       }

  });
</script>
@endsection