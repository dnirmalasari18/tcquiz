<div class="col-md-3">
    <h6>Quiz Score Total: {{$total_score}}</h6>
</div>
<div class="col-md-3">
    <h6>Average Score: {{number_format($average,2)}}%</h6>
</div>
<div class="col-md-3">
    <h6>Lowest Score: {{$min_score}}%</h6>
</div>
<div class="col-md-3">
    <h6>Highest Score: {{$max_score}}%</h6>  
</div>
<br><br>
<div class="col-md-12">
    <div class="card">
        <div class="card-header bg-white">
            <div class="row">
                <div class="col">
                    <center>
                        <h5>Quiz Distribution Score</h5>
                    </center>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div id="persebaranNilai"></div>
        </div>
    </div>
</div>