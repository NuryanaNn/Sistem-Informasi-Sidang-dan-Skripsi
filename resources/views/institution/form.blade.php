{!! Form::model($data, [
    'route' => $data->exists ? ['institution.update', $data->id_lppm] : ['institution.store'],
    'method' => $data->exists ? 'PUT' : 'POST'
]) !!}
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="" class="control-label">NIDN</label>
            {!! Form::text('nidn', null, ['class' => 'form-control', 'id' => 'nidn']) !!}
        </div>
        
        <div class="form-group">
            <label for="" class="control-label">Nama</label>
            {!! Form::text('nama', null, ['class' => 'form-control', 'id' => 'nama']) !!}
        </div>
        <div class="form-group">
            <label for="" class="control-label">No Hp</label>
            {!! Form::text('no_hp', null, ['class' => 'form-control', 'id' => 'no_hp' ]) !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="" class="control-label">Email</label>
            {!! Form::email('email', null, ['class' => 'form-control', 'id' => 'email']) !!}
        </div>
        <div class="form-group">
            <label for="" class="control-label">Alamat</label>
            {!! Form::textarea('alamat', null, ['class' => 'form-control', 'id' => 'alamat','rows'=>'4']) !!}
        </div>
    </div>
</div>


{!! Form::close() !!}