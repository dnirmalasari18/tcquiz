@extends('layouts.mahasiswa')

@section('quiz', 'active')

@section('title')
<h1>{{$kuis->nama_kuis}}</h1>
@endsection

@section('breadcrumbs')
<li><a href="/mahasiswa">Dashboard</a></li>
<li><a href="/mahasiswa/quizzes">Quizzes</a></li>
<li class="active">{{$kuis->nama_kuis}}</li>
@endsection

@section('content')

<style type="text/css">
    .nuzha{
        display: none;
    }
</style>

<div class="col-md-9">
    <?php
        $arr = array_map('intval', explode(",", $paket->question_id_list));
        $n = count($arr)-1;
        $quiz = array();
        for ($i=0; $i <$n ; $i++) { 
            $quiz[$i] = $i + 1;
        }
    ?>
    <form action="{{route('submit.quiz')}}" method="POST" id="myForm">

        {{ csrf_field() }}
        {{ method_field('PATCH') }}
        <input type="hidden" name="quiz_id" value="{{$kuis->id}}">
        <input type="hidden" name="end_time" value="{{$paket->id}}">
        <input type="hidden" name="mp_id" value="{{$paket->id}}">
        <input type="hidden" name="jumlah" value="{{count($quiz)}}">
        @foreach($quiz as $q)
            @foreach($test as $t)
                @if($t->id == $arr[$q-1])
                    <div class="card nuzha" id="soal{{$q}}">
                        <div class="card-header">
                            <strong class="card-title">Question {{$q}}</strong>
                            <strong class="card-title" style="float: right; margin-bottom: 0;">Flag</strong>
                            <label class="switch switch-3d switch-warning mr-3" style="float: right; margin-bottom: 0;">
                                <input id="flag{{$q}}" onclick="flagSoal(event, '{{$q}}')" type="checkbox" class="switch-input" name="fl[{{$q}}]" value="1"
                                @if(array_map('intval', explode(",", $paket->question_flag_list))[$q-1]==1)
                                    checked
                                @endif
                                > <span class="switch-label"></span> <span class="switch-handle"></span>
                            </label>
                        </div>
                        <div class="card-body">
                            {!!$t->question_description!!}
                        </div>
                        <div class="card-body">
                            <div style="margin-bottom: 10px;"><strong>Answers</strong></div>
                            <div class="form-check">
                                @if($t->option_1)
                                    <div class="radio">
                                      <label for="" class="form-check-label ">
                                        <input type="radio" id="" name="ans[{{$q}}]" value="1" class="form-check-input"
                                        @if(array_map('intval', explode(",", $paket->user_answer_list))[$q-1]==1)
                                            checked
                                        @endif
                                        >
                                        {!!$t->option_1!!}
                                      </label>
                                    </div>
                                @endif
                                @if($t->option_2)
                                    <div class="radio">
                                      <label for="" class="form-check-label ">
                                        <input type="radio" id="" name="ans[{{$q}}]" value="2" class="form-check-input"
                                        @if(array_map('intval', explode(",", $paket->user_answer_list))[$q-1]==2)
                                            checked
                                        @endif>
                                        {!!$t->option_2!!}
                                      </label>
                                    </div>
                                @endif
                                @if($t->option_3)
                                    <div class="radio">
                                      <label for="" class="form-check-label ">
                                        <input type="radio" id="" name="ans[{{$q}}]" value="3" class="form-check-input"
                                        @if(array_map('intval', explode(",", $paket->user_answer_list))[$q-1]==3)
                                            checked
                                        @endif>
                                        {!!$t->option_3!!}
                                      </label>
                                    </div>
                                @endif
                                @if($t->option_4)
                                    <div class="radio">
                                      <label for="" class="form-check-label ">
                                        <input type="radio" id="" name="ans[{{$q}}]" value="4" class="form-check-input"
                                        @if(array_map('intval', explode(",", $paket->user_answer_list))[$q-1]==4)
                                            checked
                                        @endif>
                                        {!!$t->option_4!!}
                                      </label>
                                    </div>
                                @endif
                                @if($t->option_5)
                                    <div class="radio">
                                      <label for="" class="form-check-label ">
                                        <input type="radio" id="" name="ans[{{$q}}]" value="5" class="form-check-input"
                                        @if(array_map('intval', explode(",", $paket->user_answer_list))[$q-1]==5)
                                            checked
                                        @endif>
                                        {!!$t->option_5!!}
                                      </label>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="card-header" style="border-top: 1px solid rgba(0,0,0,.125);">
                            @if($q==count($quiz))
                                <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#submitQuiz" style="float: right; width: 70px;">Submit</button>
                                @if($q-1>0)
                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" style="width: 70px;" onclick="openSoal(event, '{{$q-1}}')">Previous</button>
                                @endif
                            @else
                                <button type="button" class="btn btn-info btn-sm" style="float: right; width: 70px;" onclick="openSoal(event, '{{$q+1}}')">Next</button>
                                @if($q-1>0)
                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" style="width: 70px;" onclick="openSoal(event, '{{$q-1}}')">Previous</button>
                                @endif
                            @endif
                        </div>
                    </div>
                    <?php
                        break;
                    ?>
                @endif
            @endforeach
        @endforeach

        <div class="modal fade" id="submitQuiz" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg nuzha3" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="mediumModalLabel">Quiz Confirmation</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <style type="text/css">
                            .nuzha4{
                                margin-bottom: 20px;
                            }
                            .nuzha2{
                                width: 75px;
                            }
                        </style>
                        <div class="nuzha4" align="center">
                            Are you sure you want to finish this quiz?
                        </div>
                        <div align="center">
                            <button type="button" class="btn btn-danger btn-sm nuzha2" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-success btn-sm nuzha2">Continue</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </form>
