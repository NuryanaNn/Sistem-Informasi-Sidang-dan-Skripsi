<form action="{{ route('manage_guidance.update', $data->id_bimbingan) }}" enctype="multipart/form-data" method="POST">
    @csrf
    <div class="row">
        <div class="col-md-12">
            <input type="hidden" name="id_bimbingan" class="form-control" id="id_bimbingan"
                value="{{$data->id_bimbingan}}">
            <input type="hidden" name="nidn" class="form-control" id="nidn" value="{{ Session::get('username') }}">
            <div class="form-group">
                <label for="" class="control-label">Isi Revisi</label>
                <textarea name="isi_revisi" class="form-control" rows="4"></textarea>
            </div>
            <div class="form-group">
                <label for="" class="control-label">File Revisi</label>
                <input type="file" class="form-control" id="file_revisi" name="file_revisi">
            </div>
            <div class="form-group">
                <label for="" class="control-label">Tanggal</label>
                <input type="date" class="form-control" id="file_revisi" name="tanggal">
            </div>
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
<script src="{{ asset('plugins/summernote/summernote-bs4.min.js')}}"></script>
<script>
    $(function () {
        // Summernote
        $('.summernote').summernote()
    })

</script>