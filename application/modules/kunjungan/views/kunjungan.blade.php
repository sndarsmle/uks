@layout('template/back/main')

@section('scripts-css')
    <link href="{{ base_url('assets/plugins/tables/css/datatable/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="container-fluid">
        <br/>
        <h3> {{$title}}</h3>
        <br/>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <a href="{{ base_url('kunjungan/tambah') }}">
                            <button type="button"
                                    class="btn btn-primary"
                                    data-toggle="modal"
                                    data-target="#basicModal"
                                    style="float:right;">
                                Tambah Kunjungan
                            </button>
                        </a>
                        <h4 class="card-title">Daftar Jadwal</h4>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover" id="table">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Hari Tanggal</th>
                                    <th scope="col">Jam datang</th>
                                    <th scope="col">Jam Keluar</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Kelas</th>
                                    <th> Aksi</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($kunjungan as $i => $item)
                                    <tr>
                                        <th></th>
                                        <td>{{ $item->hari}} &nbsp {{ $item->tgl_kunjungan }}</td>
                                        <td>{{ $item->jam_datang }}</td>
                                        <td>{{ $item->jam_keluar }}</td>
                                        <td>{{ $item->nama }}</td>
                                        <td>{{ $item->kelas }}</td>
                                        <td>
                                            <a href="{{ base_url('kunjungan/update/' . $item->idkunjungan) }}"
                                               class="btn btn-primary">
                                                Edit
                                            </a>
                                            <a href="{{ base_url('kunjungan/hapus_kunjungan/' . $item->idkunjungan )}}"
                                               class="btn btn-danger">
                                                Hapus
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts-js')
    <script src="{{ base_url('assets/plugins/tables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ base_url('assets/plugins/tables/js/datatable/dataTables.bootstrap4.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            const table = $("#table").DataTable({
                "pageLength": 50,
            });
            table.on('order.dt search.dt', function () {
                table.column(0, {search: 'applied', order: 'applied'}).nodes().each(function (cell, i) {
                    cell.innerHTML = (i + 1) + ".";
                });
            }).draw();
        });
    </script>
@endsection

