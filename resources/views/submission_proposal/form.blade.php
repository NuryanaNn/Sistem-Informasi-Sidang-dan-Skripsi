<form action="{{ route('submission_proposal.store') }}" enctype="multipart/form-data" method="POST">
    @csrf
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="" class="control-label">Topik Skripsi</label>
                <input type="text" name="topik_skripsi" class="form-control" id="topik_skripsi"
                    value=" {{ isset($data) ? $data->topik_skripsi : '' }}">
            </div>
            <div class="form-group">
                <label for="" class="control-label">File KRS</label>
                <input type="file" class="form-control" id="file_krs" name="file_krs" required>
            </div>
            <div class="form-group">
                <label for="" class="control-label">File KHS</label>
                <input type="file" name="file_khs" class="form-control" id="file_khs" required>
            </div>
            <div class="form-group">
                <label for="" class="control-label">File Proposal</label>
                <input type="file" name="file_proposal" class="form-control" id="file_proposal" required>
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