@layout('template/back/main')

@section('scripts-css')
    <link href="{{base_url('assets/plugins/tables/css/datatable/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
    <link href="{{base_url('assets/plugins/toastr/css/toastr.min.css')}}" rel="stylesheet">
@endsection
@section('content')
    <div class="container-fluid">
        </br>
        <h3> {{ $title }}</h3>
        </br>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Daftar Kegiatan Yang Saya Rekam</h4>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover" id="table">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Kegiatan</th>
                                    <th scope="col">Periode</th>
                                    <th scope="col">Jumlah Peserta</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <th class="sorting_1">1.</th>
                                    <td>DCU</td>
                                    <td>Mei 2025</td>
                                    <td>
                                        125                                                                                                                    </td>
                                    <td>
                                        <a href="{{ base_url('recordHistories/detail/1') }}" class="btn mb-1 btn-info">Detail</a>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="sorting_1">2.</th>
                                    <td>MCU</td>
                                    <td>Februari 2025</td>
                                    <td>
                                        255
                                    </td>
                                    <td>
                                        <a href="{{ base_url('recordHistories/detail/1') }}" class="btn mb-1 btn-info">Detail</a>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="sorting_1">3.</th>
                                    <td>DCU</td>
                                    <td>Oktober 2024</td>
                                    <td>
                                        355                                                                                                                    </td>
                                    <td>
                                        <a href="{{ base_url('recordHistories/detail/1') }}" class="btn mb-1 btn-info">Detail</a>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="sorting_1">4.</th>
                                    <td>MCU</td>
                                    <td>November 2024</td>
                                    <td>
                                        255
                                    </td>
                                    <td>
                                        <a href="{{ base_url('recordHistories/detail/1') }}" class="btn mb-1 btn-info">Detail</a>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="sorting_1">5.</th>
                                    <td>SCR</td>
                                    <td>Agustus 2024</td>
                                    <td>
                                        125
                                    </td>
                                    <td>
                                        <a href="{{ base_url('recordHistories/detail/1') }}" class="btn mb-1 btn-info">Detail</a>
                                    </td>
                                </tr>
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
    <script >
        $(document).ready(function(){
            let table = $("#table").DataTable({
                "pageLength": 50,
            });
        });
    </script>
@endsection
