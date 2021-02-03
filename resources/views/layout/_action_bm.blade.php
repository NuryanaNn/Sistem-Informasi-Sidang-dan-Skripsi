@if ($data->status_1 && $data->status_2 =="proses")
<a class="btn btn-primary btn-sm modalnofooter-show edit" href="{{ $url_edit }}"
    title="Edit {{ $data->topik_skripsi }}">Edit</a>
@else
<a class="btn btn-primary btn-sm" disabled href="javascript:void(0)" style="cursor: not-allowed;">Edit</a>
@endif