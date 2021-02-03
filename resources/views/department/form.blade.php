{!! Form::model($data, [
    'route' => $data->exists ? ['department.update', $data->id_prodi] : ['department.store'],
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
            <label for="" class="control-label">Jurusan</label>
            {!! Form::select('jurusan', ['Teknik Informatika' => 'Teknik Informatika', 'Sistem Informasi' => 'Sistem Informasi', 'Manajemen Informatika' => 'Manajemen Informatika'], null, ['class' => 'form-control', 'placeholder' => 'Pilih Jurusan']) !!}
        </div>
        <div class="form-group">
            <label for="" class="control-label">No Hp</label>
            {!! Form::text('no_hp', null, ['class' => 'form-control', 'id' => 'no_hp']) !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="" class="control-label">Email</label>
            {!! Form::email('email', null, ['class' => 'form-control', 'id' => 'email']) !!}
        </div>
        <div class="form-group">
            <label for="" class="control-label">Alamat</label>
            {!! Form::textarea('alamat', null, ['class' => 'form-control', 'id' => 'alamat','rows'=>'5']) !!}
        </div>
    </div>
</div>




{!! Form::close() !!}