</div>

<style type="text/css">
    .nuzha3{
        max-width: 500px;
    }
</style>

<div class="col-md-3">

    <style type="text/css">
        .card{
            margin-bottom: 0;
        }
        .card-soal{
            margin-bottom: 20px;
        }
        .soal{
            padding-bottom: 0px;
        }
        .row{
            font-size: 10px;
            padding-right: 15px;
            margin-bottom: 15px;
        }
        .col{
            padding-right: 0;
            max-width: 20%;
        }
        .card-body .text-secondary{
            padding: 6px 6px;
            cursor: pointer;
        }
        .soal-aktif{
            background-color: #f2f2f2;
        }
        .soal-ragu{
            background-color: #ffc107;
        }
        .soal-ragu-aktif{
            background-color: #ffc107;
            color: white !important;
        }
    </style>
 <div class="card card-timer">
        <div class="card-header" align="center">
            <h7 class="strong">Time Remaining: </h7>
            <h7><span id="time" style="color:red;"></span></h7>
        </div>
        
    </div>
    <br>
    <div class="card card-soal">
        <div class="card-header" align="center">
            <strong class="card-title">Questions List</strong>
        </div>
        <div class="card-body soal">
            <?php
                $soal = array();
                for ($i=0; $i <$n ; $i++) { 
                    $soal[$i] = $i + 1;
                }
            ?>
            @foreach($soal as $m)
                @if($m%5==1)
                    <div class="row">
                        <div class="col">
                            <section class="card">
                                <div class="card-body text-secondary" onclick="openSoal(event, '{{$m}}')" id="nomer{{$m}}" align="center">{{$m}}</div>
                            </section>
                        </div>
                @else
                        <div class="col">
                            <section class="card">
                                <div class="card-body text-secondary" onclick="openSoal(event, '{{$m}}')" id="nomer{{$m}}" align="center">{{$m}}</div>
                            </section>
                        </div>
                @endif
                @if($m%5==0 || $m==count($soal))
                    </div>
                @endif
            @endforeach
        </div>
       <!--  <div class="card-body timer">
                
                            <td><h8 class="card-title">Time remaining : <span id="time" style="color:red;">{{$durasi}}</span></h8> minutes</td>
                      
        </div>     -->            
    </div>

