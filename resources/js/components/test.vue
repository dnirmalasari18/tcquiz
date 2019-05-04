<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Example Component</div>

                    <div class="card-body">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title">Soal 1</strong>
                                <strong class="card-title" style="float: right; margin-bottom: 0;">Flag</strong>
                                <label class="switch switch-3d switch-warning mr-3" style="float: right; margin-bottom: 0;"><input type="checkbox" class="switch-input" checked="false"> <span class="switch-label"></span> <span class="switch-handle"></span></label>
                            </div>
                            <div class="card-body">
                                Are you on the hunt for a free general knowledge quiz for your pub, party, social or school group? Look no further! The following quiz questions are suitable for all age groups and range from easy to profoundly thought-provoking, covering a wide range of topics so everyone can join in the fun.
                            </div>
                            <div class="card-body">
                                <div style="margin-bottom: 10px;"><strong>Jawaban</strong></div>
                                <div class="form-check">
                                    <?php
                                        $x = 5;
                                        $opt = array();
                                        for ($i=0; $i <$x ; $i++) { 
                                            $opt[$i] = $i + 1;
                                        }
                                    ?>
                                    @foreach($opt as $o)
                                    <div class="radio">
                                    <label for="radio1" class="form-check-label ">
                                        <input type="radio" id="radio1" name="radios" value="option1" class="form-check-input">
                                        Option {{$o}}
                                    </label>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="card-header" style="border-top: 1px solid rgba(0,0,0,.125);">
                                <button type="button" class="btn btn-info btn-sm" style="float: right; width: 70px;">Next</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>