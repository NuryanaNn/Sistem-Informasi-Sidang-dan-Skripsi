{!! Form::model($data, [
'route' => $data->exists ? ['program_study.update', $data->id_jurusan] : ['program_study.store'],
'method' => $data->exists ? 'PUT' : 'POST'
]) !!}
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label for="" class="control-label">Kode Jurusan</label>
            {!! Form::text('id_jurusan', null, ['class' => 'form-control', 'id' => 'id_jurusan']) !!}
        </div>
        <div class="form-group">
            <label for="" class="control-label">Nama Jurusan</label>
            {!! Form::text('nama_jurusan', null, ['class' => 'form-control', 'id' => 'nama_jurusan']) !!}
        </div>
    </div>
</div>
{!! Form::close() !!}