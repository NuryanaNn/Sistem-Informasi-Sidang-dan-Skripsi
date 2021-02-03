<form action="{{ route('prasidang.update', $data->id_ps) }}" enctype="multipart/form-data" method="POST">
    @csrf
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="" class="control-label">File Ijasah</label>
                <input type="file" class="form-control" id="file_ijasah" name="file_ijasah">
                <input type="hidden" name="old_file_ijasah" value="{{ $data->file_ijasah }}">
            </div>
            <div class="form-group">
                <label for="" class="control-label">File Sertifakat UKM</label>
                <input type="file" name="file_sertifikat_ukm" class="form-control" id="file_sertifikat">
                <input type="hidden" name="old_file_sertifikat_ukm" value="{{ $data->file_sertifikat_ukm }}">
            </div>
            <div class="form-group">
                <label for="" class="control-label">File Foto</label>
                <input type="file" name="file_foto" class="form-control" id="file_foto">
                <input type="hidden" name="old_file_foto" value="{{ $data->file_foto }}">
            </div>
            <div class="form-group">
                <label for="" class="control-label">File Skripsi</label>
                <input type="file" name="file_skripsi" class="form-control" id="file_skripsi">
                <input type="hidden" name="old_file_skripsi" value="{{ $data->file_skripsi }}">
            </div>
            <div class="form-group">
                <label for="" class="control-label">Tanggal</label>
                <input type="date" name="tanggal" class="form-control" id="tanggal"
                    value="{{ isset($data) ? $data->tanggal : '' }}">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12" align="right">
            <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
            <button type="submit" class="btn btn-primary">Edit</button>
        </div>
    </div>
</form>