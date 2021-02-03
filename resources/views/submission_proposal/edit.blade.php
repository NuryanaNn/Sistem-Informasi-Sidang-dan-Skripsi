<form action="{{ route('submission_proposal.update', $data->id_pp) }}" enctype="multipart/form-data" method="POST">
    @csrf
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="" class="control-label">Topik Skripsi</label>
                <input type="text" name="topik_skripsi" class="form-control" id="topik_skripsi"
                    value="{{$data->topik_skripsi}}">
            </div>
            <div class="form-group">
                <label for="" class="control-label">File KRS</label>
                <input type="file" class="form-control" id="file_krs" name="file_krs">
                <input type="hidden" name="old_file_krs" value="{{ $data->file_krs }}">
            </div>
            <div class="form-group">
                <label for="" class="control-label">File KHS</label>
                <input type="file" name="file_khs" class="form-control" id="file_khs">
                <input type="hidden" name="old_file_khs" value="{{ $data->file_khs }}">
            </div>
            <div class="form-group">
                <label for="" class="control-label">File Proposal</label>
                <input type="file" name="file_proposal" class="form-control" id="file_proposal">
                <input type="hidden" name="old_file_proposal" value="{{ $data->file_proposal }}">
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