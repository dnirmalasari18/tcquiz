@extends('layouts.dosen')

@section('quiz-list', 'active')

@section('breadcrumbs')
<li><a href="/">Dashboard</a></li>
<li><a href="{{route('quiz.index')}}">Quiz</a></li>
<li class="active">{{ $quiz->nama_kuis }} Questions</li>
@endsection

@section('style')
<style type="text/css">
    .content-body {
      display: none;
    }
</style>
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
                            <a class="btn btn-secondary float-right" href="/dosen/quiz/{{$quiz->id}}/#tab_question" role="button">Back</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="col-md-12">
                        @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show">
                          <ul>
                              @foreach ($errors->all() as $error)
                                  <li>{{ $error }}</li>
                              @endforeach
                          </ul>
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                          </button> 
                        </div>
                        @endif
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
                            <form action="{{route('questions.update', $questions->id)}}" method="POST" id="question_form">
                                <input name="_method" type="hidden" value="PATCH">
                                {{csrf_field()}}
                                <div class="form-group col-md-12">
                                    <div class="col col-md-3">
                                        <label class="font-weight-bold">Question</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <div class="loading">
                                            <img src="{{asset('img/spinner.gif')}}" width="60px">
                                        </div>
                                        <div class="content-body" style="display: none">
                                            <input class="form-control question-desc" name="question_description" id="question-desc" value="{{ $questions->question_description }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-12">
                                    <div class="col col-md-3">
                                        <label class="font-weight-bold">Choices</label>
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
                                                    <div class="loading">
                                                        <img src="{{asset('img/spinner.gif')}}" width="60px">
                                                    </div>
                                                    <div class="content-body" style="display: none">
                                                        <input type="textarea" class="form-control multiple-choice" id="option_a" name="option_1" value="{{ $questions->option_1 }}">
                                                    </div>
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
                                                    <div class="loading">
                                                        <img src="{{asset('img/spinner.gif')}}" width="60px">
                                                    </div>
                                                    <div class="content-body" style="display: none">
                                                        <input type="textarea" class="form-control multiple-choice" id="option_b" name="option_2" value="{{ $questions->option_2 }}">
                                                    </div>
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
                                                    <div class="loading">
                                                        <img src="{{asset('img/spinner.gif')}}" width="60px">
                                                    </div>
                                                    <div class="content-body" style="display: none">
                                                        <input type="textarea" class="form-control multiple-choice"  id="option_c" name="option_3" value="{{ $questions->option_3 }}">
                                                    </div>
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
                                                    <div class="loading">
                                                        <img src="{{asset('img/spinner.gif')}}" width="60px">
                                                    </div>
                                                    <div class="content-body" style="display: none">
                                                        <input type="textarea" class="form-control multiple-choice"  id="option_d" name="option_4" value="{{ $questions->option_4 }}">
                                                    </div>
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
                                                    <div class="loading">
                                                        <img src="{{asset('img/spinner.gif')}}" width="60px">
                                                    </div>
                                                    <div class="content-body" style="display: none">
                                                        <input type="textarea" class="form-control multiple-choice" id="option_e" name="option_5" value="{{ $questions->option_5 }}">
                                                    </div>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-12">
                                    <div class="col col-md-3">
                                        <label class="font-weight-bold" >Question Score</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <div class="loading">
                                            <img src="{{asset('img/spinner.gif')}}" width="60px">
                                        </div>
                                        <div class="content-body" style="display: none">
                                            <input type="number" min="0" class="form-control" id="score" name="question_score" value="{{ $questions->question_score }}">
                                        </div>
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
(function($) {
    setTimeout(function () {
        $(".loading").html("");
        $(".content-body").fadeIn(1000);
    }, 900);

    $("#question_form").submit(function(e) {   
        const val = tinyMCE.get('question-desc').getContent();
        const question_score = document.getElementById("score").value;
        const option_a = tinyMCE.get('option_a').getContent();
        const option_b = tinyMCE.get('option_b').getContent();
        const option_c = tinyMCE.get('option_c').getContent();
        const option_d = tinyMCE.get('option_d').getContent();
        const option_e = tinyMCE.get('option_e').getContent();

        if(val == "") {
            swal("Question description cannot be empty!");
            return false;
        }
        if(option_a == "") {
            swal("Choice A cannot be empty!");
            return false;
        }
        if(option_b == "") {
            swal("Choice B cannot be empty!");
            return false;
        }
        if(question_score == "") {
            swal("Question score cannot be empty!");
            return false;
        }

        if(question_score == "") {
            swal("Question score cannot be empty!");
            return false;
        }

        let $correct_answer = $("input[name='correct_answer']:checked").val();
        console.log($correct_answer);        
        if($correct_answer === undefined){
            swal("Correct answer cannot be empty!");
            return false;
        }

        if ($correct_answer == 3 ) {
            if (option_c == "") {
                swal("Choice C cannot be empty!");
                return false;
            }
        }
        else if ($correct_answer == 4 ) {
            if (option_d == "") {
                swal("Choice D cannot be empty!");
                return false;
            }
        }
        else if ($correct_answer == 5 ) {
            if (option_e == "") {
                swal("Choice E cannot be empty!");
                return false;
            }
        }
    });
})(jQuery);
</script>
@endsection