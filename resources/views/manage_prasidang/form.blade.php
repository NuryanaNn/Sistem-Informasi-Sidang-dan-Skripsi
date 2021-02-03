{!! Form::model($data, [
'route' => $data->exists ? ['manage_prasidang.update', $data->id_ps] : ['manage_prasidang.store'],
'method' => $data->exists ? 'PUT' : 'POST'
]) !!}
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label for="" class="control-label">Status Prasidang</label>
            {!! Form::select('status', ['proses' => 'proses', 'revisi' => 'revisi', 'terima' => 'terima'], null,
            ['class'
            => 'form-control', 'placeholder' => 'Pilih Status Prasidang']) !!}
        </div>
    </div>
</div>
{!! Form::close() !!}