</div>

<script>
    function openSoal(evt, num) {
        var i, card, soal;
        card = document.getElementsByClassName("card nuzha");
        for (i = 0; i < card.length; i++) {
            card[i].style.display = "none";
        }
        soal = document.getElementsByClassName("card-body text-secondary");
            for (i = 0; i < soal.length; i++) {
                idFlag = soal[i].id;
                idFlag = idFlag.replace("nomer", "flag");
                var x = document.getElementById(idFlag).checked;
                if (x) {
                    soal[i].className = "card-body text-secondary soal-ragu";
                }
                else{
                    soal[i].className = soal[i].className.replace(" soal-aktif", "");
                }
        }
        var id = "soal" + num;
        document.getElementById(id).style.display = "flex";
        idFlag2 = "nomer" + num;
        idFlag2 = idFlag2.replace("nomer", "flag");
        var y = document.getElementById(idFlag2).checked;
        if (y) {
            document.getElementById("nomer"+num).className = "card-body text-secondary soal-ragu-aktif";
        }
        else{
            document.getElementById("nomer"+num).className = "card-body text-secondary soal-aktif";
        }
    }
    function flagSoal(evt, num) {
        var idFlag = "flag" + num;
        var x = document.getElementById(idFlag).checked;
        if (x) {
            var id = "nomer" + num;
            document.getElementById(id).className = "card-body text-secondary soal-ragu-aktif";
        }
        else {
            var id = "nomer" + num;
            document.getElementById(id).className = "card-body text-secondary soal-aktif";
        }
    }
    document.getElementById("nomer1").click();
</script>

@endsection

@section('script')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.5.0/moment.min.js"></script>

<script>
    var start = moment();
    var end = moment('{{ $mp->end_time }}').add({{ $kuis->durasi }}, 'minutes');
    var diff = end.diff(start);

    var duration = moment.duration(diff);

    var interval = 1;
    var timer = setInterval(function() {

      duration = moment.duration(duration.asSeconds() - interval, 'seconds');
      var hour = duration.hours();
      var min = duration.minutes();
      var sec = duration.seconds();

<<<<<<< HEAD
=======
      sec -= 1;
      if (hr < 0 && min != 0){
          hr -= 1;
          min = 59;
      }
      if (hr < 0) return clearInterval(timer);
      if (min < 10 && min.length != 2) min = '0' + min;
      if (sec < 10 && sec.length != 2) sec = '0' + sec;
>>>>>>> cc0573fe2d89012ac3beedefdba435abd5440c38
      if (sec < 0 && min != 0) {
        min -= 1;
        sec = 59;
      }
      if (min < 0 && hour > 0) {
        hour -= 1;
        min = 59;
      }

      if (hour < 10 && hour.length != 2) hour = '0' + hour;
      if (min < 10 && min.length != 2) min = '0' + min;
      if (sec < 10 && sec.length != 2) sec = '0' + sec;

      $('#time').text(hour + ':' + min + ':' + sec);
      if (hour == 0 && min == 0 && sec == 0)
        clearInterval(timer);
    }, 1000);

    $(document).ready(function(){
        $(".form-check-input").click(function() {
            var data = $("#myForm").serialize();
            $.ajax({
                type: "put",
                url: "{{route('submit.quiz.ajax')}}",
                data: data,
                dataType: "json",
                success: function(data) {
                    console.log('success');
                },
                error: function(error) {
                    console.log('error');
                }
            });
        });
        $(".switch-input").click(function() {
            var data = $("#myForm").serialize();
            $.ajax({
                type: "put",
                url: "{{route('submit.quiz.ajax')}}",
                data: data,
                dataType: "json",
                success: function(data) {
                    console.log('success');
                },
                error: function(error) {
                    console.log('error');
                }
            });
        });
    });
    
    
</script>

@endsection