{!! Form::model($data, [
'route' => $data->exists ? ['schedulelecturer.update', $data->nidn] : ['schedulelecturer.store'],
'method' => $data->exists ? 'PUT' : 'POST'
]) !!}
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label for="" class="control-label">Jadwal</label>
            {!! Form::select('id_jadwal', $selectSchedule , null, ['class' => 'form-control', 'placeholder' => 'Pilih
            Jadwal']) !!}
        </div>
    </div>
</div>
{!! Form::close() !!}