{!! Form::model($data, [
    'route' => $data->exists ? ['group.update', $data->id_grup] : ['group.store'],
    'method' => $data->exists ? 'PUT' : 'POST'
]) !!}

<div class="form-group">
    <label for="" class="control-label">Nama Grup</label>
    {!! Form::text('nama_grup', null, ['class' => 'form-control', 'id' => 'nama_grup']) !!}
</div>

<div class="form-group">
    <label for="" class="control-label">Tahun</label>
    {!! Form::text('tahun', null, ['class' => 'form-control', 'id' => 'tahun']) !!}
</div>

{!! Form::close() !!}