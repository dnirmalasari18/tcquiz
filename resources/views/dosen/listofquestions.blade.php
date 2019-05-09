
@if(count($questions))
    <div class="">
        <div class="col-md-4 float-right">
            <div class="card">
                <div class="card-header text-center">
                    <strong class="card-title mb-3">PANEL SOAL</strong>
                </div>
                <div class="card-body">
                    <div align="left">
                        
                                <a href="" class="mt-2 btn2 btn-info btn-sm" style="height: 30px; width: 40px;"></a>
                           
                                <a href="" class="mt-2 btn2 btn-light btn-sm" style="height: 30px; width: 40px;"></a>
                           
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
                            <div class="col text-center finalize">
                                <br><form class="finalize" method="POST" action="{{route('generatepacket', $kuis->id)}}" accept-charset="UTF-8">
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
                    <strong class="card-title mb-3">SOAL {{$i+1}}</strong>
                    @if($kuis->finalize_status=='0')
                        <form class="delete-form" method="POST" action="{{ route('questions.destroy', $questions[$i]->id) }}" accept-charset="UTF-8">
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
