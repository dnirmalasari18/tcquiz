@extends('layouts.dosen')

@section('quiz-list', 'active')

@section('breadcrumbs')
<li><a href="#">Dashboard</a></li>
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
                            <a class="btn btn-secondary float-right" href="/dosen/quiz" role="button">Back</a>
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
                        @if (\Session::has('create_done'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {!! \Session::get('create_done') !!}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>                                    
                            </div>
                        @endif
                    </div>
                    <div class="container">  
                        <form action="{{route('questions.store')}}" method="POST" id="question_form">
                            {{csrf_field()}}
                            <input type="hidden" name="quiz_id" value="{{ $quiz->id }}">
                            <div class="form-group col-md-12">
                                <div class="col col-md-3">
                                    <label class="font-weight-bold" for="">Question</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <div class="loading">
                                        <img src="{{asset('img/spinner.gif')}}" width="60px">
                                    </div>
                                    <div class="content-body" style="display: none">
                                        <div class="form-check">
                                            <input type="textarea" class="form-control question-desc" name="question_description" id="question-desc">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <div class="col col-md-3">
                                    <label class="font-weight-bold" for="">Choices</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <div class="form-check choices">
                                        <input type="radio" name="correct_answer" value="1" class="form-check-input">
                                        <p class="font-weight-bold">A</p>
                                        <div class="loading">
                                            <img src="{{asset('img/spinner.gif')}}" width="60px">
                                        </div>
                                        <div class="content-body">
                                            <input type="textarea" id="option_a" class="form-control multiple-choice" name="option_1">    
                                        </div>
                                      
                                        <input type="radio" name="correct_answer" value="2" class="form-check-input">
                                        <p class="font-weight-bold">B</p>
                                        <div class="loading">
                                            <img src="{{asset('img/spinner.gif')}}" width="60px">
                                        </div>
                                        <div class="content-body">
                                            <input type="textarea" id="option_b" class="form-control multiple-choice" name="option_2">    
                                        </div>
                                        
                                        <div class="pil_3" style="display: none">
                                            <input type="radio" name="correct_answer" value="3" class="form-check-input">
                                            <p class="font-weight-bold">C</p>
                                            <div class="content-body">
                                                <input type="textarea" class="form-control multiple-choice" placeholder="" name="option_3">
                                            </div>
                                        </div> 

                                        <div class="pil_4" style="display: none">
                                            <input type="radio" name="correct_answer" value="4" class="form-check-input">
                                            <p class="font-weight-bold">D</p>
                                            <div class="loading">
                                                <img src="{{asset('img/spinner.gif')}}" width="60px">
                                            </div>
                                            <div class="content-body">
                                                <input type="textarea" class="form-control multiple-choice" placeholder="" name="option_4">
                                            </div>
                                        </div>     

                                        <div class="pil_5" style="display: none">
                                            <input type="radio" name="correct_answer" value="5" class="form-check-input">
                                            <p class="font-weight-bold">E</p>
                                            <div class="content-body">
                                                <input type="textarea" class="form-control multiple-choice" placeholder="" name="option_5">
                                            </div>                             
                                        </div>
                                    </div><br>
                                    <div class="text-right">
                                        <button class="btn btn-sm btn-primary" type="button" id="add-more">Add More Option</button>
                                        <button class="btn btn-sm btn-danger" type="button" id="delete-option">Delete Option</button>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <div class="col col-md-3">
                                    <label class="font-weight-bold" for="">Question Score</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="number" min="0" id="score" class="form-control" name="question_score">
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
    $("#question_form").submit(function(e) {   
        const val = tinyMCE.get('question-desc').getContent();
        const question_score = document.getElementById("score").value;
        const option_a = tinyMCE.get('option_a').getContent();
        const option_b = tinyMCE.get('option_b').getContent();
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
        //console.log(val)
    });
    setTimeout(function () {
        $(".loading").html("");
        $(".content-body").fadeIn(1000);
    }, 900);

    let level = 2;

    $("#add-more").click(function() {
        if ((level) == 5){
            swal("The maximum number of choices is 5!");
        }
        if (level < 5) {
            level++;
            $(`.pil_${level}`).fadeIn(500);       
        }
        console.log(level);
    });

    $("#delete-option").click(function() {
        if ((level) == 2){
            swal("The minimum number of choices is 2!");
        }
        if ((level) > 2) {
            $(`.pil_${level}`).fadeOut(100);
            level--;
        }
        console.log(level);
    });
})(jQuery);    
</script>
@endsection