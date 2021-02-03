{!! Form::model($data, [
    'route' => $data->exists ? ['groupstudent.update', $data->nim] : ['groupstudent.store'],
    'method' => $data->exists ? 'PUT' : 'POST'
]) !!}
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label for="" class="control-label">Kelompok Bimbingan</label>
            {!! Form::select('id_grup', $selectGroup , null, ['class' => 'form-control', 'placeholder' => 'Pilih Kelompok']) !!}
        </div>
    </div>
</div>
{!! Form::close() !!}