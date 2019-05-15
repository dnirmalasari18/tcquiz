@if(count($participants))
<table id="participant_score" class="table table-bordered">
    <thead class="thead-light" align="center">
        <tr align="center">
            <th>NRP</th>
            <th>Name</th>
            <th>Quiz Packet</th>
            <th>Score</th>
        </tr>
    </thead>
    <tbody>
        @foreach($participants as $p)
        <tr>
            <td align="center">{{ $p->user->username }}</td>
            <td>{{ $p->user->name }}</td>
            <td align="center">{{ $p->paketkuis->id }}</td>
            <td align="center">{{ $p->quiz_score }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@elseif(count($participant))
<table id="participant_score" class="table table-bordered">
    <thead class="thead-light" align="center">
        <tr align="center">
            <th>NRP</th>
            <th>Nama</th>
            <th>Paket Soal</th>
            <th>Nilai</th>
        </tr>
    </thead>
    <tbody>
        @foreach($participant as $p)
        <tr>
            <td align="center">{{ $p->user->username }}</td>
            <td>{{ $p->user->name }}</td>
            <td align="center"></td>
            <td align="center"></td>
        </tr>
        @endforeach
    </tbody>
</table>
@else
<div class="alert alert-warning">
    <i class="fa fa-exclamation-triangle"></i> There is no participant(s).
</div>
@endif