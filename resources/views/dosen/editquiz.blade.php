@extends('layouts.dosen')

@section('quiz', 'active')

@section('breadcrumbs')
<li><a href="#">Dashboard</a></li>
<li><a href="#">Quiz</a></li>
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
                    <div>
                        @if (\Session::has('update_done'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                              {!! \Session::get('update_done') !!}
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>                                    
                            </div>
                        @endif
                    </div>
                    <form action="{{route('quiz.update', $quiz->id)}}" method="POST">
                        <input name="_method" type="hidden" value="PATCH">
                        {{csrf_field()}}
                        <div class="form-group col-md-6">
                            <label class="font-weight-bold" for="">Nama Kuis</label>
                            <input type="text" class="form-control" id="" placeholder="" name="nama_kuis" value="{{ $quiz->nama_kuis }}">
                        </div>
                        <div class="form-group col-md-6">
                            <label class="font-weight-bold" for="">Durasi</label>
                            <div class="input-group">
                                <input type="number" id="" name="durasi" placeholder="" class="form-control" value="{{ $quiz->durasi }}">
                                <div class="input-group-addon">Menit</div>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="font-weight-bold" for="">Kelas</label>
                            <select class="form-control kelas-select" value="$quiz->pertemuanke->agenda->idAgenda">
                                @foreach ($agenda as $a)
                                <option value="{{ $a->idAgenda }}">{{ $a->namaAgenda }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="font-weight-bold" for="" >Jadwal</label>
                            <select class="form-control jadwal-select" name="absenkuliah_id" value="{{ $quiz->absenkuliah_id }}">
                
                            </select>
                        </div>
                        <div class="form-group col-md-12">
                            <label class="font-weight-bold" for="">Terms & Conditions</label>
                            <input type="textarea" class="form-control" id="terms-conditions" placeholder="" name="terms_conditions" value="{{ $quiz->terms_conditions }}">
                        </div>
                        <br>
                        <div class="col-md-12">
                            <button id="" type="submit" class="btn btn-lg btn-info btn-block ">
                                Save
                            </button><br><br>
                        </div>
                    </form>
                    <div class="col-md-12">
                        <form method="POST" action="{{ route('quiz.destroy', $quiz->id) }}" accept-charset="UTF-8">
                            <input name="_method" type="hidden" value="Delete">
                            <input name="_token" type="hidden" value="{{ csrf_token() }}">
                            <input type="submit" class="btn btn-lg btn-danger btn-block" onclick="return confirm('Anda yakin akan menghapus data?');" value="Delete">
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
})(jQuery);
     
   tinymce.init({
    selector: '#terms-conditions',
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
</script>
@endsection