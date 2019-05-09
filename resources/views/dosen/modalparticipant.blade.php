@foreach($participants as $p)
<div class="modal fade" id="participant-detail-{{ $p->id }}" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mediumModalLabel">Participant Detail</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table">
                    <tbody >
                        <tr>
                            <td>NRP</td>
                            <td>: {{ $p->user->username }}</td>
                        </tr>
                        <tr>
                            <td>Nama</td>
                            <td>: {{ $p->user->name }}</td>
                        </tr>
                        <tr>
                            <td>ID Paket Kuis</td>
                            <td>: {{ $p->paketkuis->id }}</td>
                        </tr>
                        <tr>
                            <td>Detail Paket Kuis</td>
                            <td>: {{ $p->paketkuis->question_id_list }}</td>
                        </tr>
                        <tr>
                            <td>Nilai Kuis</td>
                            <td>: {{ $p->quiz_score }}</td>
                        </tr>
                        <tr>
                            <td>Tanggal Ambil Kuis</td>
                            <td>: {{ $p->end_time }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endforeach