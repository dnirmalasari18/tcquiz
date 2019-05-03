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
                            <a class="btn btn-secondary float-right" href="/dosen/quiz/{{$quiz->id}}/questions" role="button">Back</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="col-md-12">
                        @if (\Session::has('update_done'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                              {!! \Session::get('update_done') !!}
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>                                    
                            </div>
                        @endif
                    </div>
                    <div class="container">
                        <div id="form_add" >
                            <form action="{{route('questions.update', $questions->id)}}" method="POST" >
                                <input name="_method" type="hidden" value="PATCH">
                                {{csrf_field()}}
                                <div class="form-group col-md-12">
                                    <div class="col col-md-3">
                                        <label class="font-weight-bold" for="">Question</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <input class="form-control question-desc" name="question_description" value="{{ $questions->question_description }}">
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
                                                    @if($questions->correct_answer==1)
                                                    <input type="radio" name="correct_answer" value="1" class="form-check-input" checked>
                                                    @else
                                                    <input type="radio" name="correct_answer" value="1" class="form-check-input" >
                                                    @endif
                                                    <p class="font-weight-bold">A</p>
                                                    <input type="textarea" class="form-control multiple-choice" placeholder="" name="option_a" value="{{ $questions->option_a }}">
                                                </label>
                                            </div><br>
                                            <div class="radio">
                                                <label for="b" class="form-check-label ">
                                                    @if($questions->correct_answer==2)
                                                    <input type="radio" name="correct_answer" value="2" class="form-check-input" checked>
                                                    @else
                                                    <input type="radio" name="correct_answer" value="2" class="form-check-input">
                                                    @endif
                                                    <p class="font-weight-bold">B</p>
                                                    <input type="textarea" class="form-control multiple-choice" placeholder="" name="option_b" value="{{ $questions->option_b }}">
                                                </label>
                                            </div><br>
                                            <div class="radio">
                                                <label for="c" class="form-check-label ">
                                                    @if($questions->correct_answer==3)
                                                    <input type="radio" name="correct_answer" value="3" class="form-check-input" checked>
                                                    @else
                                                    <input type="radio" name="correct_answer" value="3" class="form-check-input">
                                                    @endif
                                                    <p class="font-weight-bold">C</p>
                                                    <input type="textarea" class="form-control multiple-choice" placeholder="" name="option_c" value="{{ $questions->option_c }}">
                                                </label>
                                            </div><br>
                                            <div class="radio">
                                                <label for="d" class="form-check-label ">
                                                    @if($questions->correct_answer==4)
                                                    <input type="radio" name="correct_answer" value="4" class="form-check-input" checked>
                                                    @else
                                                    <input type="radio" name="correct_answer" value="4" class="form-check-input">
                                                    @endif
                                                    <p class="font-weight-bold">D</p>
                                                    <input type="textarea" class="form-control multiple-choice" placeholder="" name="option_d" value="{{ $questions->option_d }}">
                                                </label>
                                            </div><br>
                                            <div class="radio">
                                                <label for="e" class="form-check-label ">
                                                    @if($questions->correct_answer==5)
                                                    <input type="radio" name="correct_answer" value="5" class="form-check-input" checked>
                                                    @else
                                                    <input type="radio" name="correct_answer" value="5" class="form-check-input">
                                                    @endif
                                                    <p class="font-weight-bold">E</p>
                                                    <input type="textarea" class="form-control multiple-choice" placeholder="" name="option_e" value="{{ $questions->option_e }}">
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
                                        <input type="number" min="0" class="form-control" id="" placeholder="" name="question_score" value="{{ $questions->question_score }}">
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
    selector: '.multiple-choice, .question-desc',
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