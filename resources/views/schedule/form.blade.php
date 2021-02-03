{!! Form::model($data, [
'route' => $data->exists ? ['schedule.update', $data->id_jadwal] : ['schedule.store'],
'method' => $data->exists ? 'PUT' : 'POST'
]) !!}

<div class="form-group">
    <label for="" class="control-label">Tanggal</label>
    {!! Form::date('tanggal', null, ['class' => 'form-control', 'id' => 'tanggal']) !!}
</div>
<div class="form-group">
    <label for="" class="control-label">Jam</label>
    {!! Form::time('jam', $data->exists ? Carbon\Carbon::parse($data->jam)->format('H:i') : null, ['class' =>
    'form-control', 'id' => 'jam']) !!}
</div>

<div class="form-group">
    <label for="" class="control-label">Ruangan</label>
    {!! Form::text('ruangan', null, ['class' => 'form-control', 'id' => 'ruangan']) !!}
</div>

{!! Form::close() !!}