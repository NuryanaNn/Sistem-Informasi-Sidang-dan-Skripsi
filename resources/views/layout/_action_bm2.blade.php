@if ($data->status_1 && $data->status_2 =="terima")
<a class="btn btn-primary btn-sm" disabled href="javascript:void(0)" style="cursor: not-allowed;">Edit</>
    <a class="btn btn-success btn-sm" href="{{ $url_detail}}">Detail</a>
    @else
    <a class="btn btn-success btn-sm" href="{{ $url_detail}}">Detail</a>
        @endif