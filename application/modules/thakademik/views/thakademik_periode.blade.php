@layout('template/back/main')

@section('scripts-css')
    <link href="{{ base_url('assets/plugins/tables/css/datatable/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ base_url('assets/plugins/toastr/css/toastr.min.css') }}" rel="stylesheet">
@endsection
@section('content')
    <div class="container-fluid">
        <br/>
        <h3> {{ $title }} - {{ $thn->thnAkademik_yearstart }} / {{ $thn->thnAkademik_yearend }}</h3>
        <br/>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#basicModal"
                                style="float:right;">
                            Tambah Periode
                        </button>
                        <h4 class="card-title">List Periode </h4>
                        <div class="modal fade" id="basicModal">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Form Tambah Periode</h5>
                                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                        </button>
                                    </div>
                                    <form action="" method="POST">
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="form_kegiatan">Nama Kegiatan</label>
                                                <select name="form_kegiatan"
                                                        id="form_kegiatan"
                                                        class="form-control">
                                                    <option value="">--- Pilih Kegiatan ---</option>
                                                    <option value="MCU">Medical Check Up</option>
                                                    <option value="DCU">Dental Check Up</option>
                                                    <option value="SCR">Screening</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="form_bulan">Bulan</label>
                                                <select name="form_bulan"
                                                        id="form_bulan"
                                                        class="form-control">
                                                    <option value="Januari">Januari</option>
                                                    <option value="Februari">Februari</option>
                                                    <option value="Maret">Maret</option>
                                                    <option value="April">April</option>
                                                    <option value="Mei">Mei</option>
                                                    <option value="Juni">Juni</option>
                                                    <option value="Juli">Juli</option>
                                                    <option value="Agustus">Agustus</option>
                                                    <option value="September">September</option>
                                                    <option value="Oktober">Oktober</option>
                                                    <option value="November">November</option>
                                                    <option value="Desember">Desember</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="form_thn">Tahun</label>
                                                <input type="text"
                                                       id="form_thn"
                                                       class="form-control" name="form_thn" required>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" style="color:white;" class="btn btn-secondary"
                                                    data-dismiss="modal">Close
                                            </button>
                                            <button class="btn btn-primary">Save changes</button>
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
                                    <th scope="col">Kegiatan</th>
                                    <th scope="col">Periode</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($jadwal as $i => $data)
                                    <tr>
                                        <th>{{ $i+=1 }}.</th>
                                        <td>{{ formatKegiatan($data->periode_name) }}</td>
                                        <td>{{ $data->periode_monthName }} {{ $data->periode_year }}</td>
                                        <td>
                                            @if($data->periode_active == 1)
                                                <span class="badge badge-success"
                                                      style="color:white;">Active</span>
                                            @else
                                                <span class="badge badge-dark">Disable</span>
                                            @endif
                                        </td>
                                        <td>
                                            <button class="btn mb-1 btn-outline-info switch_btn"
                                                    data-id="{{ $i }}"
                                                    data-uid="{{ $data->periode_id }}"
                                                    data-status="{{ $data->periode_active }}">
                                                Switch Status
                                            </button>
                                            <button type="button" class="btn mb-1 btn-outline-secondary"
                                                    data-toggle="modal" data-target="#ubahModal{{ $i }}">
                                                Ubah
                                            </button>
                                            <div class="modal fade" id="ubahModal{{ $i }}">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Form Ubah Jadwal</h5>
                                                            <button type="button" class="close" data-dismiss="modal">
                                                                <span>&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body col-lg-10">
                                                            <div class="form-group">
                                                                <label for="kegiatan{{ $i }}">
                                                                    Nama Kegiatan
                                                                </label>
                                                                <select id="kegiatan{{ $i }}"
                                                                        class="form-control">
                                                                    <option value="">--- Pilih Kegiatan ---</option>
                                                                    <?php
                                                                        $isMCU = ($data->periode_name == 'MCU')
                                                                    ?>
                                                                    <option
                                                                            value="MCU"
                                                                            {{ $isMCU ? 'selected' : '' }}>
                                                                        Medical Check Up
                                                                    </option>
                                                                    <?php
                                                                    $isDCU = ($data->periode_name == 'DCU')
                                                                    ?>
                                                                    <option value="DCU"
                                                                            {{ $isDCU ? 'selected' : '' }}>
                                                                        Dental Check Up
                                                                    </option>
                                                                    <?php
                                                                    $isSCR = ($data->periode_name == 'SCR')
                                                                    ?>
                                                                    <option value="SCR"
                                                                            {{ $isSCR ? 'selected' : '' }}>
                                                                        Screening
                                                                    </option>
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="bulan{{ $i }}">Bulan</label>
                                                                <select id="bulan{{ $i }}"
                                                                        class="form-control">
                                                                    <?php
                                                                        $isJan = ($data->periode_monthName == 'Januari')
                                                                    ?>
                                                                    <option
                                                                            value="Januari"
                                                                            {{ $isJan ? 'selected' : '' }}>
                                                                        Januari
                                                                    </option>
                                                                    <?php
                                                                    $isFeb = ($data->periode_monthName == 'Februari')
                                                                    ?>
                                                                    <option value="Februari"
                                                                            {{ $isFeb ? 'selected' : '' }}>
                                                                        Februari
                                                                    </option>
                                                                    <?php
                                                                    $isMarch = ($data->periode_monthName == 'Maret')
                                                                    ?>
                                                                    <option value="Maret"
                                                                            {{ $isMarch ? 'selected' : '' }}>
                                                                        Maret
                                                                    </option>
                                                                    <?php
                                                                    $isApr = ($data->periode_monthName == 'April')
                                                                    ?>
                                                                    <option value="April"
                                                                            {{ $isApr ? 'selected' : '' }}>
                                                                        April
                                                                    </option>
                                                                    <?php
                                                                    $isMei = ($data->periode_monthName == 'Mei')
                                                                    ?>
                                                                    <option value="Mei"
                                                                            {{ $isMei ? 'selected' : '' }}>
                                                                        Mei
                                                                    </option>
                                                                    <?php
                                                                    $isJun = ($data->periode_monthName == 'Juni')
                                                                    ?>
                                                                    <option value="Juni"
                                                                            {{ $isJun ? 'selected' : '' }}>
                                                                        Juni
                                                                    </option>
                                                                    <?php
                                                                    $isJul = ($data->periode_monthName == 'Juli')
                                                                    ?>
                                                                    <option value="Juli"
                                                                            {{ $isJul ? 'selected' : '' }}>
                                                                        Juli
                                                                    </option>
                                                                    <?php
                                                                    $isAug = ($data->periode_monthName == 'Agustus')
                                                                    ?>
                                                                    <option value="Agustus"
                                                                            {{ $isAug ? 'selected' : '' }}>
                                                                        Agustus
                                                                    </option>
                                                                    <?php
                                                                    $isSept = ($data->periode_monthName == 'September')
                                                                    ?>
                                                                    <option value="September"
                                                                            {{ $isSept ? 'selected' : '' }}>
                                                                        September
                                                                    </option>
                                                                    <?php
                                                                        $isOct = ($data->periode_monthName == 'Oktober')
                                                                    ?>
                                                                    <option value="Oktober"
                                                                            {{ $isOct ? 'selected' : '' }}>
                                                                        Oktober
                                                                    </option>
                                                                    <?php
                                                                    $isNov = ($data->periode_monthName == 'November')
                                                                    ?>
                                                                    <option value="November"
                                                                            {{ $isNov ? 'selected' : '' }}>
                                                                        November
                                                                    </option>
                                                                    <?php
                                                                    $isDec = ($data->periode_monthName == 'Desember')
                                                                    ?>
                                                                    <option value="Desember"
                                                                            {{ $isDec ? 'selected' : '' }}>
                                                                        Desember
                                                                    </option>
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="thn{{ $i }}">Tahun</label>
                                                                <input type="text"
                                                                       class="form-control"
                                                                       id="thn{{ $i }}"
                                                                       value="{{ $data->periode_year }}"
                                                                       required>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                    style="color:white;"
                                                                    data-dismiss="modal">Close
                                                            </button>
                                                            <button data-id="{{ $i }}"
                                                                    data-uid="{{ $data->periode_id }}"
                                                                    class="btn-ubah btn btn-primary">
                                                                Save changes
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
    <script src="{{ base_url('assets/plugins/tables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ base_url('assets/plugins/tables/js/datatable/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ base_url('assets/plugins/toastr/js/toastr.min.js') }}"></script>
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

            $(".switch_btn").on('click', function () {
                showToast();
                let formId = $(this).data("uid");
                let status = $(this).data("status");
                let postForm = {
                    'id': formId,
                    'status': status
                };
                $.ajax({
                    url: '{{ base_url('api/v1/periode/switch') }}',
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
            $(".btn-ubah").on('click', function () {
                let id = $(this).data('id');
                let formId = $(this).data('uid');
                let postForm = {
                    'id': formId,
                    'periode': document.getElementById('kegiatan' + id).value,
                    'month': document.getElementById('bulan' + id).value,
                    'year': document.getElementById('thn' + id).value,
                };
                $.ajax({
                    url: '{{ base_url('api/v1/periode/update') }}',
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
