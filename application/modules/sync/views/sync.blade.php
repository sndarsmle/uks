@layout('template/back/main')
@section('scripts-css')
@endsection

@section('content')
    <div class="container-fluid">
        @if($this->session->flashdata('message'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ $this->session->flashdata('message') }}
            </div>
        @endif
        <br>
        <h3>{{$title}}</h3>
        <br>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <h4 class="card-title">Histori Sinkronasi Data</h4>
                            </div>
                            <div class="col-md-8 text-right">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#basicModal3">Sync Change</button>
                                <div class="modal fade" id="basicModal3">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Peringatan Sinkronasi Data</h5>
                                                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Mohon tidak keluar atau menekan <b>REFRESH</b> sebelum halaman ini <b>REFRESH</b> otomatis. Jika data yang disinkronasi cukup banyak memang memakan waktu yang lama.
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                <a href="{{base_url('sync/change')}}" class="btn btn-primary">Sync Now</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#basicModal">Sync Siswa</button>
                                <div class="modal fade" id="basicModal">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Peringatan Sinkronasi Data</h5>
                                                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Mohon tidak keluar atau menekan <b>REFRESH</b> sebelum halaman ini <b>REFRESH</b> otomatis. Jika data yang disinkronasi cukup banyak memang memakan waktu yang lama.
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                <a href="{{base_url('sync/doSync')}}" class="btn btn-primary">Sync Now</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#basicModal2">Sync Kelas</button>
                                <div class="modal fade" id="basicModal2">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Peringatan Sinkronasi Data</h5>
                                                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Mohon tidak keluar atau menekan <b>REFRESH</b> sebelum halaman ini <b>REFRESH</b> otomatis. Jika data yang disinkronasi cukup banyak memang memakan waktu yang lama.
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                <a href="{{base_url('sync/doSyncK')}}" class="btn btn-primary">Sync Now</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th>No.</th>
                                <th>Tanggal Sync</th>
                                <th>Total Sync</th>
                                <th>Tipe Sync</th>
                                <th>Admin Sync</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($sync as $i => $sync_data)
                                <tr>
                                    <td>{{ $i+1 }}.</td>
                                    <td>{{ $sync_data->sync_created_at }}</td>
                                    <td>{{ $sync_data->sync_count }}</td>
                                    @if((int)$sync_data->sync_type === 0)
                                        <td>Sync Siswa</td>
                                    @elseif((int)$sync_data->sync_type === 1)
                                        <td>Sync Kelas</td>
                                    @elseif((int)$sync_data->sync_type === 2)
                                        <td>Sync Change</td>
                                    @else
                                        <td>-</td>
                                    @endif
                                    <td>{{ $sync_data->nama_user }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts-js')
@endsection
