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
            <input type="button" class="btn btn-lg btn-danger btn-block delete-btnq" value="Delete">
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
