@extends('layouts.mahasiswa')

@section('dashboard', 'active')

@section('title')
<h1>Test</h1>
@endsection

@section('breadcrumbs')
<li><a href="#">Dashboard</a></li>
<li><a href="#">Quizzes</a></li>
<li class="active">PBKK</li>
@endsection

@section('content')
<div class="col-md-9">
    <div class="card">
        <div class="card-header">
            <strong class="card-title">Soal 25</strong>
            <strong class="card-title" style="float: right; margin-bottom: 0;">Flag</strong>
            <label class="switch switch-3d switch-warning mr-3" style="float: right; margin-bottom: 0;"><input type="checkbox" class="switch-input" checked="false"> <span class="switch-label"></span> <span class="switch-handle"></span></label>
        </div>
        <div class="card-body">
            Are you on the hunt for a free general knowledge quiz for your pub, party, social or school group? Look no further! The following quiz questions are suitable for all age groups and range from easy to profoundly thought-provoking, covering a wide range of topics so everyone can join in the fun.
        </div>
        <div class="card-body">
            <div style="margin-bottom: 10px;"><strong>Jawaban</strong></div>
            <div class="form-check">
                <div class="radio">
                  <label for="radio1" class="form-check-label ">
                    <input type="radio" id="radio1" name="radios" value="option1" class="form-check-input">
                    Option 1
                  </label>
                </div>
                <div class="radio">
                  <label for="radio2" class="form-check-label ">
                    <input type="radio" id="radio2" name="radios" value="option2" class="form-check-input">Option 2
                  </label>
                </div>
                <div class="radio">
                  <label for="radio3" class="form-check-label ">
                    <input type="radio" id="radio3" name="radios" value="option3" class="form-check-input">Option 3
                  </label>
                </div>
                <div class="radio">
                  <label for="radio3" class="form-check-label ">
                    <input type="radio" id="radio3" name="radios" value="option3" class="form-check-input">Option 4
                  </label>
                </div>
                <div class="radio">
                  <label for="radio3" class="form-check-label ">
                    <input type="radio" id="radio3" name="radios" value="option3" class="form-check-input">Option 5
                  </label>
                </div>
              </div>
        </div>
        <div class="card-header" style="border-top: 1px solid rgba(0,0,0,.125);">
            <button type="button" class="btn btn-info btn-sm" data-toggle="modal" style="width: 70px;">Previous</button>
            <a class="btn btn-success btn-sm" id="btn-confirm" href="/mahasiswa/result" data-toggle="confirmation" style="float: right; width: 70px;">Submit</a>
        </div>
    </div>
</div>
<!-- modal fade -->
<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="mi-modal">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Are you sure want to terminate?</h4>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" id="modal-btn-si">Yes</button>
        <button type="button" class="btn btn-primary" id="modal-btn-no">No</button>
      </div>
    </div>
  </div>
