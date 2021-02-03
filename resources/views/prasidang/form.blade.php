<form action="{{ route('prasidang.store') }}" enctype="multipart/form-data" method="POST">
    @csrf
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="" class="control-label">File Ijasah</label>
                <input type="file" class="form-control" id="file_ijasah" name="file_ijasah" accept="application/pdf"
                    required>
            </div>
            <div class="form-group">
                <label for="" class="control-label">File Sertifikat UKM</label>
                <input type="file" name="file_sertifikat_ukm" class="form-control" id="file_sertifikat_ukm"
                    accept="application/pdf" required>
            </div>
            <div class="form-group">
                <label for="" class="control-label">File Foto</label>
                <input type="file" name="file_foto" class="form-control" accept="image/*" id="file_foto" required>
            </div>
            <div class="form-group">
                <label for="" class="control-label">File Skripsi</label>
                <input type="file" name="file_skripsi" class="form-control" id="file_skripsi"
                    accept="application/pdf, application/msword" required>
            </div>
            <div class="form-group">
                <label for="" class="control-label">Tanggal</label>
                <input type="date" name="tanggal" class="form-control" id="tanggal" required>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12" align="right">
            <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
    </div>
</form>