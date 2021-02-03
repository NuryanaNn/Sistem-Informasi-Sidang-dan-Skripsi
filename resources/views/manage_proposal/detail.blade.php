<div class="row">
    <div class="col-12">
        <!-- /.card -->
        <div class="card">
            <!-- /.card-header -->
            <div class="card-body table-responsive">
                <table id="example1" class="table table-bordered table-striped" style="width: 100%;">
                    <thead>
                        <tr>
                            <th>Topik Skripsi</th>
                            <th>File KRS</th>
                            <th>File KHS</th>
                            <th>File Skripsi</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $r)
                        <tr>
                            <td>{{$r->topik_skripsi}}</td>
                            <td>
                                <a href="{{ 'upload/pengajuan/krs/'.$r->file_krs }}"
                                    target="_blank">{{$r->file_krs}}</a>
                            </td>
                            <td>
                                <a href="{{'upload/pengajuan/khs/'.$r->file_khs}}" target="_blank">{{$r->file_khs}}</a>
                            </td>
                            <td>
                                <a href="{{'upload/pengajuan/proposal/'.$r->file_proposal}}" target="_blank">
                                    {{$r->file_proposal}}</a></td>
                            <td>{{$r->tanggal}}</td>
                            <td>{{$r->status}}</td>

                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Topik Skripsi</th>
                            <th>File KRS</th>
                            <th>File KHS</th>
                            <th>File Proposal</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>