</div>
<!-- modal fade end -->
<div class="alert" role="alert" id="result"></div>

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
    <div class="card card-soal">
        <div class="card-header" align="center">
            <strong class="card-title">Daftar Soal</strong>
        </div>
        <div class="card-body soal">
            <div class="row">
                <div class="col">
                    <section class="card">
                        <div class="card-body text-secondary" align="center">1</div>
                    </section>
                </div>
                 <div class="col">
                    <section class="card">
                        <div class="card-body text-secondary" align="center">2</div>
                    </section>
                </div>
                 <div class="col">
                    <section class="card">
                        <div class="card-body text-secondary" align="center">3</div>
                    </section>
                </div>
                 <div class="col">
                    <section class="card">
                        <div class="card-body text-secondary" align="center">4</div>
                    </section>
                </div>
                 <div class="col">
                    <section class="card">
                        <div class="card-body text-secondary" align="center">5</div>
                    </section>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <section class="card">
                        <div class="card-body text-secondary" align="center">6</div>
                    </section>
                </div>
                 <div class="col">
                    <section class="card">
                        <div class="card-body text-secondary" align="center">7</div>
                    </section>
                </div>
                 <div class="col">
                    <section class="card">
                        <div class="card-body text-secondary" align="center">8</div>
                    </section>
                </div>
                 <div class="col">
                    <section class="card">
                        <div class="card-body text-secondary" align="center">9</div>
                    </section>
                </div>
                 <div class="col">
                    <section class="card">
                        <div class="card-body text-secondary" align="center">10</div>
                    </section>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <section class="card">
                        <div class="card-body text-secondary" align="center">11</div>
                    </section>
                </div>
                 <div class="col">
                    <section class="card">
                        <div class="card-body text-secondary" align="center">12</div>
                    </section>
                </div>
                 <div class="col">
                    <section class="card">
                        <div class="card-body text-secondary" align="center">13</div>
                    </section>
                </div>
                 <div class="col">
                    <section class="card">
                        <div class="card-body text-secondary soal-ragu" align="center">14</div>
                    </section>
                </div>
                 <div class="col">
                    <section class="card">
                        <div class="card-body text-secondary" align="center">15</div>
                    </section>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <section class="card">
                        <div class="card-body text-secondary" align="center">16</div>
                    </section>
                </div>
                 <div class="col">
                    <section class="card">
                        <div class="card-body text-secondary" align="center">17</div>
                    </section>
                </div>
                 <div class="col">
                    <section class="card">
                        <div class="card-body text-secondary soal-ragu" align="center">18</div>
                    </section>
                </div>
                 <div class="col">
                    <section class="card">
                        <div class="card-body text-secondary" align="center">19</div>
                    </section>
                </div>
                 <div class="col">
                    <section class="card">
                        <div class="card-body text-secondary" align="center">20</div>
                    </section>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <section class="card">
                        <div class="card-body text-secondary" align="center">21</div>
                    </section>
                </div>
                 <div class="col">
                    <section class="card">
                        <div class="card-body text-secondary" align="center">22</div>
                    </section>
                </div>
                 <div class="col">
                    <section class="card">
                        <div class="card-body text-secondary" align="center">23</div>
                    </section>
                </div>
                 <div class="col">
                    <section class="card">
                        <div class="card-body text-secondary" align="center">24</div>
                    </section>
                </div>
                 <div class="col">
                    <section class="card">
                        <div class="card-body text-secondary soal-aktif" align="center">25</div>
                    </section>
                </div>
            </div>
        </div>                
    </div>
    Registration closes in <span id="time">{{ $durasi }}</span> minutes!

</div>

@endsection


<script>
function startTimer(duration, display) {
    var timer = duration, minutes, seconds;
    setInterval(function () {
        minutes = parseInt(timer / 60, 10)
        seconds = parseInt(timer % 60, 10);

        minutes = minutes < 10 ? "0" + minutes : minutes;
        seconds = seconds < 10 ? "0" + seconds : seconds;

        display.text(minutes + ":" + seconds);

        if (--timer < 0) {
            timer = duration;
        }
    }, 1000);
}

jQuery(function ($) {
    var now = new Date();
    var time = now.getHours() + ":" + now.getMinutes() + ":" + now.getSeconds();
    var start_sec = 0;
    start_sec = start_sec + now.getHours() * 3600;
    start_sec = start_sec + now.getMinutes() * 60;
    start_sec = start_sec + now.getSeconds();

    var end = new Date('16');
    var time = now.getHours() + ":" + now.getMinutes() + ":" + now.getSeconds();
    var end_sec = 0;
    end_sec = end_sec + 17 * 3600;
    end_sec = end_sec + 0 * 60;
    end_sec = end_sec + 0;
    durations = end_sec - start_sec;
    var fiveMinutes = 60 * 5,
        display = $('#time');
    startTimer(durations, display);
});
</script>