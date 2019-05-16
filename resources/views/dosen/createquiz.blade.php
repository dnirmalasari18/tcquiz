@extends('layouts.dosen')

@section('create-quiz', 'active')

@section('breadcrumbs')
<li><a href="/">Dashboard</a></li>
<li><a href="{{route('quiz.index')}}">Quiz</a></li>
<li class="active">Create a Quiz</li>
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
                            <h3 class="m-0">Add Quiz</h3>
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
                  </div>
                	<form action="{{route('quiz.store')}}" method="POST">
                    {{csrf_field()}}
                    <input type="hidden" name="dosen_id" value="{{ Auth::user()->id}}">
                		<div class="form-group col-md-6">
                	        <label class="font-weight-bold">Quiz Name</label>
                	        <input type="text" class="form-control" name="nama_kuis" required>
                    </div>
                    <div class="form-group col-md-6">
                      <label class="font-weight-bold">Duration</label>
                        <div class="input-group">
                          <input type="number" name="durasi" class="form-control" value="60" required>
                          <div class="input-group-addon">Minute(s)</div>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                      <label class="font-weight-bold">Class</label>
                      <select class="form-control kelas-select" required>
                        @foreach ($agenda as $a)        
                          <option value="{{ $a->idAgenda }}">{{ $a->namaAgenda }}</option>
                        @endforeach
                      </select>
                	    </div>
                    <div class="form-group col-md-6">
                      <label class="font-weight-bold" >Schedule</label>
                      <select class="form-control jadwal-select" name="absenkuliah_id" required></select>
                    </div>
                    <div class="form-group col-md-6">
                      <label class="font-weight-bold">Start Time</label>
                      <fieldset class="form-control waktumulai-select" disabled></fieldset>
                    </div>
                    <div class="form-group col-md-6">
                      <label class="font-weight-bold ">End Time</label>
                      <fieldset class="form-control waktuselesai-select" disabled></fieldset>
                    </div>
                    <div class="form-group col-md-12">
                      <label class="font-weight-bold">Terms & Conditions</label>
                      <div class="loading">
                          <img src="{{asset('img/spinner.gif')}}" width="60px">
                      </div>
                      <div class="content-body" style="display: none">
                        <input type="textarea" class="form-control" id="terms-conditions" name="terms_conditions">
                      </div>
                    </div>
                    <br>
                    <div class="col-md-12">
                      <button type="submit" class="btn btn-lg btn-info btn-block ">
                        Save
                      </button>
                    </div>
                	</form>
                </div>
            </div>
        </div>
    </div>
</div><!-- .animated -->
@endsection

@section('script')
<script type="text/javascript">        
(function($) {
  setTimeout(function () {
      $(".loading").html("");
      $(".content-body").fadeIn(1000);
  }, 900);

  $(".kelas-select").click(async function() {
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

$(".jadwal-select").click(async function() {
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
})(jQuery);
     
    tinymce.init({
    selector: '#terms-conditions',
    plugins : 'advlist autolink link image lists charmap print preview',
    relative_urls : false,
    remove_script_host : false,
    convert_urls : true,
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
</script>
@endsection