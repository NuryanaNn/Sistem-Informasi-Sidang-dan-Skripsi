{!! Form::model($data, [
'route' => $data->exists ? ['student.update', $data->nim] : ['student.store'],
'method' => $data->exists ? 'PUT' : 'POST'
]) !!}
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="" class="control-label">Nim</label>
            {!! Form::text('nim', null, ['class' => 'form-control', 'id' => 'nim']) !!}
        </div>
        <div class="form-group">
            <label for="" class="control-label">Nama</label>
            {!! Form::text('nama', null, ['class' => 'form-control', 'id' => 'nama']) !!}
        </div>
        <div class="form-group">
            <label for="" class="control-label">Jenis Kelamin</label>
            {!! Form::select('jk', ['Laki-Laki' => 'Laki-laki', 'Perempuan' => 'Perempuan'], null, ['class' =>
            'form-control', 'placeholder' => 'Pilih Jenis Kelamin']) !!}
        </div>
        <div class="form-group">
            <label for="" class="control-label">Email</label>
            {!! Form::email('email', null, ['class' => 'form-control', 'id' => 'email']) !!}
        </div>
        <div class="form-group">
            <label for="" class="control-label">No Hp</label>
            {!! Form::text('no_hp', null, ['class' => 'form-control', 'id' => 'no_hp']) !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="" class="control-label">Jurusan</label>
            {!! Form::select('jurusan', ['Teknik Informatika' => 'Teknik Informatika', 'Sistem Informasi' => 'Sistem
            Informasi', 'Manajemen Informatika' => 'Manajemen Informatika'], null, ['class' => 'form-control',
            'placeholder' => 'Pilih Jurusan']) !!}
        </div>
        <div class="form-group">
            <label for="" class="control-label">Tahun Skripsi</label>
            {!! Form::text('tahun', null, ['class' => 'form-control', 'id' => 'tahun']) !!}
        </div>
        <div class="form-group">
            <label for="" class="control-label">Alamat</label>
            {!! Form::textarea('alamat', null, ['class' => 'form-control', 'id' => 'alamat','rows'=>'4']) !!}
        </div>
        @if ($data->exists)
        <label for="" class="control-label">Reset Password</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <input type="checkbox" value="check" name="check">
                </span>
            </div>
            <input type="text" class="form-control" name="password" value="{{$data->nim.'Aa*'}}" readonly>
        </div>
        @endif
    </div>
</div>
{!! Form::close() !!}