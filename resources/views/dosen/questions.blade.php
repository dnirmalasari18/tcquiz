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
                            <h3 class="m-0">Kuis Migration</h3>
                        </div>
                        <div class="col ">
                            <a class="btn btn-secondary float-right" href="/dosen/quiz-list" role="button">Back</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <a class="btn btn-primary btn-sm" href="" role="button">Add Question</a>
                        <div class="col-md-8 float-left">
                            <textarea class="tinymce" placeholder="soal"></textarea><br>
                            <textarea class="tinymce" placeholder="opsi A"></textarea><br>
                            <textarea class="tinymce" placeholder="opsi B"></textarea><br>
                            <textarea class="tinymce" placeholder="opsi C"></textarea><br>
                            <textarea class="tinymce" placeholder="opsi D"></textarea><br>
                            <textarea class="tinymce" placeholder="opsi E"></textarea><br>
                            <form action="">
                                <input type="radio" name="A" value="a"> A<br>
                                <input type="radio" name="B" value="b"> B<br>
                                <input type="radio" name="C" value="c"> C<br>
                                <input type="radio" name="D" value="d"> D<br>
                                <input type="radio" name="E" value="e"> E<br>  
                                <input type="submit" value="Submit">
                            </form>
                        </div>
                    <div class="col-md-4 float-right">
                        <div class="card">
                            <div class="card-header text-center">
                                <strong class="card-title mb-3">Questions Panel</strong>
                            </div>
                            <div class="card-body">
                                <button type="button" class="btn btn-outline-secondary">1</button>
                                <button type="button" class="btn btn-outline-secondary">2</button>
                                <button type="button" class="btn btn-outline-secondary">3</button>
                                <button type="button" class="btn btn-outline-secondary">4</button>
                                <button type="button" class="btn btn-outline-secondary">5</button>
                                <button type="button" class="btn btn-outline-secondary">6</button>
                                <button type="button" class="btn btn-outline-secondary">7</button>
                                <button type="button" class="btn btn-outline-secondary">8</button>
                                <button type="button" class="btn btn-outline-secondary">9</button>
                                
                                <hr>
                                <div class="card-text">
                                    <h6><span class="badge badge-success"> </span> Dijawab</h6>
                                    <h6><span class="badge badge-warning"> </span> Ragu</h6>
                                    <h6><span class="badge badge-light"> </span> Kosong</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><!-- .animated -->
@endsection