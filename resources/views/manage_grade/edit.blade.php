{!! Form::model($data, [
'route' => $data->exists ? ['manage_grade.update', $data->id_nilai] : ['manage_grade.store'],
'method' => $data->exists ? 'PUT' : 'POST'
]) !!}
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label for="" class="control-label">Nilai Bimbingan</label>
            {!! Form::text('nilai_bimbingan', null, ['class' => 'form-control', 'id' => 'nilai_bimbingan']) !!}
        </div>
        <div class="form-group">
            <label for="" class="control-label">Nilai Sidang</label>
            {!! Form::text('nilai_sidang', null, ['class' => 'form-control', 'id' => 'nilai_sidang']) !!}
        </div>

    </div>
</div>
{!! Form::close() !!}