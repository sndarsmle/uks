@layout('template/back/main')

@section('scripts-css')
    <link href="{{ base_url('assets/plugins/tables/css/datatable/dataTables.bootstrap4.min.css') }}"
          rel="stylesheet">
    <link href="{{ base_url('assets/plugins/toastr/css/toastr.min.css') }}" rel="stylesheet">
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
                        <button type="button" class="btn btn-primary"
                                data-toggle="modal" data-target="#basicModal" style="float:right;">
                            Tambah Tahun Akademik
                        </button>
                        <h4 class="card-title">List Tahun Akademik</h4>
                        <div class="modal fade" id="basicModal">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Form Tambah Tahun Akademik</h5>
                                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                        </button>
                                    </div>
                                    <form action="" method="POST">
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="form_thmulai">Tahun Mulai</label>
                                                <input type="text" class="form-control"
                                                       id="form_thmulai"
                                                       name="form_thmulai" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="form_thselesai">Tahun Selesai</label>
                                                <input type="text" class="form-control"
                                                       id="form_thselesai"
                                                       name="form_thselesai" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="form_th">Angkatan</label>
                                                <input type="text" class="form-control"
                                                       id="form_th"
                                                       name="form_th" required>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal" style="color:white;">
                                                Close
                                            </button>
                                            <button class="btn btn-primary">Tambah Tahun</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover" id="table">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Tahun Akademik</th>
                                    <th scope="col">Angkatan</th>
                                    <th scope="col">Status</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($tahun_akademik as $i => $data)
                                    <tr>
                                        <th>{{$i+=1}}.</th>
                                        <td>{{$data->thnAkademik_yearstart}} / {{$data->thnAkademik_yearend}}</td>
                                        <td>{{$data->thnAkademik_year}}</td>
                                        <td>
                                            @if($data->thnAkademik_active == 1)
                                                <span class="badge badge-success">Active</span>
                                            @else
                                                <span class="badge badge-dark">Disable</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ base_url('thakademik/show/'.$data->thnAkademik_id) }}"
                                               class="btn mb-1 btn-info">Detail</a>
                                            <button type="button"
                                                    class="btn mb-1 btn-outline-info update_btn"
                                                    data-id="{{ $i }}"
                                                    data-uid="{{ $data->thnAkademik_id }}">
                                                Switch Status
                                            </button>
                                            <button type="button"
                                                    class="btn mb-1 btn-outline-danger"
                                                    data-toggle="modal" data-target="#ubahModal{{$i}}">
                                                Hapus
                                            </button>
                                            <div class="modal fade" id="ubahModal{{$i}}">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Form Hapus Tahun Akademik</h5>
                                                            <button type="button" class="close" data-dismiss="modal">
                                                                <span>&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Apakah yakin menghapus tahun akademik?
                                                            <b>Data yang telah dihapus tidak dapat dikembalikan</b>.
                                                            Pastikan data belum digunakan agar integritas data terjaga.
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal" style="color:white;">
                                                                TIDAK
                                                            </button>
                                                            <button data-id="{{ $i }}"
                                                                    data-uid="{{ $data->thnAkademik_id }}"
                                                                    class="btn-hapus btn btn-danger">
                                                                YAKIN
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
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
    <script src="{{base_url('assets/plugins/tables/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{base_url('assets/plugins/tables/js/datatable/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{base_url('assets/plugins/toastr/js/toastr.min.js')}}"></script>
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

            $(".update_btn").on('click', function () {
                showToast();
                let formId = $(this).data("uid");
                let postForm = {
                    'id': formId,
                };
                $.ajax({
                    url: '{{ base_url('api/v1/year/switch') }}',
                    method: 'post',
                    data: postForm,
                    success: function (data) {
                        let response = JSON.parse(data);
                        if (response['status']) {
                            location.reload();
                        } else {
                            alert("Gagal mengubah data");
                        }
                    }
                });
            });

            $(".btn-hapus").on("click", function () {
                showToast();
                let formId = $(this).data("uid");
                let postForm = {
                    'form_id': formId,
                };
                $.ajax({
                    url: '{{ base_url('api/thnakademik/deleteRow') }}',
                    method: 'post',
                    data: postForm,
                    success: function (data) {
                        let response = JSON.parse(data);
                        if (response['status']) {
                            location.reload();
                        } else {
                            alert("Gagal mengubah data");
                        }
                    }
                });
            });
        });

        function showToast() {
            toastr.info("Permintaan sedang diproses", "Mohon Tunggu",
                {
                    positionClass: "toast-top-center",
                    timeOut: 5.0e3,
                    closeButton: 0,
                    debug: 1,
                    newestOnTop: 0,
                    progressBar: 0,
                    preventDuplicates: 0,
                    onclick: null,
                    showDuration: "600",
                    hideDuration: "1000",
                    extendedTimeOut: "1000",
                    showEasing: "swing",
                    hideEasing: "linear",
                    showMethod: "fadeIn",
                    hideMethod: "fadeOut",
                    tapToDismiss: 1
                });
        }
    </script>
@endsection
