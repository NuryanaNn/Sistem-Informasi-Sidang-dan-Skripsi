<div class="row">
    <div class="col-12">
        <!-- /.card -->
        <div class="card">
            <!-- /.card-header -->
            <div class="card-body table-responsive">
                <table id="example1" class="table table-bordered table-striped" style="width: 100%;">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Nim</th>
                            <th>Nama Bab</th>
                            <th>File Bab</th>
                            <th>Keterangan</th>
                            <th>Tanggal</th>
                            <th>Status 1</th>
                            <th>Status 2</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $r)
                        <tr>
                            <td>{{$r->nama}}</td>
                            <td>{{$r->nim}}</td>
                            <td>{{$r->nama_bab}}</td>
                            <td>
                                <a href="{{ 'upload/bimbingan/'.$r->file_bab }}" target="_blank">{{$r->file_bab}}</a>
                            </td>
                            <td>{{$r->keterangan}}</td>
                            <td>{{$r->tanggal}}</td>
                            <td>{{$r->status_1}}</td>
                            <td>{{$r->status_2}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Nama</th>
                            <th>Nim</th>
                            <th>Nama Bab</th>
                            <th>File Bab</th>
                            <th>Keterangan</th>
                            <th>Tanggal</th>
                            <th>Status 1</th>
                            <th>Status 2</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>