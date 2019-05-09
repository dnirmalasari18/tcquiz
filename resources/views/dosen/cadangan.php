@extends('layouts.dosen')

@section('quiz-list', 'active')

@section('breadcrumbs')
<li><a href="#">Dashboard</a></li>
<li><a href="#">Quiz</a></li>
<li class="active">{{$kuis->nama_kuis}}</li>
@endsection

@section('content')
@foreach($participants as $p)
<div class="modal fade" id="participant-detail-{{ $p->id }}" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mediumModalLabel">Participant Detail</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table">
                    <tbody >
                        <tr>
                            <td>NRP</td>
                            <td>: {{ $p->user->username }}</td>
                        </tr>
                        <tr>
                            <td>Nama</td>
                            <td>: {{ $p->user->name }}</td>
                        </tr>
                        <tr>
                            <td>ID Paket Kuis</td>
                            <td>: {{ $p->paketkuis->id }}</td>
                        </tr>
                        <tr>
                            <td>Detail Paket Kuis</td>
                            <td>: {{ $p->paketkuis->question_id_list }}</td>
                        </tr>
                        <tr>
                            <td>Nilai Kuis</td>
                            <td>: {{ $p->quiz_score }}</td>
                        </tr>
                        <tr>
                            <td>Tanggal Ambil Kuis</td>
                            <td>: {{ $p->end_time }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endforeach
<div class="animated fadeIn">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-white">
                    <div class="row">
                        <div class="col">
                            <h3 class="m-0">{{$kuis->nama_kuis}}</h3>
                        </div>
                        <div class="col ">
                            <a class="btn btn-secondary float-right" href="/dosen/quiz" role="button">Back</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">

                    <div class="default-tab">
                        <nav>
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                <a class="nav-item nav-link active" id="nav-info-tab" data-toggle="tab" href="#nav-info" role="tab" aria-controls="nav-info" aria-selected="true">Info</a>
                                <a class="nav-item nav-link" id="nav-question-tab" data-toggle="tab" href="#nav-question" role="tab" aria-controls="nav-question" aria-selected="false">Questions List</a>
                                <a class="nav-item nav-link" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="false">Participants</a>
                                <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Quiz Summary</a>
                            </div>
                        </nav>
                        <div class="tab-content pl-3 pt-2" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-info" role="tabpanel" aria-labelledby="nav-info-tab">
                                @if($kuis->finalize_status=='0')
                                    <form action="{{route('quiz.update', $kuis->id)}}" method="POST">
                                        <input name="_method" type="hidden" value="PATCH">
                                        {{csrf_field()}}
                                        <div class="form-group col-md-6">
                                            <label class="font-weight-bold" for="">Quiz Name</label>
                                            <input type="text" class="form-control" id="" placeholder="" name="nama_kuis" value="{{ $kuis->nama_kuis }}" required>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="font-weight-bold" for="">Duration</label>
                                            <div class="input-group">
                                                <input type="number" id="" name="durasi" placeholder="" class="form-control" value="{{ $kuis->durasi }}" required>
                                                <div class="input-group-addon">Minute(s)</div>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="font-weight-bold" for="">Class</label>
                                                <select class="form-control kelas-select" value="" required>  
                                                @foreach ($agenda as $a)
                                                    @if($kuis->pertemuanke->agenda->idAgenda == $a->idAgenda)
                                                        <option selected value="{{ $a->idAgenda }}">{{ $a->namaAgenda }}</option>  
                                                    @else
                                                        <option value="{{ $a->idAgenda }}">{{ $a->namaAgenda }}</option>
                                                    @endif
                                                @endforeach
                                                </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="font-weight-bold" for="" >Schedule</label>
                                            <select class="form-control jadwal-select" name="absenkuliah_id" value="{{ $kuis->absenkuliah_id }}" required>
                                                @foreach($jadwals as $j)      
                                                    @if($j->id ==  $kuis->absenkuliah_id)
                                                        <option selected value="{{$j->id}}">Pertemuan ke-{{$j->pertemuanKe}} | {{$j->tglPertemuan}}</option>
                                                    @else 
                                                        <option value="{{$j->id}}">Pertemuan ke-{{$j->pertemuanKe}} | {{$j->tglPertemuan}}</option>
                                                    @endif                                
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="font-weight-bold">Start Time</label>
                                            <fieldset class="form-control waktumulai-select" disabled>{{ $kuis->pertemuanke->waktuMulai }}</fieldset>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="font-weight-bold">End Time</label>
                                            <fieldset class="form-control waktuselesai-select" disabled>{{ $kuis->pertemuanke->waktuSelesai }}</fieldset>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label class="font-weight-bold" for="">Terms & Conditions</label>
                                            <textarea class="form-control" id="terms-conditions" placeholder="" name="terms_conditions" value="{{ $kuis->terms_conditions }}"></textarea>
                                        </div><br>
                                        <div class="col-md-12">
                                            <button id="" type="submit" class="btn btn-lg btn-info btn-block ">
                                                Save
                                            </button><br><br>
                                        </div>
                                        <input type="hidden" name="_tac_content" value="{{ $kuis->terms_conditions }}">
                                    </form>
                                    <div class="col-md-12">
                                        <form class="deletequiz-form" method="POST" action="{{ route('quiz.destroy', $kuis->id) }}" accept-charset="UTF-8">
                                            <input name="_method" type="hidden" value="Delete">
                                            <input name="_token" type="hidden" value="{{ csrf_token() }}">
                                            <input type="button" class="btn btn-lg btn-danger btn-block delete-btn" value="Delete">
                                        </form>
                                    </div>
                                @else
                                    <form>
                                        {{csrf_field()}}
                                        <div class="form-group col-md-6">
                                            <label class="font-weight-bold">Quiz Name</label>
                                            <input type="text" class="form-control" name="nama_kuis" value="{{ $kuis->nama_kuis }}" disabled>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="font-weight-bold">Duration</label>
                                            <div class="input-group">
                                                <input type="number"  name="durasi" class="form-control" value="{{ $kuis->durasi }}" disabled>
                                                <div class="input-group-addon">Minute(s)</div>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="font-weight-bold">Class</label>
                                            <input type="string" class="form-control" value="{{ $kuis->pertemuanke->agenda->namaAgenda}}" disabled>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="font-weight-bold">Schedule</label>
                                            <input type="string" class="form-control" value="Pertemuan ke-{{ $kuis->pertemuanke->pertemuanKe}} | {{ $kuis->pertemuanke->tglPertemuan}}" disabled>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="font-weight-bold">Start Time</label>
                                            <fieldset class="form-control waktumulai-select" disabled>{{ $kuis->pertemuanke->waktuMulai }}</fieldset>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="font-weight-bold">End Time</label>
                                            <fieldset class="form-control waktuselesai-select" disabled>{{ $kuis->pertemuanke->waktuSelesai }}</fieldset>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label class="font-weight-bold" for="">Terms & Conditions</label>
                                            {!! $kuis->terms_conditions !!}
                                        </div><br>
                                    </form>
                                @endif
                            </div>
                            <div class="tab-pane fade" id="nav-question" role="tabpanel" aria-labelledby="nav-question-tab">
                                @if(count($questions))
                                    <div class="">
                                        <div class="col-md-4 float-right">
                                            <div class="card">
                                                <div class="card-header text-center">
                                                    <strong class="card-title mb-3">PANEL SOAL</strong>
                                                </div>
                                                <div class="card-body">
                                                    <div align="left">                
                                                        
                                                    </div>
                                                    <hr>
                                                    <div class="card-text" >
                                                        @if ($kuis->finalize_status=='0')
                                                        <div class="row">
                                                            <div class="col text-center">
                                                                <a href="{{route('createquestion', $kuis->id)}}" class="btn btn-primary" style="width: 150px;">Add Question</a>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col text-center finalize"><br>
                                                                <form class="finalize" method="POST" action="{{route('generatepacket', $kuis->id)}}" accept-charset="UTF-8">
                                                                    <input type="hidden" name="_method" value="GET">
                                                                    <input type="button" class="btn btn-danger" value="Finalize Questions" style="width: 150px;">
                                                                </form>
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
                                    <div>
                                        <div class="col-md-8 float-left">
                                            <div class="card">
                                                <div class="card-header">
                                                    <strong class="card-title">SOAL {{$i+1}}</strong>
                                                    @if($kuis->finalize_status=='0')
                                                        <form class="delete-form float-right" method="POST" action="{{ route('questions.destroy', $questions[$i]->id) }}" accept-charset="UTF-8">
                                                            <input name="_method" type="hidden" value="Delete">
                                                            <input name="_token" type="hidden" value="{{ csrf_token() }}">
                                                            <input type="button" class="btn btn-sm btn-danger delete-btn float-right" value="Delete">
                                                        </form>
                                                        <a class="btn btn-sm btn-warning float-right" href="{{route('editquestion', [$kuis->id, $questions[$i]->id])}}" role="button">Edit</a>
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
                                                                <a  class="btn btn-outline-info"><i class="fa fa-chevron-left"></i></a>
                                                            </div>
                                                            <div class="col-md-10" align="right">
                                                                <a class="btn btn-outline-info" ><i class="fa fa-chevron-right"></i></a>
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
                                        <a href="{{route('createquestion', $kuis->id)}}" class="btn btn-primary">Add Question</a>
                                    </div>
                                    </div> 
                                @endif
                            </div>
                            <div class="tab-pane fade" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                @if(count($participants))
                                <table id="bootstrap-data-table" class="table table-bordered">
                                    <thead class="thead-light" align="center">
                                        <tr align="center">
                                            <th>NRP</th>
                                            <th>Nama</th>
                                            <th>Paket Soal</th>
                                            <th>Nilai</th>
                                            <th>Menu</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($participants as $p)
                                        <tr>
                                            <td align="center">{{ $p->user->username }}</td>
                                            <td>{{ $p->user->name }}</td>
                                            <td align="center">{{ $p->paketkuis->id }}</td>
                                            <td align="center">{{ $p->quiz_score }}</td>
                                            <td align="center">
                                                <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#participant-detail-{{ $p->id }}">Detail
                                                </button>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                @elseif(count($participant))
                                <table id="bootstrap-data-table" class="table table-bordered">
                                    <thead class="thead-light" align="center">
                                        <tr align="center">
                                            <th>NRP</th>
                                            <th>Nama</th>
                                            <th>Paket Soal</th>
                                            <th>Nilai</th>
                                            <th>Menu</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($participant as $p)
                                        <tr>
                                            <td align="center">{{ $p->user->username }}</td>
                                            <td>{{ $p->user->name }}</td>
                                            <td align="center"></td>
                                            <td align="center"></td>
                                            <td align="center">
                                                <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#participant-detail-{{ $p->id }}">Detail
                                                </button>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                @else
                                <div class="alert alert-warning">
                                    <i class="fa fa-exclamation-triangle"></i> There is no participant(s).
                                </div>
                                @endif
                            </div>
                            <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                                <p>Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor, williamsburg carles vegan helvetica. Reprehenderit
                                    butcher retro keffiyeh dreamcatcher synth. Cosby sweater eu banh mi, irure terry richardson ex sd. Alip placeat salvia cillum iphone. Seitan alip s cardigan american apparel, butcher voluptate nisi .</p>
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
(function($) {
    $(".kelas-select").change(async function(){
        let jadwals;
        const agenda_id = $(this).val();
        try {
            jadwals = await $.ajax({
                url: `{{url('dosen/agenda')}}/${agenda_id}/jadwals`,
                method: 'GET',
                dataType: 'json'
            });
        } catch(err) {
            alert('error');
            console.log(err);
            return;
        }
        let html = '';
        jadwals.map((jadwal, idx) => {
            html += `<option value='${jadwal.id}'>Pertemuan ke-${jadwal.pertemuanKe} | ${jadwal.tglPertemuan}</option>`
        });

        $(".jadwal-select").html(html);
        console.log(jadwals)
    });

    $(".jadwal-select").change(async function() {
        let waktus;
        const jadwal_id = $(this).val();
        try {
            waktus = await $.ajax({
                url: `{{url('dosen/agenda')}}/${jadwal_id}/waktus`,
                method: 'GET',
                dataType: 'json'
            });
        } catch(err) {
            alert('error');
            console.log(err);
            return;
        }
        let html_start = '';
        html_start += `${waktus.waktuMulai}`
        $(".waktumulai-select").html(html_start);

        let html_end = '';
        html_end += `${waktus.waktuSelesai}`
        $(".waktuselesai-select").html(html_end);

        console.log(waktus)
    }); 

    function deleteQuiz() {
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this quiz and its questions!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                $(".deletequiz-form").submit();
                swal({
                    title: "Quiz has been deleted!",
                    text:" ",
                    icon: "success",
                    button: false,
                    timer: 1500,
                });
            }
        });
    }

    $(".delete-btn").click(function() {
        deleteQuiz();
    });

    @if(Session::has('updatequiz_done'))
      swal({
            title: "Quiz has been updated!",
            text:" ",
            icon: "success",
            button: false,
            timer: 1500,
      }); 
    @endif

    tinymce.init({
        selector: '#terms-conditions',
        relative_urls : false,
        remove_script_host : false,
        convert_urls : true,
        plugins : 'advlist autolink link image lists charmap print preview',
        images_upload_handler: function (blobInfo, success, failure) {
            var xhr, formData;
            xhr = new XMLHttpRequest();
            xhr.withCredentials = false;
            xhr.open('POST', '/upload/image');
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
    const tac_content = $("[name='_tac_content']").val();
    $("#terms-conditions").html(tac_content);

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
                swal({
                    title:"Question has been deleted!",
                    text:" ",
                    icon: "success",
                    button: false,
                    timer: 1500,
                });
            }
        });
    }
    $(".delete-btn").click(function() {
        deleteQuestion();
    });

    @if(Session::has('create_done'))
      swal({
            title: "Question has been created!",
            text:" ",
            icon: "success",
            button: false,
            timer: 1500,
      }); 
    @endif
    @if(Session::has('update_done'))
      swal({
            title: "Question has been updated!",
            text:" ",
            icon: "success",
            button: false,
            timer: 1500,
      }); 
    @endif
    @if(Session::has('no_question'))
      swal({
            title: "Can't finalize quiz",
            text:"Add question first!",
            icon: "warning",
            button: false,
            timer: 1500,
      }); 
    @endif

    @if(Session::has('finalized'))
      swal({
            title: "Quiz has been finalized!",
            text: " ",
            icon: "warning",
            button: false,
            timer: 1500,
      }); 
    @endif

    @if(Session::has('cannot_add'))
      swal({
            title: "Can't add question!",
            text:"Quiz has been finalized",
            icon: "warning",
            button: false,
            timer: 3000,
      }); 
    @endif

    @if(Session::has('cannot_edit'))
        swal({
            title: "Can't edit question!",
            text:"Quiz has been finalized",
            icon: "warning",
            button: false,
            timer: 3000,
      }); 
    @endif

    function finalizeQuiz() {
        swal({
            title: "Kuis 3",
            text: "PBBK I\n10 Mei 2019, 14.00 - 15.30\n40 questions",
            icon: "info",
            buttons: ["Cancel", "Next"],
            dangerMode: true,
        })
        .then((nextConfirmation) => {
            if (nextConfirmation) {
                swal({
                    title: "Are you sure?",
                    text: "Once finalized, you will not be able to edit/delete the quiz info and questions!",
                    icon: "warning",
                    buttons: ["Cancel", "Finalize"],
                    dangerMode: true,
                })
                .then((willFinalize)=>{
                    if(willFinalize){
                        $(".finalize").submit();
                        swal({
                        title:"Question has been finalized!",
                        text:" ",
                        icon: "success",
                        button: false,
                        timer: 1500,
                        });
                    }
                });
            }
        });
    }
    $(".finalize").click(function() {
        finalizeQuiz();
    });
})(jQuery);
</script>
@endsection