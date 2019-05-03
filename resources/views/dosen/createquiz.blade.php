@extends('layouts.dosen')

@section('create-quiz', 'active')

@section('breadcrumbs')
<li><a href="#">Dashboard</a></li>
<li><a href="{{route('quiz.index')}}">Quiz</a></li>
<li class="active">Create a Quiz</li>
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
                	<form action="{{route('quiz.store')}}" method="POST">
                    {{csrf_field()}}
                    <input type="hidden" name="dosen_id" value="{{ Auth::user()->id}}">
                		<div class="form-group col-md-6">
                	        <label class="font-weight-bold" for="">Nama Kuis</label>
                	        <input type="text" class="form-control" id="" placeholder="" name="nama_kuis" required>
                    </div>
                    <div class="form-group col-md-6">
                      <label class="font-weight-bold" for="">Durasi</label>
                        <div class="input-group">
                          <input type="number" id="" name="durasi" placeholder="" class="form-control" value="60" required>
                          <div class="input-group-addon">Menit</div>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                      <label class="font-weight-bold" for="">Kelas</label>
                      <select class="form-control kelas-select" required>
                        @foreach ($agenda as $a)        
                          <option value="{{ $a->idAgenda }}">{{ $a->namaAgenda }}</option>
                        @endforeach
                      </select>
                	    </div>
                    <div class="form-group col-md-6">
                      <label class="font-weight-bold" for="" >Jadwal</label>
                      <select class="form-control jadwal-select" name="absenkuliah_id" required></select>
                    </div>
                    <div class="form-group col-md-6">
                      <label class="font-weight-bold">Waktu Mulai</label>
                      <fieldset class="form-control waktumulai-select" disabled></fieldset>
                    </div>
                    <div class="form-group col-md-6">
                      <label class="font-weight-bold ">Waktu Selesai</label>
                      <fieldset class="form-control waktuselesai-select" disabled></fieldset>
                    </div>
                    <div class="form-group col-md-12">
                      <label class="font-weight-bold" for="">Terms & Conditions</label>
                      <input type="textarea" class="form-control" id="terms-conditions" placeholder="" name="terms_conditions">
                    </div>
                    <br>
                    <div class="col-md-12">
                      <button id="" type="submit" class="btn btn-lg btn-info btn-block ">
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