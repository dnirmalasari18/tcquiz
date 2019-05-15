@extends('layouts.dosen')

@section('quiz-list', 'active')

@section('breadcrumbs')
<li><a href="#">Dashboard</a></li>
<li><a href="#">Quiz</a></li>
<li class="active">{{$kuis->nama_kuis}}</li>
@endsection
@section('style')
<link href="{!! asset('morrisjs/morris.css') !!}" rel="stylesheet">
@endsection
@section('content')
@include('dosen.modalparticipant')
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
                                <a class="nav-item nav-link active" id="nav-info-tab" data-toggle="tab" href="#info" role="tab" aria-controls="nav-info" aria-selected="true">Info</a>
                                <a class="nav-item nav-link" id="nav-question-tab" data-toggle="tab" href="#question" role="tab" aria-controls="nav-question" aria-selected="false">Questions List</a>
                                <a class="nav-item nav-link" id="nav-participant-tab" data-toggle="tab" href="#participant" role="tab" aria-controls="nav-participant" aria-selected="false">Participants</a>
                                <a class="nav-item nav-link" id="nav-summary-tab" data-toggle="tab" href="#summary" role="tab" aria-controls="nav-summary" aria-selected="false">Quiz Summary</a>
                            </div>
                        </nav>
                        <div class="tab-content pl-3 pt-2" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="info" role="tabpanel" aria-labelledby="nav-info-tab">
                                @include('dosen.editquiz')
                            </div>
                            <div class="tab-pane fade" id="question" role="tabpanel" aria-labelledby="nav-question-tab">
                                @include('dosen.listofquestions')
                            </div>
                            <div class="tab-pane fade" id="participant" role="tabpanel" aria-labelledby="nav-participant-tab">
                                @include('dosen.listofparticipants')
                            </div>
                            <div class="tab-pane fade" id="summary" role="tabpanel" aria-labelledby="nav-summary-tab">
                                @include('dosen.quizsummary')
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div><!-- .animated -->
@endsection

@section('script')
<script>
    function openSoal(evt, num) {
        var i, card, soal;
        card = document.getElementsByClassName("card panel");
        button = document.getElementsByClassName("btn panelsoal");
        for (i = 0; i < card.length; i++) {
            card[i].style.display = "none";
            button[i].style.backgroundColor  = "#17a2b8";
        }
        var id = "soal" + num;
        document.getElementById(id).style.display = "flex";
        document.getElementById("nomor"+num).style.backgroundColor  = "white";
    }
    if ('{{count($kuis->quiz)>0}}') {
        document.getElementById("nomor0").click();
    }


(function($) {

    var hash = document.location.hash;
    var prefix = "tab_";
    if (hash)
    {
        $('.nav-tabs a[href="'+hash.replace(prefix,"")+'"]').tab('show');
    }
    $('.nav-tabs a').on('shown', function (e)
    {
        window.location.hash = e.target.hash.replace("#", "#" + prefix);
    });

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

    $(".delete-btnq").click(function() {
        deleteQuiz();
    });

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

    function deleteQuestion(q_id) {
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this question!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                $(".delete-form-"+ q_id).submit();
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
        const q_id = $(this).attr('question-id');
        deleteQuestion(q_id);
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
            title: "{{$kuis->nama_kuis}}",
            text: "{{$kuis->pertemuanke->agenda->singkatAgenda}}\n{{ date('d M y', strtotime($kuis->pertemuanke->tglPertemuan)) }}, {{$kuis->pertemuanKe->waktuMulai}} - {{$kuis->pertemuanKe->waktuSelesai}}\n{{count($kuis->quiz)}} question(s)",
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

    $(document).ready(function() {
        $('#participant_score').DataTable( {
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'copyHtml5',
                    exportOptions: {
                        columns: [ 0, 1, 3]
                    }
                },
                {
                    extend: 'csvHtml5',
                    exportOptions: {
                        columns: [ 0, 1, 3]
                    }
                },
                {
                    extend: 'excelHtml5',
                    exportOptions: {
                        columns: [ 0, 1, 3]
                    }
                },
                {
                    extend: 'pdfHtml5',
                    exportOptions: {
                        columns: [ 0, 1, 3]
                    }
                },
            ]
        } );
    } );
})(jQuery);
</script>

<script src="{!! asset('raphael/raphael.min.js') !!}"></script>
<script src="{!! asset('morrisjs/morris.min.js') !!}"></script>
<script src="{!! asset('morrisjs/morris-data.js') !!}"></script>
<script>
    new Morris.Line({
            element: 'persebaranNilai',
            data: [
                { score: '60', studentAmount: 20 },
                { score: '70', studentAmount: 10 },
                { score: '80', studentAmount: 5 },
                { score: '90', studentAmount: 5 },
                { score: '100', studentAmount: 5 }
            ],
            xkey: 'score',
            parseTime:false,
            ykeys: ['studentAmount'],
            labels: ['Jumlah Siswa'],
            hideHover: 'always',
            resize: true,
            pointFillColors:['#ffffff'],
            pointStrokeColors: ['black'],
            lineColors:['#BDEDFF']
        });
        new Morris.Bar({
            element: 'chart',
            data: [
                { answer: 'A', student: 12 },
                { answer: 'B', student: 15 },
                { answer: 'C', student: 32 },
                { answer: 'D', student: 10 },

            ],
            xkey: 'answer',
            parseTime:false,
            ykeys: ['student'],
            labels: ['Jawaban'],
            hideHover: 'always',
            resize: true,
            barColors:['#BDEDFF']
        });
</script>
@endsection
