@if ($data->status=="proses")
<a class="btn btn-primary btn-sm modalnofooter-show edit" href="{{ $url_edit}}" title="Edit {{ $data->id_ps }}">Edit
</a>
@else
<a class="btn btn-primary btn-sm" disabled href="javascript:void(0)" style="cursor: not-allowed;">Edit</a>
@endif