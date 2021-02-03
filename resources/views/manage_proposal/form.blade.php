{!! Form::model($data, [
    'route' => $data->exists ? ['manage_proposal.update', $data->id_pp] : ['manage_proposal.store'],
    'method' => $data->exists ? 'PUT' : 'POST'
]) !!}
<div class="row">
    <div class="col-md-12">
        @if ($data->exists)
        <div class="form-group">
            {!! Form::hidden('nim', null, ['class' => 'form-control', 'id' => 'nim']) !!}
        </div> 
        @endif
        <div class="form-group">
            <label for="" class="control-label">Nilai</label>
            {!! Form::text('nilai_pengajuan', null, ['class' => 'form-control', 'id' => 'nama_pengajuan']) !!}
        </div>
        <div class="form-group">
            <label for="" class="control-label">Status Proposal</label>
            {!! Form::select('status', ['proses' => 'proses', 'tolak' => 'tolak', 'terima' => 'terima'], null, ['class' => 'form-control', 'placeholder' => 'Pilih Status Proposal']) !!}
        </div>
    </div>
</div>
{!! Form::close() !!}