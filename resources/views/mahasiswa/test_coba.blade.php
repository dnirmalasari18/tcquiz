{{$quiz}}

{{$paket}}

<br>
@foreach($soal as $s)
    <br>
    {{$s}}
    <br>
@endforeach

<br>
<br>
--------------------------------------------------------
<br>

<?php

$arr = array_map('intval', explode(",", $paket2->question_id_list));

?>

{{count($arr)-1}}

{{$arr[0]}}