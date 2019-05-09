@extends('layouts.dosen')

@section('quiz-list', 'active')

@section('breadcrumbs')
<li><a href="#">Dashboard</a></li>
<li><a href="#">Quiz</a></li>
<li class="active">{{$kuis->nama_kuis}}</li>
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
                                <a class="nav-item nav-link active" id="nav-info-tab" data-toggle="tab" href="#nav-info" role="tab" aria-controls="nav-info" aria-selected="true">Info</a>
                                <a class="nav-item nav-link" id="nav-question-tab" data-toggle="tab" href="#nav-question" role="tab" aria-controls="nav-question" aria-selected="false">Questions List</a>
                                <a class="nav-item nav-link" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="false">Participants</a>
                                <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Quiz Summary</a>
                            </div>
                        </nav>
                        <div class="tab-content pl-3 pt-2" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-info" role="tabpanel" aria-labelledby="nav-info-tab">
                                @include('dosen.editquiz')
                            </div>
                            <div class="tab-pane fade" id="nav-question" role="tabpanel" aria-labelledby="nav-question-tab">
                                @include('dosen.listofquestions')
                            </div>
                            <div class="tab-pane fade" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                @include('dosen.listofparticipants')
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
<script>        
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