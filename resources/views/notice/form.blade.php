{!! Form::model($data, [
'route' => $data->exists ? ['notice.update', $data->id_pengumuman] : ['notice.store'],
'method' => $data->exists ? 'PUT' : 'POST'
]) !!}
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label for="" class="control-label">Judul</label>
            {!! Form::text('judul', null, ['class' => 'form-control', 'id' => 'judul']) !!}
        </div>
        <div class="form-group">
            <label for="" class="control-label">Isi</label>
            {!! Form::textarea('isi', null, ['class' => 'form-control', 'id' => 'isi', 'rows'=>'5']) !!}
        </div>

    </div>
</div>
{!! Form::close() !!}