@extends('layouts.dosen')

@section('quiz', 'active')

@section('breadcrumbs')
<li><a href="#">Dashboard</a></li>
<li><a href="#">Quiz</a></li>
<li class="active">Add Questions</li>
@endsection

@section('content')
<div class="animated fadeIn">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-white">
                    <div class="row">
                        <div class="col">
                            <h3 class="m-0">Questions</h3>
                        </div>
                        <div class="col ">
                            <a class="btn btn-secondary float-right" href="" role="button">Back</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="" method="POST">
                        <div class="form-group col-md-8 float-left">
                            <label class="font-weight-bold" for="">Soal</label>
                            <input type="textarea" class="form-control quest" name="soal">
                            <label class="font-weight-bold" for="">Opsi A</label>
                            <input type="textarea" class="form-control quest" name="opsiA">
                            <label class="font-weight-bold" for="">Opsi B</label>
                            <input type="textarea" class="form-control quest" name="opsiB">
                            <label class="font-weight-bold" for="">Opsi C</label>
                            <input type="textarea" class="form-control quest" name="opsiC">
                            <label class="font-weight-bold" for="">Opsi D</label>
                            <input type="textarea" class="form-control quest" name="opsiD">
                            <label class="font-weight-bold" for="">Opsi E</label>
                            <input type="textarea" class="form-control quest" name="opsiE"><br>
                            
                                <input type="radio" name="A" value="a"> A<br>
                                <input type="radio" name="B" value="b"> B<br>
                                <input type="radio" name="C" value="c"> C<br>
                                <input type="radio" name="D" value="d"> D<br>
                                <input type="radio" name="E" value="e"> E<br><br>
                            <button id="" type="submit" class="btn btn-lg btn-info btn-block">Sumbit</button>
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
tinymce.init({
    selector: '.quest',
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