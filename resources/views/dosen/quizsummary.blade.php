<<<<<<< HEAD
    <div class="col-md-12">
        <div class="card">
            <div class="card-header bg-white">
                <div class="row">
                    <div class="col">
                        <center>
                            <h3>Statistik Quiz</h3>
                        </center>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div id="persebaranNilai"></div>
                <center>
                    <div>
                        <table>
                            <tr>
                                <td>Average</td>
                                <td>: {!! $average !!}</td>
                            </tr>
                            <tr>
                                <td>Min Score</td>
                                <td>: {!! $min_score !!}</td>
                            </tr>
                            <tr>
                                <td>Max Score</td>
                                <td>: {!! $max_score !!}</td>
                            </tr>                                            
                        </table>
                    </div>
                </center>
            </div>
=======
<div class="col-md-3">
    <h6>Quiz Score Total: {{$total_score}}</h6>
</div>
<div class="col-md-3">
    <h6>Average Score: {{$average}}%</h6>
</div>
<div class="col-md-3">
    <h6>Lowest Score: {{$min_score}}%</h6>
</div>
<div class="col-md-3">
    <h6>Highest Score: {{$max_score}}%</h6>  
</div>
<div class="col-md-12">
    <div class="card">
        <div class="card-header bg-white">
            <div class="row">
                <div class="col">
                    Persebaran Nilai
                </div>
            </div>
        </div>
        <div class="card-body">
            <div id="persebaranNilai"></div>
        </div>
    </div>
</div>
<div class="col-md-4">
    <div class="card">
        <div class="card-header bg-white">
            <div class="row">
                <div class="col">
                    Persebaran Jawaban No 1
                </div>
            </div>
        </div>
        <div class="card-body">
            <div id="chart"></div>
>>>>>>> d21f6b1e8568ceb2a3ada3d43b370d0d3ca21609
        </div>
    </div>