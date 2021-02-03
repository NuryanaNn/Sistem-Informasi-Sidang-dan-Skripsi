@if ($data->status_2 == 'terima')
<span class="text text-success">
    <i class="fa fa-check-circle"></i> Diterima
</span>
@elseif($data->status_2 == 'revisi')
<span class="text text-danger">
    <i class="fa fa-times-circle"></i> Revisi
</span>
@elseif($data->status_2 == 'proses')
<span class="text text-primary">
    <i class="fa fa-times-circle"></i> Sedang Diproses
</span>
@endif